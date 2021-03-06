@extends('admin.layouts.app')

@section('pagetitle')
    <title>Highlight</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
		<div class="row">
            <div class="col-sm-12">
				<div class="content-header">Highlight</div>
					<div class="content-sub-header">General analysis of advertising in monthly periods. Easily and quickly known total ad spots in a TV Channel, TV show, Product and much more. You can easily download highlight report by clicking the print button on right tab of menu.</div>
			</div>
		</div>		
<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-6">
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
      <div class="col-md-6">
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
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card gradient-green-tea">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0">{{ number_format(($data['number_of_spot'] ?? 0),0) }}</h3>
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
      <div class="col-md-6">
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
  </div>
  <div class="col-md-6">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators">
    @if(isset($data['tvchighlight']))
    @foreach($data['tvchighlight'] as $key=>$val)
      <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ ($key == 0)? 'active':'' }}"></li>
      @endforeach
      @endif
    </ol>
    <div class="carousel-inner">
    @if(isset($data['tvchighlight']))
      @foreach($data['tvchighlight'] as $key=>$val)
      <div class="carousel-item {{ ($key == 0)? 'active':'' }}">
        <video src="{{ url('/uploads/tvchighlight/'.($val->filename ?? '')) }}" controls class="playvideo"></video>
        <div class="carousel-caption d-none d-md-block">
          <h5>{{ $val->title ?? '' }}</h5>
          <p>{{ $val->description ?? ''}}</p>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>    
  </div>
