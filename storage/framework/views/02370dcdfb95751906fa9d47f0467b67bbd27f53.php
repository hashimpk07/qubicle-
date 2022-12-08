
<?php $__env->startSection('content'); ?>


<div class="card-body">
   <h5>  Customer Login Page</h5>
</div>

<div style="color: green;margin-left: 26px;display:none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Your Account Created Successfully</h2>
    </div>
    <label>Referral code </label> <label id="referral" style="color:red"></label>
</div> 

<form action="javascript:void(0)" id="customerLoginForm" name="customerLoginForm"  enctype="multipart/form-data">


    <div class="card-body">
        <div class="form-group">
            <label for="color">  Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="customerName" class="form-control" id="customerName" placeholder="Enter Name ">
            <div class="error" id="customerNameErr"></div>
        </div>

        <div class="form-group">
            <label for="color">  Email Id <span style="color:#ff0000">*</span></label>
                <input type="text" name="customerEmailId" class="form-control" id="customerEmailId" placeholder="Enter Email Id ">
            <div class="error" id="customerEmailIdErr"></div>
        </div>

        <div class="form-group">
            <label for="productSize"> Referral Code  </label>
            <div class="form-group">
                <div class="input-group">
                <select class="form-control" id="referralCode" name="referralCode"> 
                    <option value="0">Select Referral Code</option>
                    <?php $__currentLoopData = $referralCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referralCode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($referralCode->id); ?>"><?php echo e($referralCode->referral_code); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                </div>
            </div>
        </div>

    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="customerLogin-add btn btn-submit btn-primary" id="customerLogin-add">Submit</button>
    </div>
</form>
                                          
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#customerName').on('input', function() {
                $('#customerNameErr').hide();
            });
            $('#customerEmailId').on('input', function() {
                $('#customerEmailIdErr').hide();
            });
        });

        $(document).on('click', '.customerLogin-add', function (e) {
        
            $('#customerName').on('input', function() {
                $('#customerNameErr').hide();
            });
       
            $('#customerEmailId').on('input', function() {
                $('#customerEmailIdErr').hide();
            });

            var flag    = 0;
            var name    =   $("#customerName").val();
            var email   =   $("#customerEmailId").val();
            var referralCode      =   $("#referralCode option:selected").val();

            if(customerName == "") {
                $("#customerNameErr").html("Please Enter Name");
                flag = 1;
            }
            if(customerEmailId == "") {
                $("#customerEmailIdErr").html("Please Enter Email Id");
                flag = 1;
            }
        
        if( 1 == flag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"<?php echo e(route('customer.store')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    name:name,
                    email:email,
                    referralCode:referralCode
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        $("#referral").text( data.message);
                        setTimeout(function () {
                            window.location = '<?php echo e(route('customer')); ?>'
                        }, 10000);
                    }else{
                        $("#customerEmailIdErr").show();
                        $("#customerEmailIdErr").html("Data Not Saved ! Please check Data");

                    }
                    
                },
                error: function(response) {
                    $("#customerEmailIdErr").show();
                    $("#customerEmailIdErr").html("Data Not Saved ! Please check Data");
                }
                 
            });
        }
    });
       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Qubicle\resources\views/customer/login.blade.php ENDPATH**/ ?>