<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Channel;
use Session;
use Auth; 

class ChannelController extends Controller
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
        return view('admin.channel.index');
    }

    public function indexjson()
    {
        return datatables(Channel::all())
        ->addColumn('action', function ($dt) {
            return view('admin.channel.action',compact('dt'));
        })->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $item = Channel::find($channel->id);
        return view('admin.channel.createupdate',compact('item'));
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
        $requestData['channel'] = $request->channel;
        $requestData['order'] = $request->order;
        Channel::find($request->id)->update($requestData);
        Session::flash('message', 'Channel diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/channel');
    }

    public function searchjson(Request $request)
    {
        if(isset($request->term)){
            $query = Channel::select('channel')->whereNotNull('channel')->where('channel','like','%'.$request->term.'%');
            if(!empty(Auth::user()->privileges['channel'])) $query->whereIn('channel',explode(',',Auth::user()->privileges['channel']));
            return $query->get();
        }else{
            $query = Channel::select('channel')->whereNotNull('channel')->take(50);
            if(!empty(Auth::user()->privileges['channel'])) $query->whereIn('channel',explode(',',Auth::user()->privileges['channel']));
            return $query->get();
        }
    }

}
