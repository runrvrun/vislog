@extends('admin.layouts.app')

@section('pagetitle')
    <title>Video Data</title>
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
          <h4 class="card-title">Video Data</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/videodataupdate/'.$item->id, 'method' => 'patch']) }}
          @else
              {{ Form::open(['url' => 'admin/videodatastore']) }}
          @endif
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Date: </label>
                  <div class="col-md-9">
                  {{ Form::text('date', old('date',$item->date ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Channel: </label>
                  <div class="col-md-9">
                  {{ Form::select('channel', 
                    \App\Channel::pluck('channel','channel'), 
                    old('channel',$item->channel ?? null), 
                    array('class' => 'form-control')) }}
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="count">No. of File: </label>
                  <div class="col-md-9">
                  {{ Form::number('count', old('count',$item->count ?? null), array('class' => 'form-control')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="remarks">Remarks: </label>
                  <div class="col-md-9">
                  {{ Form::textarea('remarks', old('remarks',$item->remarks ?? null), array('class' => 'form-control','rows'=>4)) }}
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
@endsection
