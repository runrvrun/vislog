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
            return Tvprogrammesearch::select('nprogramme')->where('nprogramme','like','%'.$request->term.'%')->groupBy('nprogramme')->get();
        }else{
            return Tvprogrammesearch::select('nprogramme')->take(50)->groupBy('nprogramme')->get();
        }
    }

    public function searchnlevel1json(Request $request)
    {
        if(isset($request->term)){
            return Tvprogrammesearch::select('nlevel1')->where('nlevel1','like','%'.$request->term.'%')->groupBy('nlevel1')->get();
        }else{
            return Tvprogrammesearch::select('nlevel1')->take(50)->groupBy('nlevel1')->get();
        }
    }
    
    public function searchnlevel2json(Request $request)
    {
        if(isset($request->term)){
            return Tvprogrammesearch::select('nlevel2')->where('nlevel2','like','%'.$request->term.'%')->groupBy('nlevel2')->get();
        }else{
            return Tvprogrammesearch::select('nlevel2')->take(50)->groupBy('nlevel2')->get();
        }
    }
}
