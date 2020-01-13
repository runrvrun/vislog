@extends('admin.layouts.app')

@section('pagetitle')
    <title>User</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      @if ($errors->any())
      <p class="alert alert-danger">
        {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
      </p>
      @endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">User</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/user/'.$item->id.'/update', 'method' => 'patch']) }}
          @else
              {{ Form::open(['url' => 'admin/user/store']) }}
          @endif
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Name: </label>
                  <div class="col-md-9">
                  {{ Form::text('name', old('name',$item->name ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Email: </label>
                  <div class="col-md-9">
                  {{ Form::email('email', old('date',$item->email ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Role: </label>
                  <div class="col-md-9">
                  {{ Form::select('role', 
                    ['Admin'=>'Admin','Agency'=>'Agency','TV Station'=>'TV Station','Advertiser'=>'Advertiser','Trial'=>'Trial'], 
                    old('channel',$item->channel ?? null), 
                    array('class' => 'form-control')) }}
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Password: </label>
                  <div class="col-md-9">
                  {{ Form::password('password', array('class' => 'form-control','placeholder'=>'leave empty to keep password')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Expired At: </label>
                  <div class="col-md-9">
                  {{ Form::text('expired_at', old('expired_at',$item->expired_at ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <a class="pull-right" href="{{ url('admin/videodata') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
                  <i class="ft-x"></i> Cancel
                </button></a>
                <button type="submit" class="pull-left btn btn-raised btn-primary mr-3">
                  <i class="fa fa-check-square-o"></i> Save
                </button>         
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- File export table -->

          </div>
        </div>
@endsection
@section('pagecss')
@endsection
@section('pagejs')
<script>
  // make city dropdown conditional to province
  $("select[name='province_id']").change(function () {
    var opt = $("option:selected", this);
    var val = this.value;
    $("select[name='city_id'] option").hide();
    $("select[name='city_id'] option[value^='"+ val +"']").show();
    $("select[name='city_id'] option[value^='"+ val +"']:first").attr('selected','selected');
  });  
</script>
@endsection
