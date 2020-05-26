<?php

namespace App\Http\Controllers\Admin\Uploaddata;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercial;
use App\Log;
use Auth;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Jobs\InsertCommercial;
use MongoDB\Client;

class CommercialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.uploaddata.commercial');
    }

    public function indexjson()
    {
        $query = Commercial::raw(function($collection)
        {
            return $collection->aggregate([
                [
                    '$group'    => [
                        '_id'   => [
                            'year'=>'$year',
                            'month'=>'$month',
                            'date'=>'$date',
                            // 'date'=> ['$dateToString' => ['format' => '%d-%m-%Y', 'date' => '$date', 'timezone' => '+07:00' ]] ,
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ]
            ]);
        });
        // dd($query);
        return datatables($query
        )
        ->toJson();
    }

    public function upload(Request $request)
    {             
        Log::create(['user_id'=>Auth::user()->id,'action'=>'data update - commercial','date'=>date('Y-m-d')]);
        $upload_path = 'uploads/temp';
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $upload_filename = Carbon::now()->format('Ymd').$filename;
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            $data['filename'] = $filename;
            $data['mimeType'] = $mimeType;
            $data['fileSize'] = $fileSize;

            // store file to temp folder
            $file->move($upload_path,$upload_filename);

            $header = [];
            $handle = fopen($upload_path.'/'.$upload_filename, 'r');
            if ($handle) {
                $i = 0;
                $insert = [];
                while ($line = fgetcsv($handle, null, '|')) {
                    $insertData = [];
                    if($i == 0){
                        //header, save as column name
                        $header = explode(";",$line[0]);
                        $header = array_map('strtolower', $header);
                        $header = str_replace(' ', '_', $header);
                        $header = str_replace('.', '', $header);
                    }else{
                        $content = explode(";",$line[0]);// split line into columns
                        // dd($content);
                        if(count($content)<10){
                            return response(['message'=>'Incorrect template'],400);
                        }
                        foreach( $content as $key => $value ){
                            switch($header[$key]){
                                case 'date':
                                    $insertData['date'] = $value;
                                    $date = Carbon::createFromFormat('Y-m-d H:i:s',$value.' 00:00:00')->toDateTimeString();
                                    $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                                    break;
                                case 'start_time':
                                    $insertData['start_time'] = $value;
                                    $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 '.$value)->timestamp;
                                    $insertData['start_timestamp'] = $timestamp;
                                    break;
                                case 'no_of_spots':
                                case 'cost':                  
                                    $insertData[$header[$key]] = (double) $value;
                                    break;
                                case (preg_match('/tvr.*/', $header[$key]) ? true : false) :                  
                                    $insertData[$header[$key]] = (double) $value;
                                    break;
                                default:
                                    $insertData[$header[$key]] = str_replace('�',' ',$value);
                            }
                        }
                        array_push($insert, $insertData);
                        if(count($insert) == 500){// insert after 500
                            $mongoClient=new Client();
                            $mongodata=$mongoClient->vislog->commercials;
                            $mongodata->insertMany($insert);
                            $insert = [];// reset
                        }
                    }
                    $i = $i+1; //increment = no longer header
                }
                if(count($insert) > 0){                
                    $mongoClient=new Client();
                    $mongodata=$mongoClient->vislog->commercials;                            
                    $mongodata->insertMany($insert);
                }
            } 
            unset($handle);
            unlink($upload_path.'/'.$upload_filename);

            $return = [
                'message' => 'Success',
                'data' => $data
            ];
            return response($return,200);
        }else{
            return response(['message'=>'Upload failed'],400);
        }
    }
    
    public function destroymulti(Request $request)
    {
        $dates = explode(",",htmlentities($request->date));
        foreach($dates as $date){
            Commercial::where('date',$date)->delete();
        }
        return redirect('admin/uploaddata/commercial');
    }

    public function csvall()
    {
        $exp = [];
        $export = Commercial::raw(function($collection)
        {
            return $collection->aggregate([
                [
                    '$group'    => [
                        '_id'   => [
                            'year'=>'$year',
                            'month'=>'$month',
                            'date'=>'$date',
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ]
            ]);
        });
        foreach($export as $key=>$val){
            $exp[$key]['year'] = $val->_id->year;
            $exp[$key]['month'] = $val->_id->month;
            $exp[$key]['date'] = $val->_id->date;
            $exp[$key]['count'] = $val->count;
        }
        $filename = 'vislog-commercial-uploaded.csv';
        $temp = 'uploads/temp/'.$filename;
        (new FastExcel($exp))->export($temp);
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
}
