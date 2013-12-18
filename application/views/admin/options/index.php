<div class="page-header">
    <h1>Edit Options Web</h1>
</div>

<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myForm', 'role' => 'form');
echo form_open_multipart('', $attributes);
?>
<?php foreach ($option as $o) : ?>
    <?php if ($o->options_name == 'company_address') : ?>
        <div class="form-group">
            <label for="inputJab" class="col-lg-2 control-label">Alamat</label>
            <div class="col-lg-7">
                <?php
                $attr = attr(array('form-control tiny-mce', 'input_alamat', 'config[]', 'length', '3-100', 'Title harus berisi 3-100 karakter'));
                ?>
                <?php echo form_textarea($attr, $o->value); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="form-group">
            <label for="inputJab" class="col-lg-2 control-label"><?php echo strtoupper(str_replace("_", " ", $o->options_name)); ?></label>
            <div class="col-lg-7">
                <?php
                $attr = attr(array('form-control', 'input_nama', 'config[]', 'length', '3-100', 'Title harus berisi 3-100 karakter'));
                ?>
                <?php echo form_input($attr, $o->value); ?>
            </div>
        </div>

    <?php
    endif;
endforeach
?>
<div class="form-group">
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
</div>
<?php echo form_close(); ?>