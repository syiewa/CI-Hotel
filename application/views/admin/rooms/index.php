<script type="text/javascript">
    function changeFunc() {
        var selectBox = document.getElementById("selectBox");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        window.location = '?id=' + selectedValue;
    }
</script>
<div class="page-header">
    <h1>Data Kamar Hotel</h1>
</div>
<div class="col-md-12">
    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
    echo form_open_multipart('admin/rooms?id=', $attributes);
    ?>
    <div class="form-group">
        <label for="inputJab" class="col-lg-2 control-label">Pilih Kelas</label>
        <div class="col-lg-7">
            <select name="idclass" class="form-control"  id ="selectBox" onChange="changeFunc()">
                <?php
                echo '<option value="' . $kelasget->idclass . '">' . $kelasget->title . '</option>';
                ?>
                <option value="">- please select -</option>
                <?php foreach ($kelas as $r) : ?>
                    <option value="<?php echo $r->idclass; ?>"><?php echo $r->title; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
    </div>
    <?php if (isset($_GET['id'])): ?>
        <div class="form-group">
            <label for="inputJab" class="col-lg-2 control-label">Jumlah Room</label>
            <div class="col-lg-3">
                <?php
                $attr = attr(array('form-control', 'input_jumlah', 'jumlah', 'number', '1-100', 'jumlah harus berisi angka'));
                ?>
                <?php echo form_input($attr, set_value('jumlah', $jumlah)); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Prefix Nama Room</label>
            <div class="col-lg-3">
                <?php
                $attr = attr(array('form-control', 'input_title', 'namespace', 'length', '3-100', 'Nama Kamar harus berisi 3-100 karakter'));
                if (!empty($room)) {
                    echo form_input($attr, set_value('namespace', $room->namespace));
                } else {
                    echo form_input($attr, set_value('namespace'));
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
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
            </div>
        </div>
        <div class="page-header">
            <h1>Data Promo Hotel</h1>
        </div>
        <table class="table table-hover table-responsive">
            <thead>
                <tr class="success">
                    <th>Nama Kamar</th>
                    <th>Kelas</th>    
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rooms): ?>
                    <?php foreach ($rooms as $r): ?>
                        <tr>
                            <td><?php echo $r->numbers; ?></td>
                            <td><?php echo $kelasget->title; ?></td>
                            <td><?php echo _tobooking('admin/rooms/aktif/',$r->idclass,$r->idrooms,$r->status); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td>Belum ada data !</td></tr> 
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <?php echo form_close(); ?>
    <script>
    $.validate({
        form: '#myForm',
        modules: 'security',
    });
    </script>
</div>