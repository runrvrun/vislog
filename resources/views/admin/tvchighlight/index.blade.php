@extends('admin.layouts.app')

@section('pagetitle')
    <title>TVC Highlight</title>
@endsection

@section('content')
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">TVC Highlight</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">TVC Highlight</h4>                    
                    </div>    
                    <div class="card-content ">
                      <div class="card-body p-0 pl-4">
                      <a href="{{ url('admin/tvchighlight/create') }}" class="btn btn-secondary">
                        <i class="ft-plus"></i> Add New
                      </a>
                    </div>
                    </div>
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        <table class="table browse-table">
                          <thead>
                            <tr>
                              <th>Title</th>                  
                              <th>Description</th>                  
                              <th>Show in Highlight</th>                  
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
    ajax: '{!! url('admin/tvchighlight/indexjson') !!}',
    columns: [
      { data: 'title', name: 'title' },
      { data: 'description', name: 'description' },
      { data: 'show', name: 'show' },
      { data: 'action', name: 'action' },
    ],
    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    columnDefs: [ 
      {
          render: function ( data, type, row ) {
            if(data){
              return 'Show';
            }else{
              return 'No';
            }
          },
          targets: 2
      }
    ],
    order: [[1, 'DESC']]
});
$('.buttons-add').addClass('btn mr-1');

});
</script>
@endsection
