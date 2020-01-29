<?php

namespace App\Http\Controllers\Admin\Uploadsearch;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Adstypesearch;
use \Carbon\Carbon;
use Session;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Imports\AdstypesImport;

class AdstypeController extends Controller
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
        return view('admin.uploadsearch.adstype');
    }

    public function indexjson()
    {
        $query = Adstypesearch::all();
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
                return Adstypesearch::create($insertData);
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
        $ids = explode(',',htmlentities($request->id));
        foreach($ids as $id){
            Adstypesearch::where('_id',$id)->delete();
        }
        Session::flash('message', 'Search Ads Type dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/uploadsearch/adstype');
    }

    public function csvall()
    {
        $export = Adstypesearch::all();
        $filename = 'vislog-adstype-search-uploaded.csv';
        $temp = 'uploads/temp/'.$filename;
        (new FastExcel($export))->export($temp);
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
}
