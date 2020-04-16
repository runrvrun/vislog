@extends('admin.layouts.print')

@section('pagetitle')
    <title>Marketing Summary</title>
@endsection

@section('content')
<!-- BEGIN : Main Content-->
<div class="main-content">
<div class="content-wrapper">
<div class="row bg-brown text-center" style="padding-top:15px;">
  <div class="col-md-3"><img src="{{ asset('images/vislog-logo-white.png') }}" width="32px" /></div>
  <div class="col-md-6 white">
  <h3>Vislog Marketing Summary Report</h3>
  <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$request->startdate)->format('F Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d',$request->enddate)->format('F Y') }}</p>
  </div>
</div>
<div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Market Share</h4>
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
                  <h4 class="card-title">Market Share Per Month</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>All TV</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_month'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all'],0) ?? '' }}</td>
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
                  <h4 class="card-title">Market Share Per Month</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Channel</th>
                          @foreach($data['monthlist'] as $key=>$val)
                          <th>{{ $val }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data['marketshare_month_channel'] as $key=>$val)
                        <tr>
                          <td>{{ $key }}</td>
                          @foreach($data['monthlist'] as $k=>$v)
                          <td style="text-align:right">{{ number_format($val[$v]['marketshare'] ?? 0) }}</td>
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
                  <h4 class="card-title">Top 10 Agency</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>All TV</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_agency'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all'],0) ?? '' }}</td>
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
                  <h4 class="card-title">Top 10 Advertiser</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>All TV</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_advertiser'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all'],0) ?? '' }}</td>
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
                  <h4 class="card-title">Top 10 Brand/Product</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>All TV</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_product'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td style="text-align:right">{{ number_format($val['all'],0) ?? '' }}</td>
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
                  <h4 class="card-title">Top 10 Sector</h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>All TV</th>
                          @foreach($data['channel'] as $key=>$val)
                          <th>{{ $val->channel }}</th>
                          @endforeach
                          @foreach($data['marketshare_channel_sector'] as $key=>$val)
                          <tr>
                          <td>{{ $key ?? '' }}</td>
                          <td>{{ number_format($val['all'],0) ?? '' }}</td>
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
<script src="{{ asset('app-assets') }}/vendors/js/chartist.min.js"></script>
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
          {{ $val['marketshare'] }},
        @endforeach
    ]
  };
  new Chartist.Pie('.marketshare-channel-chart', data, {donut: true});
</script>
<script>
  var data = {
    labels: [
        @foreach($data['marketshare_month_channel'] as $key=>$val)
          '{{ $key }}',
        @endforeach
        ],
    series: [
        @foreach($data['marketshare_month_channel'] as $key=>$val)
          [
            @foreach($data['monthlist'] as $k=>$v)
            {{ round($val[$v]['marketshare'] ?? 0) }},
            @endforeach
          ],
        @endforeach
    ]
  };
  new Chartist.Line('.marketsharemonthchannel-chart', data);
</script>
<script>
$(window).on('load',function(){
    setTimeout(function() {
      window.print();
      setTimeout(window.close, 0);
    }, 2000);
});
</script>
@endsection