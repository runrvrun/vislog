<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;

use Illuminate\Http\Request;
use App\Commercial;

class CommercialController extends Controller
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

    public function indexjson()
    {
        $query = Commercial::select('date','channel','iprogramme','iproduct','iadstype','start_time','duration','cost','tvr01','000s01')
        ->get();
        return datatables($query
        )
        ->toJson();
    }

}
