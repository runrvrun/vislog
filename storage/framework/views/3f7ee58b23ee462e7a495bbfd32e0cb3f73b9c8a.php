<?php $__env->startSection('pagetitle'); ?>
    <title>Notification</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      <div class="card">
      <?php if($errors->any()): ?>
              <p class="alert alert-danger">
              <?php echo ucfirst(implode('<br/>', $errors->all(':message'))); ?>

              </p>
      <?php endif; ?>
        <div class="card-header">
          <h4 class="card-title"><?php echo e(empty($item)? 'Add':'Edit'); ?> Notification</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          <?php if(isset($item)): ?>
              <?php echo e(Form::model($item, ['url' => 'admin/notification/'.$item->id, 'method' => 'patch', 'files' => true])); ?>

          <?php else: ?>
              <?php echo e(Form::open(['url' => 'admin/notification', 'files' => true])); ?>

          <?php endif; ?>
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Title: </label>
                  <div class="col-md-9">
                  <?php echo e(Form::text('title', old('title',$item['data']['title'] ?? null), array('class' => 'form-control','required','autocomplete'=>'off'))); ?>

                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Notification: </label>
                  <div class="col-md-9">
                  <?php echo e(Form::textarea('message', old('title',$item['data']['message'] ?? null), array('class' => 'form-control','required','rows'=>5))); ?>

                  </div>
                </div>                                    
              </div>
              <div class="form-actions">
                <a class="pull-right" href="<?php echo e(url('admin/notification')); ?>"><button type="button" class="btn btn-raised btn-warning mr-1">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagecss'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vislog\resources\views/admin/notification/createupdate.blade.php ENDPATH**/ ?>