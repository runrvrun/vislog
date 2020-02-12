<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;
use App\Log;
use App\Commercial;
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
        }else{
            $commercial->whereBetween('isodate',[Carbon::now()->subDays(1),Carbon::now()]);
            $date = Carbon::now()->subDays(1)->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$gte' => $isodate ] ] ]);
            $date = Carbon::now()->toDateTimeString();
            $isodate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            array_push($filter,[ '$match' => [ 'isodate' => [ '$lte' => $isodate ] ] ] );    
        }
        if($request->channel){
            $commercial->whereIn('channel',array_filter(explode(',',$request->channel)));
            array_push($filter,[ '$match' => ['channel' => ['$in' => array_filter(explode(',',$request->channel))]]]);  
        }
        if($request->nprogramme){
            $commercial->whereIn('nprogramme',array_filter(explode(',',$request->nprogramme)));
            array_push($filter,[ '$match' => ['nprogramme' => ['$in' => array_filter(explode(',',$request->nprogramme))]]]);  
        }
        if($request->nlevel_1){
            $commercial->whereIn('nlevel_1',array_filter(explode(',',$request->nlevel_1)));
            array_push($filter,[ '$match' => ['nlevel_1' => ['$in' => array_filter(explode(',',$request->nlevel_1))]]]);  
        }
        if($request->nlevel_2){
            $commercial->whereIn('nlevel_2',array_filter(explode(',',$request->nlevel_2)));
            array_push($filter,[ '$match' => ['nlevel_2' => ['$in' => array_filter(explode(',',$request->nlevel_2))]]]);  
        }
        if($request->nadvertiser){
            $commercial->whereIn('nadvertiser',array_filter(explode(',',$request->nadvertiser)));
            array_push($filter,[ '$match' => ['nadvertiser' => ['$in' => array_filter(explode(',',$request->nadvertiser))]]]);  
        }
        if($request->nproduct){
            $commercial->whereIn('nproduct',array_filter(explode(',',$request->nproduct)));
            array_push($filter,[ '$match' => ['nproduct' => ['$in' => array_filter(explode(',',$request->nproduct))]]]);  
        }
        if($request->nsector){
            $commercial->whereIn('nsector',array_filter(explode(',',$request->nsector)));
            array_push($filter,[ '$match' => ['nsector' => ['$in' => array_filter(explode(',',$request->nsector))]]]);  
        }
        if($request->ncategory){
            $commercial->whereIn('ncategory',array_filter(explode(',',$request->ncategory)));
            array_push($filter,[ '$match' => ['ncategory' => ['$in' => array_filter(explode(',',$request->ncategory))]]]);  
        }
        if($request->nadstype){
            $commercial->whereIn('nadstype',array_filter(explode(',',$request->nadstype)));
            array_push($filter,[ '$match' => ['nadstype' => ['$in' => array_filter(explode(',',$request->nadstype))]]]);  
        }
        if($request->ncommercialtype == "commercialonly"){
            $commercial->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
        }

        $data['number_of_spot'] = $commercial->sum('no_of_spots');        
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
        $data['daypart'][0] = $commercial->whereBetween('start_timestamp',[0,21600])->sum('no_of_spots');//00.00-06.00
        $data['daypart'][1] = $commercial->whereBetween('start_timestamp',[21601,43200])->sum('no_of_spots');//06.00-12.00
        $data['daypart'][2] = $commercial->whereBetween('start_timestamp',[43201,63000])->sum('no_of_spots');//12.00-17.30
        $data['daypart'][3] = $commercial->whereBetween('start_timestamp',[63001,79200])->sum('no_of_spots');//17.30-22.00
        $data['daypart'][4] = $commercial->whereBetween('start_timestamp',[79201,86400])->sum('no_of_spots');//22.00-00.00

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
            ]));
        });
        // populate dropdown
        $query = \App\Targetaudience::whereNotNull('targetaudience');
        if(!empty(Auth::user()->privileges['targetaudience'])) $query->whereIn('targetaudience',explode(',',Auth::user()->privileges['targetaudience']));
        $data['ddtargetaudience'] = $query->pluck('targetaudience','code');

        return view('admin.dashboard',compact('data'));
    }
    public function highlight()
    {
        // $data['total_user'] = DB::collection('users')->count();
        // $data['total_access'] = Log::where('action','login')->count();
        // $data['min_date'] = Log::min('created_at');
        // $data['max_date'] = Log::max('created_at');
        // $data['days'] = Carbon::createFromTimestampUTC($data['min_date'])->diffInDays(Carbon::createFromTimestampUTC($data['max_date']));
        // $data['avg_user_day'] = number_format(round($data['total_access']/$data['days']),0);
        // $data['total_download'] = Log::where('action','download')->count();
        // $data['daily_user'] = Log::raw(function($collection)
        // {
        //     return $collection->aggregate([
        //         [ '$sort' => [ 'date' => 1 ] ],
        //         [ '$match' => [ 'action' => 'login' ] ],
        //         [ '$match' => [ 'date' => [ '$gte' => Carbon::now()->subDays(30)->format('Y-m-d') ] ] ],
        //         [
        //             '$group'    => [
        //                 '_id'   => [
        //                     'date'=>'$date',
        //                 ],
        //                 'count' => [
        //                     '$sum'  => 1
        //                 ]
        //             ]
        //         ]
        //     ]);
        // });
        //
        $data['number_of_spot'] = Commercial::count();        
        $data['cost'] = Commercial::sum('cost')/1000000000;
        $data['grp'] = 0;
        for($i=1;$i<10;$i++){
            $data['grp'] += Commercial::sum('tvr0'.$i);
        }
        for($i=10;$i<100;$i++){
            $data['grp'] += Commercial::sum('tvr'.$i);
        }
        $data['grp'] += Commercial::sum('tvr100');
        $query = Commercial::raw(function($collection)
        {
            return $collection->aggregate([
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
            ]);
        });
        $data['spot_per_channel'] = $query;
        $query = Commercial::raw(function($collection)
        {
            return $collection->aggregate([
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
            ]);
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
        $data['daypart'][0] = Commercial::whereBetween('start_timestamp',[0,21600])->sum('no_of_spots');//00.00-06.00
        $data['daypart'][1] = Commercial::whereBetween('start_timestamp',[21601,43200])->sum('no_of_spots');//06.00-12.00
        $data['daypart'][2] = Commercial::whereBetween('start_timestamp',[43201,63000])->sum('no_of_spots');//12.00-17.30
        $data['daypart'][3] = Commercial::whereBetween('start_timestamp',[63001,79200])->sum('no_of_spots');//17.30-22.00
        $data['daypart'][4] = Commercial::whereBetween('start_timestamp',[79201,86400])->sum('no_of_spots');//22.00-00.00

        $data['spot_per_date'] = Commercial::raw(function($collection)
        {
            return $collection->aggregate([
                [ '$sort' => [ 'date' => 1 ] ],
                // [ '$match' => [ 'date' => [ '$gte' => Carbon::now()->subDays(30)->format('Y-m-d') ] ] ],
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
            ]);
        });
        return view('admin.highlight',compact('data'));
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
