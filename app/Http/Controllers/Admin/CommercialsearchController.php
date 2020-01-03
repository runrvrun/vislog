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
            return Commercialsearch::select('nadvertiser')->distinct()->where('nadvertiser','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }
    
    public function searchnproductjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('nproduct')->distinct()->where('nproduct','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }
    
    public function searchnsectorjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('nsector')->distinct()->where('nsector','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }

    public function searchncategoryjson(Request $request)
    {
        if(isset($request->term)){
            return Commercialsearch::select('ncategory')->distinct()->where('ncategory','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }
}
