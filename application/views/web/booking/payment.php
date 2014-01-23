<div class="col-md-12">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li><a href="<?php echo site_url('booking'); ?>">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Pilih Kamar</p>
                    </a></li>
                <li><a href="<?php echo site_url('booking/guest'); ?>">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Informasi Tamu</p>
                    </a></li>
                <li class="active"><a href="#">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Pembayaran</p>
                    </a></li>
            </ul>
        </div>
    </div>
</div>
<div class="page-header">
    <h3>Payment</h3>
</div>
<div class="col-md-12">	
    <div class="col-md-6">
        <h3><i>Your</i> chosen rooms</h3>				
        <div class="pull-left strong">Room type</div><div class="pull-right "><?php echo $rooms[0]->title; ?></div><br>
        <div class="pull-left strong">Arrival date</div><div class="pull-right"><?php echo date('D j, F Y ', strtotime($this->session->userdata('from'))); ?></div><br>
        <div class="pull-left strong">Departure date</div><div class="pull-right"><?php echo date('D j, F Y ', strtotime($this->session->userdata('to'))); ?></div><br>
        <?php foreach ($this->cart->contents() as $t): ?>
            <div class="pull-left strong">Duration</div><div class="pull-right"><?php echo $t['qty']; ?> Night</div><br><br>
        <?php endforeach; ?>
    </div>
    <div class="col-md-3 pull-right">
        <h3>Base price</h3>
        <i class="price"><?php echo getOptions('currency'). ' '.$this->cart->format_number($this->cart->total()); ?></i>
    </div>	
</div>
<div class="col-md-12">
    <br><hr>
</div>
<div class="col-md-12">		
    <div class="col-md-6">
        <h3><i>Guest</i> Information</h3>				
        <div class="pull-left strong">Full Name</div><div class="pull-right "><?php echo $this->session->userdata('prefix_nama') . ' ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></div><br>
        <div class="pull-left strong">Email</div><div class="pull-right"><?php echo $this->session->userdata('email'); ?></div><br>
        <div class="pull-left strong">Telephone</div><div class="pull-right"><?php echo $this->session->userdata('phone') ?></div><br>
        <div class="pull-left strong">Alamat</div><div class="pull-right"><?php echo $this->session->userdata('alamat'); ?></div><br>
        <div class="pull-left strong">Kota</div><div class="pull-right"><?php echo $kota[$this->session->userdata('kota')]; ?></div><br>
        <div class="pull-left strong">Province</div><div class="pull-right"><?php echo $provinsi[$this->session->userdata('provinsi')]; ?></div><br>
        <div class="pull-left strong">Country</div><div class="pull-right"><?php echo $this->session->userdata('negara'); ?></div><br>
        <div class="pull-left strong">ZIP/Postal</div><div class="pull-right"><?php echo $this->session->userdata('zip'); ?></div><br>
    </div>	
</div>
<div class="col-md-12">
    <br><hr>
</div>
<div class="col-md-12">	
    <div class="col-md-8">
        <h3><i>Payment</i> Information</h3>				
        <?php echo form_open('booking/complete','class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Card Type</label>
                <div class="col-sm-8">
                    <select class="form-control" name="cc_type">
                        <option>Visa</option>
                        <option>Mastercard</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Card Number</label>
                <div class="col-sm-4">
                    <input type="text" data-validation="number" name="cc_number" class="form-control" id="inputPassword3" ">
                </div>
                <label for="inputPassword3" class="col-sm-1 control-label">CVV</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" data-validation="number" name="cvv" id="inputPassword3" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Expiration Date</label>
                <div class="col-sm-5">
                    </select>
                    <select class="form-control" name="date[]">
                        <?php
                        for ($i = 0; $i < 12; $i++) {
                            $time = strtotime(sprintf('+%d months', $i));
                            $value = date('m', $time);
                            $label = date('F', $time);
                            printf('<option value="%s">%s</option>', $value, $label);
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="date[]">
                        <?php
                        for ($i = 0; $i <= 5; $i++) {
                            $time = strtotime(sprintf('+%d years', $i));
                            $value = date('Y', $time);
                            $label = date('Y', $time);
                            printf('<option value="%s">%s</option>', $value, $label);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Card Holder Name</label>
                <div class="col-sm-8">
                    <input type="text" data-validation="required" name="cc_name" class="form-control">
                </div>
            </div>
    </div>
    <div class="col-md-3 pull-right">
        <h3>Total Price</h3>
        <i class="price"><?php echo getOptions('currency'). ' '.$this->cart->format_number($this->cart->total()); ?></i>
    </div>	
</div>
<div class="col-md-12">
    <div class="form-group pull-right">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-default" value="Submit Payment" name="payment"></button>
        </div>
    </div>
</form>
</div>
<script>
$.validate({
});
</script>