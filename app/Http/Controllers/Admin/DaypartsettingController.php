<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Daypartsetting;
use \Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use Auth;

class DaypartsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.daypartsetting.index');
    }
    public function indexjson()
    {
        $query = Daypartsetting::select('daypart','start_time','end_time')->whereNotNull('_id')
        ->orderBy('daypart','ASC');
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.daypartsetting.action',compact('dt'));
        })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.daypartsetting.createupdate');
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
        Daypartsetting::create($requestData);
        Session::flash('message', 'Daypart setting disimpan'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/daypartsetting');
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
        $item = Daypartsetting::find($id);
        return view('admin.daypartsetting.createupdate',compact('item'));
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
        $requestData = $request->all();
        Daypartsetting::find($id)->update($requestData);
        Session::flash('message', 'Daypart setting diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/daypartsetting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Daypartsetting::destroy($id);
        Session::flash('message', 'Daypart setting dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/daypartsetting');
    }
}
