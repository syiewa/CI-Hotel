<div class="col-md-5 col-md-offset-2">
    <?php echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
    <?php
    if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('success') . '</div>';
    }
    if ($this->session->flashdata('error')) {
        echo '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '</div>';
    }
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('message') . '</div>';
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please sign in</h3>
        </div>
        <div class="panel-body">
            <?php echo form_open("auth/login"); ?>
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="E-Mail" name="identity" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                </div>
                <div class="checkbox">
                    <label>
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Remember Me
                    </label>
                </div>
                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
            </fieldset>
            <?php echo form_close(); ?>
            <p><small><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></small></p>
        </div>
    </div>
</div>