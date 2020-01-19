<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Session;
use Validator;
use Hash;
use \Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function indexjson()
    {
        return datatables(User::get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
        })->toJson();
    }

    public function csvall()
    {
        $export = User::all();
        $filename = 'nujeks-user.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/nujeks-user.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.createupdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|unique:users',
        ]);

        $requestData = $request->all();
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['expired_at'].' 00:00:00')->toDateTimeString();
        $requestData['isoexpired_at'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }
        User::create($requestData);
        Session::flash('message', 'User ditambahkan'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userid)
    {
        $item = user::find($userid);
        return view('admin.user.createupdate',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($userid,Request $request)
    {
        $user = User::find($userid);
        $request->validate([
            'name' => 'required|unique:users,name,'.$user->_id. ',_id',
            'email' => 'required|unique:users,email,'.$user->_id. ',_id',
        ]);
        
        $requestData = $request->all();
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['expired_at'].' 00:00:00')->toDateTimeString();
        $requestData['isoexpired_at'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }        
        User::find($user->id)->update($requestData);
        Session::flash('message', 'User diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {
        User::destroy($userid);
        Session::flash('message', 'User dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }
    
    public function destroymulti(Request $request)
    {
        $ids = htmlentities($request->id);
        User::whereRaw('_id in ('.$ids.')')->delete();
        Session::flash('message', 'User dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    public function hashunhashed()
    {
        $user = User::whereRaw('LENGTH(password) < 20')->get();
        foreach ($user as $val){
            $hashpass = Hash::make($val->password);
            User::find($val->id)->update(['password'=>$hashpass]);
        }
    }

    public function changepassword()
    {
        $token = csrf_token();
        return view('auth.passwords.change',compact('token'));
    }

    public function editpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:4|max:50',
        ]);
        
        $password = Hash::make($request->password);
        User::find(\Auth::user()->id)->update(['password'=>$password]);
                
        Session::flash('message', 'Password changed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin');
    
    }
    public function myprofile()
    {
        return view ('admin.user.myprofile');
    }
}
