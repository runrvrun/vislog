<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use \Carbon\Carbon;
use App\Log;

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
        // dd($data);
        return view('admin.dashboard',compact('data'));
    }
    public function highlight()
    {
        return view('admin.highlight');
    }
}
