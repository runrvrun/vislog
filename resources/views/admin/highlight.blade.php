@extends('admin.layouts.app')

@section('pagetitle')
    <title>Highlight</title>
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
              <h3 class="font-large-1 mb-0">$2156</h3>
              <span>Total Tax</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-pie-chart font-large-1"></i>
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
              <h3 class="font-large-1 mb-0">$1567</h3>
              <span>Total Cost</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-bulb font-large-1"></i>
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
              <h3 class="font-large-1 mb-0">$4566</h3>
              <span>Total Sales</span>
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
              <h3 class="font-large-1 mb-0">$8695</h3>
              <span>Total Earning</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-wallet font-large-1"></i>
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
        <h4 class="card-title">PRODUCTS SALES</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="chart-info mb-3 ml-3">
            <span class="gradient-blackberry d-inline-block rounded-circle mr-1" style="width:15px; height:15px;"></span>
            Sales
            <span class="gradient-mint d-inline-block rounded-circle mr-1 ml-2" style="width:15px; height:15px;"></span>
            Visits
          </div>
          <div id="line-area" class="height-350 lineArea">
          <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="315" y2="315" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line><line y1="255" y2="255" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line><line y1="195" y2="195" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line><line y1="135" y2="135" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line><line y1="75" y2="75" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="50" x2="893.3333740234375" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M50,315L50,315C90.159,275,130.317,195,170.476,195C210.635,195,250.794,255,290.952,255C331.111,255,371.27,45,411.429,45C451.587,45,491.746,195,531.905,195C572.064,195,612.222,99,652.381,99C692.54,99,732.698,154,772.857,189C813.016,224,853.175,273,893.333,315L893.333,315Z" class="ct-area"></path><path d="M50,315C90.159,275,130.317,195,170.476,195C210.635,195,250.794,255,290.952,255C331.111,255,371.27,45,411.429,45C451.587,45,491.746,195,531.905,195C572.064,195,612.222,99,652.381,99C692.54,99,732.698,154,772.857,189C813.016,224,853.175,273,893.333,315" class="ct-line"></path><line x1="50" y1="315" x2="50.01" y2="315" class="ct-point" ct:value="0"></line><line x1="170.4761962890625" y1="195" x2="170.4861962890625" y2="195" class="ct-point" ct:value="20"></line><line x1="290.952392578125" y1="255" x2="290.962392578125" y2="255" class="ct-point" ct:value="10"></line><line x1="411.4285888671875" y1="45" x2="411.4385888671875" y2="45" class="ct-point" ct:value="45"></line><line x1="531.90478515625" y1="195" x2="531.91478515625" y2="195" class="ct-point" ct:value="20"></line><line x1="652.3809814453125" y1="99" x2="652.3909814453125" y2="99" class="ct-point" ct:value="36"></line><line x1="772.857177734375" y1="189" x2="772.867177734375" y2="189" class="ct-point" ct:value="21"></line><line x1="893.3333740234375" y1="315" x2="893.3433740234375" y2="315" class="ct-point" ct:value="0"></line></g><g class="ct-series ct-series-b"><path d="M50,315L50,315C90.159,305,130.317,300.455,170.476,285C210.635,269.545,250.794,183,290.952,183C331.111,183,371.27,231,411.429,231C451.587,231,491.746,123,531.905,123C572.064,123,612.222,243,652.381,243C692.54,243,732.698,147,772.857,147C813.016,147,853.175,259,893.333,315L893.333,315Z" class="ct-area"></path><path d="M50,315C90.159,305,130.317,300.455,170.476,285C210.635,269.545,250.794,183,290.952,183C331.111,183,371.27,231,411.429,231C451.587,231,491.746,123,531.905,123C572.064,123,612.222,243,652.381,243C692.54,243,732.698,147,772.857,147C813.016,147,853.175,259,893.333,315" class="ct-line"></path><line x1="50" y1="315" x2="50.01" y2="315" class="ct-point" ct:value="0"></line><line x1="170.4761962890625" y1="285" x2="170.4861962890625" y2="285" class="ct-point" ct:value="5"></line><line x1="290.952392578125" y1="183" x2="290.962392578125" y2="183" class="ct-point" ct:value="22"></line><line x1="411.4285888671875" y1="231" x2="411.4385888671875" y2="231" class="ct-point" ct:value="14"></line><line x1="531.90478515625" y1="123" x2="531.91478515625" y2="123" class="ct-point" ct:value="32"></line><line x1="652.3809814453125" y1="243" x2="652.3909814453125" y2="243" class="ct-point" ct:value="12"></line><line x1="772.857177734375" y1="147" x2="772.867177734375" y2="147" class="ct-point" ct:value="28"></line><line x1="893.3333740234375" y1="315" x2="893.3433740234375" y2="315" class="ct-point" ct:value="0"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">1</span></foreignObject><foreignObject style="overflow: visible;" x="170.4761962890625" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">2</span></foreignObject><foreignObject style="overflow: visible;" x="290.952392578125" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">3</span></foreignObject><foreignObject style="overflow: visible;" x="411.4285888671875" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">4</span></foreignObject><foreignObject style="overflow: visible;" x="531.90478515625" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">5</span></foreignObject><foreignObject style="overflow: visible;" x="652.3809814453125" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">6</span></foreignObject><foreignObject style="overflow: visible;" x="772.857177734375" y="320" width="120.4761962890625" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 120px; height: 20px;">7</span></foreignObject><foreignObject style="overflow: visible;" x="893.3333740234375" y="320" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">8</span></foreignObject><foreignObject style="overflow: visible;" y="255" x="10" height="60" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 60px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="195" x="10" height="60" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 60px; width: 30px;">10</span></foreignObject><foreignObject style="overflow: visible;" y="135" x="10" height="60" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 60px; width: 30px;">20</span></foreignObject><foreignObject style="overflow: visible;" y="75" x="10" height="60" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 60px; width: 30px;">30</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="60" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 60px; width: 30px;">40</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">50</span></foreignObject></g><defs><linearGradient id="gradient" x1="0" y1="1" x2="1" y2="0"><stop offset="0" stop-color="rgba(0, 201, 255, 1)"></stop><stop offset="1" stop-color="rgba(146, 254, 157, 1)"></stop></linearGradient><linearGradient id="gradient1" x1="0" y1="1" x2="1" y2="0"><stop offset="0" stop-color="rgba(132, 60, 247, 1)"></stop><stop offset="1" stop-color="rgba(56, 184, 242, 1)"></stop></linearGradient></defs></svg></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Line with Area Chart 1 Ends-->

