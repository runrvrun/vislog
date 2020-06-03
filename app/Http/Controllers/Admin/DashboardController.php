<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;
use App\Log;
use App\Commercial;
use App\Commercialgrouped;
use App\Commercialsearch;
use App\Adexnett;
use App\Daypartsetting;
use App\Tvchighlight;
use App\Channel;
use App\User;
use Auth;
use PDF;

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
    public function dashboard(Request $request, $action = null)
    {
        $channel = Channel::orderBy('order')->get();
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(';',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');

        if(empty($request->startdate)){
            // load empty on start
            return view('admin.dashboard',compact('data','request'));
        }
        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $commercial = Commercialgrouped::whereNotNull('_id');
        }else{
            $commercial = Commercial::whereNotNull('_id');
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            $commercial->whereBetween('isodate',[Auth::user()->privileges['startdate'],Auth::user()->privileges['enddate']]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            $commercial->whereIn('nsector',explode(';',Auth::user()->privileges['nsector']));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            $commercial->whereIn('ncategory',explode(';',Auth::user()->privileges['ncategory']));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            $commercial->whereIn('nproduct',explode(';',Auth::user()->privileges['nproduct']));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            $commercial->whereIn('nadvertiser',explode(';',Auth::user()->privileges['nadvertiser']));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            $commercial->whereIn('ncopy',explode(';',Auth::user()->privileges['ncopy']));
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            $commercial->whereIn('nadstype',explode(';',Auth::user()->privileges['nadstype']));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            $commercial->whereIn('channel',explode(';',Auth::user()->privileges['channel']));
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            $commercial->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            $commercial->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            $commercial->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            $commercial->whereIn('isector',explode(';',Auth::user()->privileges['isector']));
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            $commercial->whereIn('icategory',explode(';',Auth::user()->privileges['icategory']));
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            $commercial->whereIn('iproduct',explode(';',Auth::user()->privileges['iproduct']));
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            $commercial->whereIn('iadvertiser',explode(';',Auth::user()->privileges['iadvertiser']));
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            $commercial->whereIn('iadvertiser_group',explode(';',Auth::user()->privileges['iadvertiser_group']));
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            $commercial->whereIn('icopy',explode(';',Auth::user()->privileges['icopy']));
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            $commercial->whereIn('iadstype',explode(';',Auth::user()->privileges['iadstype']));
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            $commercial->whereIn('tadstype',explode(';',Auth::user()->privileges['tadstype']));
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            $commercial->whereIn('ilevel_1',explode(';',Auth::user()->privileges['ilevel_1']));
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            $commercial->whereIn('ilevel_2',explode(';',Auth::user()->privileges['ilevel_2']));
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            $commercial->whereIn('iprogramme',explode(';',Auth::user()->privileges['iprogramme']));
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
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
            $commercial->whereIn('channel',array_filter(explode(';',$request->channel)));
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            $commercial->whereIn('nprogramme',array_filter(explode(';',$request->nprogramme)));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            $commercial->whereIn('iprogramme',array_filter(explode(';',$request->iprogramme)));
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            $commercial->whereIn('nlevel_1',array_filter(explode(';',$request->nlevel_1)));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            $commercial->whereIn('ilevel_1',array_filter(explode(';',$request->ilevel_1)));
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            $commercial->whereIn('nlevel_2',array_filter(explode(';',$request->nlevel_2)));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            $commercial->whereIn('ilevel_2',array_filter(explode(';',$request->ilevel_2)));
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            $commercial->whereIn('nadvertiser',array_filter(explode(';',$request->nadvertiser)));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            $commercial->whereIn('iadvertiser',array_filter(explode(';',$request->iadvertiser)));
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            $commercial->whereIn('nproduct',array_filter(explode(';',$request->nproduct)));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            $commercial->whereIn('iproduct',array_filter(explode(';',$request->iproduct)));
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            $commercial->whereIn('nsector',array_filter(explode(';',$request->nsector)));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            $commercial->whereIn('isector',array_filter(explode(';',$request->isector)));
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            $commercial->whereIn('ncategory',array_filter(explode(';',$request->ncategory)));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            $commercial->whereIn('icategory',array_filter(explode(';',$request->icategory)));
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            $commercial->whereIn('nadstype',array_filter(explode(';',$request->nadstype)));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            $commercial->whereIn('iadstype',array_filter(explode(';',$request->iadstype)));
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            $commercial->whereIn('tadstype',array_filter(explode(';',$request->tadstype)));
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            $commercial->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            $commercial->where('nadstype','=','LOOSE SPOT');
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            $commercial->where('nadstype','<>','LOOSE SPOT');
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        $data['number_of_spot'] = $commercial->sum('no_of_spots');        
        $data['cost'] = $commercial->sum('cost')/1000000;
        $data['grp'] = $commercial->sum('tvr'.$ta);
        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use ($filter,$variabled,$divider)
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'channel'=>'$channel'
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        $oquery = [];
        $cquery = [];
        foreach($query as $key=>$val){
            $oquery[$val->_id->channel] = ['channel'=>$val->_id->channel,'total'=>$val->total];
        }
        foreach($channel as $k=>$v){
            if(isset($oquery[$v->channel])){
                $cquery[$k] = ['channel'=>$oquery[$v->channel]['channel'], 'total'=>$oquery[$v->channel]['total']];
                if($request->variable == 'COST'){
                    $cquery[$k]['total'] = number_format($cquery[$k]['total'],2,'.','');
                }
            }
        }
        $data['spot_per_channel'] = $cquery;
        
        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use ($filter,$variabled,$divider)
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nadstype'=>'$nadstype'
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ],
                    ]
                ]
            ]));
        });
        $spotpertype['LOOSE SPOT'] = 0;
        $spotpertype['NON LOOSE SPOT'] = 0;
        foreach($query as $key=>$val){
            // group loose spot vs non loose spot (other)
            if($val->id['nadstype'] == 'LOOSE SPOT'){
                $spotpertype['LOOSE SPOT'] = $val->total;
            }else{
                $spotpertype['NON LOOSE SPOT'] += $val->total;
            }
        }
        if($request->variable == 'COST'){
            $spotpertype['LOOSE SPOT'] = number_format($spotpertype['LOOSE SPOT'],2,'.','');
            $spotpertype['NON LOOSE SPOT'] = number_format($spotpertype['NON LOOSE SPOT'],2,'.','');
        }
        $data['spot_per_type'] = $spotpertype;
        //calculate spot per daypart
        $daypart = Daypartsetting::orderBy('start_time')->get();
        if($daypart){
            foreach($daypart as $key=>$val){
                $c = clone($commercial); 
                $time   = explode(":", $val->start_time);
                $hour   = $time[0] * 60 * 60;
                $minute = $time[1] * 60;
                $start_ms = $hour + $minute;
                $time   = explode(":", $val->end_time);
                if($time[0] == 0){ // end at midnight
                    $hour   = 24 * 60 * 60;
                }else{
                    $hour   = $time[0] * 60 * 60;
                }
                $minute = $time[1] * 60;
                $end_ms = $hour + $minute - 1;
                $data['daypart'][$key]['name'] = $val->daypart;
                if($request->variable == 'SPOT'){
                    $data['daypart'][$key]['value'] = $c->whereBetween('start_timestamp',[$start_ms,$end_ms])->sum('no_of_spots');
                }elseif($request->variable == 'COST'){
                    $data['daypart'][$key]['value'] = $c->whereBetween('start_timestamp',[$start_ms,$end_ms])->sum($variable);
                    $data['daypart'][$key]['value'] = number_format($data['daypart'][$key]['value']/$divider,2,'.','');
                }else{
                    $data['daypart'][$key]['value'] = $c->whereBetween('start_timestamp',[$start_ms,$end_ms])->sum($variable);
                }
            }
        }
        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $spot_per_date = $co::raw(function($collection) use($filter,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [ '$sort' => [ 'date' => 1 ] ],
                [
                    '$group'    => [
                        '_id'   => [
                            'date'=>'$date',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
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
            if($request->variable == 'COST'){
                $data['spot_per_date'][$key]['total'] = number_format($data['spot_per_date'][$key]['total'],2,'.','');
            }
        }
        usort($data['spot_per_date'], function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        if($action == 'pdf'){
            $pdf = PDF::loadView('admin.dashboardpdf',compact('request','data'));
            return $pdf->download('vislog_dashboard.pdf');
        }elseif($action == 'print'){
            return view('admin.dashboardprint',compact('request','data'));
        }else{
            return view('admin.dashboard',compact('request','data'));
        }
    }
    public function highlight(Request $request, $action = null)
    {    
        $channel = Channel::orderBy('order')->get();
        $data['tvchighlight'] = Tvchighlight::where('show',true)->orderBy('created_at')->take(10)->get();
        $filter = [];
        $commercial = new Commercial();
        $log = new Log();
        if(!empty($request->startdate)){
            $log->whereBetween('created_at',[Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00'),Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')]);
            //
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 23:59:59')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{   
            return view('admin.highlight');
        }

        $co = new Commercial;
        // summary advertiser
        $count = $co::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[                
                    [
                        '$group'=> [
                          '_id'=> '$nadvertiser'
                        ]
                    ],
                    [
                        '$group'=> [
                          '_id'=> 1,
                          'count'=> [
                            '$sum'=> 1
                          ]
                        ]
                    ]
                ])
                ,['allowDiskUse' => true]
                );
        });
        $data['advertiser'] = $count[0]['count'] ?? 0;
        // summary product
        $count = $co::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[                
                    [
                        '$group'=> [
                          '_id'=> '$nproduct'
                        ]
                    ],
                    [
                        '$group'=> [
                          '_id'=> 1,
                          'count'=> [
                            '$sum'=> 1
                          ]
                        ]
                    ]
                ])
                ,['allowDiskUse' => true]
                );
        });
        $data['product'] = $count[0]['count'] ?? 0;
        // summary spot
        $count = $co::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[                                    
                    [
                        '$group'=> [
                          '_id'=> 1,
                          'count'=> [
                            '$sum'=> '$no_of_spots'
                          ]
                        ]
                    ]
                ])
                ,['allowDiskUse' => true]
                );
        });
        $data['number_of_spot'] = $count[0]['count'] ?? 0;
        // summary cost
        $count = $co::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[                                    
                    [
                        '$group'=> [
                          '_id'=> 1,
                          'count'=> [
                            '$sum'=> '$cost'
                          ]
                        ]
                    ]
                ])
                ,['allowDiskUse' => true]
                );
        });
        $data['adex'] = $count[0]['count'] ?? 0;
        if ($data['adex'] < 1000) { // cost is already per 1000
            // Anything less than a million
            $data['adex'] = number_format($data['adex'],0);
        } else if ($data['adex'] < 1000000) {
            // Anything less than a billion
            $data['adex'] = number_format($data['adex'] / 1000, 0) . 'M';
        } else {
            // At least a billion
            $data['adex'] = number_format($data['adex'] / 1000000, 0) . 'B';
        }
        // summary ads type selection loose spot        
        $count = $co::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[                                    
                    [
                        '$group'=> [
                          '_id'=> '$nadstype',
                          'count'=> [
                            '$sum'=> '$no_of_spots'
                          ]
                        ]
                    ]
                ])
                ,['allowDiskUse' => true]
                );
        });
        foreach($count as $val){
            $key = 'adstype_'.str_replace(' ','_',strtolower($val->id));
            $data[$key] = $val->count;
        }        
        // ads type selection graph 
        $query = $co::raw(function($collection) use ($filter)
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
        $cquery = [];
        foreach($query as $key=>$val){
            $oquery[$val->_id->channel] = ['channel'=>$val->_id->channel,'total'=>number_format($val->total,0,'','')];
        }
        foreach($channel as $k=>$v){
            if(isset($oquery[$v->channel])){
                $cquery[$k] = ['channel'=>$oquery[$v->channel]['channel'], 'total'=>$oquery[$v->channel]['total']];
            }
        }
        $data['spot_per_channel_loose'] = $cquery;
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
        $cquery = [];
        foreach($query as $key=>$val){
            $oquery[$val->_id->channel] = ['channel'=>$val->_id->channel,'total'=>number_format($val->total,0,'','')];
        }
        foreach($channel as $k=>$v){
            if(isset($oquery[$v->channel])){
                $cquery[$k] = ['channel'=>$oquery[$v->channel]['channel'], 'total'=>$oquery[$v->channel]['total']];
            }
        }
        $data['spot_per_channel'] = $cquery;
        
        //calculate spot per daypart
        $daypart = Daypartsetting::orderBy('start_time')->get();
        if($daypart){
            foreach($daypart as $key=>$val){
                $c = clone($commercial); 
                $time   = explode(":", $val->start_time);
                $hour   = $time[0] * 60 * 60;
                $minute = $time[1] * 60;
                $start_ms = $hour + $minute;
                $time   = explode(":", $val->end_time);
                if($time[0] == 0){ // end at midnight
                    $hour   = 24 * 60 * 60;
                }else{
                    $hour   = $time[0] * 60 * 60;
                }
                $minute = $time[1] * 60;
                $end_ms = $hour + $minute - 1;
                $data['daypart'][$key]['name'] = $val->daypart;
                // summary spot
                $filterdp = $filter;
                array_push($filterdp,[ '$match' => [ 'start_timestamp' => [ '$gte' => $start_ms ] ] ] );            
                array_push($filterdp,[ '$match' => [ 'start_timestamp' => [ '$lte' => $end_ms ] ] ] );            
                $count = $co::raw(function($collection) use($filterdp) 
                {
                    return $collection->aggregate(array_merge($filterdp,[                                    
                            [
                                '$group'=> [
                                '_id'=> 1,
                                'count'=> [
                                    '$sum'=> '$no_of_spots'
                                ]
                                ]
                            ]
                        ])
                        ,['allowDiskUse' => true]
                        );
                });
                $data['daypart'][$key]['value'] = $count[0]['count'] ?? 0;
            }
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
                            '$sum'  => '$no_of_spots'
                        ],
                        'adex' => [
                            '$sum'  => '$cost'
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 10
                ],
            ]));
        });
        if($query){
            $topchannel = [];
            foreach($query as $key=>$val){
                $topchannel[$key]['channel'] = $val->_id->channel;
                $topchannel[$key]['spot'] = $val->count;
                $topchannel[$key]['adex'] = $val->adex/1000000;
            }
            $data['top_channel'] = $topchannel;
        }
        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nprogramme'=>'$nprogramme',
                        ],
                        'count' => [
                            '$sum'  => '$no_of_spots'
                        ],
                        'adex' => [
                            '$sum'  => '$cost'
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 10
                ],
            ]));
        });        
        if($query){
            $topprogramme = [];
            foreach($query as $key=>$val){
                $topprogramme[$key]['programme'] = $val->_id->nprogramme;
                $topprogramme[$key]['spot'] = $val->count;
                $topprogramme[$key]['adex'] = $val->adex/1000000;
            }
            $data['top_programme'] = $topprogramme;
        }
        $query = Commercial::raw(function($collection) use($filter) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nproduct'=>'$nproduct',
                        ],
                        'count' => [
                            '$sum'  => '$no_of_spots'
                        ],
                        'adex' => [
                            '$sum'  => '$cost'
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ],
                [
                    '$limit' => 10
                ],
            ]));
        });           
        if($query){
            $topproduct = [];
            foreach($query as $key=>$val){
                $topproduct[$key]['product'] = $val->_id->nproduct;
                $topproduct[$key]['spot'] = $val->count;
                $topproduct[$key]['adex'] = $val->adex/1000000;
            }
            $data['top_product'] = $topproduct;
        }
        $l = clone($log);
        $data['data_update'] = $l->where('action','regexp','/data update/')->orderBy('created_at','DESC')->take(10)->get();
        $l = clone($log);
        $data['video_update'] = $l->where('action','regexp','/video update/')->orderBy('created_at','DESC')->take(10)->get();
        $data['activity'] = Log::where('action','login')->orderBy('created_at','DESC')->take(10)->get();
        if(!empty($data['activity'])) foreach($data['activity'] as $key=>$val){
            $user = User::find($val->user_id);
            $data['activity'][$key]['name'] = $user->name;
        }
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
            $data['spot_per_date'][$key]['total'] = number_format($val->total,0,'','');
        }
        usort($data['spot_per_date'], function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        if($action == 'pdf'){
            $pdf = PDF::loadView('admin.highlightpdf',compact('request','data'));
            return $pdf->download('vislog_highlight.pdf');
        }elseif($action == 'print'){
            return view('admin.highlightprint',compact('request','data'));
        }else{
            return view('admin.highlight',compact('data','request'));
        }
    }

    public function spot_per_productjson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nproduct'=>'$nproduct',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_advertiserjson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nadvertiser'=>'$nadvertiser',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_sectorjson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nsector'=>'$nsector',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_categoryjson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'ncategory'=>'$ncategory',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    
    public function spot_per_programmejson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }


        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nprogramme'=>'$nprogramme'
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_level1json(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }


        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nlevel_1'=>'$nlevel_1',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }
    public function spot_per_level2json(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01';
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }


        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nlevel_2'=>'$nlevel_2',
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ]
                    ]
                ]
            ]));
        });
        return datatables($query
        )
        ->toJson();
    }

    public function spot_per_adstypejson(Request $request)
    {        
        if($request->ntargetaudience){
            $ta = $request->ntargetaudience;
        }else{
            $ta ='01'; 
        }
        $variable = 'no_of_spots';
        $variabled = '$no_of_spots';
        $divider = 1;
        if($request->variable == 'COST'){
            $variable = 'cost';
            $variabled = '$cost';
            $divider = 1000000;
        }
        if($request->variable == 'GRP'){
            $variable = 'tvr'.$ta;
            $variabled = '$tvr'.$ta;
        }
        $filter = [];
        // apply privileges
        if(!empty(Auth::user()->privileges['startdate'])){
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => Auth::user()->privileges['startdate'] ] ] ]);
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => Auth::user()->privileges['enddate'] ] ] ] );
        } 
        if(!empty(Auth::user()->privileges['nsector'])) {
            array_push($filter,[ '$match' => ['nsector' => ['$in' => explode(';',Auth::user()->privileges['nsector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncategory'])) {
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => explode(';',Auth::user()->privileges['ncategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['nproduct'])) {
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => explode(';',Auth::user()->privileges['nproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['nadvertiser'])) {
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => explode(';',Auth::user()->privileges['nadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ncopy'])) {
            array_push($filter,[ '$match' => ['ncopy' => ['$in' => explode(';',Auth::user()->privileges['ncopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nadstype'])) {
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => explode(';',Auth::user()->privileges['nadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['channel']))  {
            array_push($filter,[ '$match' => ['channel' => ['$in' => explode(';',Auth::user()->privileges['channel'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_1'])) {
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => explode(';',Auth::user()->privileges['nlevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nlevel_2'])) {
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => explode(';',Auth::user()->privileges['nlevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['nprogramme'])) {
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => explode(';',Auth::user()->privileges['nprogramme'])]]]);  
        }
        if(!empty(Auth::user()->privileges['isector'])) {
            array_push($filter,[ '$match' => ['isector' => ['$in' => explode(';',Auth::user()->privileges['isector'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icategory'])) {
            array_push($filter,[ '$match' => ['icategory' => ['$in' => explode(';',Auth::user()->privileges['icategory'])]]]);  
        }           
        if(!empty(Auth::user()->privileges['iproduct'])) {
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => explode(';',Auth::user()->privileges['iproduct'])]]]);  
        } 
        if(!empty(Auth::user()->privileges['iadvertiser'])) {
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadvertiser_group'])) {
            array_push($filter,[ '$match' => ['iadvertiser_group' => ['$in' => explode(';',Auth::user()->privileges['iadvertiser_group'])]]]);  
        }
        if(!empty(Auth::user()->privileges['icopy'])) {
            array_push($filter,[ '$match' => ['icopy' => ['$in' => explode(';',Auth::user()->privileges['icopy'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iadstype'])) {
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => explode(';',Auth::user()->privileges['iadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['tadstype'])) {
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => explode(';',Auth::user()->privileges['tadstype'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_1'])) {
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => explode(';',Auth::user()->privileges['ilevel_1'])]]]);  
        }
        if(!empty(Auth::user()->privileges['ilevel_2'])) {
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => explode(';',Auth::user()->privileges['ilevel_2'])]]]);  
        }
        if(!empty(Auth::user()->privileges['iprogramme'])) {
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => explode(';',Auth::user()->privileges['iprogramme'])]]]);  
        }
        // apply filter
        if($request->startdate){
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->startdate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$request->enddate.' 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 00:00:00')->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );
        }
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$gte' => $starttimestamp ] ] ]);
            array_push($filter,[ '$match' => [ 'start_timestamp' => [ '$lte' => $endtimestamp ] ] ] );
        }
        if($request->channel){
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(';',$request->channel))]]]);  
        }
        if($request->nprogramme){
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(';',$request->nprogramme))]]]);  
        }
        if($request->iprogramme){
            array_push($filter,[ '$match' => ['iprogramme' => ['$in' => array_filter(explode(';',$request->iprogramme))]]]);  
        }
        if($request->nlevel_1){
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(';',$request->nlevel_1))]]]);  
        }
        if($request->ilevel_1){
            array_push($filter,[ '$match' => ['ilevel_1' => ['$in' => array_filter(explode(';',$request->ilevel_1))]]]);  
        }
        if($request->nlevel_2){
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(';',$request->nlevel_2))]]]);  
        }
        if($request->ilevel_2){
            array_push($filter,[ '$match' => ['ilevel_2' => ['$in' => array_filter(explode(';',$request->ilevel_2))]]]);  
        }
        if($request->nadvertiser){
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(';',$request->nadvertiser))]]]);  
        }
        if($request->iadvertiser){
            array_push($filter,[ '$match' => ['iadvertiser' => ['$in' => array_filter(explode(';',$request->iadvertiser))]]]);  
        }
        if($request->nproduct){
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(';',$request->nproduct))]]]);  
        }
        if($request->iproduct){
            array_push($filter,[ '$match' => ['iproduct' => ['$in' => array_filter(explode(';',$request->iproduct))]]]);  
        }
        if($request->nsector){
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(';',$request->nsector))]]]);  
        }
        if($request->isector){
            array_push($filter,[ '$match' => ['isector' => ['$in' => array_filter(explode(';',$request->isector))]]]);  
        }
        if($request->ncategory){
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(';',$request->ncategory))]]]);  
        }
        if($request->icategory){
            array_push($filter,[ '$match' => ['icategory' => ['$in' => array_filter(explode(';',$request->icategory))]]]);  
        }
        if($request->nadstype){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(';',$request->nadstype))]]]);  
        }
        if($request->iadstype){
            array_push($filter,[ '$match' => ['iadstype' => ['$in' => array_filter(explode(';',$request->iadstype))]]]);  
        }
        if($request->tadstype){
            array_push($filter,[ '$match' => ['tadstype' => ['$in' => array_filter(explode(';',$request->tadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            array_push($filter,[ '$match' => ['nsector' => ['$nin' => ['NON-COMMERCIAL ADVERTISEMENT']]]]);  
        }
        if($request->xadstype == "loosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => ['LOOSE SPOT']]]]);  
        }
        if($request->xadstype == "nonloosespot"){
            array_push($filter,[ '$match' => ['nadstype' => ['$nin' => ['LOOSE SPOT']]]]);  
        }

        if(!empty($request->ncommercialdata) && $request->ncommercialdata == 'grouped'){
            $co = new Commercialgrouped;
        }else{
            $co = new Commercial;
        }
        $query = $co::raw(function($collection) use($filter,$ta,$variabled,$divider) 
        {
            return $collection->aggregate(array_merge($filter,[
                [
                    '$group'    => [
                        '_id'   => [
                            'nadstype'=>'$nadstype'
                        ],
                        'total' => [
                            '$sum'  => [
                                '$divide' => [$variabled,$divider]
                            ]                        
                        ],
                        'cost' => [
                            '$sum'  => '$cost'
                        ],
                        'grp' => [
                            '$sum'  => '$tvr'.$ta        
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
