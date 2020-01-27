<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commercialsearch;
use Session;

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
            return Commercialsearch::select('nadvertiser')->where('nadvertiser','like','%'.$request->term.'%')->take(50)->groupBy('nadvertiser')->get();
        }else{
            return Commercialsearch::select('nadvertiser')->take(50)->groupBy('nadvertiser')->get();
        }
    }
    
    public function searchnproductjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('nproduct')->where('nproduct','like','%'.$request->term.'%')->take(50)->groupBy('nproduct')->get();
        }else{
            return Commercialsearch::select('nproduct')->take(50)->groupBy('nproduct')->get();
        }
    }
    
    public function searchnsectorjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('nsector')->where('nsector','like','%'.$request->term.'%')->take(50)->groupBy('nsector')->get();
        }else{
            return Commercialsearch::select('nsector')->take(50)->groupBy('nsector')->get();
        }
    }

    public function searchncategoryjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('ncategory')->where('ncategory','like','%'.$request->term.'%')->take(50)->groupBy('ncategory')->get();
        }else{
            return Commercialsearch::select('ncategory')->take(50)->groupBy('ncategory')->get();
        }
    }
    public function searchncopyjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('ncopy')->where('ncopy','like','%'.$request->term.'%')->take(50)->groupBy('ncopy')->get();
        }else{
            return Commercialsearch::select('ncopy')->take(50)->groupBy('ncopy')->get();
        }
    }
}
