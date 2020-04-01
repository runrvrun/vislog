<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;
use App\Log;
use App\Commercial;
use App\Commercialsearch;
use App\Adexnett;
use App\Daypartsetting;
use App\Tvchighlight;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        if(!empty($request->commercialdata) && $request->commercialdata == 'grouped'){
            $commercial = Commercialgrouped::whereNotNull('_id');
        }else{
            $commercial = Commercial::whereNotNull('_id');
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            $commercial->whereBetween('isodate',[Auth::user()->privileges['isostartdate'],Auth::user()->privileges['isoenddate']]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['isostartdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['isoenddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            $commercial->whereIn('nsector',explode(',',Auth::user()->privileges['nsector']));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(',',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            $commercial->whereIn('ncategory',explode(',',Auth::user()->privileges['ncategory']));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(',',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            $commercial->whereIn('nproduct',explode(',',Auth::user()->privileges['nproduct']));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(',',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            $commercial->whereIn('nadvertiser',explode(',',Auth::user()->privileges['nadvertiser']));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(',',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            $commercial->whereIn('ncopy',explode(',',Auth::user()->privileges['ncopy']));
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(',',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            $commercial->whereIn('nadstype',explode(',',Auth::user()->privileges['nadstype']));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(',',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            $commercial->whereIn('channel',explode(',',Auth::user()->privileges['channel']));
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(',',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            $commercial->whereIn('nlevel_1',explode(',',Auth::user()->privileges['nlevel1']));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(',',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            $commercial->whereIn('nlevel_2',explode(',',Auth::user()->privileges['nlevel2']));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(',',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            $commercial->whereIn('nprogramme',explode(',',Auth::user()->privileges['nprogramme']));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(',',Auth::user()->privileges['nprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $commercial->whereBetween('isodate',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            $commercial->whereBetween('start_timestamp',[$starttimestamp,$endtimestamp]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            $commercial->whereIn('channel',array_filter(explode(',',$request->channel)));
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(',',$request->channel))]]]);  
        }
        if($request->nprogramme){
            $commercial->whereIn('nprogramme',array_filter(explode(',',$request->nprogramme)));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(',',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            $commercial->whereIn('iprogramme',array_filter(explode(',',$request->iprogramme)));
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(',',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            $commercial->whereIn('nlevel_1',array_filter(explode(',',$request->nlevel_1)));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(',',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            $commercial->whereIn('ilevel_1',array_filter(explode(',',$request->ilevel_1)));
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(',',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            $commercial->whereIn('nlevel_2',array_filter(explode(',',$request->nlevel_2)));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(',',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            $commercial->whereIn('ilevel_2',array_filter(explode(',',$request->ilevel_2)));
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(',',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            $commercial->whereIn('nadvertiser',array_filter(explode(',',$request->nadvertiser)));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(',',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            $commercial->whereIn('iadvertiser',array_filter(explode(',',$request->iadvertiser)));
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(',',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            $commercial->whereIn('nproduct',array_filter(explode(',',$request->nproduct)));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(',',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            $commercial->whereIn('iproduct',array_filter(explode(',',$request->iproduct)));
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(',',$request->iproduct))]]]);  
        }
        if($request->nsector){
            $commercial->whereIn('nsector',array_filter(explode(',',$request->nsector)));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(',',$request->nsector))]]]);  
        }
        if($request->isector){
            $commercial->whereIn('isector',array_filter(explode(',',$request->isector)));
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(',',$request->isector))]]]);  
        }
        if($request->ncategory){
            $commercial->whereIn('ncategory',array_filter(explode(',',$request->ncategory)));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(',',$request->ncategory))]]]);  
        }
        if($request->icategory){
            $commercial->whereIn('icategory',array_filter(explode(',',$request->icategory)));
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(',',$request->icategory))]]]);  
        }
        if($request->nadstype){
            $commercial->whereIn('nadstype',array_filter(explode(',',$request->nadstype)));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(',',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            $commercial->whereIn('iadstype',array_filter(explode(',',$request->iadstype)));
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(',',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            $commercial->whereIn('tadstype',array_filter(explode(',',$request->tadstype)));
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(',',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            $commercial->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }

        $data['number_of_spot'] = $commercial->count();        
        $data['cost'] = $commercial->sum('cost')/1000000000;
        $data['grp'] = 0;
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $data['grp'] = $commercial->sum('tvr'.$ta);        
        $query = Commercial::raw(function($collection) use ($filter)
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        $data['spot_per_channel'] = $query;
        $query = Commercial::raw(function($collection) use ($filter)
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
        $daypart = Daypartsetting::all();
        if($daypart){
            foreach($daypart as $key=>$val){
                $c = clone($commercial); 
                $time   = explode(":", $val->start_time);
                $hour   = $time[0] * 60 * 60 * 1000;
                $minute = $time[1] * 60 * 1000;
                $start_ms = $hour + $minute + 1;
                $time   = explode(":", $val->end_time);
                $hour   = $time[0] * 60 * 60 * 1000;
                $minute = $time[1] * 60 * 1000;
                $end_ms = $hour + $minute;
                $data['daypart'][$key]['name'] = $val->daypart;
                $data['daypart'][$key]['value'] = $c->whereBetween('start_timestamp',[$start_ms,$end_ms])->sum('no_of_spots');//00.00-06.00
            }
        }else{
            $c = clone($commercial); 
            $data['daypart'][0]['name'] = "00.00-06.00";
            $data['daypart'][0]['value'] = $c->whereBetween('start_timestamp',[0,21600])->sum('no_of_spots');//00.00-06.00
            $c = clone($commercial); 
            $data['daypart'][1]['name'] = "06.00-12.00";
            $data['daypart'][1]['value'] = $c->whereBetween('start_timestamp',[21601,43200])->sum('no_of_spots');//06.00-12.00
            $c = clone($commercial); 
            $data['daypart'][2]['name'] = "12.00-17.30";
            $data['daypart'][2]['value'] = $c->whereBetween('start_timestamp',[43201,63000])->sum('no_of_spots');//12.00-17.30
            $c = clone($commercial); 
            $data['daypart'][3]['name'] = "17.30-22.00";
            $data['daypart'][3]['value'] = $c->whereBetween('start_timestamp',[63001,79200])->sum('no_of_spots');//17.30-22.00
            $c = clone($commercial); 
            $data['daypart'][4]['name'] = "22.00-00.00";
            $data['daypart'][4]['value'] = $c->whereBetween('start_timestamp',[79201,86400])->sum('no_of_spots');//22.00-00.00
        }

        $data['spot_per_date'] = Commercial::raw(function($collection) use($filter) 
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
                ])
                ,['allowDiskUse' => true]
                );
        });
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');

        return view('admin.dashboard',compact('request','data'));
    }
    public function highlight(Request $request)
    {    
        $data['tvchighlight'] = Tvchighlight::orderBy('created_at')->take(10)->get();
        $filter = [];
        $commercial = Commercial::whereNotNull('_id');
        $adexnett = Adexnett::whereNotNull('_id');
        $log = Log::whereNotNull('_id');
        if($request->startdate){
            $commercial->whereBetween('isodate',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            $adexnett->whereBetween('isodate',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            $log->whereBetween('created_at',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $commercial->whereBetween('isodate',[Carbon::now()->subDays(6),Carbon::now()]);
            $adexnett->whereBetween('isodate',[Carbon::now()->subDays(6),Carbon::now()]);
            $log->whereBetween('created_at',[Carbon::now()->subDays(6),Carbon::now()]);
            $date = Carbon::now()->subDays(1)->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::now()->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );    
        }

        $data['advertiser'] = $commercial->distinct('nadvertiser')->get();
        $data['advertiser'] = count($data['advertiser']);
        $data['product'] = $commercial->distinct('nproduct')->get();
        $data['product'] = count($data['product']);
        $data['number_of_spot'] = $commercial->sum('no_of_spots');        
        $data['adex'] = $adexnett->sum('gross');
        if ($data['adex'] < 1000000) {
            // Anything less than a million
            $data['adex'] = number_format($data['adex']);
        } else if ($data['adex'] < 1000000000) {
            // Anything less than a billion
            $data['adex'] = number_format($data['adex'] / 1000000, 2) . 'M';
        } else {
            // At least a billion
            $data['adex'] = number_format($data['adex'] / 1000000000, 2) . 'B';
        }
        
        $c = clone($commercial);// clone object as so not copy by reference and got additional "where" clause
        $data['adstype_loose_spot'] = $c->where('nadstype','LOOSE SPOT')->get();
        $data['adstype_loose_spot'] = count($data['adstype_loose_spot']);
        if ($data['adstype_loose_spot'] < 1000000) {
            //
        } else if ($data['adstype_loose_spot'] < 1000000000) {
            $data['adstype_loose_spot'] = number_format($data['adstype_loose_spot'] / 1000000, 2) . 'M';
        } else {
            $data['adstype_loose_spot'] = number_format($data['adstype_loose_spot'] / 1000000000, 2) . 'B';
        }

        $c = clone($commercial);// clone object as so not copy by reference
        $data['adstype_virtual_ads'] = $c->where('nadstype','VIRTUAL ADS')->get();
        $data['adstype_virtual_ads'] = count($data['adstype_virtual_ads']);
        if ($data['adstype_virtual_ads'] < 1000000) {
            //
        } else if ($data['adstype_virtual_ads'] < 1000000000) {
            $data['adstype_virtual_ads'] = number_format($data['adstype_virtual_ads'] / 1000000, 2) . 'M';
        } else {
            $data['adstype_virtual_ads'] = number_format($data['adstype_virtual_ads'] / 1000000000, 2) . 'B';
        }

        $c = clone($commercial);// clone object as so not copy by reference
        $data['adstype_squeeze_frames'] = $c->where('nadstype','SQUEEZE FRAMES')->get();
        $data['adstype_squeeze_frames'] = count($data['adstype_squeeze_frames']);
        if ($data['adstype_squeeze_frames'] < 1000000) {
            //
        } else if ($data['adstype_squeeze_frames'] < 1000000000) {
            $data['adstype_squeeze_frames'] = number_format($data['adstype_squeeze_frames'] / 1000000, 2) . 'M';
        } else {
            $data['adstype_squeeze_frames'] = number_format($data['adstype_squeeze_frames'] / 1000000000, 2) . 'B';
        }

        $c = clone($commercial);// clone object as so not copy by reference
        $data['adstype_quiz'] = $c->where('nadstype','QUIZ')->get();
        $data['adstype_quiz'] = count($data['adstype_quiz']);
        if ($data['adstype_quiz'] < 1000000) {
            //
        } else if ($data['adstype_quiz'] < 1000000000) {
            $data['adstype_quiz'] = number_format($data['adstype_quiz'] / 1000000, 2) . 'M';
        } else {
            $data['adstype_quiz'] = number_format($data['adstype_quiz'] / 1000000000, 2) . 'B';
        }
         
        $query = Commercial::raw(function($collection) use ($filter)
        {
            array_push($filter,[ '$match' => ['nadstype' => 'LOOSE SPOT']]);  
            return $collection->aggregate(array_merge($filter,[               
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        $oquery = [];
        foreach($query as $key=>$val){
            $oquery[$val->_id->channel] = ['channel'=>$val->_id->channel,'total'=>$val->total];
        }
        asort($oquery);
        $data['spot_per_channel_loose'] = $oquery;
        //
        $query = Commercial::raw(function($collection) use ($filter)
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        $oquery = [];
        foreach($query as $key=>$val){
            $oquery[$val->_id->channel] = ['channel'=>$val->_id->channel,'total'=>$val->total];
        }
        asort($oquery);
        $data['spot_per_channel'] = $oquery;
        
        //calculate spot per daypart
        $daypart = Daypartsetting::all();
        if($daypart){
            foreach($daypart as $key=>$val){
                $c = clone($commercial); 
                $time   = explode(":", $val->start_time);
                $hour   = $time[0] * 60 * 60 * 1000;
                $minute = $time[1] * 60 * 1000;
                $start_ms = $hour + $minute + 1;
                $time   = explode(":", $val->end_time);
                $hour   = $time[0] * 60 * 60 * 1000;
                $minute = $time[1] * 60 * 1000;
                $end_ms = $hour + $minute;
                $data['daypart'][$key]['name'] = $val->daypart;
                $data['daypart'][$key]['value'] = $c->whereBetween('start_timestamp',[$start_ms,$end_ms])->sum('no_of_spots');//00.00-06.00
            }
        }else{
            $c = clone($commercial); 
            $data['daypart'][0]['name'] = "00.00-06.00";
            $data['daypart'][0]['value'] = $c->whereBetween('start_timestamp',[0,21600])->sum('no_of_spots');//00.00-06.00
            $c = clone($commercial); 
            $data['daypart'][1]['name'] = "06.00-12.00";
            $data['daypart'][1]['value'] = $c->whereBetween('start_timestamp',[21601,43200])->sum('no_of_spots');//06.00-12.00
            $c = clone($commercial); 
            $data['daypart'][2]['name'] = "12.00-17.30";
            $data['daypart'][2]['value'] = $c->whereBetween('start_timestamp',[43201,63000])->sum('no_of_spots');//12.00-17.30
            $c = clone($commercial); 
            $data['daypart'][3]['name'] = "17.30-22.00";
            $data['daypart'][3]['value'] = $c->whereBetween('start_timestamp',[63001,79200])->sum('no_of_spots');//17.30-22.00
            $c = clone($commercial); 
            $data['daypart'][4]['name'] = "22.00-00.00";
            $data['daypart'][4]['value'] = $c->whereBetween('start_timestamp',[79201,86400])->sum('no_of_spots');//22.00-00.00
        }
        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel',
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 5
                ],
            ]));
        });
        $data['top_channel'] = $query;
        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nprogramme'=>'$nprogramme',
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 5
                ],
            ]));
        });
        $data['top_programme'] = $query;
        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nproduct'=>'$nproduct',
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 5
                ],
            ]));
        });
        $data['top_product'] = $query;
        $l = clone($log);
        $data['data_update'] = $l->where('action','regexp','/data update/')->orderBy('created_at','DESC')->take(5)->get();
        $l = clone($log);
        $data['video_update'] = $l->where('action','regexp','/video update/')->orderBy('created_at','DESC')->take(5)->get();

        $spot_per_date = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
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
                ])
            ,['allowDiskUse' => true]
            );
        });
        $data['spot_per_date'] = [];
        foreach($spot_per_date as $key=>$val){
            $data['spot_per_date'][$key]['date'] = $val->_id->date;
            $data['spot_per_date'][$key]['total'] = $val->total;
        }
        usort($data['spot_per_date'], function($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        return view('admin.highlight',compact('data','request'));
    }

    public function spot_per_productjson()
    {
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['isostartdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['isoenddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(',',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(',',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(',',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(',',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(',',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(',',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(',',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(',',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(',',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(',',Auth::user()->privileges['nprogramme'])]]]);  
        }

        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nproduct'=>'$nproduct'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_programmejson()
    {
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['isostartdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['isoenddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(',',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(',',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(',',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(',',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(',',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(',',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(',',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(',',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(',',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(',',Auth::user()->privileges['nprogramme'])]]]);  
        }

        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nprogramme'=>'$nprogramme'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_adstypejson()
    {
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['isostartdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['isoenddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(',',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(',',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(',',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(',',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(',',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(',',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(',',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(',',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(',',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(',',Auth::user()->privileges['nprogramme'])]]]);  
        }

        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nadstype'=>'$nadstype'
                        ],
                        'total' => [
                            '$sum'  => '$no_of_spots'
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
}
