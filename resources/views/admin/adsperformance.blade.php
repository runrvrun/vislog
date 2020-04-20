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
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
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
    $("#filter-selected").html($("input[name=filter-"+filter+"]").val());
    // if filter by channel, load directly
    if(filter=="channel"){
      $("#search-button").click();
    }
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
            var curfil = $("#filter-selected").html().replace(/&amp;/g, '&');
            if(!$("#filter-"+filter).is(':empty') && curfil.indexOf(v + ';')+1){
              // previously selected, set style
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-primary mr-1" value="'+v+'">'+v+'</button>' );
            }else{
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-outline-primary mr-1" value="'+v+'">'+v+'</button>' );
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
  
  $("#filterersubmit").click(function() {
    // table.draw();  
    // destroy and remake datatable because column changed based on targetaudience (001-100)
    if ($.fn.DataTable.isDataTable(".browse-table")) {
      $('.browse-table').DataTable().clear().destroy();
    }
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
        data : function(d){
            d.startdate = $('#startdate').val();
            d.enddate = $('#enddate').val();
            d.filterchannel = $("input[name=filter-channel]").val();
            d.filternprogramme = $("input[name=filter-nprogramme]").val().replace(/&amp;/g, '&');
            d.filternlevel_1 = $("input[name=filter-nlevel_1]").val();
            d.filternlevel_2 = $("input[name=filter-nlevel_2]").val();
            d.filternadvertiser = $("input[name=filter-nadvertiser]").val().replace(/&amp;/g, '&');;
            d.filternproduct = $("input[name=filter-nproduct]").val().replace(/&amp;/g, '&');
            d.filternsector = $("input[name=filter-nsector]").val().replace(/&amp;/g, '&');
            d.filterncategory = $("input[name=filter-ncategory]").val().replace(/&amp;/g, '&');
            d.filternadstype = $("input[name=filter-nadstype]").val().replace(/&amp;/g, '&');
            d.filterntargetaudience = $("select[name=filter-ntargetaudience]").val();
            d.filterncommercialdata = $("select[name=filter-ncommercialdata]").val();
            d.filterncommercialtype = $("select[name=filter-ncommercialtype]").val();
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
        { data: 'tvr'+$("select[name=filter-ntargetaudience]").val(), name: 'tvr'+$("select[name=filter-ntargetaudience]").val() },              
        { data: '000s'+$("select[name=filter-ntargetaudience]").val(), name: '000s'+$("select[name=filter-ntargetaudience]").val() },              
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
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn mr-1');
    $('.buttons-deletemulti').addClass('btn-danger mr-1');

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
        <button class="btn btn-primary col-5 filter-button" data-filter="nlevel_1"><span id="filter-nlevel_1-count"></span> Level 1</button>
        {{ Form::hidden('filter-nlevel_1') }}
        <button class="btn btn-primary col-5 filter-button" data-filter="nlevel_2"><span id="filter-nlevel_2-count"></span> Level 2</button>
        {{ Form::hidden('filter-nlevel_2') }}
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
          <option value="" selected disabled>- Commercial Data -</option>
          <option value="ungrouped">Ungrouped</option>
          <option value="grouped">Grouped</option>
        </select>
        </div>
        <div class="form-group">
        <select name="filter-ncommercialtype" class="form-control col-10">
          <option value="" selected disabled>- Commercial Type -</option>
          <option value="allads">All Ads</option>
          <option value="commercialonly">Commercial Only</option>
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
