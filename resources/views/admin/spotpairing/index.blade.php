@extends('admin.layouts.app')

@section('pagetitle')
    <title>Spot Pairing</title>
@endsection

@section('content')
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Spot Pairing</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Spot Pairing</h4>                    
                    </div>
                    @csrf
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        {{ Form::hidden('startdate',null,['id'=>'startdate']) }}
                        {{ Form::hidden('enddate',null,['id'=>'enddate']) }}
                      <form method="POST" action="{{ url('admin/spotpairingupdate') }}" onSubmit="return confirm('Update Spot Pairing?')">@csrf
                        <div class="row">
                          <div class="col-md-1">Period</div>
                          <div class="col-md-4">
                            <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                          </div>
                          <div class="col-md-2"><button type="button" class="btn btn-info" id="btnfilter"><i class="ft-filter"></i> Filter</button></div>
                          <div class="col-md-3"><button type="submit" class="btn btn-success btn-block"><i class="ft-save"></i> Save Matching</button></div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-4">iProduct</div>
                              <div class="position-relative has-icon-right col-md-7 col-md-offset-1">
                                <input name="iproduct-filter" class="form-control round" placeholder="Search" type="text" />
                                <div class="form-control-position"><i class="ft-search"></i></div>
                              </div>
                            </div>                            
                          </div>
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-4">nProduct</div>
                              <div class="position-relative has-icon-right col-md-7 col-md-offset-1">
                                <input name="nproduct-filter" class="form-control round" placeholder="Search" type="text" />
                                <div class="form-control-position"><i class="ft-search"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6" id="iproduct" style="height:500px;overflow-y:scroll;">
                          </div>
                          <div class="col-md-6" id="nproduct" style="height:500px;overflow-y:scroll;">
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
@endsection
@section('modal')
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<style>
.spot{
  border: 2px solid #444444;
  height: 32px;
  margin: 4px 0;
}
.spot span{
  position: absolute;
  right: 40px;
  color: #999;
}
.spot input{
  width: 50px;
  text-align: center;
  font-weight: bold;
  margin: 0 10px 0 0;
}
form .form-control-position {
    right: 16px;
}
</style>
@endsection
@section('pagejs')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
  $.ajax({
      url: "{{ url('/admin/spotpairingjson') }}", 
      success: function(result){
        if(result.a && result.a.count>0){
          $.each(result.a, function(k,v) {                            
            var no = k+1;
            $('#iproduct').append( '<div class="spot"><input type="text" value="'+no+'" disabled></input>'+ v.iproduct +'<span>'+ v.date +' '+ v.actual_time +'</span></div><input type="hidden" id="matchn'+no+'" name="i['+ v._id +']">' );
          });
        }else{
          $('#iproduct').html('<td colspan=6>No unpaired spot</td>');
        }
        if(result.b  && result.b.count>0){
          $.each(result.b, function(k,v) {                            
            var no = k+1;
            $('#nproduct').append( '<div class="spot" id="n'+no+'"><input type="text" data-id="'+v._id+'" class="nproduct" />'+v.nproduct+'<span>'+ v.date +' '+v.start_time+'</span></div>' );
          });
        }else{
          $('#nproduct').html('<td colspan=6>No unpaired spot</td>');
        }
  }});  
  $('body').on('change', 'input.nproduct', function() {
    if($(this).val() > 0){
      $(this).attr('value', $(this).val());
      var ns = $(this).parent().attr("id");
      var nd = "n"+$(this).val();
      if(ns!=nd){
        $("#"+nd+">input").attr('value','');
        $("#match"+ns).attr('value','');
      }
      // var temp = $("#"+ns).html();
      // $("#"+ns).html($("#"+nd).html());
      // $("#"+nd).html(temp);
      $("#matchn"+$(this).val()).val($(this).data('id'));
    }
  });
});
$("#btnfilter").click(function() {
  $("#iproduct").html('');
  $("#nproduct").html('');
  $.ajax({
      url: "{{ url('/admin/spotpairingjson') }}", 
      data: {
        "startdate":$('#startdate').val(),
        "enddate":$('#enddate').val()
      }, 
      success: function(result){
        if(result.a){
          $.each(result.a, function(k,v) {                            
            var no = k+1;
            $('#iproduct').append( '<div class="spot" data-iproduct="'+v.iproduct+'"><input type="text" value="'+no+'" disabled></input>'+ v.iproduct +'<span>'+ v.date +' '+ v.actual_time +'</span></div><input type="hidden" id="matchn'+no+'" name="i['+ v._id +']">' );
          });
        }else{
          $('#iproduct').html('<td colspan=6>No unpaired spot</td>');
        }
        if(result.b){
          $.each(result.b, function(k,v) {                            
            var no = k+1;
            $('#nproduct').append( '<div class="spot" id="n'+no+'"  data-nproduct="'+v.nproduct+'"><input type="text" data-id="'+v._id+'" class="nproduct" />'+v.nproduct+'<span>'+ v.date +' '+v.start_time+'</span></div>' );
          });
        }else{
          $('#nproduct').html('<td colspan=6>No unpaired spot</td>');
        }
      }
  });
});
$("input[name=iproduct-filter]").keyup(function(){
  filter = $(this).val().trim().toUpperCase();
  if(filter==''){
    $("#iproduct").children().show();
  }else{
    $("#iproduct").children().hide();
    $('div[data-iproduct*="'+filter+'"]').show();
  }
});
$("input[name=nproduct-filter]").keyup(function(){
  filter = $(this).val().trim().toUpperCase();
  if(filter==''){
    $("#nproduct").children().show();
  }else{
    $("#nproduct").children().hide();
    $('div[data-nproduct*="'+filter+'"]').show();
  }
});
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
@endsection
