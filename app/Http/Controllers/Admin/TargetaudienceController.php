<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Targetaudience;
use Session;
use Auth; 

class TargetaudienceController extends Controller
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
        return view('admin.targetaudience.index');
    }

    public function indexjson()
    {
        return datatables(Targetaudience::all())
        ->addColumn('action', function ($dt) {
            return view('admin.targetaudience.action',compact('dt'));
        })->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Targetaudience $targetaudience)
    {
        $item = Targetaudience::find($targetaudience->id);
        return view('admin.targetaudience.createupdate',compact('item'));
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
        $requestData['targetaudience'] = $request->targetaudience;
        Targetaudience::find($request->id)->update($requestData);
        Session::flash('message', 'Target audience diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/targetaudience');
    }

    public function searchjson(Request $request)
    {
        if(isset($request->term)){
            $query = Targetaudience::select('targetaudience')->whereNotNull('targetaudience')->where('targetaudience','like','%'.$request->term.'%')->groupBy('targetaudience');
            if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
            return $query->get();
        }else{
            $query = Targetaudience::select('targetaudience')->whereNotNull('targetaudience')->take(50)->groupBy('targetaudience');
            if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
            return $query->get();
        }
    }
}
