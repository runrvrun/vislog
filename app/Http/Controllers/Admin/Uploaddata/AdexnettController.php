<?php

namespace App\Http\Controllers\Admin\Uploaddata;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Adexnett;
use App\Log;
use Auth;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use MongoDB\Client;

class AdexnettController extends Controller
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
        return view('admin.uploaddata.adexnett');
    }

    public function indexjson()
    {
        $query = Adexnett::raw(function($collection)
        {
            return $collection->aggregate([
                [
                    '$group'    => [
                        '_id'   => [
                            'date'=>'$date',
                            'year'=>'$year',
                            'month'=>'$month',
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
        Log::create(['user_id'=>Auth::user()->id,'action'=>'data update - adexnett','date'=>date('Y-m-d')]);
        $upload_path = 'uploads/temp';
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $upload_filename = Carbon::now()->format('YmdHis').$filename;
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
            //         switch($colname){
            //             case 'month':
            //                 switch($val){
            //                     case 'Januari':
            //                         $mon = '01';
            //                         break;
            //                     case 'Februari':
            //                         $mon = '02';
            //                         break;
            //                     case 'Maret':
            //                         $mon = '03';
            //                         break;
            //                     case 'April':
            //                         $mon = '04';
            //                         break;
            //                     case 'Mei':
            //                         $mon = '05';
            //                         break;
            //                     case 'Juni':
            //                         $mon = '06';
            //                         break;
            //                     case 'Juli':
            //                         $mon = '07';
            //                         break;
            //                     case 'Agustus':
            //                         $mon = '08';
            //                         break;
            //                     case 'September':
            //                         $mon = '09';
            //                         break;
            //                     case 'Oktober':
            //                         $mon = '10';
            //                         break;
            //                     case 'November':
            //                         $mon = '11';
            //                         break;
            //                     case 'Desember':
            //                         $mon = '12';
            //                         break;
            //                     default:
            //                         $mon = '01';
            //                 }
            //                 $dt = $line['Year']."-".$mon."-01";
            //                 $date = Carbon::createFromFormat('Y-m-d H:i:s',$dt.' 00:00:00')->toDateTimeString();
            //                 $insertData[$colname] = str_replace('�',' ',$val);
            //                 $insertData['key'] = $key;
            //                 $insertData['date'] = $dt;
            //                 $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            //                 break;
            //             default:
            //                 $insertData[$colname] = str_replace('�',' ',$val);
            //         }
            //     }
            //     return Adexnett::create($insertData);
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
                                case 'year':
                                    $insertData['year'] = $value;
                                    $year = $value;
                                    break;
                                case 'month':
                                    switch($value){
                                        case 'Januari':
                                        case 'January':
                                            $mon = '01';
                                            break;
                                        case 'Februari':
                                        case 'February':
                                        case 'Pebruari':
                                            $mon = '02';
                                            break;
                                        case 'Maret':
                                        case 'March':
                                            $mon = '03';
                                            break;
                                        case 'April':
                                            $mon = '04';
                                            break;
                                        case 'Mei':
                                        case 'May':
                                            $mon = '05';
                                            break;
                                        case 'Juni':
                                        case 'June':
                                            $mon = '06';
                                            break;
                                        case 'Juli':
                                        case 'July':
                                            $mon = '07';
                                            break;
                                        case 'Agustus':
                                        case 'August':
                                            $mon = '08';
                                            break;
                                        case 'September':
                                            $mon = '09';
                                            break;
                                        case 'Oktober':
                                        case 'October':
                                            $mon = '10';
                                            break;
                                        case 'November':
                                            $mon = '11';
                                            break;
                                        case 'Desember':
                                        case 'December':
                                            $mon = '12';
                                            break;
                                        default:
                                            $mon = '01';
                                    }
                                    $insertData['month'] = $value;
                                    $dt = $year."-".$mon."-01";
                                    $insertData['date'] = $dt;
                                    $date = Carbon::createFromFormat('Y-m-d H:i:s',$dt.' 00:00:00')->toDateTimeString();
                                    $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));                                        
                                    break;
                                case 'spots':
                                case 'grp':
                                case 'gross':
                                case 'revenue':
                                case 'nett1':
                                case 'nett2':
                                case 'nett3':
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
                            $mongodata=$mongoClient->vislog->adexnetts;
                            $mongodata->insertMany($insert);
                            $insert = [];// reset
                        }
                    }
                    $i = $i+1; //increment = no longer header
                }
                if(count($insert) > 0){                
                    $mongoClient=new Client();
                    $mongodata=$mongoClient->vislog->adexnetts;                            
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
        // dd($request->all());
        $dates = explode(",",htmlentities($request->date));
        foreach($dates as $date){
            Adexnett::where('date',$date)->delete();
        }
        return redirect('admin/uploaddata/adexnett');
    }

    public function csvall()
    {
        $exp = [];
        $export = Adexnett::raw(function($collection)
        {
            return $collection->aggregate([
                [
                    '$group'    => [
                        '_id'   => [
                            'year'=>'$year',
                            'month'=>'$month',
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
            $exp[$key]['count'] = $val->count;
        }
        $filename = 'vislog-adexnett-upload.csv';
        $temp = 'uploads/temp/'.$filename;
        (new FastExcel($exp))->export($temp);
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
}
