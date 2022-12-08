   
    <?php
    if( 0  != $sizes->total() ){?>

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
            $i = ($sizes->perPage() * ($sizes->currentPage() - 1)) + 1; ?>
            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td ><?php echo e($i++); ?></td>
                <td > <?php echo e($size->name); ?> </td>
                <td>
                    <a class="btn"  title="edit" href="<?php echo e(route('size.edit', ['id' => $size->id])); ?>"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="<?php echo e(route('size.show', ['id' => $size->id])); ?>" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan <?php echo e($size->name); ?> ?')"  href="<?php echo e(route('size.delete', ['id' => $size->id])); ?>" ><i class="fas fa-times"></i></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </tbody> 
    </table>

<?php } else{?> 
<img src="<?php echo e(url('/images/norecordfound.png')); ?>" class="no-data-found" style="width: 100%;" />
    <?php } ?>

<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <?php echo $sizes->links('pagination::bootstrap-4'); ?>

    </ul>
</div>
</div><?php /**PATH E:\Project\TimesworldTechnology\resources\views/size/size_data.blade.php ENDPATH**/ ?>