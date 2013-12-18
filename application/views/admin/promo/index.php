<div class="page-header">
    <h1>Data Promo Hotel</h1>
</div>
<table class="table table-hover table-responsive">
    <thead>
        <tr class="success">
            <th>Nama Promo</th>
            <th>Type Kelas</th>    
            <th>Dari Tanggal</th>
            <th>Sampe Tanggal</th>
            <th>Diskon</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($promo): ?>
                <tr>
                    <td><?php echo $promo->title; ?></td>
                    <td><?php echo $class[$promo->idclass]; ?></td>
                    <td><?php echo $promo->start_date; ?></td>
                    <td><?php echo $promo->end_date; ?></td>
                    <td><?php echo $promo->discount; ?></td>
                    <td><?php echo _toaktif('admin/promo/aktif/', $promo->idpromo, $promo->status); ?></td>
                    <td>
                        <a href="<?php echo base_url('index.php/admin/promo/edit/' . $promo->idclass); ?>" class="btn btn-default btn-xs btn-primary" data-target="#telo" role="button" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    </td>
                </tr>
        <?php else: ?>
            <tr><td>Belum ada data !</td></tr> 
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal -->

<div class="modal fade" id="telo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Event</h4>
            </div>
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
</div><!-- /.modal-dialog -->
<script>
    $('#telo').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
</script>
<script>
    $(function() {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>