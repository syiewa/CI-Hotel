<?php
$captcha['telo'] = array(mt_rand(0, 9), mt_rand(1, 9));
$this->session->set_userdata($captcha);
$telo = $this->session->userdata('telo');
?>
<script type="text/javascript">
    $(function() {
        activate_match();
    });
    function activate_match()
    {
        var tnmt_id = $('select#tournament_list').val(); //Get the id of the tournament selected in the list
        var cct = $("input[name=csrf_test_name]").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/booking/list_dropdown', //We are going to make the request to the method "list_dropdown" in the match controller
            data: {'tnmnt': tnmt_id, 'csrf_test_name': cct}, //POST parameter to be sent with the tournament id
            success: function(resp) { //When the request is successfully completed, this function will be executed
                //Activate and fill in the matches list
                $('select#match_list').attr('disabled', false).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
            }
        });
    }
</script>
<div class="page-header">
    <h3>Registration</h3>
    <small>FILL OUT THE FORM TO COMPLETE YOUR REGISTRATION.</small>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <?php echo form_open('', 'class =form-horizontal'); ?>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Name</legend>
                </div>
                <div class="col-sm-2">
                    <?php
                    $prefix = array('Mr.', 'Mrs.', 'Miss.');
                    echo form_dropdown($prefix_name['name'], $prefix, $prefix_name['value'], 'class=' . $prefix_name['class']);
                    ?>
                </div>
                <div class="col-sm-5">
                    <?php
                    echo form_input($first_name);
                    ?>
                </div>
                <div class="col-sm-5">
                    <?php
                    echo form_input($last_name);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Contact Details</legend>
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Email address</label>
                    <?php
                    echo form_input($email);
                    ?>
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Telephone</label>
                    <?php
                    echo form_input($phone);
                    ?>
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputPassword2">Password</label>
                    <input name="pass_confirmation" type="password" data-validation="required length"  data-validation-length="min8" class="form-control" id="pass" placeholder="Password">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input type="password" name="pass" data-validation="confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Address Details</legend>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Address</label>
                    <?php
                    $attr = array(
                        'name' => 'alamat',
                        'data-validation' => 'required',
                        'rows' => 5,
                        'class' => 'form-control',
                    );
                    echo form_textarea($attr, set_value('address', empty($address->alamat) ? '' : $address->alamat));
                    ?>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">City</label>
                    <select name="kota" id="match_list" class="form-control">
                    </select>
                    <label for="exampleInputEmail1">Zip/Postal</label>
                    <?php
                    $attr = array(
                        'name' => 'zip',
                        'data-validation' => 'number',
                        'rows' => 5,
                        'class' => 'form-control',
                    );
                    echo form_input($attr, set_value('zip', empty($address->zip) ? '' : $address->zip));
                    ?>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">State/Province</label>
                    <?php
                    $js = 'id="tournament_list" class="form-control" onChange="activate_match();"';
                    echo form_dropdown('provinsi', $provinsi, empty($address->provinsi) ? '' : $address->provinsi, $js);
                    ?>
                    <label for="exampleInputEmail1">Country</label>
                    <select class="form-control" name="negara">
                        <option value="Indonesia">Indonesia</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label>What is the sum of <?php echo $telo[0]; ?> + <?php echo $telo[1]; ?>?
                        (security question)</label>
                    <input name="captcha" data-validation="spamcheck"
                           data-validation-captcha="<?php echo ( $telo[0] + $telo[1] ); ?>" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input name="submit" type="submit" class="btn btn-default pull-right" value="Register">
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $.validate({
        modules: 'security',
    });
</script>
