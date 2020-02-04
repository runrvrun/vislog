@extends('admin.layouts.app')

@section('pagetitle')
    <title>Dashboard</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper"><!--Statistics cards Starts-->
<div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-blackberry">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['total_user'] }}</h3>
              <span>Total User</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-user font-large-1"></i>
            </div>
          </div>
        </div>
        <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="10" x2="10" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="25.90277862548828" x2="25.90277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="41.80555725097656" x2="41.80555725097656" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="57.708335876464844" x2="57.708335876464844" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="73.61111450195312" x2="73.61111450195312" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="89.5138931274414" x2="89.5138931274414" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="105.41667175292969" x2="105.41667175292969" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="121.31945037841797" x2="121.31945037841797" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="137.22222900390625" x2="137.22222900390625" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="153.12500762939453" x2="153.12500762939453" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="169.0277862548828" x2="169.0277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="184.9305648803711" x2="184.9305648803711" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="200.83334350585938" x2="200.83334350585938" y1="15" y2="70" class="ct-grid ct-horizontal"></line></g><g><g class="ct-series ct-series-a"><path d="M10,51.667C25.903,60.833,25.903,60.833,25.903,60.833C41.806,33.333,41.806,33.333,41.806,33.333C57.708,42.5,57.708,42.5,57.708,42.5C73.611,15,73.611,15,73.611,15C89.514,42.5,89.514,42.5,89.514,42.5C105.417,33.333,105.417,33.333,105.417,33.333C121.319,42.5,121.319,42.5,121.319,42.5C137.222,24.167,137.222,24.167,137.222,24.167C153.125,38.833,153.125,38.833,153.125,38.833C169.028,33.333,169.028,33.333,169.028,33.333C184.931,46.167,184.931,46.167,184.931,46.167C200.833,46.167,200.833,46.167,200.833,46.167" class="ct-line"></path><line x1="10" y1="51.66666666666667" x2="10.01" y2="51.66666666666667" class="ct-point" ct:value="50"></line><line x1="25.90277862548828" y1="60.833333333333336" x2="25.912778625488283" y2="60.833333333333336" class="ct-point" ct:value="45"></line><line x1="41.80555725097656" y1="33.333333333333336" x2="41.81555725097656" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="57.708335876464844" y1="42.5" x2="57.71833587646484" y2="42.5" class="ct-point" ct:value="55"></line><line x1="73.61111450195312" y1="15" x2="73.62111450195313" y2="15" class="ct-point" ct:value="70"></line><line x1="89.5138931274414" y1="42.5" x2="89.52389312744141" y2="42.5" class="ct-point" ct:value="55"></line><line x1="105.41667175292969" y1="33.333333333333336" x2="105.42667175292969" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="121.31945037841797" y1="42.5" x2="121.32945037841797" y2="42.5" class="ct-point" ct:value="55"></line><line x1="137.22222900390625" y1="24.166666666666664" x2="137.23222900390624" y2="24.166666666666664" class="ct-point" ct:value="65"></line><line x1="153.12500762939453" y1="38.83333333333333" x2="153.13500762939452" y2="38.83333333333333" class="ct-point" ct:value="57"></line><line x1="169.0277862548828" y1="33.333333333333336" x2="169.0377862548828" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="184.9305648803711" y1="46.16666666666667" x2="184.94056488037108" y2="46.16666666666667" class="ct-point" ct:value="53"></line><line x1="200.83334350585938" y1="46.16666666666667" x2="200.84334350585937" y2="46.16666666666667" class="ct-point" ct:value="53"></line></g></g><g class="ct-labels"></g></svg></div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-ibiza-sunset">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['total_access'] }}</h3>
              <span>Total Access</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-users font-large-1"></i>
            </div>
          </div>
        </div>
        <div id="Widget-line-chart1" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="10" x2="10" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="25.90277862548828" x2="25.90277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="41.80555725097656" x2="41.80555725097656" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="57.708335876464844" x2="57.708335876464844" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="73.61111450195312" x2="73.61111450195312" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="89.5138931274414" x2="89.5138931274414" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="105.41667175292969" x2="105.41667175292969" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="121.31945037841797" x2="121.31945037841797" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="137.22222900390625" x2="137.22222900390625" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="153.12500762939453" x2="153.12500762939453" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="169.0277862548828" x2="169.0277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="184.9305648803711" x2="184.9305648803711" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="200.83334350585938" x2="200.83334350585938" y1="15" y2="70" class="ct-grid ct-horizontal"></line></g><g><g class="ct-series ct-series-a"><path d="M10,51.667C25.903,60.833,25.903,60.833,25.903,60.833C41.806,33.333,41.806,33.333,41.806,33.333C57.708,42.5,57.708,42.5,57.708,42.5C73.611,15,73.611,15,73.611,15C89.514,42.5,89.514,42.5,89.514,42.5C105.417,33.333,105.417,33.333,105.417,33.333C121.319,42.5,121.319,42.5,121.319,42.5C137.222,24.167,137.222,24.167,137.222,24.167C153.125,38.833,153.125,38.833,153.125,38.833C169.028,33.333,169.028,33.333,169.028,33.333C184.931,46.167,184.931,46.167,184.931,46.167C200.833,46.167,200.833,46.167,200.833,46.167" class="ct-line"></path><line x1="10" y1="51.66666666666667" x2="10.01" y2="51.66666666666667" class="ct-point" ct:value="50"></line><line x1="25.90277862548828" y1="60.833333333333336" x2="25.912778625488283" y2="60.833333333333336" class="ct-point" ct:value="45"></line><line x1="41.80555725097656" y1="33.333333333333336" x2="41.81555725097656" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="57.708335876464844" y1="42.5" x2="57.71833587646484" y2="42.5" class="ct-point" ct:value="55"></line><line x1="73.61111450195312" y1="15" x2="73.62111450195313" y2="15" class="ct-point" ct:value="70"></line><line x1="89.5138931274414" y1="42.5" x2="89.52389312744141" y2="42.5" class="ct-point" ct:value="55"></line><line x1="105.41667175292969" y1="33.333333333333336" x2="105.42667175292969" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="121.31945037841797" y1="42.5" x2="121.32945037841797" y2="42.5" class="ct-point" ct:value="55"></line><line x1="137.22222900390625" y1="24.166666666666664" x2="137.23222900390624" y2="24.166666666666664" class="ct-point" ct:value="65"></line><line x1="153.12500762939453" y1="38.83333333333333" x2="153.13500762939452" y2="38.83333333333333" class="ct-point" ct:value="57"></line><line x1="169.0277862548828" y1="33.333333333333336" x2="169.0377862548828" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="184.9305648803711" y1="46.16666666666667" x2="184.94056488037108" y2="46.16666666666667" class="ct-point" ct:value="53"></line><line x1="200.83334350585938" y1="46.16666666666667" x2="200.84334350585937" y2="46.16666666666667" class="ct-point" ct:value="53"></line></g></g><g class="ct-labels"></g></svg></div>

      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-green-tea">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['avg_user_day'] }}</h3>
              <span>Avg User Per Day</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-graph font-large-1"></i>
            </div>
          </div>
        </div>
        <div id="Widget-line-chart2" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="10" x2="10" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="25.90277862548828" x2="25.90277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="41.80555725097656" x2="41.80555725097656" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="57.708335876464844" x2="57.708335876464844" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="73.61111450195312" x2="73.61111450195312" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="89.5138931274414" x2="89.5138931274414" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="105.41667175292969" x2="105.41667175292969" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="121.31945037841797" x2="121.31945037841797" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="137.22222900390625" x2="137.22222900390625" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="153.12500762939453" x2="153.12500762939453" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="169.0277862548828" x2="169.0277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="184.9305648803711" x2="184.9305648803711" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="200.83334350585938" x2="200.83334350585938" y1="15" y2="70" class="ct-grid ct-horizontal"></line></g><g><g class="ct-series ct-series-a"><path d="M10,51.667C25.903,60.833,25.903,60.833,25.903,60.833C41.806,33.333,41.806,33.333,41.806,33.333C57.708,42.5,57.708,42.5,57.708,42.5C73.611,15,73.611,15,73.611,15C89.514,42.5,89.514,42.5,89.514,42.5C105.417,33.333,105.417,33.333,105.417,33.333C121.319,42.5,121.319,42.5,121.319,42.5C137.222,24.167,137.222,24.167,137.222,24.167C153.125,38.833,153.125,38.833,153.125,38.833C169.028,33.333,169.028,33.333,169.028,33.333C184.931,46.167,184.931,46.167,184.931,46.167C200.833,46.167,200.833,46.167,200.833,46.167" class="ct-line"></path><line x1="10" y1="51.66666666666667" x2="10.01" y2="51.66666666666667" class="ct-point" ct:value="50"></line><line x1="25.90277862548828" y1="60.833333333333336" x2="25.912778625488283" y2="60.833333333333336" class="ct-point" ct:value="45"></line><line x1="41.80555725097656" y1="33.333333333333336" x2="41.81555725097656" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="57.708335876464844" y1="42.5" x2="57.71833587646484" y2="42.5" class="ct-point" ct:value="55"></line><line x1="73.61111450195312" y1="15" x2="73.62111450195313" y2="15" class="ct-point" ct:value="70"></line><line x1="89.5138931274414" y1="42.5" x2="89.52389312744141" y2="42.5" class="ct-point" ct:value="55"></line><line x1="105.41667175292969" y1="33.333333333333336" x2="105.42667175292969" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="121.31945037841797" y1="42.5" x2="121.32945037841797" y2="42.5" class="ct-point" ct:value="55"></line><line x1="137.22222900390625" y1="24.166666666666664" x2="137.23222900390624" y2="24.166666666666664" class="ct-point" ct:value="65"></line><line x1="153.12500762939453" y1="38.83333333333333" x2="153.13500762939452" y2="38.83333333333333" class="ct-point" ct:value="57"></line><line x1="169.0277862548828" y1="33.333333333333336" x2="169.0377862548828" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="184.9305648803711" y1="46.16666666666667" x2="184.94056488037108" y2="46.16666666666667" class="ct-point" ct:value="53"></line><line x1="200.83334350585938" y1="46.16666666666667" x2="200.84334350585937" y2="46.16666666666667" class="ct-point" ct:value="53"></line></g></g><g class="ct-labels"></g></svg></div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-pomegranate">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ $data['total_download'] }}</h3>
              <span>Total Download</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-cloud-download font-large-1"></i>
            </div>
          </div>
        </div>
        <div id="Widget-line-chart3" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="10" x2="10" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="25.90277862548828" x2="25.90277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="41.80555725097656" x2="41.80555725097656" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="57.708335876464844" x2="57.708335876464844" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="73.61111450195312" x2="73.61111450195312" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="89.5138931274414" x2="89.5138931274414" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="105.41667175292969" x2="105.41667175292969" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="121.31945037841797" x2="121.31945037841797" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="137.22222900390625" x2="137.22222900390625" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="153.12500762939453" x2="153.12500762939453" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="169.0277862548828" x2="169.0277862548828" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="184.9305648803711" x2="184.9305648803711" y1="15" y2="70" class="ct-grid ct-horizontal"></line><line x1="200.83334350585938" x2="200.83334350585938" y1="15" y2="70" class="ct-grid ct-horizontal"></line></g><g><g class="ct-series ct-series-a"><path d="M10,51.667C25.903,60.833,25.903,60.833,25.903,60.833C41.806,33.333,41.806,33.333,41.806,33.333C57.708,42.5,57.708,42.5,57.708,42.5C73.611,15,73.611,15,73.611,15C89.514,42.5,89.514,42.5,89.514,42.5C105.417,33.333,105.417,33.333,105.417,33.333C121.319,42.5,121.319,42.5,121.319,42.5C137.222,24.167,137.222,24.167,137.222,24.167C153.125,38.833,153.125,38.833,153.125,38.833C169.028,33.333,169.028,33.333,169.028,33.333C184.931,46.167,184.931,46.167,184.931,46.167C200.833,46.167,200.833,46.167,200.833,46.167" class="ct-line"></path><line x1="10" y1="51.66666666666667" x2="10.01" y2="51.66666666666667" class="ct-point" ct:value="50"></line><line x1="25.90277862548828" y1="60.833333333333336" x2="25.912778625488283" y2="60.833333333333336" class="ct-point" ct:value="45"></line><line x1="41.80555725097656" y1="33.333333333333336" x2="41.81555725097656" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="57.708335876464844" y1="42.5" x2="57.71833587646484" y2="42.5" class="ct-point" ct:value="55"></line><line x1="73.61111450195312" y1="15" x2="73.62111450195313" y2="15" class="ct-point" ct:value="70"></line><line x1="89.5138931274414" y1="42.5" x2="89.52389312744141" y2="42.5" class="ct-point" ct:value="55"></line><line x1="105.41667175292969" y1="33.333333333333336" x2="105.42667175292969" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="121.31945037841797" y1="42.5" x2="121.32945037841797" y2="42.5" class="ct-point" ct:value="55"></line><line x1="137.22222900390625" y1="24.166666666666664" x2="137.23222900390624" y2="24.166666666666664" class="ct-point" ct:value="65"></line><line x1="153.12500762939453" y1="38.83333333333333" x2="153.13500762939452" y2="38.83333333333333" class="ct-point" ct:value="57"></line><line x1="169.0277862548828" y1="33.333333333333336" x2="169.0377862548828" y2="33.333333333333336" class="ct-point" ct:value="60"></line><line x1="184.9305648803711" y1="46.16666666666667" x2="184.94056488037108" y2="46.16666666666667" class="ct-point" ct:value="53"></line><line x1="200.83334350585938" y1="46.16666666666667" x2="200.84334350585937" y2="46.16666666666667" class="ct-point" ct:value="53"></line></g></g><g class="ct-labels"></g></svg></div>
      </div>
    </div>
  </div>
