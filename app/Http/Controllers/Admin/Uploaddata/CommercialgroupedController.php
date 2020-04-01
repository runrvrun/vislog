<?php

namespace App\Http\Controllers\Admin\Uploaddata;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercialgrouped;
use App\Log;
use Auth;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use MongoDB\Client;

class CommercialgroupedController extends Controller
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
        return view('admin.uploaddata.commercialgrouped');
    }

    public function indexjson()
    {
        $query = Commercialgrouped::raw(function($collection)
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
        // dd($query);
        return datatables($query
        )
        ->toJson();
    }

    public function upload(Request $request)
    {             
        Log::create(['user_id'=>Auth::user()->id,'action'=>'data update - commercial grouped','date'=>date('Y-m-d')]);
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

            // import to database
            // $imp = (new FastExcel)->configureCsv(';', '}', '\n', 'gbk')->import($upload_path.'/'.$upload_filename, function ($line) {
            //     $insertData = [];
            //     foreach($line as $key=>$val){
            //         $colname = strtolower($key);
            //         $colname = str_replace(' ','_',$colname);
            //         $colname = str_replace('.','',$colname);
            //         $insertData[$colname] = $val;
            //     }
            //     return Commercialgrouped::create($insertData);
            // });
            // $data['rowCount'] = $imp->count();

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
                        foreach( $content as $key => $value ){  
                            switch($header[$key]){
                                case 'date':
                                    $insertData['date'] = $value;
                                    $date = Carbon::createFromFormat('Y-m-d H:i:s',$value.' 00:00:00')->toDateTimeString();
                                    $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                                    break;
                                case 'start_time':
                                    $insertData['start_time'] = $value;
                                    $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$value)->timestamp;
                                    $insertData['start_timestamp'] = $timestamp;
                                    break;
                                case 'no_of_spots':
                                case 'cost':                  
                                    $insertData[$header[$key]] = (int) $value;
                                    break;
                                case (preg_match('/tvr.*/', $header[$key]) ? true : false) :                  
                                    $insertData[$header[$key]] = (double) $value;
                                    break;
                                default:
                                    $insertData[$header[$key]] = $value;
                            }                          
                        }
                        array_push($insert, $insertData);
                        if(count($insert) == 1){
                            // Commercial::insertMany($insertData);// insert after 1000
                            $mongoClient=new Client();
                            $mongodata=$mongoClient->vislog->commercialgroupeds;
                            $mongodata->insertMany($insert);
                            $insert = [];// reset
                        }
                    }
                    $i = $i+1; //increment = no longer header
                }
                if(count($insert) > 0){                
                    $mongoClient=new Client();
                    $mongodata=$mongoClient->vislog->commercialgroupeds;                            
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
            Commercialgrouped::where('date',$date)->delete();
        }
        return redirect('admin/uploaddata/commercialgrouped');
    }

    public function csvall()
    {
        $exp = [];
        $export = Commercialgrouped::raw(function($collection)
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
        $filename = 'vislog-commercialgrouped-uploaded.csv';
        $temp = 'uploads/temp/'.$filename;
        (new FastExcel($exp))->export($temp);
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
}
