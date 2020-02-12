@extends('admin.layouts.app')

@section('pagetitle')
    <title>Highlight</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
<div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-blackberry">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['number_of_spot'] }}</h3>
              <span>Number of Spot</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-monitor font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-ibiza-sunset">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format($data['cost'],2) }}</h3>
              <span>Cost (IDR Billions)</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-credit-card font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-green-tea">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format($data['grp'],2) }}</h3>
              <span>GRP</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-users font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-pomegranate">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format($data['cost']*1000/$data['grp'],2) }}</h3>
              <span>CPRP (IDR Millions)</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-target font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total Spot for Each Channel</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-channel-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total Spot for Each Product</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-product-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Spot</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total Spot for Each Program</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-programme-table">
            <thead>
              <tr>
                <th>Program</th>
                <th>Spot</th>
              </tr>
            </thead>
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
        <h4 class="card-title">Total Spot for Each Type</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-type-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total Spot for Each Ads Type</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-adstype-table">
            <thead>
              <tr>
                <th>Ads Type</th>
                <th>Spot</th>
              </tr>
            </thead>
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
        <h4 class="card-title">Total Spot for Each Time Period</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-time-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total Spot for Each Daypart</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <div class="spot-per-daypart-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total Spot for Each Date</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-date-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
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
#filterersubmit{
  bottom: 10px;
  top: auto;
  width: 95%;
}
button.search-result{
  min-width:100px;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
<script>
  var data = {
    labels: [
        @foreach($data['spot_per_channel'] as $key=>$val)
          '{{ $val->_id['channel'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_channel'] as $key=>$val)
          {{ $val->total.',' }}
        @endforeach
      ]
    ]
  };
  new Chartist.Bar('.spot-per-channel-chart', data);
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.spot-per-product-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_productjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST'
        },
        columns: [
          { data: '_id.nproduct', name: '_id.nproduct' },
          { data: 'total', name: 'total' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[1, 'DESC']]
    });
});
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.spot-per-programme-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_programmejson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST'
        },
        columns: [
          { data: '_id.nprogramme', name: '_id.nprogramme' },
          { data: 'total', name: 'total' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[1, 'DESC']]
    });
});
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.spot-per-adstype-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_adstypejson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST'
        },
        columns: [
          { data: '_id.nadstype', name: '_id.nadstype' },
          { data: 'total', name: 'total' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[1, 'DESC']]
    });
});
</script>
<script>
  var data = {
    labels: [
        @foreach($data['spot_per_type'] as $key=>$val)
          '{{ $key }} ({{ $val }})',
        @endforeach
        ],
    series: [
        @foreach($data['spot_per_type'] as $key=>$val)
          {{ $val }},
        @endforeach
    ]
  };
  new Chartist.Pie('.spot-per-type-chart', data, {donut: true});
</script>
<script>
  var data = {
    labels: [
          'Primetime ({{ $data["daypart"][3] }})',
          'Non Primetime ({{ $data["daypart"][0]+$data["daypart"][1]+$data["daypart"][2]+$data["daypart"][4] }})',
        ],
    series: [
        {{ $data["daypart"][3] }},
        {{ $data["daypart"][0]+$data["daypart"][1]+$data["daypart"][2]+$data["daypart"][4] }}
    ]
  };
  new Chartist.Pie('.spot-per-time-chart', data, {donut: true});
</script>
<script>
  var data = {
    labels: [
          '00.00-06.00',
          '06.00-12.00',
          '12.00-17.30',
          '17.30-22.00',
          '22.00-00.00',
        ],
    series: [
      [
        {{ $data["daypart"][0] }},
        {{ $data["daypart"][1] }},
        {{ $data["daypart"][2] }},
        {{ $data["daypart"][3] }},
        {{ $data["daypart"][4] }},
      ]
    ]
  };
  new Chartist.Bar('.spot-per-daypart-chart', data);
</script>
<script>
  var data = {
    labels: [
        @foreach($data['spot_per_date'] as $key=>$val)
          '{{ $val->_id['date'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_date'] as $key=>$val)
          {{ $val->total.',' }}
        @endforeach
      ]
    ]
  };
  new Chartist.Line('.spot-per-date-chart', data);
