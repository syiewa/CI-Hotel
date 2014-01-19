<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
echo form_open("admin/users/deactivate/" . $user->id, $attributes);
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4><?php echo lang('deactivate_heading'); ?></h4>
            <p><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="col-lg-7">
                    <label class="radio-inline">
                        <input type="radio" name="confirm" value="yes" checked="checked" /> YES
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="confirm" value="no" /> NO
                    </label>
                    <?php echo form_hidden($csrf); ?>
                    <?php echo form_hidden(array('id' => $user->id)); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            $data = array(
                "value" => 'Submit',
                "class" => 'btn btn-primary',
                "id" => 'x',
                "name" => 'submit'
            );
            ?>
            <?php echo form_submit($data, lang('deactivate_submit_btn')); ?>
            <?php echo form_reset('reset', 'Reset', 'class="btn btn-primary"'); ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php echo form_close(); ?>
<script>
    $.validate({
        form: '#myForm',
        modules: 'security',
    });
</script>