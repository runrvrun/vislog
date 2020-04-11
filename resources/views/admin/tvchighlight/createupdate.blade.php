@extends('admin.layouts.app')

@section('pagetitle')
    <title>TVC Highlight</title>
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
          <h4 class="card-title">TVC Highlight</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/tvchighlight/'.$item->id, 'method' => 'patch', 'files' => true]) }}
          @else
              {{ Form::open(['url' => 'admin/tvchighlight', 'files' => true]) }}
          @endif
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Title: </label>
                  <div class="col-md-9">
                  {{ Form::text('title', old('title',$item->title ?? null), array('class' => 'form-control','required','autocomplete'=>'off')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Description: </label>
                  <div class="col-md-9">
                  {{ Form::textarea('description', old('description',$item->description ?? null), array('id'=>'description','class' => 'form-control','autocomplete'=>'off','rows'=>5)) }}
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Show in Highlight: </label>
                  <div class="col-md-9">
                  {{ Form::checkbox('show', 1, old('show',$item->show ?? null), array('style' => 'width: 25px;height: 25px;')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="count">Video File: </label>
                  <div class="col-md-9">
                  @if(isset($item->filename))                    
                    {{ Form::file('filename') }}
                    <video width="500px" src="{{ url('/uploads/tvchighlight/'.$item->filename) }}" controls id="playvideo" style="margin-top:20px"></video>
                  @else
                    {{ Form::file('filename', array('required')) }}
                  @endif
                  </div>
                </div>                
              </div>
              <div class="form-actions">
                <a class="pull-right" href="{{ url('admin/tvchighlight') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
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
