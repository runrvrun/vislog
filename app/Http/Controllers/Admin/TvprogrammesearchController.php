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
            if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nprogramme')->take(50)->groupBy('nprogramme');
            if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']));
            return $query->get();
        }
    }
    
    public function searchiprogrammejson(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('iprogramme')->where('iprogramme','like','%'.$request->term.'%')->groupBy('iprogramme');
            if(!empty(Auth::user()->privileges['iprogramme'])) $query->whereIn('iprogramme',explode(';',Auth::user()->privileges['iprogramme']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('iprogramme')->take(50)->groupBy('iprogramme');
            if(!empty(Auth::user()->privileges['iprogramme'])) $query->whereIn('iprogramme',explode(';',Auth::user()->privileges['iprogramme']));
            return $query->get();
        }
    }

    public function searchnlevel_1json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('nlevel_1')->where('nlevel_1','like','%'.$request->term.'%')->groupBy('nlevel_1');
            if(!empty(Auth::user()->privileges['nlevel_1'])) $query->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nlevel_1')->take(50)->groupBy('nlevel_1');
            if(!empty(Auth::user()->privileges['nlevel_1'])) $query->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']));
            return $query->get();
        }
    }
    
    public function searchilevel_1json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('ilevel_1')->where('ilevel_1','like','%'.$request->term.'%')->groupBy('ilevel_1');
            if(!empty(Auth::user()->privileges['ilevel_1'])) $query->whereIn('ilevel_1',explode(';',Auth::user()->privileges['ilevel_1']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('ilevel_1')->take(50)->groupBy('ilevel_1');
            if(!empty(Auth::user()->privileges['ilevel_1'])) $query->whereIn('ilevel_1',explode(';',Auth::user()->privileges['ilevel_1']));
            return $query->get();
        }
    }
    
    public function searchnlevel_2json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('nlevel_2')->where('nlevel_2','like','%'.$request->term.'%')->groupBy('nlevel_2');
            if(!empty(Auth::user()->privileges['nlevel_2'])) $query->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('nlevel_2')->take(50)->groupBy('nlevel_2');
            if(!empty(Auth::user()->privileges['nlevel_2'])) $query->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']));
            return $query->get();
        }
    }

    public function searchilevel_2json(Request $request)
    {
        if(isset($request->term)){
            $query = Tvprogrammesearch::select('ilevel_2')->where('ilevel_2','like','%'.$request->term.'%')->groupBy('ilevel_2');
            if(!empty(Auth::user()->privileges['ilevel_2'])) $query->whereIn('ilevel_2',explode(';',Auth::user()->privileges['ilevel_2']));
            return $query->get();
        }else{
            $query = Tvprogrammesearch::select('ilevel_2')->take(50)->groupBy('ilevel_2');
            if(!empty(Auth::user()->privileges['ilevel_2'])) $query->whereIn('ilevel_2',explode(';',Auth::user()->privileges['ilevel_2']));
            return $query->get();
        }
    }
}
