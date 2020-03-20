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
                    <form method="POST" action="{{ url('admin/spotpairingupdate') }}" onSubmit="return confirm('Update Spot Pairing?')">
                    @csrf
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        <div class="row">
                          <div class="col-md-3 offset-md-9"><button type="submit" class="btn btn-success btn-block"><i class="ft-save"></i> Save Matching</button></div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">iProduct</div>
                          <div class="col-md-6">nProduct</div>
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
</style>
@endsection
@section('pagejs')
<script>
$(document).ready(function() {
  $.ajax({
      url: "{{ url('/admin/spotpairingjson') }}", 
      success: function(result){
        if(result.a){
          $.each(result.a, function(k,v) {                            
            var no = k+1;
            $('#iproduct').append( '<div class="spot"><input type="text" value="'+no+'" disabled></input>'+ v.iproduct +'<span>'+ v.date +' '+ v.actual_time +'</span></div><input type="hidden" id="matchn'+no+'" name="i['+ v._id +']">' );
          });
        }else{
          $('#iproduct').html('<td colspan=6>No unpaired spot</td>');
        }
        if(result.b){
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
</script>
@endsection
