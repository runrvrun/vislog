<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercial;

class AdsperformanceController extends Controller
{
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
        return view('admin.adsperformance');
    }

    public function indexjson(Request $request)
    {
        $filterchannel = explode(',',$request->filterchannel);
        $query = Commercial::select('date','channel','iprogramme','iproduct','iadstype','start_time',
        'duration','cost','tvr01','000s01')
        ->whereIn('channel',$filterchannel)
        ->get();
        return datatables($query
        )
        ->toJson();
    }

}
