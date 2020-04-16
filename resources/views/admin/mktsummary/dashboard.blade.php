@extends('admin.layouts.app')

@section('pagetitle')
    <title>Marketing Summary</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Market Share Total (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                      </thead>
                      <tbody>
                        @foreach($data['marketshare_channel'] as $key=>$val)
                        <tr>
                          <td>{{ $val['channel'] }}</td>
                          <td style="text-align:right">{{ round($val['percentage']*100).'%' ?? '' }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-8">
            <div class="card">    
                <div class="card-header">
                  <h4 class="card-title">Market Share Total (B)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">          
                    <div class="marketshare-channel-chart ct-perfect-fifth"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Market Share Per Month (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th style="white-space: nowrap;">All TV (B)</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_month'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all']/1000000,2) ?? '' }}</td>
                          @foreach($data['channel'] as $k=>$v)
                          <td style="text-align:right"><?php  $p = $val[$v->channel]['percentage'] ?? 0;?>{{ round($p*100).'%' }}</td>
                          @endforeach                
                          </tr>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Market Share Per Month (B)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Channel</th>
                          @foreach($data['monthlist'] as $key=>$val)
                          <th style="text-align:right">{{ $val }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data['marketshare_month_channel'] as $key=>$val)
                        <tr>
                          <td>{{ $key }}</td>
                          @foreach($data['monthlist'] as $k=>$v)
                          <td style="text-align:right">{{ number_format(($val[$v]['marketshare'] ?? 0)/1000000,2) }}</td>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Market Share Trend (B)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="marketsharemonthchannel-chart ct-square"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Top 10 Agency (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th style="white-space: nowrap;">All TV (B)</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_agency'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all']/1000000,2) ?? '' }}</td>
                          @foreach($data['channel'] as $k=>$v)
                          <td style="text-align:right"><?php  $p = $val[$v->channel]['percentage'] ?? 0;?>{{ round($p*100).'%' }}</td>
                          @endforeach                
                          </tr>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Top 10 Advertiser (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th style="white-space: nowrap;">All TV (B)</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_advertiser'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all']/1000000,2) ?? '' }}</td>
                          @foreach($data['channel'] as $k=>$v)
                          <td style="text-align:right"><?php  $p = $val[$v->channel]['percentage'] ?? 0;?>{{ round($p*100).'%' }}</td>
                          @endforeach                
                          </tr>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Top 10 Product/Brand (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th style="white-space: nowrap;">All TV (B)</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_product'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all']/1000000,2) ?? '' }}</td>
                          @foreach($data['channel'] as $k=>$v)
                          <td style="text-align:right"><?php  $p = $val[$v->channel]['percentage'] ?? 0;?>{{ round($p*100).'%' }}</td>
                          @endforeach                
                          </tr>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Top 10 Sector (%)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th style="white-space: nowrap;">All TV (B)</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_sector'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all']/1000000,2) ?? '' }}</td>
                          @foreach($data['channel'] as $k=>$v)
                          <td style="text-align:right"><?php  $p = $val[$v->channel]['percentage'] ?? 0;?>{{ round($p*100).'%' }}</td>
                          @endforeach                
                          </tr>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
