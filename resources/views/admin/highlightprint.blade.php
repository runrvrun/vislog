@extends('admin.layouts.print')

@section('pagetitle')
    <title>Highlight</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
<div class="row bg-brown text-center" style="padding-top:15px;">
  <div class="col-md-3"><img src="{{ asset('images/vislog-logo-white.png') }}" width="32px" /></div>
  <div class="col-md-6 white">
  <h3>Vislog Highlight Report</h3>
  <p>{{ $request->startdate }} - {{ $request->enddate }}</p>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card gradient-blackberry">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['advertiser'] ?? 0 }}</h3>
              <span>Advertiser</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-monitor font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card gradient-ibiza-sunset">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['product'] ?? 0 }}</h3>
              <span>Products</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-credit-card font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card gradient-green-tea">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['number_of_spot'] ?? 0 }}</h3>
              <span>Spots</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-users font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card gradient-pomegranate">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['adex'] ?? 0 }}</h3>
              <span>Adex</span>
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
  <div class="col-sm-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Ads Type Selection</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <i class="adsicon bgaqua ft-monitor font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_loose_spot'] ?? 0 }}</div><small>Loose Spot</small>
            </div>
            <div class="col-md-3">
              <i class="adsicon bgtosca ft-check-circle font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_virtual_ads'] ?? 0 }}</div><small>Virtual Ads</small>
            </div>
            <div class="col-md-4">
              <i class="adsicon bgpink ft-film font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_squeeze_frames'] ?? 0 }}</div><small>Built-in Segmen</small>
            </div>
            <div class="col-md-2">
              <i class="adsicon bgpurple ft-message-square font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_quiz'] ?? 0 }}</div><small>Kuis</small>
            </div>
          </div>
          <div class="spot-per-channel-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daypart</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-daypart-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Top Channel</h4>
      </div>
      <div class="card-content"  style="min-height: 218px;">
        <table class="table">
        <thead>
          <tr>
          <th>Channel</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
          </tr>
        </thead>
        @foreach($data['top_channel'] as $key=>$val)
        <tr>
        <td>{{ $val['channel'] }}</td><td style="text-align:right">{{ $val['spot'] }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
        </tr>
        @endforeach
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Top Program</h4>
      </div>
      <div class="card-content"  style="min-height: 218px;">
        <table class="table">
        <thead>
          <tr>
          <th>Program</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
          </tr>
        </thead>
        @foreach($data['top_programme'] as $key=>$val)
        <tr>
        <td>{{ $val['programme'] }}</td><td style="text-align:right">{{ $val['spot'] }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
        </tr>
        @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Top Product</h4>
      </div>
      <div class="card-content"  style="min-height: 218px;">
        <table class="table">
        <thead>
          <tr>
          <th>Product</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
          </tr>
        </thead>
        @foreach($data['top_product'] as $key=>$val)
        <tr>
        <td>{{ $val['product'] }}</td><td style="text-align:right">{{ $val['spot'] }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
        </tr>
        @endforeach
        </table>
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
@section('modal')
<div class="modal fade text-left show" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-s" role="document">
    <div class="modal-content">
      <div class="modal-body" style="text-align:center">
        Loading ... <i class="ft-refresh-cw font-medium-4 fa fa-spin align-middle"></i>        
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
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
.adsicon{
    float: left;
    color: white;
    border-radius: 50%;
    margin-right: 7px;
}
.adsicon.bgaqua{
  background-color: #0080ff;
}
.adsicon.bgpink{
  background-color: #ff0080;
}
.adsicon.bgpurple{
  background-color: #b803fc;
}
.adsicon.bgtosca{
  background-color: #408080;
}
.adsheading{
    font-weight: 500;
    color: coral;
}
.adstext{
    font-size: 12px;
}
.whitebox{
  background-color: white;
  margin: 15px;
}
.carousel-item{
  text-align: center;
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
/* additional css for print */
.main-panel .main-content {
  padding-left:0px;
}
.bg-brown{
  background-color: #804848;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist-plugin-tooltip.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
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
          '{{ $data['daypart'][0]['name'] ?? 0 }}',
          '{{ $data['daypart'][1]['name'] ?? 0 }}',
          '{{ $data['daypart'][2]['name'] ?? 0 }}',
          '{{ $data['daypart'][3]['name'] ?? 0 }}',
          '{{ $data['daypart'][4]['name'] ?? 0 }}',
        ],
    series: [
      [
        {{ $data['daypart'][0]['value'] ?? 0 }},
        {{ $data['daypart'][1]['value'] ?? 0 }},
        {{ $data['daypart'][2]['value'] ?? 0 }},
        {{ $data['daypart'][3]['value'] ?? 0 }},
        {{ $data['daypart'][4]['value'] ?? 0 }},
      ]
    ]
  };
  new Chartist.Bar('.spot-per-daypart-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
        @foreach($data['spot_per_date'] as $key=>$val)
          '{{ $val['date'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_date'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
      ]
    ]
  };
  new Chartist.Line('.spot-per-date-chart', data,{
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
    var start = moment().subtract(6, 'day');
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
    $("#loading-modal").modal();
  });

  $("select[name='filter-ntargetaudience']").addClass('selectpicker'); // dropdown search with bootstrap select
  $("select[name='filter-ntargetaudience']").attr('data-live-search','true'); // dropdown search with bootstrap select
  $("select[name='filter-ntargetaudience']").attr('data-size','3'); // dropdown search with bootstrap select
});
</script>
<script>
  var data = {
    labels: [
        @foreach($data['spot_per_channel_loose'] as $key=>$val)
          '{{ $val['channel'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_channel_loose'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
      ],
      [
        @foreach($data['spot_per_channel'] as $key=>$val)
          @if(isset($data['spot_per_channel_loose'][$key]))
          {{ ($val['total'] - $data['spot_per_channel_loose'][$key]['total']).',' }}
          @endif
        @endforeach
      ]
    ]
  };
  new Chartist.Bar('.spot-per-channel-chart', data,{stackBars:true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>

<script>
  $(document).ready(function(){
    $("#filtererreset").click(function(){
      var start = moment().subtract(6, 'day');
      $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
      var start = moment();
      $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
      $("input[name^=filter-]").val('');
      $("span[id^=filter-]").html('');
    });
  });
$(window).on('load',function(){
    setTimeout(function() {
      window.print();
      setTimeout(window.close, 0);
    }, 2000);
});
</script>
@endsection