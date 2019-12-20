@extends('admin.layouts.app')

@section('pagetitle')
    <title>Ads Performance</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Ads Performance</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">TV Ads</h4>                    
                    </div>
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        <table class="table browse-table">
                          <thead>
                            <tr>
                              <th></th>                  
                              <th>Date</th>                  
                              <th>Channel</th>                  
                              <th>Programme</th>                  
                              <th>Product</th>                  
                              <th>Ads Type</th>                  
                              <th>Start Time</th>                  
                              <th>Duration</th>                  
                              <th>Cost</th>                  
                              <th>TVR</th>                  
                              <th>000s</th>                  
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!--Calendar Ends-->
          </div>
        </div>
@endsection
@section('modal')
<div class="modal fade text-left show" id="filter-modal-channel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8">Filter Channel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group row">
          <div class="col-sm-4">
            <input id="search-term-channel" type="text" class="form-control" placeholder="Cari">
          </div>
            <span class="input-group-btn">
                <button id="search-button-channel" class="btn btn-primary" type="button"><span class="ft-search"></span>Cari</button>
            </span>
        </div>
        <div id="filter-modal-channel-search-result" style="height:250px; overflow-y:scroll">
        </div>
      </div>
      <div class="modal-footer">
        <div id="filter-channel"></div>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Add Filter</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
