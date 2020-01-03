<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Adstypesearch;
use Session;

class AdstypesearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function searchnadstypejson(Request $request)
    {
        if(isset($request->term)){
            return Adstypesearch::select('nadstype')->distinct()->where('nadstype','like','%'.$request->term.'%')->get();
        }else{
            return [];
        }
    }

    public function destroymulti(Request $request)
    {
        $ids = explode(',',htmlentities($request->id));
        foreach($ids as $id){
            Adstypesearch::where('_id',$id)->delete();
        }
        Session::flash('message', 'Search Ads Type dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/uploadsearch/commercial');
    }
    
}