<div class="row match-height">
  <div class="col-xl-4 col-lg-12 col-12">
    <div class="card" style="height: 414.667px;">
      <div class="card-header">
        <h4 class="card-title">Statistics</h4>
      </div>
      <div class="card-content">

        <p class="font-medium-2 text-muted text-center pb-2">Last 6 Months Sales</p>
        <div id="Stack-bar-chart" class="height-300 Stackbarchart mb-2">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="49.81523695882161" x2="49.81423695882161" y1="240" y2="72" class="ct-bar" ct:value="8" style="stroke-width: 5px"></line><line x1="89.44371087646483" x2="89.44271087646483" y1="240" y2="51" class="ct-bar" ct:value="9" style="stroke-width: 5px"></line><line x1="129.07218479410807" x2="129.07118479410806" y1="240" y2="135" class="ct-bar" ct:value="5" style="stroke-width: 5px"></line><line x1="168.70065871175132" x2="168.6996587117513" y1="240" y2="114" class="ct-bar" ct:value="6" style="stroke-width: 5px"></line><line x1="208.32913262939454" x2="208.32813262939453" y1="240" y2="93" class="ct-bar" ct:value="7" style="stroke-width: 5px"></line><line x1="247.95760654703776" x2="247.95660654703775" y1="240" y2="156" class="ct-bar" ct:value="4" style="stroke-width: 5px"></line></g><g class="ct-series ct-series-b"><line x1="49.81523695882161" x2="49.81423695882161" y1="72" y2="30" class="ct-bar" ct:value="2" style="stroke-width: 5px"></line><line x1="89.44371087646483" x2="89.44271087646483" y1="51" y2="30" class="ct-bar" ct:value="1" style="stroke-width: 5px"></line><line x1="129.07218479410807" x2="129.07118479410806" y1="135" y2="30" class="ct-bar" ct:value="5" style="stroke-width: 5px"></line><line x1="168.70065871175132" x2="168.6996587117513" y1="114" y2="30" class="ct-bar" ct:value="4" style="stroke-width: 5px"></line><line x1="208.32913262939454" x2="208.32813262939453" y1="93" y2="30" class="ct-bar" ct:value="3" style="stroke-width: 5px"></line><line x1="247.95760654703776" x2="247.95660654703775" y1="156" y2="30" class="ct-bar" ct:value="6" style="stroke-width: 5px"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="30" y="270" width="39.62847391764323" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Jan</span></foreignObject><foreignObject style="overflow: visible;" x="69.62847391764322" y="270" width="39.62847391764323" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Feb</span></foreignObject><foreignObject style="overflow: visible;" x="109.25694783528645" y="270" width="39.628473917643234" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Mar</span></foreignObject><foreignObject style="overflow: visible;" x="148.8854217529297" y="270" width="39.62847391764322" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Apr</span></foreignObject><foreignObject style="overflow: visible;" x="188.5138956705729" y="270" width="39.62847391764322" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">May</span></foreignObject><foreignObject style="overflow: visible;" x="228.14236958821613" y="270" width="39.62847391764325" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 40px; height: 20px;">Jun</span></foreignObject></g><defs><linearGradient id="linear" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(0, 201, 255,1)"></stop><stop offset="1" stop-color="rgba(17,228,183, 1)"></stop></linearGradient></defs></svg></div>

      </div>
    </div>
  </div>
  <div class="col-xl-8 col-lg-12 col-12">
    <div class="card" style="height: 414.667px;">
      <div class="card-header pb-2">
        <h4 class="card-title">Shopping Cart</h4>
      </div>
      <div class="card-content">
        <table class="table table-responsive-sm text-center">
          <thead>
            <tr>
              <th>Image</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img class="media-object round-media height-50" src="app-assets/img/elements/01.png" alt="Generic placeholder image"></td>
              <td>Ferrero Rocher</td>
              <td>1</td>
              <td>
                <a class="btn white btn-round btn-primary">Active</a>
              </td>
              <td>$19.94</td>
              <td>
                <a class="danger" data-original-title="" title="">
                  <i class="ft-x"></i>
                </a>
              </td>
            </tr>
            <tr>
              <td><img class="media-object round-media height-50" src="app-assets/img/elements/07.png" alt="Generic placeholder image"></td>
              <td>Headphones</td>
              <td>2</td>
              <td>
                <a class="btn white btn-round btn-danger">Disabled</a>
              </td>
              <td>$99.00</td>
              <td>
                <a class="danger" data-original-title="" title="">
                  <i class="ft-x"></i>
                </a>
              </td>
            </tr>
            <tr>
              <td><img class="media-object round-media height-50" src="app-assets/img/elements/11.png" alt="Generic placeholder image"></td>
              <td>Camera</td>
              <td>1</td>
              <td>
                <a class="btn white btn-round btn-info">Paused</a>
              </td>
              <td>$299.00</td>
              <td>
                <a class="danger" data-original-title="" title="">
                  <i class="ft-x"></i>
                </a>
              </td>
            </tr>
            <tr>
              <td><img class="media-object round-media height-50" src="app-assets/img/elements/14.png" alt="Generic placeholder image"></td>
              <td>Beer</td>
              <td>2</td>
              <td>
                <a class="btn white btn-round btn-success">Active</a>
              </td>
              <td>$24.51</td>
              <td>
                <a class="danger" data-original-title="" title="">
                  <i class="ft-x"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row match-height">
  <div class="col-xl-8 col-lg-12 col-12">
    <div class="card" style="height: 522.083px;">
      <div class="card-header">
        <h4 class="card-title mb-0">Visit &amp; Sales Statistics</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="chart-info mb-2">
            <span class="text-uppercase mr-3"><i class="fa fa-circle primary font-small-2 mr-1"></i> Sales</span>
            <span class="text-uppercase"><i class="fa fa-circle deep-purple font-small-2 mr-1"></i> Visits</span>
          </div>
          <div id="line-area2" class="height-400 lineAreaDashboard">
          <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="365" y2="365" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="277.5" y2="277.5" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="190" y2="190" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="102.5" y2="102.5" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="50" x2="565.5521240234375" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M50,365L50,356.25L96.868,312.5L143.737,321.25L190.605,268.75L237.473,286.25L284.342,251.25L331.21,260L378.079,181.25L424.947,225L471.815,172.5L518.684,155L565.552,102.5L565.552,365Z" class="ct-area"></path><path d="M50,356.25L96.868,312.5L143.737,321.25L190.605,268.75L237.473,286.25L284.342,251.25L331.21,260L378.079,181.25L424.947,225L471.815,172.5L518.684,155L565.552,102.5" class="ct-line"></path><circle cx="50" cy="356.25" r="4" class="ct-point-circle"></circle><circle cx="96.8683749112216" cy="312.5" r="4" class="ct-point-circle"></circle><circle cx="143.7367498224432" cy="321.25" r="4" class="ct-point-circle"></circle><circle cx="190.60512473366478" cy="268.75" r="4" class="ct-point-circle"></circle><circle cx="237.47349964488637" cy="286.25" r="4" class="ct-point-circle"></circle><circle cx="284.341874556108" cy="251.25" r="4" class="ct-point-circle"></circle><circle cx="331.21024946732956" cy="260" r="4" class="ct-point-circle"></circle><circle cx="378.0786243785511" cy="181.25" r="4" class="ct-point-circle"></circle><circle cx="424.94699928977275" cy="225" r="4" class="ct-point-circle"></circle><circle cx="471.81537420099437" cy="172.5" r="4" class="ct-point-circle"></circle><circle cx="518.683749112216" cy="155" r="4" class="ct-point-circle"></circle><circle cx="565.5521240234375" cy="102.5" r="4" class="ct-point-circle"></circle></g><g class="ct-series ct-series-b"><path d="M50,365L50,225L96.868,198.75L143.737,212.75L190.605,93.75L237.473,120L284.342,107.75L331.21,137.5L378.079,50L424.947,85L471.815,58.75L518.684,76.25L565.552,15L565.552,365Z" class="ct-area"></path><path d="M50,225L96.868,198.75L143.737,212.75L190.605,93.75L237.473,120L284.342,107.75L331.21,137.5L378.079,50L424.947,85L471.815,58.75L518.684,76.25L565.552,15" class="ct-line"></path><circle cx="50" cy="225" r="4" class="ct-point-circle"></circle><circle cx="96.8683749112216" cy="198.75" r="4" class="ct-point-circle"></circle><circle cx="143.7367498224432" cy="212.75" r="4" class="ct-point-circle"></circle><circle cx="190.60512473366478" cy="93.75" r="4" class="ct-point-circle"></circle><circle cx="237.47349964488637" cy="120" r="4" class="ct-point-circle"></circle><circle cx="284.341874556108" cy="107.75" r="4" class="ct-point-circle"></circle><circle cx="331.21024946732956" cy="137.5" r="4" class="ct-point-circle"></circle><circle cx="378.0786243785511" cy="50" r="4" class="ct-point-circle"></circle><circle cx="424.94699928977275" cy="85" r="4" class="ct-point-circle"></circle><circle cx="471.81537420099437" cy="58.75" r="4" class="ct-point-circle"></circle><circle cx="518.683749112216" cy="76.25" r="4" class="ct-point-circle"></circle><circle cx="565.5521240234375" cy="15" r="4" class="ct-point-circle"></circle></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="43.4341874556108" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jan</span></foreignObject><foreignObject style="overflow: visible;" x="90.30256236683239" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Feb</span></foreignObject><foreignObject style="overflow: visible;" x="137.170937278054" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Mar</span></foreignObject><foreignObject style="overflow: visible;" x="184.03931218927556" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Apr</span></foreignObject><foreignObject style="overflow: visible;" x="230.90768710049718" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">May</span></foreignObject><foreignObject style="overflow: visible;" x="277.7760620117188" y="370" width="46.86837491122159" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jun</span></foreignObject><foreignObject style="overflow: visible;" x="324.6444369229404" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Jul</span></foreignObject><foreignObject style="overflow: visible;" x="371.51281183416194" y="370" width="46.86837491122162" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Aug</span></foreignObject><foreignObject style="overflow: visible;" x="418.38118674538356" y="370" width="46.86837491122162" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Sep</span></foreignObject><foreignObject style="overflow: visible;" x="465.2495616566051" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Oct</span></foreignObject><foreignObject style="overflow: visible;" x="512.1179365678267" y="370" width="46.868374911221565" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 47px; height: 20px;">Nov</span></foreignObject><foreignObject style="overflow: visible;" x="550.5521240234375" y="370" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">Dec</span></foreignObject><foreignObject style="overflow: visible;" y="277.5" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="190" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">50</span></foreignObject><foreignObject style="overflow: visible;" y="102.5" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">100</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="-5" height="87.5" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 88px; width: 30px;">150</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="-5" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">200</span></foreignObject></g><defs><linearGradient id="gradient2" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-opacity="0.2" stop-color="rgba(255, 255, 255, 1)"></stop><stop offset="1" stop-opacity="0.2" stop-color="rgba(0, 201, 255, 1)"></stop></linearGradient><linearGradient id="gradient3" x1="0" y1="1" x2="0" y2="0"><stop offset="0.3" stop-opacity="0.2" stop-color="rgba(255, 255, 255, 1)"></stop><stop offset="1" stop-opacity="0.2" stop-color="rgba(132, 60, 247, 1)"></stop></linearGradient></defs></svg></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-12 col-12">
    <div class="card gradient-blackberry" style="height: 522.083px;">
      <div class="card-content">
        <div class="card-body">
          <h4 class="card-title white">Statistics</h4>
          <div class="p-2 text-center">
            <a class="white font-medium-1">Month</a>
            <a class="btn btn-raised btn-round bg-white mx-3 px-3">Week</a>
            <a class="white font-medium-1">Day</a>
          </div>
          <div class="my-3 text-center white">
            <a class="font-large-2 d-block mb-1">$ 78.89 <span class="ft-arrow-up font-large-2"></span></a>
            <span class="font-medium-1">Week2 +15.44</span>
          </div>
        </div>
        <div id="lineChart" class="height-250 lineChart lineChartShadow">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M10,55C25.154,51.667,40.308,45,55.462,45C70.616,45,85.77,58.333,100.924,65C116.078,71.667,131.231,82.778,146.385,85C161.539,87.222,176.693,89,191.847,89C207.001,89,222.155,80.895,237.309,75C252.463,69.105,267.617,59,282.771,51" class="ct-line"></path><line x1="10" y1="55" x2="10.01" y2="55" class="ct-point" ct:value="80"></line><line x1="55.46180725097656" y1="45" x2="55.47180725097656" y2="45" class="ct-point" ct:value="85"></line><line x1="100.92361450195312" y1="65" x2="100.93361450195313" y2="65" class="ct-point" ct:value="75"></line><line x1="146.3854217529297" y1="85" x2="146.39542175292968" y2="85" class="ct-point" ct:value="65"></line><line x1="191.84722900390625" y1="89" x2="191.85722900390624" y2="89" class="ct-point" ct:value="63"></line><line x1="237.3090362548828" y1="75" x2="237.3190362548828" y2="75" class="ct-point" ct:value="70"></line><line x1="282.7708435058594" y1="51" x2="282.78084350585937" y2="51" class="ct-point" ct:value="82"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="10" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Mon</span></foreignObject><foreignObject style="overflow: visible;" x="55.46180725097656" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Tue</span></foreignObject><foreignObject style="overflow: visible;" x="100.92361450195312" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Wed</span></foreignObject><foreignObject style="overflow: visible;" x="146.3854217529297" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Thu</span></foreignObject><foreignObject style="overflow: visible;" x="191.84722900390625" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Fri</span></foreignObject><foreignObject style="overflow: visible;" x="237.3090362548828" y="220" width="45.46180725097656" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 45px; height: 20px;">Sat</span></foreignObject><foreignObject style="overflow: visible;" x="282.7708435058594" y="220" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">Sun</span></foreignObject></g></svg></div>
      </div>
    </div>
  </div>
