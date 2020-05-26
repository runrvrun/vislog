@extends('admin.layouts.app')

@section('pagetitle')
    <title>Video Data</title>
@endsection

@section('content')
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Video Data</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">Video Data</h4>                    
                    </div>    
                    <div class="card-content ">
                      <div class="card-body p-0 pl-4">
                      <a href="#" class="videosettings-button btn btn-primary" data-toggle="modal" data-target="#videosettings-modal">
                        <i class="ft-settings"></i> Video Settings
                      </a>
                      <a href="{{ url('admin/videodata/create') }}" class="btn btn-secondary">
                        <i class="ft-plus"></i> Add New
                      </a>
                    </div>
                    </div>
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        <table class="table browse-table">
                          <thead>
                            <tr>
                              <th>Date</th>                  
                              <th>Channel</th>                  
                              <th>No. of Files</th>                  
                              <th>Remarks</th>                  
                              <th></th>                  
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
@endsection
@section('modal')
<div class="modal fade text-left show" id="videosettings-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel7"><span id="videosettings-title">Video Settings</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-content ">
          <div class="card-body">
            <form method="POST" action="{{ url('admin/videodata/updateconfigs') }}" class="form form-horizontal" >
              <div class="form-group row">
                <p class="col-md-3 label-control" for="projectinput5">Video HD: </p>
                <div class="col-md-7">
                  @csrf
                  {{ Form::hidden('key','video path hd') }}
                  <input type="text" id="video_path_hd" value="{{ $config['video_path_hd'] }}" class="form-control" name="value">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-raised btn-primary">
                    <i class="fa fa-check-square-o"></i> Save
                  </button>
                </div>
              </div>  
            </form>
            <form method="POST" action="{{ url('admin/videodata/updateconfigs') }}" class="form form-horizontal" >
              <div class="form-group row">
                <p class="col-md-3 label-control" for="projectinput5">Video SD: </p>
                <div class="col-md-7">
                  @csrf
                  {{ Form::hidden('key','video path') }}
                  <input type="text" id="video_path" value="{{ $config['video_path'] }}" class="form-control" name="value">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-raised btn-primary">
                    <i class="fa fa-check-square-o"></i> Save
                  </button>
                </div>
              </div>  
            </form>            
            <form method="POST" action="{{ url('admin/videodata/updateconfigs') }}" class="form form-horizontal" >
              <div class="form-group row">
                <p class="col-md-3 label-control" for="projectinput5">Bumper (s): </p>
                <div class="col-md-7">
                  @csrf
                  {{ Form::hidden('key','video bumper') }}
                  <input type="text" id="video_path"  value="{{ $config['video_bumper'] }}" class="form-control" name="value">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-raised btn-primary">
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
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
@section('pagejs')
<script src="{{ asset('') }}app-assets/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
var resp = false;
if(window.innerWidth <= 800) resp=true;

var table = $('.browse-table').DataTable({
    responsive: resp,
    processing: true,
    serverSide: true,
    ajax: '{!! url('admin/videodata/indexjson') !!}',
    columns: [
      { data: 'date', name: 'date' },
      { data: 'channel', name: 'channel' },
      { data: 'count', name: 'count' },
      { data: 'remarks', name: 'remarks' },
      { data: 'action', name: 'action' },
    ],
    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    order: []
});
$('.buttons-add').addClass('btn mr-1');

});
</script>
@endsection
