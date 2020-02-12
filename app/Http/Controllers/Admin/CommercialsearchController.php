<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercialsearch;
use Session;
use Auth;

class CommercialsearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function searchnadvertiserjson(Request $request)
    {
        if(isset($request->term)){
            $query = Commercialsearch::select('nadvertiser')->where('nadvertiser','like','%'.$request->term.'%')->take(50)->groupBy('nadvertiser');
            if(!empty(Auth::user()->privileges['nadvertiser'])) $query->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']));
            return $query->get();
        }else{
            $query = Commercialsearch::select('nadvertiser')->take(50)->groupBy('nadvertiser');
            if(!empty(Auth::user()->privileges['nadvertiser'])) $query->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']));
            return $query->get();
        }
    }
    
    public function searchnproductjson(Request $request)
    {
        if(isset($request->term)){
            $query = Commercialsearch::select('nproduct')->where('nproduct','like','%'.$request->term.'%')->take(50)->groupBy('nproduct');
            if(!empty(Auth::user()->privileges['nproduct'])) $query->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']));
            return $query->get();
        }else{
            $query = Commercialsearch::select('nproduct')->take(50)->groupBy('nproduct');
            if(!empty(Auth::user()->privileges['nproduct'])) $query->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']));
            return $query->get();
        }
    }
    
    public function searchnsectorjson(Request $request)
    {
        if(isset($request->term)){
            $query = Commercialsearch::select('')->where('nsector','like','%'.$request->term.'%')->take(50)->groupBy('nsector');
            if(!empty(Auth::user()->privileges['nsector'])) $query->whereIn('nsector',explode(',',Auth::user()->privileges['nsector']));
            return $query->get();
        }else{
            $query = Commercialsearch::select('nsector')->take(50)->groupBy('nsector');
            if(!empty(Auth::user()->privileges['nsector'])) $query->whereIn('nsector',explode(',',Auth::user()->privileges['nsector']));
            return $query->get();
        }
    }

    public function searchncategoryjson(Request $request)
    {
        if(isset($request->term)){
            $query = Commercialsearch::select('ncategory')->where('ncategory','like','%'.$request->term.'%')->take(50)->groupBy('ncategory');
            if(!empty(Auth::user()->privileges['ncategory'])) $query->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']));
            return $query->get();
        }else{
            $query = Commercialsearch::select('ncategory')->take(50)->groupBy('ncategory');
            if(!empty(Auth::user()->privileges['ncategory'])) $query->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']));
            return $query->get();
        }
    }
    public function searchncopyjson(Request $request)
    {
        if(isset($request->term)){
            $query = Commercialsearch::select('ncopy')->where('ncopy','like','%'.$request->term.'%')->take(50)->groupBy('ncopy');
            if(!empty(Auth::user()->privileges['ncopy'])) $query->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']));
            return $query->get();
        }else{
            $query = Commercialsearch::select('ncopy')->take(50)->groupBy('ncopy');
            if(!empty(Auth::user()->privileges['ncopy'])) $query->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']));
            return $query->get();
        }
    }
}
