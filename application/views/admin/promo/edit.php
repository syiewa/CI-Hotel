<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Promosi</h4>
        </div>
        <div class="modal-body">
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
            echo form_open_multipart('admin/promo/edit', $attributes);
            ?>
            <div class="form-group">
                <label for="inputJab" class="col-lg-2 control-label">Kelas</label>
                <div class="col-lg-7">
                    <?php echo form_dropdown('idclass', $class, $promo->idclass, 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputJab" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-7">
                    <?php
                    $attr = attr(array('form-control', 'input_nama', 'title', 'length', '3-100', 'Title harus berisi 3-100 karakter'));
                    ?>
                    <?php echo form_input($attr, $promo->title); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Waktu Promosi</label>
                <div class="col-lg-3">
                    <?php
                    $data = array(
                        'class' => 'datepicker form-control',
                        'id' => 'from',
                        'name' => 'start_date',
                        'placeholder' => 'Awal',
                        'data-validation' => 'date',
                        'data-validation-format' => 'yyyy-mm-dd',
                        'data-validation-help' => 'Format yyyy-mm-dd',
                        'data-validation-error-msg' => 'Salah memasukan tanggal masuk'
                    );
                    ?>
                    <?php echo form_input($data, date('Y-m-d', strtotime($promo->start_date))); ?>
                </div>
                <div class="col-lg-1">
                    <p class="text-center">-</p>
                </div>
                <div class="col-lg-3">
                    <?php
                    $data = array(
                        'class' => 'datepicker form-control',
                        'id' => 'to',
                        'name' => 'end_date',
                        'placeholder' => 'Akhir',
                        'data-validation' => 'date',
                        'data-validation-format' => 'yyyy-mm-dd',
                        'data-validation-help' => 'Format yyyy-mm-dd',
                        'data-validation-error-msg' => 'Salah memasukan tanggal masuk'
                    );
                    ?>
                    <?php echo form_input($data, date('Y-m-d', strtotime($promo->end_date))); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Diskon</label>
                <div class="col-lg-2">
                    <?php
                    $attr = attr(array('form-control', 'input_nama', 'discount', 'number', '', 'Angka!!'));
                    $attr['data-validation-allowing'] = 'range[0;100]';
                    ?>
                    <?php echo form_input($attr, $promo->discount); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Deskripsi</label>
                <div class="col-lg-8">
                    <?php
                    $attr = attr(array('form-control', 'input_desc', 'description', 'length', '3-1000', 'Harga harus berisi 3-1000 karakter'));
                    ?>
                    <?php echo form_textarea($attr, $promo->description); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputJab" class="col-lg-2 control-label">Status</label>
                <div class="col-lg-7">
                    <?php echo form_dropdown('status', $aktif, $promo->status, 'class="form-control"'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            $data = array(
                "value" => 'Update',
                "class" => 'btn btn-primary',
                "id" => 'x',
                "name" => 'update'
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
<script>
    $(function() {
        $('.datepicker').datepicker({dateFormat: "yy-mm-dd"});
        $('.datepicker2').datepicker({dateFormat: "yy-mm-dd"});
    });</script>