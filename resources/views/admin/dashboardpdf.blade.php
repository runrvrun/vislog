@extends('admin.layouts.pdf')

@section('content')
<table style="background-color:#804040;text-align:center;height:60px">
  <tr>
    <td style="width:20%"><img src="{{ asset('images/vislog-logo-white.png') }}" width="32px" /></td>
    <td style="width:80%">
      <table>
        <tr><td class="white center">Vislog Highlight Report</td></tr>
        <tr><td class="white center">{{ $request->startdate }} - {{ $request->enddate }}</td></tr>
      </table>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style="width:25%">
      <table class="border-black">
        <tr><td>Number of Spot</td></tr>
        <tr><td>{{ $data['number_of_spot'] }}</td></tr>
      </table>
    </td>
    <td style="width:25%">
      <table class="border-black">
        <tr><td>Cost (IDR Billions)</td></tr>
        <tr><td>{{ number_format($data['cost'],2) }}</td></tr>
      </table>
    </td>
    <td style="width:25%">
      <table class="border-black">
        <tr><td>GRP</td></tr>
        <tr><td>{{ number_format($data['grp'],2) }}</td></tr>
      </table>
    </td>
    <td style="width:25%">
      <table class="border-black">
        <tr><td>CPRP (IDR Millions)</td></tr>
        <tr><td>{{ ($data['grp'] > 0)? number_format($data['cost']*1000/$data['grp'],2) : '0.00' }}</td></tr>
      </table>
    </td>
  </tr>
</table>
<table>
<tr>
  <td></td>
</tr>
</table>
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">

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
                <th>Advertiser</th>
                <th>Category</th>
                <th>Sector</th>
                <th>Spot</th>
                <th>Cost</th>
                <th>GRP</th>
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
                <th>Channel</th>
                <th>Spot</th>
                <th>Cost</th>
                <th>GRP</th>
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
                <th>Cost</th>
                <th>GRP</th>
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
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/chartist-plugin-tooltip.css">
<link href="{{ asset('css') }}/jquery.timepicker.min.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="{{ asset('app-assets') }}/css/bootstrap-select.min.css">
<style type="text/css" media="all">
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
<style type="text/css" media="all">
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
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist-plugin-tooltip.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
<script src="{{ asset('js') }}/jquery.timepicker.min.js"></script>
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script>
  $(document).ready(function(){
    var options = { 'timeFormat': 'H:i:s','step':60 };
    $('#starttime').timepicker(options);
    $('#endtime').timepicker(options);
  });
</script>
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
  new Chartist.Bar('.spot-per-channel-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    $("#filterersubmit").click(function() {
      $("#loading-modal").modal();
    });

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
          type: 'POST',
          data: {
            'ntargetaudience': '{{$request->ntargetaudience}}'
          }
        },
        columns: [
          { data: '_id.nproduct', name: '_id.nproduct' },
          { data: '_id.nadvertiser', name: '_id.nadvertiser' },
          { data: '_id.ncategory', name: '_id.ncategory' },
          { data: '_id.nsector', name: '_id.nsector' },
          { data: 'total', name: 'total' },
          { data: 'cost', name: 'cost' },
          { data: 'grp', name: 'grp' },
        ],
        columnDefs: [ 
            {
                "render": function ( data, type, row ) {
                    return (data/1000000).toFixed(2);
                },
                "targets": [5,6]
            },{
              "targets": [1,2,3,5,6],
              visible: false,
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[4, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
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
          type: 'POST',
          data: {
            'ntargetaudience': '{{$request->ntargetaudience}}'
          }
        },
        columns: [
          { data: '_id.nprogramme', name: '_id.nprogramme' },
          { data: '_id.channel', name: '_id.channel' },
          { data: 'total', name: 'total' },
          { data: 'cost', name: 'cost' },
          { data: 'grp', name: 'grp' },
        ],
        columnDefs: [ 
            {
                "render": function ( data, type, row ) {
                    return (data/1000000).toFixed(2);
                },
                "targets": [3,4]
            },{
              "targets": [1,3,4],
              visible: false,
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[2, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
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
          type: 'POST',
          data: {
            'ntargetaudience': '{{$request->ntargetaudience}}'
          }
        },
        columns: [
          { data: '_id.nadstype', name: '_id.nadstype' },
          { data: 'total', name: 'total' },
          { data: 'cost', name: 'cost' },
          { data: 'grp', name: 'grp' },
        ],
        columnDefs: [ 
            {
                "render": function ( data, type, row ) {
                    return (data/1000000).toFixed(2);
                },
                "targets": [2,3]
            },{
              "targets": [2,3],
              visible: false,
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
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
  new Chartist.Pie('.spot-per-type-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
          'Primetime',
          'Non Primetime',
        ],
    series: [
        @foreach($data["daypart"] as $key=>$val)
          @if($val['name'] == 'Primetime')
            {{ $val['value'] }}
          @endif
        @endforeach
        ,
        <?php
        $nonprime = 0;
        foreach($data["daypart"] as $key=>$val):
          if($val['name'] != 'Primetime'):
             $nonprime = $nonprime + $val['value'];
          endif;
        endforeach;
        ?>
        {{ $nonprime }}
    ]
  };
  new Chartist.Pie('.spot-per-time-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
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
  new Chartist.Line('.spot-per-date-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
@endsection
