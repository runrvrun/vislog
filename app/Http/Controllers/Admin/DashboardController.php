<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use \Carbon\Carbon;
use App\Log;
use App\Commercial;

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
    public function dashboard()
    {
        $data['total_user'] = DB::collection('users')->count();
        $data['total_access'] = Log::where('action','login')->count();
        $data['min_date'] = Log::min('created_at');
        $data['max_date'] = Log::max('created_at');
        $data['days'] = Carbon::createFromTimestampUTC($data['min_date'])->diffInDays(Carbon::createFromTimestampUTC($data['max_date']));
        $data['avg_user_day'] = number_format(round($data['total_access']/$data['days']),0);
        $data['total_download'] = Log::where('action','download')->count();
        $data['daily_user'] = Log::raw(function($collection)
        {
            return $collection->aggregate([
                [ '$sort' => [ 'date' => 1 ] ],
                [ '$match' => [ 'action' => 'login' ] ],
                [ '$match' => [ 'date' => [ '$gte' => Carbon::now()->subDays(30)->format('Y-m-d') ] ] ],
                [
                    '$group'    => [
                        '_id'   => [
                            'date'=>'$date',
                        ],
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ]
            ]);
        });
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
        // dd($data);
        return view('admin.dashboard',compact('data'));
    }
    public function highlight()
    {
        return view('admin.highlight');
    }
}
