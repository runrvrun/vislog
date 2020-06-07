<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FFMpeg;
use \App\Channel;
use \App\Commercial;
use \App\Spotmatching;
use \App\Tvprogramme;
use \App\Config;
use \App\Videodata;
use \Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use App\Log;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use File;
use ZipArchive;

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

        $query = Commercial::select('date','channel',
            'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
            'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
            'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
            'start_time','end_time','duration','break_type');

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
        } 
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            $query->whereBetween('start_timestamp',[$starttimestamp,$endtimestamp]);
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
        if($request->xadstype == "loosespot"){
            $query->where('nadstype','=','LOOSE SPOT');
        }
        if($request->xadstype == "nonloosespot"){
            $query->where('nadstype','<>','LOOSE SPOT');
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
        if(!empty(Auth::user()->privileges['iadvertiser_group']))  $query->whereIn('iadvertiser_group',explode(';',Auth::user()->privileges['iadvertiser_group']));
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

        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

    public function tvadscsvall(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->subDays(1);
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate);
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
        $filternadstype = array_filter(explode(';',$request->{'filter-nadstype'}));
        $filteriadstype = array_filter(explode(';',$request->{'filter-iadstype'}));
        $filtertadstype = array_filter(explode(';',$request->{'filter-tadstype'}));
        
        $query = Commercial::select('date','channel',
        'nprogramme','nlevel_1','nlevel_2','nsector','ncategory','nadvertiser','nproduct','ncopy','nadstype',
        'iprogramme','ilevel_1','ilevel_2','isector','icategory','iadvertiser','iadvertiser_group',
        'iproduct','icopy','iadstype','tadstype','size','title','sb_time','sb_no','position','pos_in_break','tot_spots_in_break',
        'start_time','end_time','duration','break_type');

        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
        } 
        if($request->starttime && $request->endtime){
            $starttimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->starttime)->timestamp;        
            $endtimestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$request->endtime)->timestamp;        
            $query->whereBetween('start_timestamp',[$starttimestamp,$endtimestamp]);
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
        if($request->{'filter-ncommercialtype'} == "commercialonly"){
            $query->where('nsector','<>','NON-COMMERCIAL ADVERTISEMENT');
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
        if(!empty(Auth::user()->privileges['iadvertiser_group']))  $query->whereIn('iadvertiser_group',explode(';',Auth::user()->privileges['iadvertiser_group']));
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

        $export = $query->get();
        $filename = 'vislog-tvads.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/vislog-tvads.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }

    public function tvprogramme()
    {
        return view('admin.tvprogramme.index');
    }

    public function tvprogrammejson(Request $request)
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

        $query = Tvprogramme::select('date','channel','nprogramme','nlevel_1','nlevel_2','iprogramme','ilevel_1','ilevel_2','iproduct','iadstype','start_time','end_time','duration','cost','status','kode','rate');
        
        if($request->startdate && $request->enddate){
            $query->whereBetween('isodate',[$startdate,$enddate]);
        } 
        if($request->starttime && $request->endtime){
            $starttimestamp = $request->starttime;
            $endtimestamp = $request->endtime;
            $query->whereBetween('start_time',[$starttimestamp,$endtimestamp]);
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
        // add filter by user privilege 
        if(!empty(Auth::user()->privileges['startdate']))  {            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['startdate'].' 00:00:00')->toDateTimeString();
            $isostartdate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['enddate'].' 00:00:00')->toDateTimeString();
            $isoenddate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $query->whereBetween('isodate',[$isostartdate,$isoenddate]);
        }
        if(!empty(Auth::user()->privileges['channel']))  $query->whereIn('channel',explode(';',Auth::user()->privileges['channel']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']??'%%'));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']??'%%'));

        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.adsperformance.action',compact('dt'));
        })->toJson();
    }

    public function tvprogrammecsvall(Request $request)
    {
        $startdate = Carbon::createFromFormat('Y-m-d',$request->startdate)->subDays(1);
        $enddate = Carbon::createFromFormat('Y-m-d',$request->enddate);
        $filterchannel = array_filter(explode(';',$request->{'filter-channel'}));
        $filternprogramme = array_filter(explode(';',$request->{'filter-nprogramme'}));
        $filteriprogramme = array_filter(explode(';',$request->{'filter-iprogramme'}));
        $filternlevel_1 = array_filter(explode(';',$request->{'filter-nlevel_1'}));
        $filterilevel_1 = array_filter(explode(';',$request->{'filter-ilevel_1'}));
        $filternlevel_2 = array_filter(explode(';',$request->{'filter-nlevel_2'}));
        $filterilevel_2 = array_filter(explode(';',$request->{'filter-ilevel_2'}));
        
        $query = Tvprogramme::select('date','channel','nprogramme','nlevel_1','nlevel_2','iprogramme','ilevel_1','ilevel_2','iproduct','iadstype','start_time','end_time','duration','cost','status','kode','rate');

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
        // add filter by user privilege 
        if(!empty(Auth::user()->privileges['startdate']))  {            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['startdate'].' 00:00:00')->toDateTimeString();
            $isostartdate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $date = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->privileges['enddate'].' 00:00:00')->toDateTimeString();
            $isoenddate = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));            
            $query->whereBetween('isodate',[$isostartdate,$isoenddate]);
        }
        if(!empty(Auth::user()->privileges['channel']))  $query->whereIn('channel',explode(';',Auth::user()->privileges['channel']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_1']))  $query->whereIn('nlevel_1',explode(';',Auth::user()->privileges['nlevel_1']??'%%'));
        if(!empty(Auth::user()->privileges['nlevel_2']))  $query->whereIn('nlevel_2',explode(';',Auth::user()->privileges['nlevel_2']??'%%'));
        if(!empty(Auth::user()->privileges['nprogramme'])) $query->whereIn('nprogramme',explode(';',Auth::user()->privileges['nprogramme']??'%%'));

        $export = $query->get();
        $filename = 'vislog-tvprogramme.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/vislog-tvprogramme.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }
    public function tvprogrammeget(Request $request){
        $query = Tvprogramme::select('date','channel','nprogramme','nlevel_1','nlevel_2','iprogramme','ilevel_1','ilevel_2','iproduct','iadstype','start_time','end_time','duration','cost','status','kode','rate')
        ->where('_id',$request->id)->first();
        return $query;
    }

    public function generatevideo(Request $request)
    {
        $temppath = Config::select('value')->where('key','temp path')->first();
        $webpath = Config::select('value')->where('key','web path')->first();
        // check if video already exist in temp
        if(file_exists($temppath->value."\\".$request->id.".m3u8")){
            Log::create(['user_id'=>Auth::user()->id,'action'=>'play','page'=>$request->page??'','target'=>$webpath->value."/".$request->id.".m3u8"]);
            return url($webpath->value."/".$request->id.".m3u8");
        }

        // video not exist, create
        if($request->table == 'spotmatching'){
            $commercial = Spotmatching::find($request->id);
        }elseif($request->table == 'tvprogramme'){
            $commercial = Tvprogramme::find($request->id);
            $librarypath = Config::select('value')->where('key','video path hd')->first();
        }else{
            $commercial = Commercial::find($request->id);            
            if($commercial->nadstype == "LOOSE SPOT"){
                $librarypath = Config::select('value')->where('key','video path')->first();
            }else{
                $librarypath = Config::select('value')->where('key','video path hd')->first();
            }
        }
        // get channel
        $channel = Channel::where('channel',$commercial->channel)->first();

        $channel = "channel".$channel->code;
        // get bumper
        $bumper = Config::select('value')->where('key','video bumper')->first();
        $bumper = $bumper->value ?? 0;
        if($request->table == 'spotmatching'){
            $d_start = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->start_video1);
            $d_end = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->end_video1);
        }elseif($request->table == 'tvprogramme'){
            $d_start = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->start_video);
            $d_end = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->end_video);
        }else{
            if($commercial->nadstype == "LOOSE SPOT"){
                $d_start = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->start_video2);
                $d_end = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->end_video2);
            }else{
                $d_start = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->start_video1);
                $d_end = Carbon::createFromFormat('Y-m-d H:i:s',$commercial->date." ".$commercial->end_video1);
            }
        }
        if($d_end < $d_start) $d_end->addDays(1); // cross midnight, add 1 day
        $d_first = clone($d_start);// first video file
        $d_first->subMinutes($d_first->minute % 5);// 5 minutes files
        $d_first->subSeconds($d_first->second);// remove seconds
        $d_last = clone($d_end);;// last video file
        $d_last->subMinutes($d_last->minute % 5);// 5 minutes files
        $d_last->subSeconds($d_last->second);// remove seconds
        $channelpath = $librarypath->value."\\".$channel."\\";
        //loop and copy to temp_video
        $i=0;
        $d_pro = clone($d_first);
        while($d_pro <= $d_last){                
            $filename = $channel."_".$d_pro->format('Y_m_d_H_i_s').".mp4";
            $ts = new Process('ffmpeg -y -i '.$channelpath.$d_pro->format('Y_m_d')."\\".$filename.' -c copy -bsf:v h264_mp4toannexb -f mpegts '.$temppath->value.'\\ts'.$i.'_'.$request->id.'.ts');
            $ts->run();
            $d_pro->addMinutes(5);
            $i++;
        }
        $i--;
        //join video into 1
        $j=0;
        while($j<$i){
            $join = new Process('ffmpeg -y -i "concat:'.$temppath->value.'\\ts0'.'_'.$request->id.'.ts|'.$temppath->value.'\\ts'.($j+1).'_'.$request->id.'.ts" -c copy -bsf:v h264_mp4toannexb -f mpegts '.$temppath->value.'\\ts_'.$request->id.'.ts');
            $join->run();
            if (!$join->isSuccessful()) {
                // throw new ProcessFailedException($join);
            }
            @unlink($temppath->value.'\\ts0_'.$request->id.'.ts');//delete ts0
            @unlink($temppath->value.'\\ts'.($j+1).'_'.$request->id.'.ts');//delete file #2
            @rename($temppath->value.'\\ts_'.$request->id.'.ts',$temppath->value.'\\ts0_'.$request->id.'.ts');//rename ts to ts0 for next process
            $j++;
        }
        //convert ts file to mp4
        $mp4 = new Process('ffmpeg -y -i '.$temppath->value.'\\ts0_'.$request->id.'.ts -c copy -bsf:a aac_adtstoasc '.$temppath->value.'\\mp4_'.$request->id.'.mp4');
        $mp4->run();
        if (!$mp4->isSuccessful()) {
            // throw new ProcessFailedException($mp4);
        }
        @unlink($temppath->value.'\\ts0_'.$request->id.'.ts');//delete file ts0_
        //trim the file, add bumper on start and end
        $clipbeginning = $d_first->diffInSeconds($d_start)-$bumper;
        if($clipbeginning < 0 ){
            $clipbeginning = 0;
            $addbumper = $bumper;
        }else{
            $addbumper = $bumper*2;
        }                
        $duration = $d_end->diffInSeconds($d_start)+$addbumper;
        $process = new Process('ffmpeg -y -i "'.$temppath->value.'\\mp4_'.$request->id.'.mp4" -ss '.$clipbeginning.' -c copy -t '.$duration.' "'.$temppath->value.'\\'.$request->id.'.mp4" -y');
        $process->run();
        @unlink($temppath->value.'\\ts0_'.$request->id.'.ts');//delete file ts0_
        @unlink($temppath->value.'\\mp4_'.$request->id.'.mp4');//delete file mp4
        if (!$process->isSuccessful()) {
            // throw new ProcessFailedException($process);
        }
        // convert into streamable HLS m38u format
        $m38u = new Process('ffmpeg -i '.$temppath->value.'\\'.$request->id.'.mp4 -g 60 -hls_time 10 -hls_list_size 0 -hls_flags single_file '.$temppath->value.'\\'.$request->id.'.m3u8');
        $m38u->setTimeout(9600);
        $m38u->run();
        if (!$m38u->isSuccessful()) {
            // throw new ProcessFailedException($m38u);
        }        

        Log::create(['user_id'=>Auth::user()->id,'action'=>'play','page'=>$request->page??'','target'=>$webpath->value."/".$request->id.".mp4"]);
        return url($webpath->value."/".$request->id.".m3u8");
    }
    public function downloadmultivideo(Request $request){
        $id = urldecode($request->id);
        $ids = explode(',',$id);
        $temppath = Config::select('value')->where('key','temp path')->first();

        $zip = new ZipArchive;
        $zip_file = 'vislog-tvads.zip';
        @unlink($temppath->value.'\\'.$zip_file);//delete old file
        if ($zip->open($temppath->value.'\\'.$zip_file, ZipArchive::CREATE) === TRUE)
        {
            foreach($ids as $key=>$val){
                // generate video
                $req = new \Illuminate\Http\Request();
                if($request->table == 'tvprogramme'){
                    $req->replace(['id' => $val,'table'=>'tvprogramme']);
                }else{
                    $req->replace(['id' => $val]);
                }
                $this->generatevideo($req);
                // add generated video to zip
                $videopath = $temppath->value.'\\'.$val.'.mp4';
                if($request->table == 'tvprogramme'){
                    $commercial = Tvprogramme::select('date','start_time','channel','iprogramme','iproduct','iadstype')->where('_id',$val)->first();
                }else{
                    $commercial = Commercial::select('date','start_time','channel','iprogramme','iproduct','iadstype')->where('_id',$val)->first();
                }
                if($request->table == 'tvprogramme'){
                    $zipfile = basename($commercial->iprogramme.'_'.$commercial->channel.'_'.str_replace('-','_',$commercial->date).'_'.str_replace(':','_',$commercial->start_time).'.mp4');
                }else{
                    $zipfile = basename($commercial->iproduct.'_'.$commercial->channel.'_'.$commercial->iadstype.'_'.str_replace('-','_',$commercial->date).'_'.str_replace(':','_',$commercial->start_time).'.mp4');
                }
                $zip->addFile($videopath, $zipfile);
            }
            $zip->close();
        }
        if(file_exists($temppath->value.'\\'.$zip_file)){
            return response()->download($temppath->value.'\\'.$zip_file);
        }else{
            // Session::flash('message', 'Video not found'); 
            // Session::flash('alert-class', 'alert-danger');             
            // return redirect()->back();
            echo '<script type="text/javascript">alert("Video not found");</script>';
            echo '<script type="text/javascript">window.close();</script>';
        }
    }

    public function videodata(Request $request)
    {
        if(!empty($request->fixdate)){
            $commercialg = \App\Commercialgrouped::where('date',$request->date)->get();
            foreach($commercialg as $com){
                $date = Carbon::createFromFormat('Y-m-d H:i:s',$com->date.' 00:00:00')->toDateTimeString();
                $upd['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 '.$com->start_time)->timestamp;
                $upd['start_timestamp'] = $timestamp;                
                \App\Commercialgrouped::find($com->_id)->update($upd);
            }
            $commercial = \App\Commercial::where('date',$request->date)->get();
            foreach($commercial as $com){
                $date = Carbon::createFromFormat('Y-m-d H:i:s',$com->date.' 00:00:00')->toDateTimeString();
                $upd['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01 '.$com->start_time)->timestamp;
                $upd['start_timestamp'] = $timestamp;
                \App\Commercial::find($com->_id)->update($upd);
            }
        }
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
        if($request->key == 'video path' || $request->key == 'video path hd'){
            // remove trailing \
            $request->value = rtrim($request->value, '\\');
        }
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
