<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Tvchighlight;
use \Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use Auth;

class TvchighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tvchighlight.index');
    }
    public function indexjson()
    {
        $query = Tvchighlight::select('title','description')->whereNotNull('_id')->orderBy('created_at');
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.tvchighlight.action',compact('dt'));
        })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tvchighlight.createupdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['filename'] = '';
        $tvc = Tvchighlight::create($requestData);        
        //upload video
        if ($request->hasFile('filename')) {
            $filename = $request->file('filename');
            $name = $tvc->_id.'.'.$filename->getClientOriginalExtension();
            $filename->move(base_path('public/uploads/tvchighlight'), $name);  
        }else{
            Session::flash('message', 'No file uploaded'); 
            Session::flash('alert-class', 'alert-error'); 
            return redirect('admin/tvchighlight');
        }
        $tvc->update(['filename' => $name]);
        Session::flash('message', 'TVC Highlight disimpan'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/tvchighlight');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Tvchighlight::find($id);
        return view('admin.tvchighlight.createupdate',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tvc = Tvchighlight::find($id);
        if($tvc){
            //delete old video //upload video
            if ($request->hasFile('filename')) {
                if(isset($tvc->filename)){
                    @unlink(base_path('public/uploads/tvchighlight/'. $tvc->filename));
                }
                $filename = $request->file('filename');
                $name = $tvc->_id.'.'.$filename->getClientOriginalExtension();
                $filename->move(base_path('public/uploads/tvchighlight'), $name);  
            }
            $requestData = $request->all();
            $requestData['filename'] = $tvc->filename;
            $tvc->update($requestData);
            Session::flash('message', 'TVC Highlight diubah'); 
            Session::flash('alert-class', 'alert-success'); 
        }
        return redirect('admin/tvchighlight');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tvc = Tvchighlight::find($id);
        //delete video
        if(isset($tvc->filename)){
            @unlink(base_path('public/uploads/tvchighlight/'. $tvc->filename));
        }
        Tvchighlight::destroy($id);
        Session::flash('message', 'TVC Highlight dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/tvchighlight');
    }
}
