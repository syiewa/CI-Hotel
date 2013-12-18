<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Add Class Room</h4>
        </div>
        <div class="modal-body">
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
            echo form_open_multipart('admin/kelas/add', $attributes);
            ?>
            <div class="form-group">
                <label for="inputJab" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php
                    $attr = attr(array('form-control', 'input_nama', 'title', 'length', '3-100', 'Title harus berisi 3-100 karakter'));
                    ?>
                    <?php echo form_input($attr); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Harga</label>
                <div class="col-lg-3">
                    <?php
                    $attr = attr(array('form-control', 'input_price', 'price', 'length', '3-100', 'Harga harus berisi 3-12 karakter'));
                    ?>
                    <?php echo form_input($attr); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputJabatan" class="col-lg-2 control-label">Fasilitas</label>
                <div class = "col-lg-4">
                    <label class="checkbox">
                        <input type="checkbox" value="lcd" name="lcd">LCD</label>
                    <label class="checkbox">
                        <input type="checkbox" value="wifi" name="wifi" >Wifi</label>
                    <label class="checkbox">
                        <input type="checkbox" value="breakfast" name="breakfast" >Sarapan</label>
                    <label class="checkbox">
                        <input type="checkbox" value="safe" name="safe" >Pelayanan Hotel Plus</label>
                </div>
                <div class = "col-lg-4">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="bath" name="bath" >Kamar Mandi</label>
                    <label class="checkbox">
                        <input type="checkbox" value="dinner" name="dinner" >Makan Malam</label>
                    <label class="checkbox">
                        <input type="checkbox" value="parking" name="parking" >Parkir</label>
                    <label class="checkbox">
                        <input type="checkbox" value="laundry" name="laundry" >Laundry
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Deskripsi</label>
                <div class="col-lg-8">
                    <?php
                    $attr = attr(array('form-control tinymce', 'input_desc', 'description', 'length', '3-1000', 'Harga harus berisi 3-1000 karakter'));
                    ?>
                    <?php echo form_textarea($attr); ?>
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
    <?php echo form_close(); ?>
</div><!-- /.modal-dialog -->
<script>
    $.validate({
        form: '#myForm',
        modules: 'security',
    });
</script>
