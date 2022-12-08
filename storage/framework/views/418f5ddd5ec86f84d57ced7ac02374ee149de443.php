
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('product')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  New Product Add Page</h5>
</div>

<form action="javascript:void(0)" id="productForm" name="productForm"  method="post">
   
    <div class="card-body">
        <div class="form-group">
            <label for="color"> Product Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="productName" class="form-control" id="productName" placeholder="Enter Color ">
            <div class="error" id="productNameErr"></div>
        </div>

        <div class="form-group">
            <label for="member_input_image"> Product Image </label>
            <div class="form-group" id="product_image_div" style="display:none;">
                <div class="input-group">
                    <img id="product_image" name="product_image" src="" alt="your image" />
                </div>
            </div>
            <input type='file' id="product_input_image" onchange="readURL(this);"  name="product_input_image" class="form-control" />
            <div class="error" id="product_imageErr"></div>
        </div>

        <div class="form-group">
            <label for="mobileNumber"> Product Description  </label>
            <div class="form-group">
                <div class="input-group">
                    <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50"></textarea>
                </div>
        </div>

        <div class="form-group">
            <label for="productSize"> Product Sizes  </label>
            <div class="form-group">
                <div class="input-group">
                <select class="selectpicker" multiple data-live-search="true" name="productSize" id="productSize">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="productColors"> Product Colors  </label>
            <div class="form-group">
                <div class="input-group">
                <select class="selectpicker" multiple data-live-search="true" name="productColors" id="productColors">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>
                </div>
            </div>
        </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="productForm-add btn btn-submit btn-primary" id="productForm-add">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Products Added Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#productName').on('input', function() {
                $('#productNameErr').hide();
            });
        });

        $(document).on('click', '.productForm-add', function (e) {
        
        $('#productName').on('input', function() {
            $('#productNameErr').hide();
        });
       
        var productFlag  = 0;
        var productName          = $("#productName").val();
    
        if(productFlag == "") {
            $("#productNameErr").html("Please Enter Product");
            productFlag = 1;
        }
        
        if( 1 == productFlag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"<?php echo e(route('product.create')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    color:color,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '<?php echo e(route('product')); ?>'
                        }, 2500);
                    }else{
                        $("#colorErr").html("Data Not Saved ! Please check Data");
                    }
                    
                },
                error: function(response) {
                    
                }
                 
            });
        }
    });
       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\TimesworldTechnology\resources\views/product/product_add.blade.php ENDPATH**/ ?>