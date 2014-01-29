<div class="col-md-12">
    <div class="row">
        <div class="col-md-9">
            <h1>Account login</h1>
        </div>
    </div>
    <div>
        <hr>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5 well">
                    <h2>New Customers</h2>
                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                    <a class="btn btn-primary btn-xs pull-right" href="<?php echo base_url() ?>index.php/users/register">Create an account</a>
                </div>	 		
                <div class="col-md-6 well pull-right">
                    <h2>Registered Customers</h2>
                    <p>If you have an account with us, please log in.</p>
                    <?php echo form_open('users/login'); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="identity" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Remember Me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-xs btn-primary pull-right">Submit</button>
                    <?php echo form_close(); ?>
                    <p><small><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></small></p>
                </div>
            </div>
        </div>