</div>
<!--Statistics cards Ends-->

<!--Line with Area Chart 1 Starts-->
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daily Users</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="daily-user-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Line with Area Chart 1 Ends-->

<div class="row match-height">
  <div class="col-xl-12 col-lg-12 col-12">
    <div class="card" style="height: 414.667px;">
      <div class="card-header">
        <h4 class="card-title">Time of User Access</h4>
      </div>
      <div class="card-content">

        <div id="Stack-bar-chart" class="height-300 Stackbarchart mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="49.81523695882161" x2="49.81423695882161" y1="240" y2="72" class="ct-bar" ct:value="8" style="stroke-width: 5px"></line><line x1="89.44371087646483" x2="89.44271087646483" y1="240" y2="51" class="ct-bar" ct:value="9" style="stroke-width: 5px"></line><line x1="129.07218479410807" x2="129.07118479410806" y1="240" y2="135" class="ct-bar" ct:value="5" style="stroke-width: 5px"></line><line x1="168.70065871175132" x2="168.6996587117513" y1="240" y2="114" class="ct-bar" ct:value="6" style="stroke-width: 5px"></line><line x1="208.32913262939454" x2="208.32813262939453" y1="240" y2="93" class="ct-bar" ct:value="7" style="stroke-width: 5px"></line><line x1="247.95760654703776" x2="247.95660654703775" y1="240" y2="156" class="ct-bar" ct:value="4" style="stroke-width: 5px"></line></g><g class="ct-series ct-series-b"><line x1="49.81523695882161" x2="49.81423695882161" y1="72" y2="30" class="ct-bar" ct:value="2" style="stroke-width: 5px"></line><line x1="89.44371087646483" x2="89.44271087646483" y1="51" y2="30" class="ct-bar" ct:value="1" style="stroke-width: 5px"></line><line x1="129.07218479410807" x2="129.07118479410806" y1="135" y2="30" class="ct-bar" ct:value="5" style="stroke-width: 5px"></line><line x1="168.70065871175132" x2="168.6996587117513" y1="114" y2="30" class="ct-bar" ct:value="4" style="stroke-width: 5px"></line><line x1="208.32913262939454" x2="208.32813262939453" y1="93" y2="30" class="ct-bar" ct:value="3" style="stroke-width: 5px"></line><line x1="247.95760654703776" x2="247.95660654703775" y1="156" y2="30" class="ct-bar" ct:value="6" style="stroke-width: 5px"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="30" y="270" width="39.62847391764323" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Jan</span></foreignObject><foreignObject style="overflow: visible;" x="69.62847391764322" y="270" width="39.62847391764323" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Feb</span></foreignObject><foreignObject style="overflow: visible;" x="109.25694783528645" y="270" width="39.628473917643234" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Mar</span></foreignObject><foreignObject style="overflow: visible;" x="148.8854217529297" y="270" width="39.62847391764322" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Apr</span></foreignObject><foreignObject style="overflow: visible;" x="188.5138956705729" y="270" width="39.62847391764322" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">May</span></foreignObject><foreignObject style="overflow: visible;" x="228.14236958821613" y="270" width="39.62847391764325" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Jun</span></foreignObject></g><defs><linearGradient id="linear" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(0, 201, 255,1)"></stop><stop offset="1" stop-color="rgba(17,228,183, 1)"></stop></linearGradient></defs></svg></div>

      </div>
    </div>
  </div>
