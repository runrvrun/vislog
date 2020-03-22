<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Adexnett;
use App\Channel;
use Auth;

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
    
    public function mktsummary(Request $request)
    {
        $nett = $request->nett ?? 'nett1';

        $channel = Channel::whereNotNull('channel')->where('order','<>',999)->orderBy('order','ASC')->get();
        $data['channel'] = $channel;
        $adexnett = Adexnett::whereNotNull('_id');
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            $adexnett->whereBetween('isodate',[Auth::user()->privileges['isostartdate'],Auth::user()->privileges['isoenddate']]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['isostartdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['isoenddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            $adexnett->whereIn('nsector',explode(',',Auth::user()->privileges['nsector']));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(',',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            $adexnett->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(',',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            $adexnett->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(',',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            $adexnett->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(',',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            $adexnett->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']));
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(',',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            $adexnett->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(',',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            $adexnett->whereIn('channel',explode(',',Auth::user()->privileges['channel']));
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(',',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            $adexnett->whereIn('nlevel_1',explode(',',Auth::user()->privileges['nlevel1']));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(',',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            $adexnett->whereIn('nlevel_2',explode(',',Auth::user()->privileges['nlevel2']));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(',',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            $adexnett->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(',',Auth::user()->privileges['nprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            // TODO: change startdate to be start of month and enddate to be endofmonth
            $adexnett->whereBetween('isodate',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $adexnett->whereBetween('isodate',[Carbon::now()->subDays(1),Carbon::now()]);
            $date = Carbon::now()->subDays(1)->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::now()->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );    
        }
        if($request->channel){
            $adexnett->whereIn('channel',array_filter(explode(',',$request->channel)));
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(',',$request->channel))]]]);  
        }
        if($request->nprogramme){
            $adexnett->whereIn('nprogramme',array_filter(explode(',',$request->nprogramme)));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(',',$request->nprogramme))]]]);  
        }
        if($request->nlevel_1){
            $adexnett->whereIn('nlevel_1',array_filter(explode(',',$request->nlevel_1)));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(',',$request->nlevel_1))]]]);  
        }
        if($request->nlevel_2){
            $adexnett->whereIn('nlevel_2',array_filter(explode(',',$request->nlevel_2)));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(',',$request->nlevel_2))]]]);  
        }
        if($request->nadvertiser){
            $adexnett->whereIn('nadvertiser',array_filter(explode(',',$request->nadvertiser)));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(',',$request->nadvertiser))]]]);  
        }
        if($request->nproduct){
            $adexnett->whereIn('nproduct',array_filter(explode(',',$request->nproduct)));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(',',$request->nproduct))]]]);  
        }
        if($request->nsector){
            $adexnett->whereIn('nsector',array_filter(explode(',',$request->nsector)));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(',',$request->nsector))]]]);  
        }
        if($request->ncategory){
            $adexnett->whereIn('ncategory',array_filter(explode(',',$request->ncategory)));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(',',$request->ncategory))]]]);  
        }
        if($request->nadstype){
            $adexnett->whereIn('nadstype',array_filter(explode(',',$request->nadstype)));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(',',$request->nadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            $adexnett->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }

        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ]
            ]));
        });
        // sum all
        $sum_marketshare_channel = 0;
        foreach($query as $key=>$val){
            $sum_marketshare_channel += $val->total;
        }
        $data['marketshare_channel'] = [];
        foreach ($channel as $key=>$val){
            foreach($query as $k=>$v){
                if($val->channel == $v->_id->channel){
                    $data['marketshare_channel'][] = ['channel'=>$val->channel,'marketshare'=>$v->total,'percentage'=>$v->total/$sum_marketshare_channel];
                }
            }
        }
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'isodate'=>'$isodate'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ]
            ]));
        });
        // sum all
        $totalmonth = [];
        $totalall = 0;
        foreach($query as $key=>$val){
            $cmonth = Carbon::parse($val->_id->isodate->toDateTime());
            $month = $cmonth->format('M Y');
            $totalmonth[$month][$val->_id->channel]['marketshare'] = $val->total;
            $totalall += $val->total;
            $totalmonth[$month]['all'] = $totalall;
        }
        foreach($totalmonth as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalmonth[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        $data['marketshare_channel_month'] = $totalmonth;
        // dd($data['marketshare_channel_month']);
        $query = Adexnett::raw(function($collection) use ($filter)
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nadstype'=>'$nadstype'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ],
                    ]
                ]
            ]));
        });
        // $spotpertype['LOOSE SPOT'] = 0;
        $spotpertype['NON LOOSE SPOT'] = 0;
        foreach($query as $key=>$val){
            // group loose spot vs non loose spot (other)
            if($val->id['nadstype'] == 'LOOSE SPOT'){
                // $spotpertype['LOOSE SPOT'] = $val->total;
            }else{
                $spotpertype['NON LOOSE SPOT'] += $val->total;
            }
        }
        $data['spot_per_type'] = $spotpertype;
        //calculate spot per daypart
        $data['daypart'][0] = $adexnett->whereBetween('start_timestamp',[0,21600])->sum('no_of_spots');//00.00-06.00
        $data['daypart'][1] = $adexnett->whereBetween('start_timestamp',[21601,43200])->sum('no_of_spots');//06.00-12.00
        $data['daypart'][2] = $adexnett->whereBetween('start_timestamp',[43201,63000])->sum('no_of_spots');//12.00-17.30
        $data['daypart'][3] = $adexnett->whereBetween('start_timestamp',[63001,79200])->sum('no_of_spots');//17.30-22.00
        $data['daypart'][4] = $adexnett->whereBetween('start_timestamp',[79201,86400])->sum('no_of_spots');//22.00-00.00

        $data['spot_per_date'] = Adexnett::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [ '$sort' => [ 'date' => 1 ] ],
                [
                    '$group'    => [
                        '_id'   => [
                            'date'=>'$date',
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');

        return view('admin.mktsummary.dashboard',compact('data'));
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
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');
        
        return view('admin.spotmatching.index',compact('data'));
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
