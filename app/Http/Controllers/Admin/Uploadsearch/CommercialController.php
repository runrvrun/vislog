<?php

namespace App\Http\Controllers\Admin\Uploadsearch;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Commercialsearch;
use \Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
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
        return view('admin.uploadsearch.commercial');
    }

    public function indexjson()
    {
        $query = Commercialsearch::all();
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
            // $imp = (new FastExcel)->configureCsv(';', '}', '\n', 'gbk')->import($upload_path.'/'.$upload_filename, function ($line) {
            //     $insertData = [];
            //     foreach($line as $key=>$val){
            //         $colname = strtolower($key);
            //         $colname = str_replace(' ','_',$colname);
            //         $colname = str_replace('.','',$colname);
            //         $insertData[$colname] = $val;
            //     }
            //     return Commercialsearch::create($insertData);
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
                            $insertData[$header[$key]] = $value;
                        }
                        array_push($insert, $insertData);
                        if(count($insert) == 500){
                            // Commercial::insertMany($insertData);// insert after 1000
                            $mongoClient=new Client();
                            $mongodata=$mongoClient->vislog->commercialsearches;
                            $mongodata->insertMany($insert);
                            $insert = [];// reset
                        }
                    }
                    $i = $i+1; //increment = no longer header
                }
                if(count($insert) > 0){                
                    $mongoClient=new Client();
                    $mongodata=$mongoClient->vislog->commercialsearches;                            
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
        $ids = explode(',',htmlentities($request->id));
        foreach($ids as $id){
            Commercialsearch::where('_id',$id)->delete();
        }
        Session::flash('message', 'Search Data Commercial dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/uploadsearch/commercial');
    }

    public function csvall()
    {
        $export = Commercialsearch::all();
        $filename = 'vislog-commercial-search-uploaded.csv';
        $temp = 'uploads/temp/'.$filename;
        (new FastExcel($export))->export($temp);
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
}
