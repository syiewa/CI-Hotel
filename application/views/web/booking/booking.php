<?php
$from = date('Y/m/d', strtotime($this->session->userdata('from')));
$to = date('Y/m/d', strtotime($this->session->userdata('to')));
?>
<div class="page-header">
    <h1>Booking Kamar</h1>
</div>
<?php if ($this->cart->contents()): ?>
<div class="well col-xs-12 col-sm-12 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-0">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <address>
            <strong><?php echo $rooms[0]->title; ?></strong>
        </address>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
        <p>
            <em>Tgl Pesan : <?php echo $from . ' s/d ' . $to ?></em>
        </p>
        <p>
            <br />
        </p>
    </div>
    <div class="text-center">
        <h1>Info Pemesanan</h1>
    </div>
</span>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tgl</th>
                <th>#</th>
                <th class="text-center">Price</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 0;
            foreach ($this->cart->contents() as $items):
                do {
                    ?>
                    <?php echo form_hidden('id', $items['rowid']); ?>
                    <tr>
                        <td class="col-md-9"><?php echo $from; ?></td>
                        </td>
                        <td class="col-md-1">
                            1 days
                        </td>
                        <td class="col-md-2 text-center"><?php echo $this->cart->format_number($items['price']); ?></td>
                    </tr>
                    <?php
                    $from = mktime(0, 0, 0, date('m', strtotime($from)), date('d', strtotime($from)) + 1, date('Y', strtotime($from)));
                    $from = date('Y/m/d ', $from);
                    $i++;
                } while (strtotime($from) <= strtotime($to));
            endforeach;
            ?>
            <tr>
                <td class="text-right">Subtotal: </td>
                <td class="text-right">
                    <?php echo $i; ?> days
                    <p>
                        <strong><?php $this->cart->contents('qty'); ?></strong>
                    </p>
                </td>
                <td class="text-center">
                    <p>
                        <strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong>
                    </p>
                    <p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                <td class="text-center text-danger"><h4><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></h4></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-success btn-lg btn-block">
        Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
    </button></td>
    </div>
<?php endif; ?>
<script>
    $(function() {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>