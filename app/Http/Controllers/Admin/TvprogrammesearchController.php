<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Tvprogrammesearch;
use Session;

class TvprogrammesearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function searchnprogrammejson(Request $request)
    {
        if(isset($request->term)){
            return Tvprogrammesearch::select('nprogramme')->distinct()->where('nprogramme','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }

    public function searchnlevel_1json(Request $request)
    {
        if(isset($request->term)){
            return Tvprogrammesearch::select('nlevel1')->distinct()->where('nlevel1','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }
    
    public function searchnlevel_2json(Request $request)
    {
        if(isset($request->term)){
            return Tvprogrammesearch::select('nlevel2')->distinct()->where('nlevel2','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }
}