</script>
<script type="text/javascript">
$(function() {
    var start = moment().subtract(1, 'day');
    $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
    var end = moment();
    $('input[name=enddate]').val(end.format('YYYY-MM-DD'));

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
    $("#filter-selected").html($("input[name=filter-"+filter+"]").val());
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
    $("input[name=filter-"+filter+"]").val($("#filter-selected").html());
    $("#filter-"+filter+"-count").html(count); // set count at button
  });
});
</script>
<script>
$(document).ready(function(){
  var resp = false;
  if(window.innerWidth <= 800) resp=true;
  
  $("#filterersubmit").click(function() {
  //
  });

  $("select[name='filter-ntargetaudience']").addClass('selectpicker'); // dropdown search with bootstrap select
  $("select[name='filter-ntargetaudience']").attr('data-live-search','true'); // dropdown search with bootstrap select
  $("select[name='filter-ntargetaudience']").attr('data-size','3'); // dropdown search with bootstrap select
});
</script>
@endsection
@section('filterer')
<div class="filterer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
<a class="filterer-close"><i class="ft-x font-medium-3"></i></a>
<button id="filterersubmit" class="btn btn-warning pull-right filterer-close" style="color:#fff"><i class="ft-filter"></i> Process</button>
<a id="rtl-icon" class="filterer-toggle bg-dark"><i class="ft-filter font-medium-4 fa white align-middle"></i></a>
      <div data-ps-id="8db9d3c9-2e00-94a2-f661-18a2e74f8b35" class="filterer-content p-3 ps-container ps-theme-dark ps-active-y">
        <h4 class="text-uppercase mb-0 text-bold-400">Filter Data</h4>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Period & Time</h6>
          <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
              {{ Form::hidden('startdate',null,['id'=>'startdate']) }}
              {{ Form::hidden('enddate',null,['id'=>'enddate']) }}
          </div>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Channel</h6>
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="channel"><span id="filter-channel-count"></span> Channel</button>
        {{ Form::hidden('filter-channel') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nprogramme"><span id="filter-nprogramme-count"></span> Programme</button>
        {{ Form::hidden('filter-nprogramme') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nlevel1"><span id="filter-nlevel1-count"></span> Level 1</button>
        {{ Form::hidden('filter-nlevel1') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nlevel2"><span id="filter-nlevel2-count"></span> Level 2</button>
        {{ Form::hidden('filter-nlevel2') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Commercial</h6>
        <button class="btn btn-primary col-5 filter-button" data-filter="nadvertiser"><span id="filter-nadvertiser-count"></span> Advertiser</button>
        {{ Form::hidden('filter-nadvertiser') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nproduct"><span id="filter-nproduct-count"></span> Product</button>
        {{ Form::hidden('filter-nproduct') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nsector"><span id="filter-nsector-count"></span> Sector</button>
        {{ Form::hidden('filter-nsector') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="ncategory"><span id="filter-ncategory-count"></span> Category</button>
        {{ Form::hidden('filter-ncategory') }}
        <button class="btn btn-primary col-10 filter-button" data-filter="nadstype"><span id="filter-nadstype-count"></span> Ads Type</button>
        {{ Form::hidden('filter-nadstype') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Target Audience</h6>
        {{ Form::select('filter-ntargetaudience',\App\Targetaudience::whereNotNull('targetaudience')->pluck('targetaudience','code'),null,['class'=>'form-control']) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Other</h6>
        <div class="form-group">
        <select name="filter-ncommercialdata" class="form-control col-10">
          <option value="ungrouped" selected>Ungrouped</option>
          <option value="grouped">Grouped</option>
        </select>
        </div>
        <div class="form-group">
        <select name="filter-ncommercialtype" class="form-control col-10">
          <option value="allads">All Ads</option>
          <option value="commercialonly" selected>Commercial Only</option>
        </select>
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
      </div>
    </div>
  </div>
</div>
@endsection
