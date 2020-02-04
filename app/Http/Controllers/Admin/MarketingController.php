<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Adexnett;
use App\Spotmatching;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function mktsummary($id)
    {
        //
    }

    public function adexnett()
    {
        return view('admin.adexnett.index');
    }

    public function adexnettjson(Request $request)
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
        
        $query = Adexnett::select('month', 'year','channel','iprogramme','iproduct','spots',
        'grp','gross','nett1','nett2','nett3');

        if($request->startdate && $request->enddate){
            // $query->whereBetween('year',[$startdate->format('m'),$enddate->format('m')]); // not working, need to handle cross year
            $query->whereBetween('year',[$startdate->format('Y'),$enddate->format('Y')]);
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
        // dd($query->toSql());
        return datatables($query->get())
        ->toJson();
    }
    
    public function spotmatching()
    {
        return view('admin.spotmatching.index');
    }

    public function spotmatchingjson(Request $request)
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
        
        $query = Spotmatching::select('date','channel','programme','product_name','copy','start_time',
        'duration\target','cost'); //di spec ada TVR, tapi di table ga ada kolom itu
    
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
        if(!empty(Auth::user()->privileges['ncategory']))  $query->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']??'%%'));
        if(!empty(Auth::user()->privileges['nproduct']))  $query->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']??'%%'));
        if(!empty(Auth::user()->privileges['nadvertiser']))  $query->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']??'%%'));
        if(!empty(Auth::user()->privileges['ncopy']))  $query->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']??'%%'));
        if(!empty(Auth::user()->privileges['nadstype']))  $query->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']??'%%'));
        if(!empty(Auth::user()->privileges['channel']))  $query->whereIn('channel',explode(',',Auth::user()->privileges['channel']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(',',Auth::user()->privileges['nlevel1']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(',',Auth::user()->privileges['nlevel2']??'%%'));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']??'%%'));

        // dd($query->toSql());
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.spotmatching.action',compact('dt'));
        })->toJson();
    }
}
