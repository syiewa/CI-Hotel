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
                    <input name="nama_depan" type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                </div>
                <div class="col-sm-5">
                    <input name="nama_belakang" type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Contact Details</legend>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Email address Confirmation</label>
                    <input type="email" class="form-control" id="inputEmailConfirm" placeholder="Email Confirmation">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" name="telepon" class="form-control" id="inputTelp" placeholder="Telephone">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <legend>Your Address Details</legend>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">Address</label>
                    <textarea name="alamat" rows="5" class="form-control" id="inputEmail3"></textarea>
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" name="kota" class="form-control" id="inputEmail3">
                    <label for="exampleInputEmail1">Zip/Postal</label>
                    <input type="text" name="zip" class="form-control" id="inputEmail3">
                </div>
                <div class="col-sm-4">
                    <label for="exampleInputEmail1">State/Province</label>
                    <input type="text" name="provinsi" class="form-control" id="inputEmail3">
                    <label for="exampleInputEmail1">Country</label>
                    <select class="form-control" name="negara">
                        <option>Indonesia</option>
                        <option>Malaysia</option>
                        <option>Singapore</option>
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