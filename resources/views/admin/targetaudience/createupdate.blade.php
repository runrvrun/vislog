@extends('admin.layouts.app')

@section('pagetitle')
    <title>Target Audience</title>
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
          <h4 class="card-title">Target Audience</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
            {{ Form::model($item, ['url' => ['admin/targetaudience/update'], 'method' => 'patch']) }}
              {{ Form::hidden('id', $item->id) }}
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="code">@lang('Code'): </label>
                  <div class="col-md-9">
                  {{ $item->code ?? null }}
                  </div>
                </div><div class="form-group row">
                  <label class="col-md-3 label-control" for="targetaudience">@lang('Target Audience'): </label>
                  <div class="col-md-9">
                  {{ Form::text('targetaudience', old('targetaudience',$item->targetaudience ?? null), array('class' => 'form-control')) }}
                  </div>
                </div>
                <div class="form-actions">
                  <a class="pull-right" href="admin/targetaudience"><button type="button" class="btn btn-raised btn-warning mr-1">
                    <i class="ft-x"></i> Cancel
                  </button></a>
                  <button type="submit" class="pull-left btn btn-raised btn-primary mr-3">
                    <i class="fa fa-check-square-o"></i> Save
                  </button>     
                </div>
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
