<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FFMpeg;
use \App\Channel;
use \App\Commercial;
use \App\Config;
use \App\Videodata;
use \Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use App\Log;
use Auth;

class VideoController extends Controller
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

    public function tvads()
    {
        return view('admin.tvads.index');
    }

    public function tvadsjson(Request $request)
    {
        // dd($request->all());
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

        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

    public function tvprogramme()
    {
        return view('admin.tvprogramme.index');
    }

    public function tvprogrammejson(Request $request)
    {
        // dd($request->all());
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
        // 'date'=> ['$dateToString' => ['format' => '%d-%m-%Y', 'date' => '$date', 'timezone' => '+07:00' ]] ,
        $query = Commercialgrouped::select('date','channel','iprogramme','iproduct','iadstype','start_time','duration');
        
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

        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

    public function generatevideo(Request $request)
    {
        $temppath = Config::select('value')->where('key','temp path')->first();
        $webpath = Config::select('value')->where('key','web path')->first();
        // check if video already exist in temp
        if(file_exists($temppath->value."\\".$request->id.".mp4")){
            Log::create(['user_id'=>Auth::user()->id,'action'=>'play','page'=>$request->page??'','target'=>$webpath->value."/".$request->id.".mp4"]);
            return url($webpath->value."/".$request->id.".mp4");
        }

        // video not exist, create
        $commercial = Commercial::find($request->id);
        $librarypath = Config::select('value')->where('key','video path')->first();
        // get channel
        $channel = Channel::where('channel',$commercial->channel)->first();

        $channel = "channel".$channel->code;
        // get bumper
        $bumper = Config::select('value')->where('key','video bumper')->first();
        $bumper = $bumper->value ?? 2;
        $date = Carbon::createFromFormat('Y-m-d', $commercial->date)->format('Y_m_d');
        $start_video1 = Carbon::createFromFormat('H:i:s',$commercial->start_video1);
        $end_video1 = Carbon::createFromFormat('H:i:s',$commercial->end_video1);
        $start5minute = floor($start_video1->format("i") / 5)*5;
        $end5minute = floor($end_video1->format("i") / 5)*5;
        if($start5minute == $end5minute){
            //only 1 file
            $minute = str_pad($start5minute, 2, '0', STR_PAD_LEFT);
            $sourcepath = $librarypath->value."\\".$channel."\\".$date."\\";
            $sourcefilename = $channel."_".$date."_".$start_video1->format("H")."_".$minute."_00.mp4";
            $sourcestarttime = Carbon::createFromFormat("H_i_s",$start_video1->format("H")."_".$minute."_00");
            $clipbeginning = $sourcestarttime->diffInSeconds($start_video1)-$bumper;
            $duration = Carbon::createFromFormat("H:i:s",$commercial->duration)->addSeconds($bumper*2)->format("s");
            $process = new Process('ffmpeg -i "'.$sourcepath.$sourcefilename.'" -ss '.$clipbeginning.' -c copy -t '.$duration.' "'.$temppath->value.'\\'.$request->id.'.mp4" -y');
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }else{
            // need to concatenate/join 2 file
            $minute1 = str_pad($start5minute, 2, '0', STR_PAD_LEFT);
            $minute2 = str_pad($end5minute, 2, '0', STR_PAD_LEFT);
            $hour1 = $start_video1->format("H");
            $hour2 = $hour1;
            if($minute1 >= 55 ){
                $hour2 += 1;
            }
            $sourcepath = $librarypath->value."\\".$channel."\\".$date."\\";
            $sourcefilename1 = $channel."_".$date."_".$hour1."_".$minute1."_00.mp4";
            $sourcefilename2 = $channel."_".$date."_".$hour2."_".$minute2."_00.mp4";
            // dd($sourcepath.$sourcefilename1);
            // convert mp4 to ts before concat
            $ts = new Process('ffmpeg -i '.$sourcepath.$sourcefilename1.' -c copy -bsf:v h264_mp4toannexb -f mpegts '.$temppath->value.'\\ts1'.$request->id.'.ts');
            $ts->run();
            $ts = new Process('ffmpeg -i '.$sourcepath.$sourcefilename2.' -c copy -bsf:v h264_mp4toannexb -f mpegts '.$temppath->value.'\\ts2'.$request->id.'.ts');
            $ts->run();
            // join 2 source file
            $joinedsource = new Process('ffmpeg -i "concat:'.$temppath->value.'\\ts1'.$request->id.'.ts|'.$temppath->value.'\\ts2'.$request->id.'.ts" -c copy -bsf:a aac_adtstoasc '.$temppath->value.'\\join'.$request->id.'.mp4');
            $joinedsource->run();
            if (!$joinedsource->isSuccessful()) {
                throw new ProcessFailedException($joinedsource);
            }
            $sourcestarttime = Carbon::createFromFormat("H_i_s",$start_video1->format("H")."_".$minute1."_00");
            $clipbeginning = $sourcestarttime->diffInSeconds($start_video1)-$bumper;
            $duration = Carbon::createFromFormat("H:i:s",$commercial->duration)->addSeconds($bumper*2)->format("s");
            $process = new Process('ffmpeg -i "'.$temppath->value.'\\join'.$request->id.'.mp4" -ss '.$clipbeginning.' -c copy -t '.$duration.' "'.$temppath->value.'\\'.$request->id.'.mp4" -y');
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            // delete temp file ts and joined
            unlink($temppath->value.'\\ts1'.$request->id.'.ts');
            unlink($temppath->value.'\\ts2'.$request->id.'.ts');
            unlink($temppath->value.'\\join'.$request->id.'.mp4');
        }
        Log::create(['user_id'=>Auth::user()->id,'action'=>'play','page'=>$request->page??'','target'=>$webpath->value."/".$request->id.".mp4"]);
        return url($webpath->value."/".$request->id.".mp4");
    }

    public function spotpairing()
    {
        return view('admin.spotpairing.index');
    }

    public function videodata()
    {
        $config = [];
        $configs = Config::all();
        foreach($configs as $val){
            $key = strtolower(str_replace(' ','_',$val->key));
            $config[$key] = $val->value;
        }
        return view('admin.videodata.index',compact('config'));
    }    
    public function videodatajson()
    {
        $query = Videodata::select('date','channel','count','remarks')->orderBy('isodate','desc');
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.videodata.action',compact('dt'));
        })->toJson();
    }
    
    public function videodatacreate()
    {
        return view('admin.videodata.createupdate');
    }
    
    public function videodatastore(Request $request)
    {
        $requestData = $request->all();
        Log::create(['user_id'=>Auth::user()->id,'action'=>'video update - '.$request->channel,'date'=>date('Y-m-d')]);
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['date'].' 00:00:00')->toDateTimeString();
        $requestData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        Videodata::create($requestData);
        Session::flash('message', 'Video Data disimpan'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/videodata');
    }

    public function videodataedit($id)
    {
        $item = Videodata::find($id);
        return view('admin.videodata.createupdate',compact('item'));
    }

    public function videodataupdate($id, Request $request)
    {
        $requestData = $request->all();
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['date'].' 00:00:00')->toDateTimeString();
        $requestData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        Videodata::find($id)->update($requestData);
        Session::flash('message', 'Video Data diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/videodata');
    }

    public function videodatadestroy($id)
    {
        Videodata::destroy($id);
        Session::flash('message', 'Video Data dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/videodata');
    }

    public function updateconfigs(Request $request)
    {
        Config::where('key',$request->key)->update(['value'=>$request->value]);
        Session::flash('message', 'Video Setting diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/videodata');
    }

    public function logdownload(Request $request)
    {
        Log::create(['user_id'=>Auth::user()->id,'action'=>'download','page'=>$request->page,'target'=>$request->target]);
    }
}
