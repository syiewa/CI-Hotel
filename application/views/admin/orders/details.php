<div class="page-header">
    <h1>Detail Orders #<?php echo $order->order_id; ?></h1>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Guest Details</a></h4>
            </div>
            <div class="panel-body">
                <address>
                    <strong><?php echo $guest->nama_depan . ' ' . $guest->nama_belakang; ?></strong><br>
                    <a href="mailto:#"><?php echo $guest->email; ?></a><br>
                    <?php echo $guest->alamat . ' , ' . ucwords(strtolower($kota->lokasi_nama)); ?><br>
                    <?php echo $provinsi->lokasi_nama . ' , ' . $guest->negara . ' ' . $guest->zip; ?><br>
                </address>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Credit Card details</h4>
            </div>
            <div class="panel-body">
                <p>Credit Card  Type : <?php echo $cc->cc_type; ?></p>
                <p>Credit Card  Name : <?php echo $cc->cc_name; ?></p>
                <p>Credit Card  No.  : <?php echo $cc->cc_number; ?></p>
            </div>
        </div>
    </div>
</div> <!-- / end client details section -->
<div class="row">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th><h4>Room Class</h4></th>
        <th><h4>Check In</h4></th>
        <th><h4>Check Out</h4></th>
        <th><h4>Sub Total</h4></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $kelas->title; ?></td>
                <td><?php echo $order->check_in; ?></td>
                <td><?php echo $order->check_out; ?></td>
                <td class="text-right"><?php echo $order->payment_total; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <?php echo form_open('', 'class="form-inline"'); ?>
    <div class="form-group">
        <label for="exampleInputEmail2">Status : </label>
        <?php
        echo $status;
        echo form_hidden('order_status', $order->order_status);
        ?>
    </div>
    <div class="form-group">
        <?php
        switch ($order->order_status) {
            case 0;
                if ($room) {
                    echo '<label for="exampleInputEmail2">Select Room : </label>' . form_dropdown('room', $room, '', 'class="form-control"');
                    echo ' ' . form_submit('submit', 'Approve!', 'class="btn btn-primary"');
                } else {
                    echo '<span class="label label-danger">There is no available rooms!!</span>';
                }
                break;
            case 1;
                echo form_submit('submit', 'Complete!', 'class="btn btn-success"');
                break;
        }
        ?>
    </div>
    <?php
    if ($order->order_status != 3)
        echo form_submit('cancel', 'Cancel Order', 'class="btn btn-danger btn-sm pull-right"');
    ?>
</form>
</div>