
<?php $__env->startSection('content'); ?>

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('color.add')); ?>'" ><i class="fa fa-plus"></i> Add Colors </button>
</div>
<div class="card-body">
    <h5> Colors Table</h5>
    <?php
    if( 0  != $colors->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 250px">Name</th>
                <th style="width: 30px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($colors->perPage() * ($colors->currentPage() - 1)) + 1; ?>
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td ><?php echo e($i++); ?></td>
                <td > <?php echo e($color->name); ?> </td>
                <td>
                    <a class="btn"  title="edit" href="<?php echo e(route('color.edit', ['id' => $color->id])); ?>"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="<?php echo e(route('color.show', ['id' => $color->id])); ?>" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan <?php echo e($color->name); ?> ?')"  href="<?php echo e(route('color.delete', ['id' => $color->id])); ?>" ><i class="fas fa-times"></i></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="<?php echo e(url('/images/norecordfound.png')); ?>" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <?php echo $colors->links('pagination::bootstrap-4'); ?>

    </ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\TimesworldTechnology\resources\views/color/colors-list.blade.php ENDPATH**/ ?>