</div>

<div class="row match-height">
  <div class="col-xl-4 col-lg-12">
    <div class="card" style="height: 522.583px;">
      <div class="card-header">
        <h4 class="card-title">Statistics</h4>
      </div>
      <div class="card-content">

        <p class="font-medium-2 text-muted text-center">Hobbies</p>
        <div id="bar-chart" class="height-250 BarChartShadow BarChart">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="44.09735543823242" x2="44.09635543823242" y1="195" y2="38.33333333333334" class="ct-bar" ct:value="53"></line><line x1="112.29006631469727" x2="112.28906631469727" y1="195" y2="138.33333333333331" class="ct-bar" ct:value="23"></line><line x1="180.4827771911621" x2="180.4817771911621" y1="195" y2="81.66666666666666" class="ct-bar" ct:value="40"></line><line x1="248.67548806762696" x2="248.67448806762695" y1="195" y2="115" class="ct-bar" ct:value="30"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="10" y="220" width="68.19271087646484" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 68px; height: 20px;">Sport</span></foreignObject><foreignObject style="overflow: visible;" x="78.19271087646484" y="220" width="68.19271087646484" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 68px; height: 20px;">Music</span></foreignObject><foreignObject style="overflow: visible;" x="146.3854217529297" y="220" width="68.19271087646484" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 68px; height: 20px;">Travel</span></foreignObject><foreignObject style="overflow: visible;" x="214.57813262939453" y="220" width="68.19271087646484" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 68px; height: 20px;">News</span></foreignObject></g><defs><linearGradient id="gradient4" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(238, 9, 121,1)"></stop><stop offset="1" stop-color="rgba(255, 106, 0, 1)"></stop></linearGradient><linearGradient id="gradient5" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(0, 75, 145,1)"></stop><stop offset="1" stop-color="rgba(120, 204, 55, 1)"></stop></linearGradient><linearGradient id="gradient6" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(132, 60, 247,1)"></stop><stop offset="1" stop-color="rgba(56, 184, 242, 1)"></stop></linearGradient><linearGradient id="gradient7" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="rgba(155, 60, 183,1)"></stop><stop offset="1" stop-color="rgba(255, 57, 111, 1)"></stop></linearGradient></defs></svg></div>

        <div class="card-body">
          <div class="row">
            <div class="col text-center">
              <span class="gradient-pomegranate d-block rounded-circle mx-auto mb-2" style="width:10px; height:10px;"></span>
              <span class="font-large-1 d-block mb-2">48</span>
              <span>Sport</span>
            </div>
            <div class="col text-center">
              <span class="gradient-green-tea d-block rounded-circle mx-auto mb-2" style="width:10px; height:10px;"></span>
              <span class="font-large-1 d-block mb-2">9</span>
              <span>Music</span>
            </div>
            <div class="col text-center">
              <span class="gradient-blackberry d-block rounded-circle mx-auto mb-2" style="width:10px; height:10px;"></span>
              <span class="font-large-1 d-block mb-2">26</span>
              <span>Travel</span>
            </div>
            <div class="col text-center">
              <span class="gradient-ibiza-sunset d-block rounded-circle mx-auto mb-2" style="width:10px; height:10px;"></span>
              <span class="font-large-1 d-block mb-2">17</span>
              <span>News</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-12">
    <div class="card" style="height: 522.583px;">
      <div class="card-header">
        <h4 class="card-title mb-0">User List</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-primary height-50 rounded-circle" src="app-assets/img/portrait/small/avatar-s-12.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Jessica Rice</h4>
              <p class="text-muted font-small-3">UX Designer</p>
            </div>
            <div class="mt-1">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" checked="" id="customcheckbox1">
                <label class="custom-control-label" for="customcheckbox1"></label>
              </div>

            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-danger height-50 rounded-circle" src="app-assets/img/portrait/small/avatar-s-11.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Jacob Rios</h4>
              <p class="text-muted font-small-3">HTML Developer</p>
            </div>
            <div class="mt-1">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" id="customcheckbox2">
                <label class="custom-control-label" for="customcheckbox2"></label>
              </div>

            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-success height-50 rounded-circle" src="app-assets/img/portrait/small/avatar-s-3.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Russell Delgado</h4>
              <p class="text-muted font-small-3">Database Designer</p>
            </div>
            <div class="mt-1">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" id="customcheckbox3">
                <label class="custom-control-label" for="customcheckbox3"></label>
              </div>

            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-warning height-50 rounded-circle" src="app-assets/img/portrait/small/avatar-s-6.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Sara McDonald</h4>
              <p class="text-muted font-small-3">Team Leader</p>
            </div>
            <div class="mt-1">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" checked="" id="customcheckbox4">
                <label class="custom-control-label" for="customcheckbox4"></label>
              </div>

            </div>
          </div>
          <div class="media mb-1">
            <a>
              <img alt="96x96" class="media-object d-flex mr-3 bg-info height-50 rounded-circle" src="app-assets/img/portrait/small/avatar-s-18.png">
            </a>
            <div class="media-body">
              <h4 class="font-medium-1 mt-1 mb-0">Janet Lucas</h4>
              <p class="text-muted font-small-3">Project Manger</p>
            </div>
            <div class="mt-1">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" id="customcheckbox5">
                <label class="custom-control-label" for="customcheckbox5"></label>
              </div>

            </div>
          </div>
          <div class="action-buttons mt-2 text-center">
            <a class="btn btn-raised gradient-blackberry py-2 px-4 white mr-2">Add New</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-12">
    <div class="card" style="height: 522.583px;">
      <div class="card-header">
        <h4 class="card-title">Project Stats</h4>
      </div>
      <div class="card-content">

        <p class="font-medium-2 text-muted text-center">Project Tasks</p>
        <div id="donut-dashboard-chart" class="height-250 donut">
        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;"><g ct:series-name="done" class="ct-series ct-done"><path d="M238.176,113.72A90,90,0,0,0,148.885,35" class="ct-slice-donut" ct:value="23" style="stroke-width: 60px;"></path></g><g ct:series-name="progress" class="ct-series ct-progress"><path d="M214.493,186.609A90,90,0,0,0,238.136,113.408" class="ct-slice-donut" ct:value="14" style="stroke-width: 60px;"></path></g><g ct:series-name="outstanding" class="ct-series ct-outstanding"><path d="M60.48,141.864A90,90,0,0,0,214.707,186.38" class="ct-slice-donut" ct:value="35" style="stroke-width: 60px;"></path></g><g ct:series-name="started" class="ct-series ct-started"><path d="M148.885,35A90,90,0,0,0,60.539,142.173" class="ct-slice-donut" ct:value="28" style="stroke-width: 60px;"></path></g><g><text dx="148.8854217529297" dy="125" text-anchor="middle" class="ct-label">100%</text></g></svg></div>

        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <span class="mb-1 text-muted d-block">23% - Started</span>
              <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 23%;" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="col">
              <span class="mb-1 text-muted d-block">14% - In Progress</span>
              <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-amber" role="progressbar" style="width: 14%;" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <span class="mb-1 text-muted d-block">35% - Remaining</span>
              <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-deep-purple bg-lighten-1" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="col">
              <span class="mb-1 text-muted d-block">28% - Done</span>
              <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-blue" role="progressbar" style="width: 28%;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
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
@endsection
@section('pagejs')
@endsection
