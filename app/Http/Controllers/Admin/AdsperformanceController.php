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
        $filteriprogramme = array_filter(explode(',',$request->filteriprogramme));
        $filternlevel_1 = array_filter(explode(',',$request->filternlevel_1));
        $filterilevel_1 = array_filter(explode(',',$request->filterilevel_1));
        $filternlevel_2 = array_filter(explode(',',$request->filternlevel_2));
        $filterilevel_2 = array_filter(explode(',',$request->filterilevel_2));
        $filternadvertiser = array_filter(explode(',',$request->filternadvertiser));
        $filteriadvertiser = array_filter(explode(',',$request->filteriadvertiser));
        $filternproduct = array_filter(explode(',',$request->filternproduct));
        $filteriproduct = array_filter(explode(',',$request->filteriproduct));
        $filternsector = array_filter(explode(',',$request->filternsector));
        $filterisector = array_filter(explode(',',$request->filterisector));
        $filterncategory = array_filter(explode(',',$request->filterncategory));
        $filtericategory = array_filter(explode(',',$request->filtericategory));
        $filternadstype = array_filter(explode(',',$request->filternadstype));
        $filteriadstype = array_filter(explode(',',$request->filteriadstype));
        $filtertadstype = array_filter(explode(',',$request->filtertadstype));
        $filterntargetaudience = $request->filterntargetaudience ?? '01';
        
        // 'date'=> ['$dateToString' => ['format' => '%d-%m-%Y', 'date' => '$date', 'timezone' => '+07:00' ]] ,
        if($request->filterncommercialdata == 'grouped'){
            $query = Commercialgrouped::select('date','channel',
            'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
            'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
            'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
            'start_time','end_time','duration','no_of_spots','cost','t_second_cost', 
            'tvr'.$filterntargetaudience,'t_second_tvr'.$filterntargetaudience,'000s'.$filterntargetaudience,'break_type');
        }else{
            $query = Commercial::select('date','channel',
            'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
            'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
            'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
            'start_time','end_time','duration','no_of_spots','cost','t_second_cost', 
            'tvr'.$filterntargetaudience,'t_second_tvr'.$filterntargetaudience,'000s'.$filterntargetaudience,'break_type');
        }

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
        } 
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            $query->whereBetween('start_timestamp',[$starttimestamp,$endtimestamp]);
        }
        if(count($filterchannel)){
            $query->whereIn('channel',$filterchannel);
        } 
        if(count($filternprogramme)){
            $query->whereIn('nprogramme',$filternprogramme);
        } 
        if(count($filteriprogramme)){
            $query->whereIn('iprogramme',$filteriprogramme);
        } 
        if(count($filternlevel_1)){
            $query->whereIn('nlevel_1',$filternlevel_1);
        } 
        if(count($filterilevel_1)){
            $query->whereIn('ilevel_1',$filterilevel_1);
        } 
        if(count($filternlevel_2)){
            $query->whereIn('nlevel_2',$filternlevel_2);
        } 
        if(count($filterilevel_2)){
            $query->whereIn('ilevel_2',$filterilevel_2);
        } 
        if(count($filternadvertiser)){
            $query->whereIn('nadvertiser',$filternadvertiser);
        } 
        if(count($filteriadvertiser)){
            $query->whereIn('iadvertiser',$filteriadvertiser);
        } 
        if(count($filternproduct)){
            $query->whereIn('nproduct',$filternproduct);
        } 
        if(count($filteriproduct)){
            $query->whereIn('iproduct',$filteriproduct);
        } 
        if(count($filternsector)){
            $query->whereIn('nsector',$filternsector);
        } 
        if(count($filterisector)){
            $query->whereIn('isector',$filterisector);
        } 
        if(count($filterncategory)){
            $query->whereIn('ncategory',$filterncategory);
        } 
        if(count($filtericategory)){
            $query->whereIn('icategory',$filtericategory);
        } 
        if(count($filternadstype)){
            $query->whereIn('nadstype',$filternadstype);
        } 
        if(count($filteriadstype)){
            $query->whereIn('iadstype',$filteriadstype);
        } 
        if(count($filtertadstype)){
            $query->whereIn('tadstype',$filtertadstype);
        } 
        if($request->filterncommercialtype == "commercialonly"){
            $query->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }
        if($request->xadstype == "loosespot"){
            $query->where('nadstype','=','LOOSE SPOT');
        }
        if($request->xadstype == "nonloosespot"){
            $query->where('nadstype','<>','LOOSE SPOT');
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
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(',',Auth::user()->privileges['nlevel_1']));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(',',Auth::user()->privileges['nlevel_2']));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));

        // dd($query->toSql());
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

    public function get(Request $request){
        $filterntargetaudience = $request->filterntargetaudience ?? '01';
        if($request->filterncommercialdata == 'grouped'){
            $query = Commercialgrouped::select('date','channel',
            'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
            'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
            'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
            'start_time','end_time','duration','no_of_spots','cost','t_second_cost',
            'tvr'.$filterntargetaudience,'t_second_tvr'.$filterntargetaudience,'000s'.$filterntargetaudience,'break_type')
            ->where('_id',$request->id)->first();
        }else{
            $query = Commercial::select('date','channel',
            'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
            'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
            'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
            'start_time','end_time','duration','no_of_spots','cost','t_second_cost',
            'tvr'.$filterntargetaudience,'t_second_tvr'.$filterntargetaudience,'000s'.$filterntargetaudience,'break_type')
            ->where('_id',$request->id)->first();
        }
        return response($query);
    }

}
