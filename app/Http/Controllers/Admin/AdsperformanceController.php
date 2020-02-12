<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Commercial;
use App\Commercialgrouped;
use App\User;
use Auth;

class AdsperformanceController extends Controller
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
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');

        return view('admin.adsperformance.index',compact('data'));
    }

    public function indexjson(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->subDays(1);
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate);
        $filterchannel = array_filter(explode(',',$request->filterchannel));
        $filternprogramme = array_filter(explode(',',$request->filternprogramme));
        $filternlevel_1 = array_filter(explode(',',$request->filternlevel_1));
        $filternlevel_2 = array_filter(explode(',',$request->filternlevel_2));
        $filternadvertiser = array_filter(explode(',',$request->filternadvertiser));
        $filternproduct = array_filter(explode(',',$request->filternproduct));
        $filternsector = array_filter(explode(',',$request->filternsector));
        $filterncategory = array_filter(explode(',',$request->filterncategory));
        $filternadstype = array_filter(explode(',',$request->filternadstype));
        $filterntargetaudience = $request->filterntargetaudience ?? '01';
        
        // 'date'=> ['$dateToString' => ['format' => '%d-%m-%Y', 'date' => '$date', 'timezone' => '+07:00' ]] ,
        if($request->commercialdata == 'grouped'){
            $query = Commercialgrouped::select('date','channel','iprogramme','iproduct','iadstype','start_time',
            'duration','cost','tvr'.$filterntargetaudience,'000s'.$filterntargetaudience);
        }else{
            $query = Commercial::select('date','channel','iprogramme','iproduct','iadstype','start_time',
            'duration','cost','tvr'.$filterntargetaudience,'000s'.$filterntargetaudience);
        }

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
        } 
        if(count($filterchannel)){
            $query->whereIn('channel',$filterchannel);
        } 
        if(count($filternprogramme)){
            $query->whereIn('nprogramme',$filternprogramme);
        } 
        if(count($filternlevel_1)){
            $query->whereIn('nlevel_1',$filternlevel_1);
        } 
        if(count($filternlevel_2)){
            $query->whereIn('nlevel_2',$filternlevel_2);
        } 
        if(count($filternadvertiser)){
            $query->whereIn('nadvertiser',$filternadvertiser);
        } 
        if(count($filternproduct)){
            $query->whereIn('nproduct',$filternproduct);
        } 
        if(count($filternsector)){
            $query->whereIn('nsector',$filternsector);
        } 
        if(count($filterncategory)){
            $query->whereIn('ncategory',$filterncategory);
        } 
        if(count($filternadstype)){
            $query->whereIn('nadstype',$filternadstype);
        } 
        if($request->filterncommercialtype == "commercialonly"){
            $query->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }
        // add filter by user privilege
        if(!empty(Auth::user()->privileges['startdate']))  $query->whereBetween('isodate',[Auth::user()->privileges['isostartdate']??$startdate,Auth::user()->privileges['isoenddate']??$enddate]);
        if(!empty(Auth::user()->privileges['nsector'])) $query->whereIn('nsector',explode(',',Auth::user()->privileges['nsector']));
        if(!empty(Auth::user()->privileges['ncategory']))  $query->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']));
        if(!empty(Auth::user()->privileges['nproduct']))  $query->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']));
        if(!empty(Auth::user()->privileges['nadvertiser']))  $query->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']));
        if(!empty(Auth::user()->privileges['ncopy']))  $query->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']));
        if(!empty(Auth::user()->privileges['nadstype']))  $query->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']));
        if(!empty(Auth::user()->privileges['channel']))  $query->whereIn('channel',explode(',',Auth::user()->privileges['channel']));
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(',',Auth::user()->privileges['nlevel1']));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(',',Auth::user()->privileges['nlevel2']));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));

        // dd($query->toSql());
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

}
