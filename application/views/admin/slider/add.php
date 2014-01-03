<div class="col-md-9">
    <div class="row">

        <!-- breadcrum -->
        <div class="col-md-12">
            <?php echo $this->breadcrumb->output(); ?>
        </div>
        <!-- end breadcrumd -->

        <div class="col-md-12">
            <?php echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
            <?php
            if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('message') . '</div>';
            }
            if ($this->session->flashdata('error')) {
                echo '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('message') . '</div>';
            }
            ?>
        </div>

        <!-- input form -->
        <div class="col-md-12">
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'role' => 'form');
            echo form_open_multipart('', $attributes);
            ?>
            <?php if (isset($slide->slide_id)) : ?>
                <?php echo form_hidden('id', set_value('id', $slide->slide_id)); ?>
            <?php endif; ?>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control', 'id' => 'inputNama', 'name' => 'slide_title'); ?>
                    <?php echo form_input($data, set_value('title', $slide->slide_title)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Body</label>
                <div class="col-lg-7">
                    <?php $data = array('class' => 'form-control tinymce', 'id' => 'inputDesc', 'name' => 'slide_desc'); ?>
                    <?php echo form_textarea($data, set_value('body', $slide->slide_desc)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Status</label>
                <div class="col-lg-7">
                    <?php echo form_dropdown('status', $status, $slide->slide_status, 'class=form-control'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName1" class="col-lg-2 control-label">Picture</label>
                <div class="col-lg-2">
                    <?php echo form_upload('image'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <?php echo form_submit('submit', $button, 'class="btn btn-primary"'); ?>
                    <?php echo form_reset('reset', 'Reset', 'class="btn btn-primary"'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>