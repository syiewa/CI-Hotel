<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
echo form_open_multipart('', $attributes);
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Slide</h4>
        </div>
        <div class="modal-body">
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
            echo form_open_multipart('', $attributes);
            ?>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control', 'id' => 'inputNama', 'name' => 'slide_title','data-validation' => "required"); ?>
                    <?php echo form_input($data,  set_value('slide_title',$slide->slide_title)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Body</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control tinymce', 'id' => 'inputDesc', 'name' => 'slide_desc'); ?>
                    <?php echo form_textarea($data,set_value('slide_desc',$slide->slide_desc)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Picture</label>
                <div class="col-lg-2">
                    <?php
                    $data = array(
                        'name' => 'slide_image',
                        'data-validation' => "required mime size",
                        'data-validation-allowing' => "jpg, png, gif",
                        'data-validation-max-size' => "2M"
                    );
                    ?>
                    <?php echo form_upload($data); ?>
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
            <?php echo form_submit($data); ?>
            <?php echo form_reset('reset', 'Reset', 'class="btn btn-primary"'); ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php echo form_close(); ?>
<script>
    $.validate({
        form: '#myForm',
        modules: 'file',
    });
</script>
