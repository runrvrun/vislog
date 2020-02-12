<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Tvprogrammesearch;
use Session;
use Auth;

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
            $query = Tvprogrammesearch::select('nprogramme')->where('nprogramme','like','%'.$request->term.'%')->groupBy('nprogramme');
            if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nprogramme')->take(50)->groupBy('nprogramme');
            if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));
            return $query->get();
        }
    }

    public function searchnlevel1json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('nlevel1')->where('nlevel1','like','%'.$request->term.'%')->groupBy('nlevel1');
            if(!empty(Auth::user()->privileges['nlevel1'])) $query->whereIn('nlevel1',explode(',',Auth::user()->privileges['nlevel1']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nlevel1')->take(50)->groupBy('nlevel1');
            if(!empty(Auth::user()->privileges['nlevel1'])) $query->whereIn('nlevel1',explode(',',Auth::user()->privileges['nlevel1']));
            return $query->get();
        }
    }
    
    public function searchnlevel2json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('nlevel2')->where('nlevel2','like','%'.$request->term.'%')->groupBy('nlevel2');
            if(!empty(Auth::user()->privileges['nlevel2'])) $query->whereIn('nlevel2',explode(',',Auth::user()->privileges['nlevel2']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nlevel2')->take(50)->groupBy('nlevel2');
            if(!empty(Auth::user()->privileges['nlevel2'])) $query->whereIn('nlevel2',explode(',',Auth::user()->privileges['nlevel2']));
            return $query->get();
        }
    }
}
