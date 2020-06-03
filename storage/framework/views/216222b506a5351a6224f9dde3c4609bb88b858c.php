<form method="POST" action="<?php echo e(url('admin/notification/'.$dt->id )); ?>">
<a href="<?php echo e(url('admin/notification/'.$dt->id.'/edit')); ?>" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <a class="danger p-0" onclick="if(confirm('Hapus data ini?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form><?php /**PATH C:\xampp\htdocs\vislog\resources\views/admin/notification/action.blade.php ENDPATH**/ ?>