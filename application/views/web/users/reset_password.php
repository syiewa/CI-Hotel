<h1><?php echo lang('reset_password_heading'); ?></h1>


<?php echo form_open('users/reset_password/' . $code, ' class="form-horizontal"'); ?>
<?php echo form_input($user_id); ?>
<?php echo form_hidden($csrf); ?>
<div class="form-group">
    <div class="col-md-4">
        <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
        <?php echo form_input($new_password); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-4">
        <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
        <?php echo form_input($new_password_confirm); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-4">
    <?php echo form_submit('submit', lang('reset_password_submit_btn'), 'class="btn btn-default"'); ?>
</div>
</div>
<?php echo form_close(); ?>