<?php

namespace App\Http\Controllers\Admin\Uploaddata;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercial;
use App\Log;
use Auth;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

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

            // import to database
            $imp = (new FastExcel)->configureCsv(';', '}', '\n', 'gbk')->import($upload_path.'/'.$upload_filename, function ($line) {
                $insertData = [];
                foreach($line as $key=>$val){
                    $colname = strtolower($key);
                    $colname = str_replace(' ','_',$colname);
                    $colname = str_replace('.','',$colname);
                    switch($colname){
                        case 'date':
                            // $date = Carbon::createFromFormat('d/m/Y H:i:s',$val.' 00:00:00')->toDateTimeString();
                            $date = Carbon::createFromFormat('Y-m-d H:i:s',$val.' 00:00:00')->toDateTimeString();
                            $insertData[$colname] = $val;
                            $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                            break;
                        case 'start_time':
                            $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$val)->timestamp;
                            $insertData[$colname] = $val;
                            $insertData['start_timestamp'] = $timestamp;
                            break;
                        case 'count':
                            $insertData[$colname] = $val;
                            break;
                        default:
                            $insertData[$colname] = $val;
                    }
                }
                return Commercial::create($insertData);
            });

            $data['rowCount'] = $imp->count();
            
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
