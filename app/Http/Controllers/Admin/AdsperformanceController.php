<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Commercial;
use App\Commercialgrouped;
use App\User;

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
        return view('admin.adsperformance.index');
    }

    public function indexjson(Request $request)
    {
        // dd($request->all());
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
        $filterntargetaudience = $request->filterntargetaudience ?? '001';
        
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
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

}
