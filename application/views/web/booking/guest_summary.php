<style>
    #myTextBox
    {
        display: none;
    }
    #myTextBox2
    {
        display: none;
    }
</style>

<script>
    function ShowTextBox(checkbox)
    {
        var pass = document.getElementById('pass');
        if (checkbox.checked) {
            pass.setAttribute('data-validation-optional', 'false');
            document.getElementById('myTextBox').style.display = 'inline';
            document.getElementById('myTextBox2').style.display = 'inline';
        } else {
            pass.setAttribute('data-validation-optional', 'true');
            document.getElementById('myTextBox').style.display = 'none';
            document.getElementById('myTextBox2').style.display = 'none';
        }
    }
</script>
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
<div class="col-md-12">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li><a href="<?php echo site_url('booking'); ?>">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Pilih Kamar</p>
                    </a></li>
                <li class="active"><a href="#">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Informasi Tamu</p>
                    </a></li>
                <li class="disabled"><a href="#">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Pembayaran</p>
                    </a></li>
            </ul>
        </div>
    </div>
</div>
<?php
$from = date('D j, F Y ', strtotime($this->session->userdata('from')));
$to = date('D j, F Y ', strtotime($this->session->userdata('to')));
?>
<div class="page-header">
    <h3>Guest Information</h3>
    <small>FILL OUT THE FORM TO COMPLETE YOUR RESERVATION.</small>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-9">
            <?php echo form_open('booking/payment', 'class =form-horizontal'); ?>
            <?php echo form_hidden('idclass', $rooms[0]->idclass); ?>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Email address</label>
                    <?php
                    echo form_input($email);
                    ?>
                </div>
                <?php if (!$this->ion_auth->logged_in()): ?>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Email address Confirmation</label>
                        <input type="email" name="email" data-validation="confirmation" class="form-control" id="inputEmailConfirm" placeholder="Email Confirmation">
                    </div>
                <?php endif; ?>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Telephone</label>
                    <?php
                    echo form_input($phone);
                    ?>
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
                <?php if (!$this->ion_auth->logged_in()): ?>
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="myCheckBox" onclick="ShowTextBox(this)" value="1" name="signup" >
                                Sign Up as Member ?
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group" id="myTextBox">
                            <label for="exampleInputPassword2">Password</label>
                            <input name="pass_confirmation" type="password" data-validation="length" data-validation-optional="true" data-validation-length="min8" class="form-control" id="pass" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group" id="myTextBox2">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" name="pass" data-validation="confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input name="submit" type="submit" class="btn btn-default pull-right" value="Booking">
                </div>
            </div>
            </form>
            <?php if (!$this->ion_auth->logged_in()): ?>
                <div class="col-md-12">
                    <legend>Already have an Account ?</legend>
                </div>
                <?php echo form_open('users/login'); ?>
                <?php echo form_hidden('uri', uri_string()); ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword2" class="sr-only">Email</label>
                        <input type="email" class="form-control" data-validation="required" id="exampleInputEmail1" placeholder="Enter email" name="identity" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword2" class="sr-only">Confirm Password</label>
                        <input type="password" name="password" data-validation="required" class="form-control" id="exampleInputPassword2" placeholder="Password">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="checkbox">
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="form-group"'); ?> 
                        <label>Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-xs btn-primary pull-right">Login</button>
                </div>
                <?php echo form_close(); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <h3>
                <legend>Your Summary</legend></h3>
            <p>
                Your choosen dates are:
            </p><div class="pull-left">Arrival : <i><?php echo $from; ?></i></div><br>
            <div class="pull-left">Departure : <i><?php echo $to; ?></i></div><br>

            <br>
            Your choosen room is:
            <div class="pull-left"><i><?php echo $rooms[0]->title; ?></i></div><br>
            <br><br>
            <p></p>
        </div>
    </div>
</div>
<script>
    $.validate({
        modules: 'security'
    });
</script>