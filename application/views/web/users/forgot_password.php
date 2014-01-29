<h1><?php echo lang('forgot_password_heading'); ?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>
<?php echo form_open("users/forgot_password", 'class="form-horizontal"'); ?>
<div class="form-group col-md-4">
    <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label); ?></label> <br />
    <?php echo form_input($email); ?>
    <?php echo form_submit('submit', lang('forgot_password_submit_btn'),'class="btn btn-small btn-default"'); ?>
</div>


<?php echo form_close(); ?>