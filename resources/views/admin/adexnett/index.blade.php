@extends('admin.layouts.app')

@section('pagetitle')
    <title>Adex Nett</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Adex Nett</div>                
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
                              <th>Year</th>                  
                              <th>Month</th>                  
                              <th>Channel</th>                  
                              <th>nSector</th>
                              <th>nCategory</th>
                              <th>nAdvertiser</th>
                              <th>nProduct</th>                  
                              <th>nProgramme</th>                  
                              <th>nLevel 1</th>
                              <th>nLevel 2</th>
                              <th>nAdstype</th>
                              <th>iSector</th>
                              <th>iCategory</th>
                              <th>iAdvertiser</th>
                              <th>iProduct</th>
                              <th>iProgramme</th>
                              <th>iLevel 1</th>
                              <th>iLevel 2</th>
                              <th>iAdstype</th>
                              <th>tAdstype</th>
                              <th>Advertiser Group</th>
                              <th>Agency</th>
                              <th>Agency_Subs</th>
                              <th>GM</th>
                              <th>SM</th>
                              <th>SGH</th>
                              <th>AM</th>
                              <th>Target</th>
                              <th>Spots</th>                  
                              <th>GRP</th>                  
                              <th>Gross</th>                  
                              <th>Revenue</th>
                              <th>Nett1</th>                  
                              <th>Nett2</th>                  
                              <th>Nett3</th>
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
        <a id="filter-reset-selected" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- modal play video -->