</div>

<div class="row match-height">
  <div class="col-xl-8 col-lg-12 col-12">
    <div class="card" style="height: 522.083px;">
      <div class="card-header">
        <h4 class="card-title mb-0">Daily Video Download</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="chart-info mb-2">
            <span class="text-uppercase mr-3"><i class="fa fa-circle primary font-small-2 mr-1"></i> Play</span>
            <span class="text-uppercase"><i class="fa fa-circle deep-purple font-small-2 mr-1"></i> Download</span>
          </div>
          <div id="line-area2" class="height-400 lineAreaDashboard">
          <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="365" y2="365" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="277.5" y2="277.5" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="190" y2="190" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="102.5" y2="102.5" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M50,365L50,356.25L96.868,312.5L143.737,321.25L190.605,268.75L237.473,286.25L284.342,251.25L331.21,260L378.079,181.25L424.947,225L471.815,172.5L518.684,155L565.552,102.5L565.552,365Z" class="ct-area"></path><path d="M50,356.25L96.868,312.5L143.737,321.25L190.605,268.75L237.473,286.25L284.342,251.25L331.21,260L378.079,181.25L424.947,225L471.815,172.5L518.684,155L565.552,102.5" class="ct-line"></path><circle cx="50" cy="356.25" r="4" class="ct-point-circle"></circle><circle cx="96.8683749112216" cy="312.5" r="4" class="ct-point-circle"></circle><circle cx="143.7367498224432" cy="321.25" r="4" class="ct-point-circle"></circle><circle cx="190.60512473366478" cy="268.75" r="4" class="ct-point-circle"></circle><circle cx="237.47349964488637" cy="286.25" r="4" class="ct-point-circle"></circle><circle cx="284.341874556108" cy="251.25" r="4" class="ct-point-circle"></circle><circle cx="331.21024946732956" cy="260" r="4" class="ct-point-circle"></circle><circle cx="378.0786243785511" cy="181.25" r="4" class="ct-point-circle"></circle><circle cx="424.94699928977275" cy="225" r="4" class="ct-point-circle"></circle><circle cx="471.81537420099437" cy="172.5" r="4" class="ct-point-circle"></circle><circle cx="518.683749112216" cy="155" r="4" class="ct-point-circle"></circle><circle cx="565.5521240234375" cy="102.5" r="4" class="ct-point-circle"></circle></g><g class="ct-series ct-series-b"><path d="M50,365L50,225L96.868,198.75L143.737,212.75L190.605,93.75L237.473,120L284.342,107.75L331.21,137.5L378.079,50L424.947,85L471.815,58.75L518.684,76.25L565.552,15L565.552,365Z" class="ct-area"></path><path d="M50,225L96.868,198.75L143.737,212.75L190.605,93.75L237.473,120L284.342,107.75L331.21,137.5L378.079,50L424.947,85L471.815,58.75L518.684,76.25L565.552,15" class="ct-line"></path><circle cx="50" cy="225" r="4" class="ct-point-circle"></circle><circle cx="96.8683749112216" cy="198.75" r="4" class="ct-point-circle"></circle><circle cx="143.7367498224432" cy="212.75" r="4" class="ct-point-circle"></circle><circle cx="190.60512473366478" cy="93.75" r="4" class="ct-point-circle"></circle><circle cx="237.47349964488637" cy="120" r="4" class="ct-point-circle"></circle><circle cx="284.341874556108" cy="107.75" r="4" class="ct-point-circle"></circle><circle cx="331.21024946732956" cy="137.5" r="4" class="ct-point-circle"></circle><circle cx="378.0786243785511" cy="50" r="4" class="ct-point-circle"></circle><circle cx="424.94699928977275" cy="85" r="4" class="ct-point-circle"></circle><circle cx="471.81537420099437" cy="58.75" r="4" class="ct-point-circle"></circle><circle cx="518.683749112216" cy="76.25" r="4" class="ct-point-circle"></circle><circle cx="565.5521240234375" cy="15" r="4" class="ct-point-circle"></circle></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="43.4341874556108" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jan</span></foreignObject><foreignObject style="overflow: visible;" x="90.30256236683239" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Feb</span></foreignObject><foreignObject style="overflow: visible;" x="137.170937278054" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Mar</span></foreignObject><foreignObject style="overflow: visible;" x="184.03931218927556" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Apr</span></foreignObject><foreignObject style="overflow: visible;" x="230.90768710049718" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">May</span></foreignObject><foreignObject style="overflow: visible;" x="277.7760620117188" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jun</span></foreignObject><foreignObject style="overflow: visible;" x="324.6444369229404" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jul</span></foreignObject><foreignObject style="overflow: visible;" x="371.51281183416194" y="370" width="46.86837491122162" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Aug</span></foreignObject><foreignObject style="overflow: visible;" x="418.38118674538356" y="370" width="46.86837491122162" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Sep</span></foreignObject><foreignObject style="overflow: visible;" x="465.2495616566051" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Oct</span></foreignObject><foreignObject style="overflow: visible;" x="512.1179365678267" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Nov</span></foreignObject><foreignObject style="overflow: visible;" x="550.5521240234375" y="370" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">Dec</span></foreignObject><foreignObject style="overflow: visible;" y="277.5" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="190" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">50</span></foreignObject><foreignObject style="overflow: visible;" y="102.5" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">100</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">150</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="-5" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">200</span></foreignObject></g><defs><linearGradient id="gradient2" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-opacity="0.2" stop-color="rgba(255, 255, 255, 1)"></stop><stop offset="1" stop-opacity="0.2" stop-color="rgba(0, 201, 255, 1)"></stop></linearGradient><linearGradient id="gradient3" x1="0" y1="1" x2="0" y2="0"><stop offset="0.3" stop-opacity="0.2" stop-color="rgba(255, 255, 255, 1)"></stop><stop offset="1" stop-opacity="0.2" stop-color="rgba(132, 60, 247, 1)"></stop></linearGradient></defs></svg></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-12 col-12">
    <div class="card" style="height: 522.583px;">
      <div class="card-header">
        <h4 class="card-title mb-0">User List</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-primary height-50 rounded-circle" src="{{ asset('') }}/app-assets/img/portrait/small/avatar-s-12.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Jessica Rice</h4>
              <p class="text-muted font-small-3">UX Designer</p>
            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-danger height-50 rounded-circle" src="{{ asset('') }}/app-assets/img/portrait/small/avatar-s-11.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Jacob Rios</h4>
              <p class="text-muted font-small-3">HTML Developer</p>
            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-success height-50 rounded-circle" src="{{ asset('') }}/app-assets/img/portrait/small/avatar-s-3.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Russell Delgado</h4>
              <p class="text-muted font-small-3">Database Designer</p>
            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-warning height-50 rounded-circle" src="{{ asset('') }}/app-assets/img/portrait/small/avatar-s-6.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Sara McDonald</h4>
              <p class="text-muted font-small-3">Team Leader</p>
            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-info height-50 rounded-circle" src="{{ asset('') }}/app-assets/img/portrait/small/avatar-s-18.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Janet Lucas</h4>
              <p class="text-muted font-small-3">Project Manger</p>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>

          </div>
        </div>
@endsection
@section('pagecss')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
@endsection
@section('pagejs')
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script>
      var data = {
        labels: [
            @foreach($data['daily_user'] as $key=>$val)
              '{{ $val->_id['date'] }}',
            @endforeach
            ],
        series: [
          [
            @foreach($data['daily_user'] as $key=>$val)
              {{ $val->count.',' }}
            @endforeach
          ]
        ]
      };
      new Chartist.Bar('.daily-user-chart', data);
    </script>
@endsection
