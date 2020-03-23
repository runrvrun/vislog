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
        $sumtopchannel = 0;
        $data['marketshare_channel'] = [];
        foreach ($channel as $key=>$val){
            foreach($query as $k=>$v){
                if($v->_id->channel == $val->channel){
                    if($sum_marketshare_channel > 0){
                        $data['marketshare_channel'][] = ['channel'=>$val->channel,'marketshare'=>$v->total,'percentage'=>$v->total/$sum_marketshare_channel];
                    }else{
                        $data['marketshare_channel'][] = ['channel'=>$val->channel,'marketshare'=>$v->total,'percentage'=>0];
                    }
                    $sumtopchannel += $v->total;
                }
            }
        }
        if($sum_marketshare_channel > 0){
            $data['marketshare_channel'][] = ['channel'=>'OTHER','marketshare'=>($sum_marketshare_channel-$sumtopchannel),'percentage'=>($sum_marketshare_channel-$sumtopchannel)/$sum_marketshare_channel];
        }else{
            $data['marketshare_channel'][] = ['channel'=>'OTHER','marketshare'=>($sum_marketshare_channel-$sumtopchannel),'percentage'=>0];
        }
        // market share per month
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
        foreach($query as $key=>$val){
            $cmonth = Carbon::parse($val->_id->isodate->toDateTime());
            $month = $cmonth->format('MY');
            ${'totalall'.$month} = (${'totalall'.$month} ?? 0) + $val->total;
            $totalmonth[$month]['all'] = ${'totalall'.$month};
            $totalmonth[$month][$val->_id->channel]['marketshare'] = $val->total;
        }
        foreach($totalmonth as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalmonth[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        $data['marketshare_channel_month'] = $totalmonth;
        // market share per month
        $totalmonth = [];
        $monthlist = [];
        foreach($query as $key=>$val){
            $cmonth = Carbon::parse($val->_id->isodate->toDateTime());
            $month = $cmonth->format('MY');
            $monthlist[] = $month;
            $totalmonth[$val->_id->channel][$month]['marketshare'] = $val->total;
        }
        $data['marketshare_month_channel'] = $totalmonth;
        $data['monthlist'] = array_unique($monthlist);
        // top 10 agency
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'agency'=>'$agency'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ]
            ]));
        });
        // sum all
        $totalagency = [];
        foreach($query as $key=>$val){
            $agency = $val->_id->agency;
            $totalagency[$agency][$val->_id->channel]['marketshare'] = $val->total;
            ${'totalall'.$agency} = (${'totalall'.$agency} ?? 0) + $val->total;
            $totalagency[$agency]['all'] = ${'totalall'.$agency};
        }
        foreach($totalagency as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalagency[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        uasort($totalagency, function($a, $b) {
            return $b['all'] <=> $a['all'];
        });
        $data['marketshare_channel_agency'] = array_slice($totalagency, 0, 10, true);

        //
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'nadvertiser'=>'$nadvertiser'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ]
            ]));
        });
        // sum all
        $totaladvertiser = [];        
        foreach($query as $key=>$val){
            $advertiser = $val->_id->nadvertiser;
            $totaladvertiser[$advertiser][$val->_id->channel]['marketshare'] = $val->total;
            ${'totalall'.$advertiser} = (${'totalall'.$advertiser} ?? 0) + $val->total;
            $totaladvertiser[$advertiser]['all'] = ${'totalall'.$advertiser};
        }
        foreach($totaladvertiser as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totaladvertiser[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        uasort($totaladvertiser, function($a, $b) {
            return $b['all'] <=> $a['all'];
        });
        $data['marketshare_channel_advertiser'] = array_slice($totaladvertiser, 0, 10, true);
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'nproduct'=>'$nproduct'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ],
                [
                    '$limit' => 10
                ]
            ]));
        });
        // sum all
        $totalproduct = [];
        foreach($query as $key=>$val){
            $product = $val->_id->nproduct;
            $totalproduct[$product][$val->_id->channel]['marketshare'] = $val->total;
            ${'totalall'.$product} = (${'totalall'.$product} ?? 0) + $val->total;
            $totalproduct[$product]['all'] = ${'totalall'.$product};
        }
        foreach($totalproduct as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalproduct[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        uasort($totalproduct, function($a, $b) {
            return $b['all'] <=> $a['all'];
        });
        $data['marketshare_channel_product'] = array_slice($totalproduct, 0, 10, true);
        //
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'nsector'=>'$nsector'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ],
                [
                    '$limit' => 10
                ]
            ]));
        });
        // sum all
        $totalsector = [];
        foreach($query as $key=>$val){
            $sector = $val->_id->nsector;
            $totalsector[$sector][$val->_id->channel]['marketshare'] = $val->total;
            ${'totalall'.$sector} = (${'totalall'.$sector} ?? 0) + $val->total;
            $totalsector[$sector]['all'] = ${'totalall'.$sector};
        }
        foreach($totalsector as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalsector[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        uasort($totalsector, function($a, $b) {
            return $b['all'] <=> $a['all'];
        });
        $data['marketshare_channel_sector'] = array_slice($totalsector, 0, 10, true);

        //
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