<div class="modal fade text-left show" id="playvideo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel7"><span id="playvideo-title"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="loadingvideo" style="font-size:20px;">Loading video... Please wait  <i class="ft-refresh-cw font-medium-4 fa fa-spin align-middle"></i></div>
          <video src="" controls id="playvideo"></video>
      </div>
      <div class="modal-footer">
        <a href="" download="" id="downloadvideo" class="btn white btn-warning"> <i class="ft-download"></i> Download </a>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
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
    $("#filter-selected").html('');
    $("#filter-selected").html($("input[name=filter-"+filter+"]").val());
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
            curfil = curfil.split(";");
            if(!$("#filter-"+filter).is(':empty') && (jQuery.inArray(v[filter], curfil) != -1) ){
              // previously selected, set style
              $('#filter-modal-search-result').append( '<button type="button" class="btn search-result btn-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }else{
              $('#filter-modal-search-result').append( '<button type="button" class="btn search-result btn-outline-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
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

  $(".browse-table").on("click", ".playvideo-button", function(){
    $("#playvideo-title").html($(this).data("iproduct") + " - " + $(this).data("iprogramme") + " - " + $(this).data("channel"));
    $("#playvideo").attr('src','');
    $("#loadingvideo").show();
    // get video path
    $.ajax({
        url:"{{ url('/admin/video/generatevideo') }}",
        data:{
          id: $(this).data("id"),
          page: window.location.href,
        },
        success:function(response) {
          videopath = response;
          $("#loadingvideo").hide();
          $("#playvideo").attr('src',videopath);
          $("#downloadvideo").attr('href',videopath);
          $("#downloadvideo").attr('download',$("#playvideo-title").html());
       },
       error:function(){
        console.log("error getting video path");
       }
    });
  });
}); 
</script>
<script>
$(document).ready(function(){
  var resp = false;
  if(window.innerWidth <= 800) resp=true;
  
  $("#filterersubmit").click(function() {
    // table.draw();  
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
        url: '{!! url('admin/adexnett/indexjson') !!}',
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : function(d){
            d.startdate = $('#startdate').val();
            d.enddate = $('#enddate').val();
            d.filterchannel = $("input[name=filter-channel]").val();
            d.filternprogramme = $("input[name=filter-nprogramme]").val().replace(/&amp;/g, '&');
            d.filteriprogramme = $("input[name=filter-iprogramme]").val().replace(/&amp;/g, '&');
            d.filternlevel_1 = $("input[name=filter-nlevel_1]").val();
            d.filterilevel_1 = $("input[name=filter-ilevel_1]").val();
            d.filternlevel_2 = $("input[name=filter-nlevel_2]").val();
            d.filterilevel_2 = $("input[name=filter-ilevel_2]").val();
            d.filternadvertiser = $("input[name=filter-nadvertiser]").val().replace(/&amp;/g, '&');;
            d.filteriadvertiser = $("input[name=filter-iadvertiser]").val().replace(/&amp;/g, '&');
            d.filternproduct = $("input[name=filter-nproduct]").val().replace(/&amp;/g, '&');
            d.filteriproduct = $("input[name=filter-iproduct]").val().replace(/&amp;/g, '&');
            d.filternsector = $("input[name=filter-nsector]").val().replace(/&amp;/g, '&');
            d.filterisector = $("input[name=filter-isector]").val().replace(/&amp;/g, '&');
            d.filterncategory = $("input[name=filter-ncategory]").val().replace(/&amp;/g, '&');
            d.filtericategory = $("input[name=filter-icategory]").val().replace(/&amp;/g, '&');
            d.filteriadvertiser_group = $("input[name=filter-iadvertiser_group]").val();
        },
        type: 'POST'
      },
      columns: [
        { data: 'year', name: 'year' },              
        { data: 'month', name: 'month' },
        { data: 'channel', name: 'channel' },
        { data: 'nsector', name: 'nsector' },
        { data: 'ncategory', name: 'ncategory' },
        { data: 'nadvertiser', name: 'nadvertiser' },
        { data: 'nproduct', name: 'nproduct' },
        { data: 'nprogramme', name: 'nprogramme' },
        { data: 'nlevel_1', name: 'nlevel_1' },
        { data: 'nlevel_2', name: 'nlevel_2' },
        { data: 'nadstype', name: 'nadstype' },
        { data: 'isector', name: 'isector' },
        { data: 'icategory', name: 'icategory' },
        { data: 'iadvertiser', name: 'iadvertiser' },
        { data: 'iproduct', name: 'iproduct' },
        { data: 'iprogramme', name: 'iprogramme' },
        { data: 'ilevel_1', name: 'ilevel_1' },
        { data: 'ilevel_2', name: 'ilevel_2' },
        { data: 'iadstype', name: 'iadstype' },
        { data: 'tadstype', name: 'tadstype' },
        { data: 'advertiser_group', name: 'advertiser_group' },
        { data: 'agency', name: 'agency' },
        { data: 'agency_subs', name: 'agency_subs' },
        { data: 'gm', name: 'gm' },
        { data: 'sm', name: 'sm' },
        { data: 'sgh', name: 'sgh' },
        { data: 'am', name: 'am' },
        { data: 'target', name: 'target' },
        { data: 'spots', name: 'spots' },
        { data: 'grp', name: 'grp' },
        { data: 'gross', name: 'gross', render: $.fn.dataTable.render.number('', '.', 0, '') },
        { data: 'revenue', name: 'revenue', render: $.fn.dataTable.render.number('', '.', 0, '') },
        { data: 'nett1', name: 'nett1', render: $.fn.dataTable.render.number('', '.', 0, '') },
        { data: 'nett2', name: 'nett2', render: $.fn.dataTable.render.number('', '.', 0, '') },
        { data: 'nett3', name: 'nett3', render: $.fn.dataTable.render.number('', '.', 0, '') },
      ],
      dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'B>>"+
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [            
          { extend: 'colvis', text: 'Column' },
          {
            extend: 'csv',
            text: 'CSV All',
            className: 'buttons-csvall',
            action: function ( e, dt, node, config ) {
                var oriaction = $("#filterer-form").attr('action');
                $("#filterer-form").attr('action','{{ url('admin/adexnett/csvall') }}');
                $("#filterer-form").submit();
                $("#filterer-form").attr('action',oriaction);
                $("#filterer-form").attr('target','');
            }
          }
      ],
      lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      columnDefs: [ 
      {
          targets: ['id','created_at','updated_at'],
          visible: false,
          searchable: false,
      },{
          targets: [0,1],
          sortable: false,
      },{
          targets: [3,4,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,31],
          visible: false,
      }
     ],
      select: {
          style:    'multi',
          selector: 'td:first-child'
      } 
    }); 
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn mr-1');
    $('.buttons-deletemulti').addClass('btn-danger mr-1');

  });

});
</script>
<script>
  $(document).ready(function(){
    $("#filtererreset").click(function(){
      var start = moment().subtract(6, 'day');
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
@endsection
@section('filterer')
<div class="filterer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
<a class="filterer-close"><i class="ft-x font-medium-3"></i></a>
<button id="filterersubmit" class="btn btn-warning pull-right filterer-close" style="color:#fff"><i class="ft-filter"></i> Process</button>
<a id="filtererreset" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
<a id="rtl-icon" class="filterer-toggle bg-success"><i class="ft-filter font-medium-4 fa white align-middle"></i></a>
      <div data-ps-id="8db9d3c9-2e00-94a2-f661-18a2e74f8b35" class="filterer-content p-3 ps-container ps-theme-dark ps-active-y">
        <form id="filterer-form" method="post" action="">@csrf
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
        {{ Form::hidden('filter-channel') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nprogramme"><span id="filter-nprogramme-count"></span> nProgramme</button>
        {{ Form::hidden('filter-nprogramme') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iprogramme"><span id="filter-iprogramme-count"></span> iProgramme</button>
        {{ Form::hidden('filter-iprogramme') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_1"><span id="filter-nlevel_1-count"></span> nLevel 1</button>
        {{ Form::hidden('filter-nlevel_1') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_1"><span id="filter-ilevel_1-count"></span> iLevel 1</button>
        {{ Form::hidden('filter-ilevel_1') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_2"><span id="filter-nlevel_2-count"></span> nLevel 2</button>
        {{ Form::hidden('filter-nlevel_2') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_2"><span id="filter-ilevel_2-count"></span> iLevel 2</button>
        {{ Form::hidden('filter-ilevel_2') }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Commercial</h6>
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nadvertiser"><span id="filter-nadvertiser-count"></span> nAdvertiser</button>
        {{ Form::hidden('filter-nadvertiser') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadvertiser"><span id="filter-iadvertiser-count"></span> iAdvertiser</button>
        {{ Form::hidden('filter-iadvertiser') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nproduct"><span id="filter-nproduct-count"></span> nProduct</button>
        {{ Form::hidden('filter-nproduct') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iproduct"><span id="filter-iproduct-count"></span> iProduct</button>
        {{ Form::hidden('filter-iproduct') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nsector"><span id="filter-nsector-count"></span> nSector</button>
        {{ Form::hidden('filter-nsector') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="isector"><span id="filter-isector-count"></span> iSector</button>
        {{ Form::hidden('filter-isector') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ncategory"><span id="filter-ncategory-count"></span> nCategory</button>
        {{ Form::hidden('filter-ncategory') }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="icategory"><span id="filter-icategory-count"></span> iCategory</button>
        {{ Form::hidden('filter-icategory') }}        
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadvertiser_group"><span id="filter-iadvertiser_group-count"></span> Advertiser Group</button>
        {{ Form::hidden('filter-iadvertiser_group') }}   
        <hr>
        </form>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
          <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 295px; right: 3px;">
          <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 108px;"></div>
        </div>
      </div>
    </div>
@endsection
