<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Demorequest;
use Session;
use Auth; 

class DemorequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.demorequest.index');
    }

    public function indexjson()
    {
        return datatables(Demorequest::all())
        ->addColumn('action', function ($dt) {
            return view('admin.demorequest.action',compact('dt'));
        })->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Demorequest $demorequest)
    {
        $item = Demorequest::find($demorequest->id);
        return view('admin.demorequest.createupdate',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $requestData['name'] = $request->name;
        $requestData['email'] = $request->email;
        $requestData['status'] = $request->status;
        Demorequest::find($request->id)->update($requestData);
        Session::flash('message', 'Demo request diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/demorequest');
    }

    public function destroy($id)
    {
        Demorequest::destroy($id);
        Session::flash('message', 'Demo request dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/demorequest');
    }

}
