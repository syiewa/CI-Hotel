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
            <?php echo form_open('booking/payment','class =form-horizontal'); ?>
            <?php echo form_hidden('idclass',$rooms[0]->idclass); ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <legend>Your Name</legend>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control">
                            <option>Mr.</option>
                            <option>Mrs.</option>
                            <option>Miss.</option>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <legend>Your Contact Details</legend>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Email address Confirmation</label>
                        <input type="email" class="form-control" id="inputEmailConfirm" placeholder="Email Confirmation">
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Telephone</label>
                        <input type="text" class="form-control" id="inputTelp" placeholder="Telephone">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <legend>Your Address Details</legend>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea rows="5" class="form-control" id="inputEmail3"></textarea>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">City</label>
                        <input type="email" class="form-control" id="inputEmail3">
                        <label for="exampleInputEmail1">Zip/Postal</label>
                        <input type="email" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">State/Province</label>
                        <input type="email" class="form-control" id="inputEmail3">
                        <label for="exampleInputEmail1">Country</label>
                        <select class="form-control">
                            <option>Indonesia</option>
                            <option>Malaysia</option>
                            <option>Singapore</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default pull-right">Booking</button>
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