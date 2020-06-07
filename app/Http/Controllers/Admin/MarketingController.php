<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Adexnett;
use App\Spotmatching;
use App\Channel;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;

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
    
    public function mktsummary(Request $request, $action = null)
    {
        $nett = $request->nett ?? 'nett1';

        $channel = Channel::whereNotNull('channel')->where('order','<>',999)->orderBy('order','ASC')->get();
        $data['channel'] = $channel;
        $adexnett = Adexnett::whereNotNull('_id');
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['startdate'].' 00:00:00')->toDateTimeString();
            $isostartdate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['enddate'].' 00:00:00')->toDateTimeString();
            $isoenddate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $adexnett->whereBetween('isodate',[$isostartdate,$isoenddate]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isostartdate ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isoenddate ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            $adexnett->whereIn('nsector',explode(';',Auth::user()->privileges['nsector']));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            $adexnett->whereIn('ncategory',explode(';',Auth::user()->privileges['ncategory']));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            $adexnett->whereIn('nproduct',explode(';',Auth::user()->privileges['nproduct']));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            $adexnett->whereIn('nadvertiser',explode(';',Auth::user()->privileges['nadvertiser']));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            $adexnett->whereIn('ncopy',explode(';',Auth::user()->privileges['ncopy']));
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            $adexnett->whereIn('nadstype',explode(';',Auth::user()->privileges['nadstype']));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            $adexnett->whereIn('channel',explode(';',Auth::user()->privileges['channel']));
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            $adexnett->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            $adexnett->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            $adexnett->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            $adexnett->whereIn('isector',explode(';',Auth::user()->privileges['isector']));
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            $adexnett->whereIn('icategory',explode(';',Auth::user()->privileges['icategory']));
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            $adexnett->whereIn('iproduct',explode(';',Auth::user()->privileges['iproduct']));
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            $adexnett->whereIn('iadvertiser',explode(';',Auth::user()->privileges['iadvertiser']));
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            $adexnett->whereIn('advertiser_group',explode(';',Auth::user()->privileges['iadvertiser_group']));
            array_push($filter,[ '$match' => ['advertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            $adexnett->whereIn('icopy',explode(';',Auth::user()->privileges['icopy']));
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            $adexnett->whereIn('iadstype',explode(';',Auth::user()->privileges['iadstype']));
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            $adexnett->whereIn('tadstype',explode(';',Auth::user()->privileges['tadstype']));
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            $adexnett->whereIn('ilevel_1',explode(';',Auth::user()->privileges['ilevel_1']));
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            $adexnett->whereIn('ilevel_2',explode(';',Auth::user()->privileges['ilevel_2']));
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            $adexnett->whereIn('iprogramme',explode(';',Auth::user()->privileges['iprogramme']));
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){            
            $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->firstOfMonth();
            $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate)->endOfMonth();
            $adexnett->whereBetween('isodate',[$startdate,$enddate]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->firstOfMonth()->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->endOfMonth()->toDateTimeString();
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
            $adexnett->whereIn('channel',array_filter(explode(';',$request->channel)));
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            $adexnett->whereIn('nprogramme',array_filter(explode(';',$request->nprogramme)));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            $adexnett->whereIn('iprogramme',array_filter(explode(';',$request->iprogramme)));
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            $adexnett->whereIn('nlevel_1',array_filter(explode(';',$request->nlevel_1)));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            $adexnett->whereIn('ilevel_1',array_filter(explode(';',$request->ilevel_1)));
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            $adexnett->whereIn('nlevel_2',array_filter(explode(';',$request->nlevel_2)));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            $adexnett->whereIn('ilevel_2',array_filter(explode(';',$request->ilevel_2)));
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            $adexnett->whereIn('nadvertiser',array_filter(explode(';',$request->nadvertiser)));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            $adexnett->whereIn('iadvertiser',array_filter(explode(';',$request->iadvertiser)));
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            $adexnett->whereIn('nproduct',array_filter(explode(';',$request->nproduct)));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            $adexnett->whereIn('iproduct',array_filter(explode(';',$request->iproduct)));
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            $adexnett->whereIn('nsector',array_filter(explode(';',$request->nsector)));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            $adexnett->whereIn('isector',array_filter(explode(';',$request->isector)));
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            $adexnett->whereIn('ncategory',array_filter(explode(';',$request->ncategory)));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            $adexnett->whereIn('icategory',array_filter(explode(';',$request->icategory)));
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            $adexnett->whereIn('nadstype',array_filter(explode(';',$request->nadstype)));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            $adexnett->whereIn('iadstype',array_filter(explode(';',$request->iadstype)));
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            $adexnett->whereIn('tadstype',array_filter(explode(';',$request->tadstype)));
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->iadvertiser_group){
            $adexnett->whereIn('advertiser_group',array_filter(explode(';',$request->iadvertiser_group)));
            array_push($filter,[ '$match' => ['advertiser_group' => ['$in' => array_filter(explode(';',$request->iadvertiser_group))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            $adexnett->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }

        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            // $filter = [];
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
            // $filter = [];
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
        $totalmonthchannel = [];
        $monthlist = [];
        foreach($query as $key=>$val){
            $cmonth = Carbon::parse($val->_id->isodate->toDateTime());
            $month = $cmonth->format('MY');
            $monthlist[] = $month;
            $totalmonth[$val->_id->channel][$month]['marketshare'] = $val->total;
        }
        foreach($channel as $key=>$val){
            if(isset($totalmonth[$val->channel])){
                $totalmonthchannel[$val->channel] = $totalmonth[$val->channel];
            }
        }
        $data['marketshare_month_channel'] = $totalmonthchannel;
        $data['monthlist'] = array_unique($monthlist);
        // top 10 agency
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            // $filter = [];
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
        // dd($query);
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
            // $filter = [];
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
            ${'totalall'.$advertiser} = (${'totalall'.$advertiser} ?? 0) + $val->total;
            $totaladvertiser[$advertiser]['all'] = ${'totalall'.$advertiser};
            $totaladvertiser[$advertiser][$val->_id->channel]['marketshare'] = $val->total;
        }
        // dd($totaladvertiser);
        foreach($totaladvertiser as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    if($val['all'] == 0 || !isset($val['all'])){
                        continue;
                    }
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
            // $filter = [];
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
            // $filter = [];
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
        $query = Adexnett::raw(function($collection) use ($filter,$nett)
        {
            // $filter = [];
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                            'ncategory'=>'$ncategory'
                        ],
                        'total' => [
                            '$sum'  => '$'.$nett
                        ]
                    ]
                ]
            ]));
        });
        // sum all
        $totalcategory = [];
        foreach($query as $key=>$val){
            $category = $val->_id->ncategory;
            $totalcategory[$category][$val->_id->channel]['marketshare'] = $val->total;
            ${'totalall'.$category} = (${'totalall'.$sector} ?? 0) + $val->total;
            $totalcategory[$category]['all'] = ${'totalall'.$category};
        }
        foreach($totalcategory as $key=>$val){
            foreach($val as $k=>$v){
                if($k != 'all'){
                    $totalcategory[$key][$k]['percentage'] = $v['marketshare']/$val['all'];
                }
            }
        }
        uasort($totalcategory, function($a, $b) {
            return $b['all'] <=> $a['all'];
        });
        $data['marketshare_channel_category'] = array_slice($totalcategory, 0, 10, true);

        if($action == 'print'){
            return view('admin.mktsummary.print',compact('request','data'));
        }else{
            return view('admin.mktsummary.dashboard',compact('data','request'));
        }
    }

    public function adexnett()
    {
        return view('admin.adexnett.index');
    }

    public function adexnettjson(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->firstOfMonth();
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate)->endOfMonth();
        $filterchannel = array_filter(explode(';',$request->filterchannel));
        $filternprogramme = array_filter(explode(';',$request->filternprogramme));
        $filteriprogramme = array_filter(explode(';',$request->filteriprogramme));
        $filternlevel_1 = array_filter(explode(';',$request->filternlevel_1));
        $filterilevel_1 = array_filter(explode(';',$request->filterilevel_1));
        $filternlevel_2 = array_filter(explode(';',$request->filternlevel_2));
        $filterilevel_2 = array_filter(explode(';',$request->filterilevel_2));
        $filternadvertiser = array_filter(explode(';',$request->filternadvertiser));
        $filteriadvertiser = array_filter(explode(';',$request->filteriadvertiser));
        $filternproduct = array_filter(explode(';',$request->filternproduct));
        $filteriproduct = array_filter(explode(';',$request->filteriproduct));
        $filternsector = array_filter(explode(';',$request->filternsector));
        $filterisector = array_filter(explode(';',$request->filterisector));
        $filterncategory = array_filter(explode(';',$request->filterncategory));
        $filtericategory = array_filter(explode(';',$request->filtericategory));
        $filteriadvertiser_group = array_filter(explode(';',$request->filteriadvertiser_group));
        
        $query = Adexnett::select('month', 'year','channel','iprogramme','iproduct','spots',
        'grp','gross','nett1','nett2','nett3','nsector','ncategory','nadvertiser','nproduct',
        'nprogramme','nlevel_1','nlevel_2','nadstype','isector','icategory','iadvertiser','ilevel_1','ilevel_2',
        'iadstype','tadstype','advertiser_group','agency','agency_subs','gm','sm','sgh','am','target','revenue');

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
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
        if(count($filteriadvertiser_group)){
            $query->whereIn('advertiser_group',$filteriadvertiser_group);
        } 
        
        // dd($query->toSql());
        return datatables($query->get())
        ->toJson();
    }

    public function adexnettcsvall(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->firstOfMonth();
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate)->endOfMonth();
        $filterchannel = array_filter(explode(';',$request->{'filter-channel'}));
        $filternprogramme = array_filter(explode(';',$request->{'filter-nprogramme'}));
        $filteriprogramme = array_filter(explode(';',$request->{'filter-iprogramme'}));
        $filternlevel_1 = array_filter(explode(';',$request->{'filter-nlevel_1'}));
        $filterilevel_1 = array_filter(explode(';',$request->{'filter-ilevel_1'}));
        $filternlevel_2 = array_filter(explode(';',$request->{'filter-nlevel_2'}));
        $filterilevel_2 = array_filter(explode(';',$request->{'filter-ilevel_2'}));
        $filternadvertiser = array_filter(explode(';',$request->{'filter-nadvertiser'}));
        $filteriadvertiser = array_filter(explode(';',$request->{'filter-iadvertiser'}));
        $filternproduct = array_filter(explode(';',$request->{'filter-nproduct'}));
        $filteriproduct = array_filter(explode(';',$request->{'filter-iproduct'}));
        $filternsector = array_filter(explode(';',$request->{'filter-nsector'}));
        $filterisector = array_filter(explode(';',$request->{'filter-isector'}));
        $filterncategory = array_filter(explode(';',$request->{'filter-ncategory'}));
        $filtericategory = array_filter(explode(';',$request->{'filter-icategory'}));
        $filteriadvertiser_group = array_filter(explode(';',$request->{'filter-iadvertiser_group'}));
        
        $query = Adexnett::select('month', 'year','channel','iprogramme','iproduct','spots',
        'grp','gross','nett1','nett2','nett3','nsector','ncategory','nadvertiser','nproduct',
        'nprogramme','nlevel_1','nlevel_2','nadstype','isector','icategory','iadvertiser','ilevel_1','ilevel_2',
        'iadstype','tadstype','advertiser_group','agency','agency_subs','gm','sm','sgh','am','target','revenue');

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
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
        if(count($filteriadvertiser_group)){
            $query->whereIn('advertiser_group',$filteriadvertiser_group);
        } 
        
        $export = $query->get();
        $filename = 'vislog-adexnett.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/vislog-adexnett.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);    
    }
    
    public function spotmatching()
    {
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(';',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');
        
        return view('admin.spotmatching.index',compact('data'));
    }

    public function spotmatchingjson(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->subDays(1);
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate);
        $filterchannel = array_filter(explode(';',$request->filterchannel));
        $filternprogramme = array_filter(explode(';',$request->filternprogramme));
        $filteriprogramme = array_filter(explode(';',$request->filteriprogramme));
        $filternlevel_1 = array_filter(explode(';',$request->filternlevel_1));
        $filterilevel_1 = array_filter(explode(';',$request->filterilevel_1));
        $filternlevel_2 = array_filter(explode(';',$request->filternlevel_2));
        $filterilevel_2 = array_filter(explode(';',$request->filterilevel_2));
        $filternadvertiser = array_filter(explode(';',$request->filternadvertiser));
        $filteriadvertiser = array_filter(explode(';',$request->filteriadvertiser));
        $filternproduct = array_filter(explode(';',$request->filternproduct));
        $filteriproduct = array_filter(explode(';',$request->filteriproduct));
        $filternsector = array_filter(explode(';',$request->filternsector));
        $filterisector = array_filter(explode(';',$request->filterisector));
        $filterncategory = array_filter(explode(';',$request->filterncategory));
        $filtericategory = array_filter(explode(';',$request->filtericategory));
        $filternadstype = array_filter(explode(';',$request->filternadstype));
        $filteriadstype = array_filter(explode(';',$request->filteriadstype));
        $filtertadstype = array_filter(explode(';',$request->filtertadstype));
        $filterntargetaudience = $request->filterntargetaudience ?? '01';
        $filteriadvertiser_group = array_filter(explode(';',$request->{'filter-iadvertiser_group'}));
        
        $query = Spotmatching::select('channel','date','mo_no','sales_name','sales_group','sales_manager',
        'agent_name','sub_agent_name','isector','icategory','iadvertiser','iproduct','barcode','icopy',
        'line_no','po_no','add_flag','ilevel1','ilevel2','iprogramme','title_program','duration_program',
        'date_program','start_time_program','end_time_program','air_date','actual_time','cb','update_date',
        'bookingdatetime','bookingdatetime1','spot_type','flag_rate','po_type','po_type_desc','ket_inventory',
        'tx_code','dur','seq','nsector','ncategory','nadvertiser','nproduct','ncopy','start_time','end_time',
        'duration','nprogramme','nlevel1','nlevel2','no_of_spots','cost','t_second_cost',
        'tvr'.$filterntargetaudience);
    
        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
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
        if(count($filteriadvertiser_group)){
            // $query->whereIn('advertiser_group',$filteriadvertiser_group);
        } 
        if($request->xadstype){
            switch($request->xadstype):
                case 'loosespot':
                    $query->where('ket_inventory','Y')->where('status','Found');
                break;
                case 'nonloosespot':
                    $query->where('ket_inventory','N')->where('status','Found');
                break;
                case 'notfound':
                    $query->where('status','Not Found');
                break;
            endswitch;
        }
        // add filter by user privilege        
        if(!empty(Auth::user()->privileges['startdate']))  {            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['startdate'].' 00:00:00')->toDateTimeString();
            $isostartdate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['enddate'].' 00:00:00')->toDateTimeString();
            $isoenddate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $query->whereBetween('isodate',[$isostartdate,$isoenddate]);
        }
        if(!empty(Auth::user()->privileges['nsector'])) $query->whereIn('nsector',explode(';',Auth::user()->privileges['nsector']));
        if(!empty(Auth::user()->privileges['ncategory']))  $query->whereIn('ncategory',explode(';',Auth::user()->privileges['ncategory']??'%%'));
        if(!empty(Auth::user()->privileges['nproduct']))  $query->whereIn('nproduct',explode(';',Auth::user()->privileges['nproduct']??'%%'));
        if(!empty(Auth::user()->privileges['nadvertiser']))  $query->whereIn('nadvertiser',explode(';',Auth::user()->privileges['nadvertiser']??'%%'));
        if(!empty(Auth::user()->privileges['ncopy']))  $query->whereIn('ncopy',explode(';',Auth::user()->privileges['ncopy']??'%%'));
        if(!empty(Auth::user()->privileges['nadstype']))  $query->whereIn('nadstype',explode(';',Auth::user()->privileges['nadstype']??'%%'));
        if(!empty(Auth::user()->privileges['isector'])) $query->whereIn('isector',explode(';',Auth::user()->privileges['isector']));
        if(!empty(Auth::user()->privileges['icategory']))  $query->whereIn('icategory',explode(';',Auth::user()->privileges['icategory']));
        if(!empty(Auth::user()->privileges['iproduct']))  $query->whereIn('iproduct',explode(';',Auth::user()->privileges['iproduct']));
        if(!empty(Auth::user()->privileges['iadvertiser']))  $query->whereIn('iadvertiser',explode(';',Auth::user()->privileges['iadvertiser']));
        if(!empty(Auth::user()->privileges['iadvertiser_group']))  $query->whereIn('advertiser_group',explode(';',Auth::user()->privileges['iadvertiser_group']));
        if(!empty(Auth::user()->privileges['icopy']))  $query->whereIn('icopy',explode(';',Auth::user()->privileges['icopy']));
        if(!empty(Auth::user()->privileges['iadstype']))  $query->whereIn('iadstype',explode(';',Auth::user()->privileges['iadstype']));
        if(!empty(Auth::user()->privileges['tadstype']))  $query->whereIn('tadstype',explode(';',Auth::user()->privileges['tadstype']));
        if(!empty(Auth::user()->privileges['channel']))  $query->whereIn('channel',explode(';',Auth::user()->privileges['channel']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']??'%%'));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']??'%%'));
        if(!empty(Auth::user()->privileges['ilevel_1']))  $query->whereIn('ilevel_1',explode(';',Auth::user()->privileges['ilevel_1']??'%%'));
        if(!empty(Auth::user()->privileges['ilevel_2']))  $query->whereIn('ilevel_2',explode(';',Auth::user()->privileges['ilevel_2']??'%%'));
        if(!empty(Auth::user()->privileges['iprogramme'])) $query->whereIn('iprogramme',explode(';',Auth::user()->privileges['iprogramme']??'%%'));

        // dd($query->toSql());
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.spotmatching.action',compact('dt'));
        })->toJson();
    }

    public function spotmatchingcsvall(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->firstOfMonth();
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate)->endOfMonth();
        $filterchannel = array_filter(explode(';',$request->{'filter-channel'}));
        $filternprogramme = array_filter(explode(';',$request->{'filter-nprogramme'}));
        $filteriprogramme = array_filter(explode(';',$request->{'filter-iprogramme'}));
        $filternlevel_1 = array_filter(explode(';',$request->{'filter-nlevel_1'}));
        $filterilevel_1 = array_filter(explode(';',$request->{'filter-ilevel_1'}));
        $filternlevel_2 = array_filter(explode(';',$request->{'filter-nlevel_2'}));
        $filterilevel_2 = array_filter(explode(';',$request->{'filter-ilevel_2'}));
        $filternadvertiser = array_filter(explode(';',$request->{'filter-nadvertiser'}));
        $filteriadvertiser = array_filter(explode(';',$request->{'filter-iadvertiser'}));
        $filternproduct = array_filter(explode(';',$request->{'filter-nproduct'}));
        $filteriproduct = array_filter(explode(';',$request->{'filter-iproduct'}));
        $filternsector = array_filter(explode(';',$request->{'filter-nsector'}));
        $filterisector = array_filter(explode(';',$request->{'filter-isector'}));
        $filterncategory = array_filter(explode(';',$request->{'filter-ncategory'}));
        $filtericategory = array_filter(explode(';',$request->{'filter-icategory'}));
        $filterntargetaudience = $request->{'filter-ntargetaudience'} ?? '01';
        $filteriadvertiser_group = array_filter(explode(';',$request->{'filter-iadvertiser_group'}));
        
        $query = Spotmatching::select('channel','date','mo_no','sales_name','sales_group','sales_manager',
        'agent_name','sub_agent_name','isector','icategory','iadvertiser','iproduct','barcode','icopy',
        'line_no','po_no','add_flag','ilevel1','ilevel2','iprogramme','title_program','duration_program',
        'date_program','start_time_program','end_time_program','air_date','actual_time','cb','update_date',
        'bookingdatetime','bookingdatetime1','spot_type','flag_rate','po_type','po_type_desc','ket_inventory',
        'tx_code','dur','seq','nsector','ncategory','nadvertiser','nproduct','ncopy','start_time','end_time',
        'duration','nprogramme','nlevel1','nlevel2','no_of_spots','cost','t_second_cost',
        'tvr'.$filterntargetaudience);

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
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
        if(count($filteriadvertiser_group)){
            // $query->whereIn('iadvertiser_group',$filteriadvertiser_group);
        } 
        if($request->xadstype){
            switch($request->xadstype):
                case 'loosespot':
                    $query->where('ket_inventory','Y');
                break;
                case 'nonloosespot':
                    $query->where('ket_inventory','N');
                break;
                case 'notfound':
                    $query->where('ket_inventory','Not Found');
                break;
            endswitch;
        }
        
        $export = $query->get();
        $filename = 'vislog-spotmatching.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/vislog-spotmatching.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);    
    }
}
