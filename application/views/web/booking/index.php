<div class="page-header">
    <h1>Kamar tersedia</h1>
    <?php if ($this->session->userdata('from') && $this->session->userdata('to')) : ?>
        <p><?php echo 'Rooms tersedia tgl ' . $this->session->userdata('from') . ' s/d ' . $this->session->userdata('to'); ?></p>
    <?php else : ?>
        <?php echo form_open('booking'); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Check In</label>
            <input type="text" class="form-control datepicker" id="from" placeholder="Enter date" name="from">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Check Out</label>
            <input type="text" class="form-control datepicker" id="to" placeholder="Enter date" name="to">
        </div>
        <div class="form-group">
            <?php echo form_submit('check', 'Check', 'class=form-control btn btn-default'); ?>
        </div>

        <?php echo form_close(); ?>
    <?php endif; ?>
</div>
<table class="table table-hover table-responsive">
    <thead>
        <tr class="success">
            <th></th>
            <th>Rooms</th>
            <th>Harga</th>    
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rooms): ?>
            <?php
            $i = 1;
            foreach ($rooms as $p) :
                ?>
                <tr>
                    <td class="col-md-3"><a href="<?php echo ($p->image == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($p->image) ); ?>" class="thumbnail fancybox">
                                    <img class="img-responsive" src='<?php echo ($p->thumb == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($p->thumb) ); ?>'></a></td>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo $p->net; ?></td>
                    <td>
                        <a href="<?php echo base_url('index.php/booking/order/' . $p->idclass); ?>" class="btn btn-default btn-xs btn-primary" ><span class="glyphicon glyphicon-edit"></span>Book Now</a>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        <?php else: ?>
            <tr><td>Belum ada data !</td></tr> 
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal -->

<script>
    $(function() {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>