</div>
<div class="row">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Ads Type Selection</h4>
			<p class="card-subtitle text-muted">Highlight the highest number of ad spots among TV Channels and the comparison between Loose Spot and Non Loose Spot.</p>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <i class="adsicon bgaqua ft-monitor font-medium-2 p-1"></i>
              <div class="adsheading">{{ number_format(($data['adstype_loose_spot'] ?? 0),0) }}</div><small>Loose Spot</small>
            </div>
            <div class="col-md-3">
              <i class="adsicon bgtosca ft-check-circle font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_virtual_ads'] ?? 0 }}</div><small>Virtual Ads</small>
            </div>
            <div class="col-md-4">
              <i class="adsicon bgpink ft-film font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_squeeze_frame'] ?? 0 }}</div><small>Built-in Segmen</small>
            </div>
            <div class="col-md-2">
              <i class="adsicon bgpurple ft-message-square font-medium-2 p-1"></i>
              <div class="adsheading">{{ $data['adstype_kuis'] ?? 0 }}</div><small>Kuis</small>
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
			<p class="card-subtitle text-muted">The following graph is comparison of total ad spots between the selection of time periods.</p>
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
  <div class="col-sm-7">
    <div class="card" style="background-color:#2196f3">
      <div class="card-header">
        <h4 class="card-title white">Top Performance</h4>
        <small class="white">Quickly get the highlight ranking of total ad spots and advertising expenditures based on TV Channels, TV Programs, and Products.</small>
      </div>
      <div class="card-content"  style="min-height: 218px;">
        <div class="whitebox">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="channel-tab" data-toggle="tab" href="#channel" role="tab" aria-controls="channel" aria-selected="true"><i class="ft-monitor"></i> Channel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="program-tab" data-toggle="tab" href="#program" role="tab" aria-controls="program" aria-selected="false"><i class="ft-aperture"></i> Program</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false"><i class="ft-award"></i> Product</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="channel" role="tabpanel" aria-labelledby="channel-tab">
                <table class="table">
                <thead>
                  <tr>
                  <th>Channel</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
                  </tr>
                </thead>
                @if(!empty($data['top_channel']))
                @foreach($data['top_channel'] as $key=>$val)
                <tr>
                <td>{{ $val['channel'] }}</td><td style="text-align:right">{{ number_format($val['spot'],0,'','') }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
                </tr>
                @endforeach
                @endif
                </table>
            </div>
            <div class="tab-pane fade" id="program" role="tabpanel" aria-labelledby="program-tab">
                <table class="table">
                <thead>
                  <tr>
                  <th>Program</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
                  </tr>
                </thead>
                @if(!empty($data['top_programme']))
                @foreach($data['top_programme'] as $key=>$val)
                <tr>
                <td>{{ $val['programme'] }}</td><td style="text-align:right">{{ number_format($val['spot'],0,'','') }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
                </tr>
                @endforeach
                @endif
                </table>
            </div>
            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                <table class="table">
                <thead>
                  <tr>
                  <th>Product</th><th style="text-align:right">Spot</th><th style="text-align:right">Adex (B)</th>
                  </tr>
                </thead>
                @if(!empty($data['top_product']))
                @foreach($data['top_product'] as $key=>$val)
                <tr>
                <td>{{ $val['product'] }}</td><td style="text-align:right">{{ number_format($val['spot'],0,'','') }}</td><td style="text-align:right">{{ number_format($val['adex'],2,'.','') }}</td>
                </tr>
                @endforeach
                @endif
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-5">
   <div class="card">
      <div class="card-content" style="min-height: 286px;">
        <ul class="nav nav-tabs" id="myTab1" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="dataupdate-tab" data-toggle="tab" href="#dataupdate" role="tab" aria-controls="channel" aria-selected="true"><i class="ft-user"></i> Data update</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="videoupdate-tab" data-toggle="tab" href="#videoupdate" role="tab" aria-controls="program" aria-selected="false"><i class="ft-film"></i> Video Update</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="recentactivity-tab" data-toggle="tab" href="#recentactivity" role="tab" aria-controls="product" aria-selected="false"><i class="ft-bell"></i> Activity</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="dataupdate" role="tabpanel" aria-labelledby="dataupdate-tab">
                @if(!empty($data['data_update']))
              @foreach($data['data_update'] as $key=>$val)
              <div class="row"><div class="col-md-8">{{ ucfirst($val->action) }}</div><div class="col-md-4"><small>{{ $val->created_at->diffForHumans() }}</small></div></div>
              @endforeach
              @endif
          </div>
          <div class="tab-pane fade" id="videoupdate" role="tabpanel" aria-labelledby="videoupdate-tab">
              @if(!empty($data['video_update']))
              @foreach($data['video_update'] as $key=>$val)
              <div class="row"><div class="col-md-8">{{ ucfirst($val->action) }}</div><div class="col-md-4"><small>{{ $val->created_at->diffForHumans() }}</small></div></div>
              @endforeach
              @endif
          </div>
          <div class="tab-pane fade" id="recentactivity" role="tabpanel" aria-labelledby="recentactivity-tab">
              @if(!empty($data['activity']))
              @foreach($data['activity'] as $key=>$val)
              <div class="row"><div class="col-md-8">{{ ucfirst($val->name) }} logged in</div><div class="col-md-4"><small>{{ $val->created_at->diffForHumans() }}</small></div></div>
              @endforeach
              @endif
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
        <h4 class="card-title">Total Spot for Each Date</h4>
			<p class="card-subtitle text-muted">The graph shows total ad spots that posted on all TV channels every day during monthly period. You can learn the pattern of daily total ad spots, measuring lowest and highest total ad spots, and much more.</p>
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
}
button.search-result{
  min-width:100px;
}
.playvideo{
    width: 473px;
    padding-top: 17px;
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
body.layout-dark.layout-transparent .whitebox{
  background-color: inherit !important;
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

.carousel-control-prev-icon {
 background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
}

.carousel-control-next-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
}
.carousel-control-prev, .carousel-control-next{
  height: 40%;
  top: 25%;
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
    // pause on carousel move
    $(".carousel-control-next").click(function(){
      $(".playvideo").trigger('pause');
    })
    $(".carousel-control-prev").click(function(){
      $(".playvideo").trigger('pause');
    })
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
        {{ number_format(($data['daypart'][0]['value'] ?? 0),0,'','') }},
        {{ number_format(($data['daypart'][1]['value'] ?? 0),0,'','') }},
        {{ number_format(($data['daypart'][2]['value'] ?? 0),0,'','') }},
        {{ number_format(($data['daypart'][3]['value'] ?? 0),0,'','') }},
        {{ number_format(($data['daypart'][4]['value'] ?? 0),0,'','') }},
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
        @if(!empty($data['spot_per_date']))
        @foreach($data['spot_per_date'] as $key=>$val)
          '{{ $val['date'] }}',
        @endforeach
        @endif
        ],
    series: [
      [
        @if(!empty($data['spot_per_date']))
        @foreach($data['spot_per_date'] as $key=>$val)
          {meta: '{{ $val['date'] }}', value: {{ $val['total'] }} },          
        @endforeach
        @endif
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
            if(!$("#filter-"+filter).is(':empty') && curfil.indexOf(v[filter] + ';')+1){
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
          html = html + filt + ';';
          return html;
      });
    }else{
      count--; // unselected, decrement button count
      newval = $("#filter-selected").html().replace(/&amp;/g, '&');
      $("#filter-selected").html(newval.replace(filt+';',''));
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
        @if(!empty($data['spot_per_channel']))
        @foreach($data['spot_per_channel'] as $key=>$val)
          '{{ $val['channel'] }}',
        @endforeach
        @endif
        ],
    series: [
      [
        @if(!empty($data['spot_per_channel']))
        @foreach($data['spot_per_channel'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
        @endif
      ],
        [
        @if(!empty($data['spot_per_channel']))
        @foreach($data['spot_per_channel'] as $key=>$val)
        @if(isset($data['spot_per_channel_loose'][$key]))
          {{ ($val['total'] - $data['spot_per_channel_loose'][$key]['total']).',' }}          
        @else
        0,
        @endif
        @endforeach
        @endif
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
</script>
<script>
$(document).ready(function(){
  $("#rtl-icon2").click(function(){
    var oriaction = $("#filterer-form").attr('action');
    $("#filterer-form").attr('action','{{ url('admin/highlight/print') }}');
    $("#filterer-form").attr('target','_blank');
    $("#filterer-form").submit();
    $("#filterer-form").attr('action',oriaction);
    $("#filterer-form").attr('target','');
  });
});
</script>
@endsection
@section('filterer')
<a id="rtl-icon2" class="bg-info"><i class="ft-printer font-medium-4 white fa align-middle"></i></a>
<form method="GET" id="filterer-form" action="{{ url('admin/highlight') }}">
<div class="filterer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
<a class="filterer-close"><i class="ft-x font-medium-3"></i></a>
<button id="filterersubmit" class="btn btn-warning pull-right filterer-close" style="color:#fff"><i class="ft-filter"></i> Process</button>
<button id="filtererreset" class="btn btn-secondary pull-left filterer-close" style="color:#fff"><i class="ft-rotate-ccw"></i></button>
<a id="rtl-icon" class="filterer-toggle bg-success"><i class="ft-filter font-medium-4 fa white align-middle"></i></a>
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
<div class="modal fade text-left show" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-s" role="document">
    <div class="modal-content">
      <div class="modal-body" style="text-align:center">
        Loading ... <i class="ft-refresh-cw font-medium-4 fa fa-spin align-middle"></i>        
      </div>
    </div>
  </div>
</div>
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
