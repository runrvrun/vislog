<?php $__env->startSection('pagetitle'); ?>
    <title>Notification</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <div class="main-content">
          <div class="content-wrapper">
            <section id="page">
              <div class="row">
                <div class="col-sm-12">
                  <div class="content-header">Notification</div>                
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <?php if(Session::has('message')): ?>
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(ucfirst(Session::get('message'))); ?></p>
                    <?php endif; ?>
                    <div class="card-header">
                      <h4 class="card-title">Notification</h4>                    
                    </div>    
                    <div class="card-content ">
                      <div class="card-body p-0 pl-4">
                      <a href="<?php echo e(url('admin/notification/create')); ?>" class="btn btn-secondary">
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
                              <th>Message</th>                  
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('')); ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('')); ?>app-assets/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
var resp = false;
if(window.innerWidth <= 800) resp=true;

var table = $('.browse-table').DataTable({
    responsive: resp,
    processing: true,
    serverSide: true,
    ajax: '<?php echo url('admin/notification/indexjson'); ?>',
    columns: [
      { data: 'data.title', name: 'data.title' },
      { data: 'data.message', name: 'data.message' },
      { data: 'action', name: 'action' },
    ],
    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    columnDefs: [ ],
    order: [[1, 'DESC']]
});
$('.buttons-add').addClass('btn mr-1');

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vislog\resources\views/admin/notification/index.blade.php ENDPATH**/ ?>