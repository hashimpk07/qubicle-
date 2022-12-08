
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('size')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Details Size Page</h5>
</div>
<form action="javascript:void(0)" id="sizeForm" name="sizeForm"  method="post">
    
    <div class="card-body">
        <div class="form-group">
            <label for="color"> Size <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="<?php echo e($size->name); ?>" readonly>
            <div class="error" id="sizeErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\TimesworldTechnology\resources\views/size/size-show.blade.php ENDPATH**/ ?>