<div id="loading">
  Loading ... <i class="ft-refresh-cw font-medium-4 fa fa-spin align-middle"></i>
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist-plugin-tooltip.css">
<style>
.card-content{
  min-height: 100px;
}
.ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
    stroke: #0CC162;
}
.ct-series-b .ct-bar, .ct-series-b .ct-line, .ct-series-b .ct-point, .ct-series-b .ct-slice-donut {
    stroke: #33BFE0;
}
.ct-series-c .ct-bar, .ct-series-c .ct-line, .ct-series-c .ct-point, .ct-series-c .ct-slice-donut {
    stroke: #F6C41C;
}
</style>
<style>
#loading{
  display: none;
  position: absolute;
  top: -16px;
  left: 700px;
  z-index: 900;
  font-size: 22px;
}
#filterersubmit{
  bottom: 10px;
  top: auto;
  width: 85%;
}
#filtererreset{
  bottom: 10px;
  top: auto;
  width: 9%;
  right: auto;
  left: 10px;
  position: absolute;
  padding: 7px;
  z-index: 10;
}
button.search-result{
  min-width:100px;
}
#rtl-icon2{
  position: fixed;
  right: -1px;
  top: 42%;
  width: 54px;
  height: 50px;
  text-align: center;
  cursor: pointer;
  line-height: 50px;
  margin-top: 50px;
  z-index:3;
}
</style>
@endsection
@section('pagejs')
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist-plugin-tooltip.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
<script>
  var data = {
    labels: [
        @foreach($data['marketshare_channel'] as $key=>$val)
          '{{ $val["channel"] }}',
        @endforeach
        ],
    series: [
        @foreach($data['marketshare_channel'] as $key=>$val)
          {meta: '{{ $val["channel"] }}', value: {{ round($val['marketshare']/1000000) }}},
        @endforeach
    ]
  };
  new Chartist.Pie('.marketshare-channel-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
        @foreach($data['monthlist'] as $k=>$v)            
          '{{ $v }}',
        @endforeach
        ],
    series: [
        @foreach($data['marketshare_month_channel'] as $key=>$val)
          [
            @foreach($data['monthlist'] as $k=>$v)            
            {meta: '{{ $key }}', value: {{ round($val[$v]['marketshare']/1000000 ?? 0) }}},
            @endforeach
          ],
        @endforeach
    ]
  };
  new Chartist.Line('.marketsharemonthchannel-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script type="text/javascript">
$(function() {
    @if(!empty($request->startdate))
    var start = moment("{{$request->startdate}}");
    $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
    @else
    var start = moment().startOf('year'); 
    $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
    @endif    
    @if(!empty($request->enddate))
    var end = moment("{{$request->enddate}}");
    $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
    @else
    var end = moment();
    $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
    @endif


    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari ini': [moment(), moment()],
           'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Hari': [moment().subtract(6, 'days'), moment()],
           '30 Hari': [moment().subtract(29, 'days'), moment()],
           'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      daterange = $('#daterange').data('daterangepicker');
      $('#startdate').val(daterange.startDate.format('YYYY-MM-DD'));
      $('#enddate').val(daterange.endDate.format('YYYY-MM-DD'));
    });

});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".filter-button").click(function(){
    var filter = $(this).data("filter");
    $("#filter-title").html($(this).html());
    $("input[name=filter-active]").val(filter);
    $("#filter-modal-search-result").empty();
    $('#search-term').val('');
    $("#filter-modal").modal();
    // show existing filter in modal footer
    $("#filter-selected").html('');
    $("#filter-selected").html($("input[name="+filter+"]").val());
    // if filter by channel, load directly
    $("#search-button").click();
  });
  $('#search-term').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          $('#search-button').click();
        }
  });
  $("#search-button").click(function(){
    var filter = $("input[name=filter-active]").val();
    $("#filter-modal-search-result").empty();
    var term = $('#search-term').val();
    // get and show search result
    $.ajax({
      url: "{{ url('/admin/adsperformance') }}/search-"+filter+"-json", 
      data: {term: term}, 
      success: function(result){
        if(result.length){
          $.each(result, function(k,v) {
            var curfil = $("#filter-selected").html();
            if(!$("#filter-"+filter).is(':empty') && curfil.indexOf(v[filter] + ',')+1){
              // previously selected, set style
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }else{
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-outline-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }
          });
        }else{
          $('#filter-modal-search-result').html('<p>No result found</p>');
        }
    }});      
  }); 
  $("#filter-modal-search-result").on('click', '.search-result', function() {
    var filter = $("input[name=filter-active]").val();
    count = $("#filter-"+filter+"-count").html(); // get initial button count
    $(this).toggleClass("btn-outline-primary");
    $(this).toggleClass("btn-primary"); 
    var filt = $(this).val();
    if($(this).hasClass('btn-primary')){
      count++; // selected, increment button count
      $("#filter-selected").html(function(i,html) { 
          html = html + filt + ',';
          return html;
      });
    }else{
      count--; // unselected, decrement button count
      newval = $("#filter-selected").html();
      $("#filter-selected").html(newval.replace(filt+',',''));
    }
    $("input[name="+filter+"]").val($("#filter-selected").html());
    $("#filter-"+filter+"-count").html(count); // set count at button
  });
  
  $("#filtererreset").click(function(){
      var start = moment().startOf('year'); 
      $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
      var end = moment();
      $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
      $(".filterer").find('input[type=hidden]').val('');
      $(".filterer").find('select').prop("selectedIndex", 0);
      $("span[id^=filter-]").html('');
  });
  
  $("#filter-reset-selected").click(function(){
    var filter = $("input[name=filter-active]").val();
    $(".search-result.btn-primary").addClass("btn-outline-primary");
    $(".search-result.btn-primary").removeClass("btn-primary");    
    $("#filter-selected").html('');
    $("input[name="+filter+"]").val('');
    $("#filter-"+filter+"-count").html(''); // set count at button
  });
});
</script>
<script>
$(document).ready(function(){
  var resp = false;
  if(window.innerWidth <= 800) resp=true;
    
  $("#filterersubmit").click(function() {
      $("#loading").show();
  });

});
</script>
<script>
$(document).ready(function(){
  $("#rtl-icon2").click(function(){
    var oriaction = $("#filterer-form").attr('action');
    $("#filterer-form").attr('action','{{ url('admin/mktsummary/print') }}');
    $("#filterer-form").attr('target','_blank');
    $("#filterer-form").submit();
    $("#filterer-form").attr('action',oriaction);
    $("#filterer-form").attr('target','');
  });
});
</script>
@endsection
@section('filterer')
<a id="rtl-icon2" class="bg-secondary"><i class="ft-printer font-medium-4 white fa align-middle"></i></a>
<form method="GET" id="filterer-form" action="{{ url('admin/mktsummary') }}">
<div class="filterer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
<a class="filterer-close"><i class="ft-x font-medium-3"></i></a>
<button type="submit" id="filterersubmit" class="btn btn-warning pull-right filterer-close" style="color:#fff"><i class="ft-filter"></i> Process</button>
<a id="filtererreset" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
<a id="rtl-icon" class="filterer-toggle bg-dark"><i class="ft-filter font-medium-4 fa white align-middle"></i></a>
      <div data-ps-id="8db9d3c9-2e00-94a2-f661-18a2e74f8b35" class="filterer-content p-3 ps-container ps-theme-dark ps-active-y">
        <h4 class="text-uppercase mb-0 text-bold-400">Filter Data</h4>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Period</h6>
          <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
              {{ Form::hidden('startdate',null,['id'=>'startdate']) }}
              {{ Form::hidden('enddate',null,['id'=>'enddate']) }}
          </div>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Channel</h6>
        <button type="button" class="btn btn-primary col-10 filter-button" data-filter="channel"><span id="filter-channel-count"></span> Channel</button>
        {{ Form::hidden('channel') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nprogramme">
        <span id="filter-nprogramme-count">{{ ($request->nprogramme)? count(explode(',',$request->nprogramme))-1:'' }}</span> nProgramme</button>
        {{ Form::hidden('nprogramme', $request->nprogramme ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iprogramme">
        <span id="filter-iprogramme-count">{{ ($request->iprogramme)? count(explode(',',$request->iprogramme))-1:'' }}</span> iProgramme</button>
        {{ Form::hidden('iprogramme', $request->iprogramme ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_1">
        <span id="filter-nlevel_1-count">{{ ($request->nlevel_1)? count(explode(',',$request->nlevel_1))-1:'' }}</span> nLevel 1</button>
        {{ Form::hidden('nlevel_1', $request->nlevel_1 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_1">
        <span id="filter-ilevel_1-count">{{ ($request->ilevel_1)? count(explode(',',$request->ilevel_1))-1:'' }}</span> iLevel 1</button>
        {{ Form::hidden('ilevel_1', $request->ilevel_1 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_2">
        <span id="filter-nlevel_2-count">{{ ($request->nlevel_2)? count(explode(',',$request->nlevel_2))-1:'' }}</span> nLevel 2</button>
        {{ Form::hidden('nlevel_2', $request->nlevel_2 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_2">
        <span id="filter-ilevel_2-count">{{ ($request->ilevel_2)? count(explode(',',$request->ilevel_2))-1:'' }}</span> iLevel 2</button>
        {{ Form::hidden('ilevel_2', $request->ilevel_2 ?? null) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Commercial</h6>
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nadvertiser">
        <span id="filter-nadvertiser-count">{{ ($request->nadvertiser)? count(explode(',',$request->nadvertiser))-1:'' }}</span> nAdvertiser</button>
        {{ Form::hidden('nadvertiser', $request->nadvertiser ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadvertiser">
        <span id="filter-iadvertiser-count">{{ ($request->iadvertiser)? count(explode(',',$request->iadvertiser))-1:'' }}</span> iAdvertiser</button>
        {{ Form::hidden('iadvertiser', $request->iadvertiser ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nproduct">
        <span id="filter-nproduct-count">{{ ($request->nproduct)? count(explode(',',$request->nproduct))-1:'' }}</span> nProduct</button>
        {{ Form::hidden('nproduct', $request->nproduct ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iproduct">
        <span id="filter-iproduct-count">{{ ($request->iproduct)? count(explode(',',$request->iproduct))-1:'' }}</span> iProduct</button>
        {{ Form::hidden('iproduct', $request->iproduct ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nsector">
        <span id="filter-nsector-count">{{ ($request->nsector)? count(explode(',',$request->nsector))-1:'' }}</span> nSector</button>
        {{ Form::hidden('nsector', $request->nsector ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="isector">
        <span id="filter-isector-count">{{ ($request->isector)? count(explode(',',$request->isector))-1:'' }}</span> iSector</button>
        {{ Form::hidden('isector', $request->isector ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ncategory">
        <span id="filter-ncategory-count">{{ ($request->ncategory)? count(explode(',',$request->ncategory))-1:'' }}</span> nCategory</button>
        {{ Form::hidden('ncategory', $request->ncategory ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="icategory">
        <span id="filter-icategory-count">{{ ($request->icategory)? count(explode(',',$request->icategory))-1:'' }}</span> iCategory</button>
        {{ Form::hidden('icategory', $request->icategory ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nadstype">
        <span id="filter-nadstype-count">{{ ($request->nadstype)? count(explode(',',$request->nadstype))-1:'' }}</span> nAds Type</button>
        {{ Form::hidden('nadstype', $request->nadstype ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadstype">
        <span id="filter-iadstype-count">{{ ($request->iadstype)? count(explode(',',$request->iadstype))-1:'' }}</span> iAds Type</button>
        {{ Form::hidden('iadstype', $request->iadstype ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="tadstype">
        <span id="filter-tadstype-count">{{ ($request->tadstype)? count(explode(',',$request->tadstype))-1:'' }}</span> tAds Type</button>
        {{ Form::hidden('tadstype', $request->tadstype ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadvertiser_group">
        <span id="filter-iadvertiser_group-count">{{ ($request->iadvertiser_group)? count(explode(',',$request->iadvertiser_group))-1:'' }}</span> Advertiser Group</button>
        {{ Form::hidden('iadvertiser_group', $request->iadvertiser_group ?? null) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Other</h6>        
        <div class="form-group">
        <select name="ncommercialtype" class="form-control col-10">
          <option value="commercialonly"  {{ ($request->ncommercialtype == 'commercialonly') ? 'selected':''}}>Commercial Only</option>
          <option value="allads" {{ ($request->ncommercialtype == 'allads') ? 'selected':''}}>All Ads</option>
        </select>
        <div class="form-group" style="margin-top: 1rem;">
        <select name="nett" class="form-control col-10">
          <option value="nett1"  {{ ($request->nett == 'nett1') ? 'selected':''}}>Market Share 1</option>
          <option value="nett2" {{ ($request->nett == 'nett2') ? 'selected':''}}>Market Share 2</option>
          <option value="nett3" {{ ($request->nett == 'nett2') ? 'selected':''}}>Market Share 3</option>
        </select>
        </div>
        </div>
        <hr>
        <hr>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
          <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 295px; right: 3px;">
          <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 108px;"></div>
        </div>
      </div>
    </div>
</form>
@endsection
@section('modal')
<div class="modal fade text-left show" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8">Filter <span id="filter-title"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="filter-active"></input>
        <div class="input-group row">
          <div class="col-sm-4">
            <input id="search-term" type="text" class="form-control" placeholder="Cari">
          </div>
            <span class="input-group-btn">
                <button id="search-button" class="btn btn-primary" type="button"><span class="ft-search"></span> Cari</button>
            </span>
        </div>
        <div id="filter-modal-search-result" style="height:250px; overflow-y:scroll">
        </div>
      </div>
      <div class="modal-footer">
        <div id="filter-selected"></div>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Add Filter</button>
        <a id="filter-reset-selected" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
