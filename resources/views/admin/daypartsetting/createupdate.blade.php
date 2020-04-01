@extends('admin.layouts.app')

@section('pagetitle')
    <title>Daypart Setting</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      <div class="card">
      @if ($errors->any())
              <p class="alert alert-danger">
              {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
              </p>
      @endif
        <div class="card-header">
          <h4 class="card-title">Daypart Setting</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/daypartsetting/'.$item->id, 'method' => 'patch']) }}
          @else
              {{ Form::open(['url' => 'admin/daypartsetting']) }}
          @endif
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Daypart: </label>
                  <div class="col-md-9">
                  {{ Form::text('daypart', old('daypart',$item->daypart ?? null), array('class' => 'form-control','required','autocomplete'=>'off')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Start Time: </label>
                  <div class="col-md-9">
                  {{ Form::text('start_time', old('start_time',$item->start_time ?? null), array('id'=>'start_time','class' => 'form-control','required','autocomplete'=>'off')) }}
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="count">End Time: </label>
                  <div class="col-md-9">
                  {{ Form::text('end_time', old('end_time',$item->end_time ?? null), array('id'=>'end_time','class' => 'form-control','required','autocomplete'=>'off')) }}
                  </div>
                </div>                
              </div>
              <div class="form-actions">
                <a class="pull-right" href="{{ url('admin/daypartsetting') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
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
<link href="{{ asset('css') }}/jquery.timepicker.min.css" rel="stylesheet" type="text/css">
@endsection
@section('pagejs')
<script src="{{ asset('js') }}/jquery.timepicker.min.js"></script>
<script>
  $(document).ready(function(){
    var options = { 'timeFormat': 'H:i','step':30 };
    $('#start_time').timepicker(options);
    $('#end_time').timepicker(options);
  });
</script>
@endsection
