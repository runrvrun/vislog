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
      @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
      @endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">User</h4>
        </div>
        <div class="card-content ">
          <div class="card-body card-dashboard table-responsive">
            <table class="table browse-table">
              <thead>
                <tr>
                  <th class="name">Name</th>
                  <th class="email">Email</th>
                  <th class="company">Company</th>
                  <th class="phone">Phone</th>
                  <th class="role">Role</th>
                  <th class="targetaudience">Target Audience</th>
                  <th class="nsector">nSector</th>
                  <th class="isector">iSector</th>
                  <th class="ncategory">nCategory</th>
                  <th class="icategory">iCategory</th>
                  <th class="nadvertiser">nAdvertiser</th>
                  <th class="iadvertiser">iAdvertiser</th>
                  <th class="iadvertiser_group">Advertiser Group</th>
                  <th class="nproduct">nProduct</th>
                  <th class="iproduct">iProduct</th>
                  <th class="ncopy">nCopy</th>
                  <th class="icopy">iCopy</th>
                  <th class="nadstype">nAdsType</th>
                  <th class="iadstype">iAdsType</th>
                  <th class="tadstype">tAdsType</th>
                  <th class="channel">Channel</th>
                  <th class="nlevel_1">nLevel1</th>
                  <th class="ilevel_1">iLevel 1</th>
                  <th class="nlevel_2">nLevel 2</th>
                  <th class="ilevel_2">iLevel 2</th>
                  <th class="nprogramme">nProgramme</th>
                  <th class="iprogramme">iProgramme</th>
                  <th class="startdate">Data Period Start</th>
                  <th class="enddate">Data Period End</th>
                  <th class="expired_at">Expired At</th>
                  <th class="last_login">Last Login</th>
                  <th style="white-space: nowrap;">Action</th>
                </tr>
              </thead>
            </table>
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

    $.fn.dataTable.ext.errMode = 'none';

    $('.browse-table').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'DataTables error: ', message );
    } ) ;

    var table = $('.browse-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/user/indexjson') !!}',
        columns: [
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'company', name: 'company' },
          { data: 'phone', name: 'phone' },
          { data: 'role', name: 'role' },
          { data: 'privileges.targetaudience', name: 'privileges.targetaudience' },
          { data: 'privileges.nsector', name: 'privileges.nsector' },
          { data: 'privileges.isector', name: 'privileges.isector' },
          { data: 'privileges.ncategory', name: 'privileges.ncategory' },
          { data: 'privileges.icategory', name: 'privileges.icategory' },
          { data: 'privileges.nadvertiser', name: 'privileges.nadvertiser' },
          { data: 'privileges.iadvertiser', name: 'privileges.iadvertiser' },
          { data: 'privileges.iadvertiser_group', name: 'privileges.iadvertiser_group' },
          { data: 'privileges.nproduct', name: 'privileges.nproduct' },
          { data: 'privileges.iproduct', name: 'privileges.iproduct' },
          { data: 'privileges.ncopy', name: 'privileges.ncopy' },
          { data: 'privileges.icopy', name: 'privileges.icopy' },
          { data: 'privileges.nadstype', name: 'privileges.nadstype' },
          { data: 'privileges.iadstype', name: 'privileges.iadstype' },
          { data: 'privileges.tadstype', name: 'privileges.tadstype' },
          { data: 'privileges.channel', name: 'privileges.channel' },
          { data: 'privileges.nlevel_1', name: 'privileges.nlevel_1' },
          { data: 'privileges.ilevel_1', name: 'privileges.ilevel_1' },
          { data: 'privileges.nlevel_2', name: 'privileges.nlevel_2' },
          { data: 'privileges.ilevel_2', name: 'privileges.ilevel_2' },
          { data: 'privileges.nprogramme', name: 'privileges.nprogramme' },
          { data: 'privileges.iprogramme', name: 'privileges.iprogramme' },
          { data: 'privileges.startdate', name: 'privileges.startdate' },
          { data: 'privileges.enddate', name: 'privileges.enddate' },
          { data: 'expired_at', name: 'expired_at' },
          { data: 'last_login', name: 'last_login' },
          { data: 'action', name: 'action' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'B>>"+
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
              text: '<i class="ft-plus"></i> Add New', className: 'buttons-add',
              action: function ( e, dt, node, config ) {
                  window.location = '{{ url('admin/user/create') }}'
              }
            },  
            { extend: 'colvis', text: 'Column' },
            {
              extend: 'csv',
              text: 'CSV',
              className: 'buttons-csvall',
              action: function ( e, dt, node, config ) {
                  window.location = '{{ url('admin/user/csvall') }}'
              }
            }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [{
            targets: ['targetaudience','nsector','isector','ncategory','icategory','nadvertiser','iadvertiser',
            'iadvertiser_group','nproduct','iproduct','ncopy','icopy','nadstype','iadstype','tadstype','channel',
            'nprogramme','iprogramme','nlevel_1','nlevel_2','ilevel_1','ilevel_2','startdate','enddate','phone'],
            visible: false,
        },{
            targets: ['id','created_at','updated_at'],
            visible: false,
            searchable: false,
        } ]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn mr-1');

});
</script>
@endsection
