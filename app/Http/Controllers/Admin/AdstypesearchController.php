<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Adstypesearch;
use Session;
use Auth;

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
            $query = Adstypesearch::select('nadstype')->distinct()->where('nadstype','like','%'.$request->term.'%')->get();
            if(!empty(Auth::user()->privileges['nadstype'])) $query->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']));
            return $query->get();
        }else{
            $query = Adstypesearch::select('nadstype')->take(50)->groupBy('nadstype');
            if(!empty(Auth::user()->privileges['nadstype'])) $query->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']));
            return $query->get();
        }
    }

    public function searchiadstypejson(Request $request)
    {
        if(isset($request->term)){
            $query = Adstypesearch::select('iadstype')->distinct()->where('iadstype','like','%'.$request->term.'%')->get();
            if(!empty(Auth::user()->privileges['iadstype'])) $query->whereIn('iadstype',explode(',',Auth::user()->privileges['iadstype']));
            return $query->get();
        }else{
            $query = Adstypesearch::select('iadstype')->take(50)->groupBy('iadstype');
            if(!empty(Auth::user()->privileges['iadstype'])) $query->whereIn('iadstype',explode(',',Auth::user()->privileges['iadstype']));
            return $query->get();
        }
    }

    
    public function searchtadstypejson(Request $request)
    {
        if(isset($request->term)){
            $query = Adstypesearch::select('tadstype')->distinct()->where('tadstype','like','%'.$request->term.'%')->get();
            if(!empty(Auth::user()->privileges['tadstype'])) $query->whereIn('tadstype',explode(',',Auth::user()->privileges['tadstype']));
            return $query->get();
        }else{
            $query = Adstypesearch::select('tadstype')->take(50)->groupBy('tadstype');
            if(!empty(Auth::user()->privileges['tadstype'])) $query->whereIn('tadstype',explode(',',Auth::user()->privileges['tadstype']));
            return $query->get();
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
