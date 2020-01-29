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
                    $insertData[$colname] = $val;
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
        dd($request->all());
        $dates = explode(",",htmlentities($request->date));
        foreach($dates as $date){
            Tvprogramme::where('date',$date)->delete();
        }
        return redirect('admin/uploaddata/adexnett');
    }
}
