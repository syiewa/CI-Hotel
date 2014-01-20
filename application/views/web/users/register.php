<div class="row">
    <?php echo $this->breadcrumb->output(); ?>
</div>
<!-- End Breadcrumb -->

<div class="row">
    <div class="col-md-9">
        <h1>Register</h1>
    </div>
</div>
<hr>
<div class="row">	 		
    <div class="col-md-12">
        <p>If you have an account with us, please log in.</p>
        <?php echo form_open('users/register'); ?>
        <div class="col-md-6">
            <legend>Your Personal Details</legend>
            <form role="form">
                <div class="form-group">
                    <label for="exampleInputName">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputFullName" placeholder="Enter Full Name" name="user_fullname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="user_pass">
                </div>
                <div class="form-group">
                    <label for="exampleInputPasswordConfirm">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPasswordConfirm" placeholder="Confirm Password" name="ConfirmPass">
                </div>
        </div>
        <div class="col-md-6">
            <legend>Your Address</legend>
            <div class="form-group">
                <label for="exampleInputAddress">Address</label>
                <textarea name="user_address" placeholder="Enter Address" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Phone</label>
                <input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter Phone" name="user_phone">
            </div>
            <div class="form-group">
                <label for="exampleInputZip">ZIP</label>
                <input type="text" class="form-control" id="exampleInputPasswordConfirm" placeholder="Enter Zip" name="user_zip">
            </div>
            <button type="submit" class="btn btn-primary pull-right">Register</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>