<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spotmatching;
use \Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use Auth;

class SpotController extends Controller
{    
    public function spotpairing()
    {
        return view('admin.spotpairing.index');
    }

    public function spotpairingjson(Request $request)
    {
        if($request->startdate){
            $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->subDays(1);
            $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate);
            $query = Spotmatching::whereBetween('isodate',[$startdate,$enddate]);
        }else{
            $startdate = Carbon::now()->subDays(1);
            $enddate = Carbon::now();
            $query = Spotmatching::whereBetween('isodate',[$startdate,$enddate]);            
        }
        $queryb = clone($query);
        $data['a'] = $query->where('nproduct','Not Found')->orderBy('iproduct')->orderBy('actual_time')->orderBy('isodate')->get();
        $data['b'] = $queryb->where('iproduct','Not Found')->orderBy('nproduct')->orderBy('start_time')->orderBy('isodate')->get();
        return $data;
    }

    public function spotpairingupdate(Request $request){
        $requestData = $request->all();
        foreach($requestData['i'] as $key=>$val){
            if(!empty($val)){
                $dataa = Spotmatching::where('_id',$key)->first();
                $datab = Spotmatching::where('_id',$val)->first();
                $pair = ['market','activity','target','year','quarter','month','iso_week','day_of_week'
                ,'wk_day/wk_end','nsector','ncategory','nadvertiser','nproduct','ncopy','start_time',
                'end_time','duration','nprogramme','nlevel_1','nlevel_2','nadstype','startvideo1','endvideo1',
                'startvideo2','endvideo2','no_of_spots','cost','t_second_cost','remark','variance',
                'similar','durasi','status','source'];
                foreach($pair as $p){
                    $dataa->update([$p => $datab->$p]);
                }
                $datab->delete();
            }
        }
        
        Session::flash('message', 'Spot pairing sukses'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/spotpairing');
    }
}
