<div class="page-header">
    <h1>Booking Kamar</h1>
</div>
<div class="col-md-12">
    <?php if ($this->cart->contents()): ?>
        <?php echo form_open_multipart('booking/update'); ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Tgl</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Hari</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                ?>
                <?php foreach ($this->cart->contents() as $items): ?>
                    <?php echo form_hidden('id', $items['rowid']); ?>
                    <tr>
                        <td><input type="checkbox" name="approve[]" value="<?php echo $items['rowid']; ?>"></td>
                        <td> <?php echo $items['from'] . ' s/d ' . $items['to']; ?>
                        </td>
                        <td><?php echo $items['name']; ?></td>
                        <td>
                            <?php echo $items['qty']; ?> days
                        </td>
                        <td><?php echo $this->cart->format_number($items['price']); ?></td>
                        <td><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><p class="pull-right">Total</td>
                    <td><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                </tr>
            </tbody>
        </table>  
        <div class="row">
            <div class="col-md-5">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>		  
            <div class="col-md-2">
            </div>		  
            <div class="col-md-5">
                <a href="<?php echo site_url('orders/checkout'); ?>" class="btn btn-primary pull-right">Services</a>
            </div>
        </div>
    <?php elseif (isset($keterangan)): ?>
        <div class="col-md-12">
            <?php echo 'Kamar ' . $keterangan->title . ' tidak tersedia pada tanggal ' . $keterangan->from . ' sampai ' . $keterangan->to; ?>
        </div>		  
        <div class="col-md-2">
            <a href="<?php echo site_url('service'); ?>" class="btn btn-primary pull-right">Checkout</a>
        </div>	
    <?php else : ?>
        <?php $this->load->view('web/widget/reservasi'); ?>
    <?php endif; ?>
    <?php echo form_close(); ?>
</div>
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