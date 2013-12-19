<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
echo form_open_multipart('', $attributes);
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Class Room</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="inputJab" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php
                    $attr = attr(array('form-control', 'input_nama', 'title', 'length', '3-100', 'Title harus berisi 3-100 karakter'));
                    ?>
                    <?php echo form_input($attr, set_value('title', $kelas->title)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Harga</label>
                <div class="col-lg-3">
                    <?php
                    $attr = attr(array('form-control', 'input_price', 'price', 'length', '3-100', 'Harga harus berisi 3-12 karakter'));
                    ?>
                    <?php echo form_input($attr, set_value('price', $kelas->price)); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputJabatan" class="col-lg-2 control-label">Fasilitas</label>
                <div class = "col-lg-4">
                    <label class="checkbox">
                        <input type="checkbox" value="lcd" name="lcd" <?php echo getselectedfas($kelas->idclass, 'lcd'); ?>>LCD</label>
                    <label class="checkbox">
                        <input type="checkbox" value="wifi" name="wifi" <?php echo getselectedfas($kelas->idclass, 'wifi'); ?>>Wifi</label>
                    <label class="checkbox">
                        <input type="checkbox" value="breakfast" name="breakfast" <?php echo getselectedfas($kelas->idclass, 'breakfast'); ?>>Sarapan</label>
                    <label class="checkbox">
                        <input type="checkbox" value="safe" name="safe" <?php echo getselectedfas($kelas->idclass, 'safe'); ?>>Pelayanan Hotel Plus</label>
                </div>
                <div class = "col-lg-4">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="bath" name="bath" <?php echo getselectedfas($kelas->idclass, 'bath'); ?>>Kamar Mandi</label>
                    <label class="checkbox">
                        <input type="checkbox" value="dinner" name="dinner" <?php echo getselectedfas($kelas->idclass, 'dinner'); ?>>Makan Malam</label>
                    <label class="checkbox">
                        <input type="checkbox" value="parking" name="parking" <?php echo getselectedfas($kelas->idclass, 'parking'); ?>>Parkir</label>
                    <label class="checkbox">
                        <input type="checkbox" value="laundry" name="laundry" <?php echo getselectedfas($kelas->idclass, 'laundry'); ?>>Laundry
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Deskripsi</label>
                <div class="col-lg-8">
                    <?php
                    $attr = attr(array('form-control', 'input_desc', 'description', 'length', '3-1000', 'Harga harus berisi 3-1000 karakter'));
                    ?>
                    <?php echo form_textarea($attr, set_value('description', $kelas->description)); ?>
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
