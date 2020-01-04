@extends('admin.layouts.app')

@section('pagetitle')
    <title>Upload Search Data - TV Programme</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Upload Search Data</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
                    @endif
                    <div class="card-header">
                      <h4 class="card-title">TV Programme</h4>                    
                    </div>
                    <div class="card-content ">
                      <div class="card-body card-dashboard table-responsive">
                        <table class="table browse-table">
                          <thead>
                            <tr>
                              <th></th>                  
                              <th>nLevel1</th>
                              <th>nLevel2</th>
                              <th>nProgramme</th>
                              <th>iLevel1</th>
                              <th>iLevel2</th>
                              <th>iProgramme</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!--Calendar Ends-->
          </div>
        </div>
@endsection
@section('modal')
        <div class="modal fade" id="uploadmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ url('admin/uploadsearch/tvprogramme/upload') }}" class="dropzone" id="upload-dropzone">
                  @csrf
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/dropzone.min.css">
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>    
<script src="{{ asset('app-assets') }}/vendors/js/dropzone.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/js/dropzone.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.browse-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        ajax:{
          url: '{!! url('admin/uploadsearch/tvprogramme/indexjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST'
        },
        columns: [
          { data: 'id', name: 'checkbox' },  
          { data: 'nlevel1', name: 'nlevel1' },
          { data: 'nlevel2', name: 'nlevel2' },
          { data: 'nprogramme', name: 'nprogramme' },
          { data: 'ilevel1', name: 'ilevel1' },
          { data: 'ilevel2', name: 'ilevel2' },
          { data: 'iprogramme', name: 'iprogramme' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'B>>"+
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [            
            {
              extend: 'csv',
              text: '<i class="ft-upload-cloud"></i>',
              className: 'buttons-upload',
              action: function (e, node, config){
                $('#uploadmodal').modal('show')
                }
            },
            {
              extend: 'csv',
              text: '<i class="ft-download"></i>',
              className: 'buttons-csvall',
              action: function ( e, dt, node, config ) {
                  window.location = '{{ url('admin/uploadsearch/tvprogramme/csvall') }}'
              }
            },
            {
              text: '<i class="ft-trash"></i>', className: 'buttons-deletemulti',
              action: function ( e, dt, node, config ) {

              }
            },  
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [ {
            targets: 0,
            data: null,
            defaultContent: '',
            orderable: false,
            searchable: false,
            checkboxes: {
                'selectRow': true
            }
        }],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn mr-1');
    $('.buttons-deletemulti').addClass('btn-danger mr-1');

    $('.buttons-deletemulti').click(function(){
      var deleteids_arr = [];
      var rows_selected = table.column(0).checkboxes.selected();
      $.each(rows_selected, function(index, rowId){
         deleteids_arr.push(rowId);
      });
      var deleteids_str = encodeURIComponent(deleteids_arr);

      // Check any checkbox checked or not
      if(deleteids_arr.length > 0){
        var confirmdelete = confirm("Hapus seluruh data terpilih?");
        if (confirmdelete == true) {
          window.location = '{{ url('admin/uploadsearch/destroymulti?id=') }}'+deleteids_str
        } 
      }
    });
});
</script>
<script>
  // reload page after upload finishes
  Dropzone.options.uploadDropzone = {
    init: function () {
        this.on("success", function(file) { 
          alert("Upload and insert finished."); 
          location.reload();
        });
      }
  };
</script>
@endsection