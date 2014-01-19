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
        if (checkbox.checked) {
            document.getElementById('myTextBox').style.display = 'inline';
            document.getElementById('myTextBox2').style.display = 'inline';
        } else {
            document.getElementById('myTextBox').style.display = 'none';
            document.getElementById('myTextBox2').style.display = 'none';
        }
    }
</script>

<div class="page-header">
    <h3>Guest Information</h3>
    <small>FILL OUT THE FORM TO COMPLETE YOUR RESERVATION.</small>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-9">
            <?php echo form_open('booking/payment', 'class =form-horizontal'); ?>
            <?php echo form_hidden('idclass', $rooms[0]->idclass); ?>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Name</legend>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="prefix_nama">
                        <option>Mr.</option>
                        <option>Mrs.</option>
                        <option>Miss.</option>
                    </select>
                </div>
                <div class="col-sm-5">
                    <input name="nama_depan" data-validation="required" type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                </div>
                <div class="col-sm-5">
                    <input name="nama_belakang" data-validation="required" type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Contact Details</legend>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email_confirmation" data-validation="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Email address Confirmation</label>
                    <input type="email" name="email" data-validation="confirmation" class="form-control" id="inputEmailConfirm" placeholder="Email Confirmation">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" name="telepon" data-validation="number" class="form-control" id="inputTelp" placeholder="Telephone">
                </div>
                <div class="col-sm-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="myCheckBox" onclick="ShowTextBox(this)" >
                            Sign Up as Member ?
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="myTextBox">
                        <label for="exampleInputPassword2">Password</label>
                        <input name="pass_confirmation" type="password" data-validation="length" data-validation-optional="true" data-validation-length="min8" class="form-control" id="exampleInputPassword2" placeholder="Password">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="myTextBox2">
                        <label for="exampleInputPassword2">Confirm Password</label>
                        <input type="password" name="pass" data-validation="confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Address Details</legend>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Address</label>
                    <textarea name="alamat" rows="5" data-validation="required" class="form-control" id="inputEmail3"></textarea>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" name="kota" data-validation="required" class="form-control" id="inputEmail3">
                    <label for="exampleInputEmail1">Zip/Postal</label>
                    <input type="text" name="zip" data-validation="number" class="form-control" id="inputEmail3">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">State/Province</label>
                    <input type="text" name="provinsi" data-validation="required" class="form-control" id="inputEmail3">
                    <label for="exampleInputEmail1">Country</label>
                    <select class="form-control" name="negara">
                        <option>Indonesia</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input name="submit" type="submit" class="btn btn-default pull-right" value="Booking">
                </div>
            </div>
            </form>
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