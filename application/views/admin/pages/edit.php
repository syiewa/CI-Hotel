<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
echo form_open_multipart('', $attributes);
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Halaman</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Template</label>
                <div class="col-lg-7">
                    <?php echo form_dropdown('template', array('page' => 'Page', 'news' => 'News', 'homepage' => 'Homepage', 'service' => 'Service','news' => 'News','galery' => 'Galery'), $this->input->post('template') ? $this->input->post('template') : $page->template,'class=form-control'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control', 'id' => 'inputNama', 'name' => 'title'); ?>
                    <?php echo form_input($data, $page->title); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">URL</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control', 'id' => 'inputNama', 'name' => 'slug'); ?>
                    <?php echo form_input($data, $page->slug); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Body</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control tinymce', 'id' => 'inputDesc', 'name' => 'body'); ?>
                    <?php echo form_textarea($data, $page->body); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Parent</label>
                <div class="col-lg-7">
                    <?php echo form_dropdown('parent', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent, 'class=form-control'); ?>
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
        modules: 'security',
    });
</script>
<script>
    $('#telo').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
</script>