#filterersubmit{
  bottom: 10px;
  top: auto;
  width: 95%;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>    
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
<script>
$("#filterersubmit").click(function() {
    var filtered = 0;
    var filterchannel = $("input[name=filter-channel]").val();
    if (filterchannel) filtered = 1;
    var filterprogramme = $("input[name=filter-programme]").val();
    if (filterprogramme) filtered = 1;
    if(filtered){
      var resp = false;
      if(window.innerWidth <= 800) resp=true;
      var table = $('.browse-table').DataTable({
          responsive: resp,
          processing: true,
          language: {
              processing: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="color:#bbbbbb"></i><span class="sr-only">Loading...</span> '
              },
          serverSide: true,
          ajax:{
            url: '{!! url('admin/adsperformance/indexjson') !!}',
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              'filterchannel': filterchannel,
              'filterprogramme': filterprogramme,
            },
            type: 'POST'
          },
          columns: [
            { data: 'id', name: 'checkbox' },              
            { data: 'date', name: 'date' },              
            { data: 'channel', name: 'channel' },              
            { data: 'iprogramme', name: 'iprogramme' },              
            { data: 'iproduct', name: 'iproduct' },              
            { data: 'iadstype', name: 'iadstype' },              
            { data: 'start_time', name: 'start_time' },              
            { data: 'duration', name: 'duration' },              
            { data: 'cost', name: 'cost' },              
            { data: 'tvr01', name: 'tvr01' },              
            { data: '000s01', name: '000s01' },              
          ],
          dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
              "<'row'<'col-sm-12'B>>"+
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          buttons: [            
              { extend: 'colvis', text: 'Column' },'copy', 'csv', 'excel', 'pdf', 'print',
              {
                extend: 'csv',
                text: 'CSV All',
                className: 'buttons-csvall',
                action: function ( e, dt, node, config ) {
                    window.location = '{{ url('admin/uploaddata/csvall') }}'
                }
              },
              {
                text: '<i class="ft-trash"></i> Hapus', className: 'buttons-deletemulti',
                action: function ( e, dt, node, config ) {

                }
              },  
          ],
          lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          columnDefs: [ {
              targets: 0,
              data: null,
              defaultContent: '',
              orderable: false,
              searchable: false,
              checkboxes: {
                  'selectRow': true
              }
          },{
              targets: ['id','created_at','updated_at'],
              visible: false,
              searchable: false,
          } ],
          select: {
              style:    'multi',
              selector: 'td:first-child'
          }
      });
  }else{
    alert("Please select a filter");
  }
  $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
  $('.buttons-add').addClass('btn mr-1');
  $('.buttons-deletemulti').addClass('btn-danger mr-1');

  $('.buttons-deletemulti').click(function(){
    var deleteids_arr = [];
    var rows_selected = table.column(0).checkboxes.selected();
    $.each(rows_selected, function(index, rowId){
      deleteids_arr.push(rowId);
    });
    var deleteids_str = encodeURIComponent(deleteids_arr);

    // Check any checkbox checked or not
    if(deleteids_arr.length > 0){
      var confirmdelete = confirm("Hapus seluruh data terpilih?");
      if (confirmdelete == true) {
        window.location = '{{ url('admin/uploaddata/destroymulti?id=') }}'+deleteids_str
      } 
    }
  });
});
</script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

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

});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('show.bs.modal','#filter-modal-channel', function(){
    $("#search-button-channel").click();
  });
  $('#search-term-channel').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          $('#search-button-channel').click();
        }
  });
  $("#search-button-channel").click(function(){
    $("#filter-modal-channel-search-result").empty();
    var term = $('#search-term-channel').val();
    // get data
    $.ajax({
      url: "{{ url('/admin/channel/searchjson') }}", 
      data: {term: term}, 
      success: function(result){
      $.each(result, function(k,v) {
        var curfil = $("#filter-channel").html();
        if(!$("#filter-channel").is(':empty') && curfil.indexOf(v.channel + ',')+1){
          // previously selected, set style
          $('#filter-modal-channel-search-result').append( '<button class="btn search-result btn-primary mr-1 col-1" title="'+v.channel+'" value="'+v.channel+'">'+v.channel+'</button>' );
        }else{
          $('#filter-modal-channel-search-result').append( '<button class="btn search-result btn-outline-primary mr-1 col-1" title="'+v.channel+'" value="'+v.channel+'">'+v.channel+'</button>' );
        }
      });
    }});      
  }); 
  $("#filter-modal-channel-search-result").on('click', '.search-result', function() {
    count = $("#filter-channel-count").html(); // get initial button count
    $(this).toggleClass("btn-outline-primary");
    $(this).toggleClass("btn-primary"); 
    var filt = $(this).val();
    if($(this).hasClass('btn-primary')){
      count++; // selected, increment button count
      $("#filter-channel").html(function(i,html) { 
          html = html + filt + ',';
          return html;
      });
    }else{
      count--; // unselected, decrement button count
      newval = $("#filter-channel").html();
      $("#filter-channel").html(newval.replace(filt+',',''));
    }
    $("input[name=filter-channel]").val($("#filter-channel").html());
    $("#filter-channel-count").html(count); // set count at button
  });
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
        <button type="button" class="btn btn-primary col-5" id="filter-button-channel" data-toggle="modal" data-backdrop="false" data-target="#filter-modal-channel"><span id="filter-channel-count"></span> Channel</button>
        {{ Form::hidden('filter-channel') }}
        <button class="btn btn-primary col-5">Programme</button>
        {{ Form::hidden('filter-programme') }}
        <button class="btn btn-primary col-5">Level 1</button>
        {{ Form::hidden('filter-level-1') }}
        <button class="btn btn-primary col-5">Level 2</button>
        {{ Form::hidden('filter-level-2') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Commercial</h6>
        <button class="btn btn-primary col-5">Advertiser</button>
        {{ Form::hidden('filter-advertiser') }}
        <button class="btn btn-primary col-5">Product</button>
        {{ Form::hidden('filter-product') }}
        <button class="btn btn-primary col-5">Sector</button>
        {{ Form::hidden('filter-sector') }}
        <button class="btn btn-primary col-5">Category</button>
        {{ Form::hidden('filter-category') }}
        <button class="btn btn-primary col-10">Ads Type</button>
        {{ Form::hidden('filter-ads-type') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Target Audience</h6>
        <button class="btn btn-primary col-10">Target Audience</button>
        {{ Form::hidden('filter-target-audience') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Other</h6>
        <button class="btn btn-primary col-5">Commercial Data</button>
        {{ Form::hidden('filter-commercial-data') }}
        <button class="btn btn-primary col-5">Commercial Type</button>
        {{ Form::hidden('filter-commercial-type') }}
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
