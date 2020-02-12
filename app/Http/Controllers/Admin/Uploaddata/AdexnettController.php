<?php

namespace App\Http\Controllers\Admin\Uploaddata;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Adexnett;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

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
                        case 'month':
                            switch($val){
                                case 'Januari':
                                    $mon = '01';
                                    break;
                                case 'Februari':
                                    $mon = '02';
                                    break;
                                case 'Maret':
                                    $mon = '03';
                                    break;
                                case 'April':
                                    $mon = '04';
                                    break;
                                case 'Mei':
                                    $mon = '05';
                                    break;
                                case 'Juni':
                                    $mon = '06';
                                    break;
                                case 'Juli':
                                    $mon = '07';
                                    break;
                                case 'Agustus':
                                    $mon = '08';
                                    break;
                                case 'September':
                                    $mon = '09';
                                    break;
                                case 'Oktober':
                                    $mon = '10';
                                    break;
                                case 'November':
                                    $mon = '11';
                                    break;
                                case 'Desember':
                                    $mon = '12';
                                    break;
                                default:
                                    $mon = '01';
                            }
                            $dt = $line['year']."-".$mon."-01";
                            $date = Carbon::createFromFormat('Y-m-d H:i:s',$dt.' 00:00:00')->toDateTimeString();
                            $insertData[$colname] = $val;
                            $insertData['date'] = $dt;
                            $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                            break;
                        default:
                            $insertData[$colname] = $val;
                    }
                }
                return Adexnett::create($insertData);
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
