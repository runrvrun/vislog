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
                  {{ Form::text('expired_at', old('expired_at',$item->expired_at ?? null), array('class' => 'form-control datepicker-here','autocomplete'=>'off', 'data-language'=>'id')) }}
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
<link href="{{ asset('css') }}/datepicker.min.css" rel="stylesheet" type="text/css">
@endsection
@section('pagejs')
<script src="{{ asset('js') }}/datepicker.min.js"></script>
<script src="{{ asset('js') }}/i18n/datepicker.id.js"></script>
@endsection
