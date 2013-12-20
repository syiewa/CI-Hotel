<div class="page-header">
    <h2>Data Halaman Web</h2>
    <p class="alert alert-info">Drag untuk memilih posisi halaman web & tekan "SAVE"</p>
</div>
<a href="<?php echo base_url('index.php/admin/pages/add'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#telo">+ Add a New Page</a>
<br><br>
<div id="orderResult"></div>
<input type="button" id="save" value="Save" class="btn btn-primary" />
<script>
    $(function() {
        $.post('<?php echo site_url('admin/pages/order_ajax'); ?>', {}, function(data) {
            $('#orderResult').html(data);

        });

        $('#save').click(function() {
            oSortable = $('.sortable').nestedSortable('toArray');

            $('#orderResult').slideUp(function() {
                $.post('<?php echo site_url('admin/pages/order_ajax'); ?>', {sortable: oSortable}, function(data) {
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });

        });
    });
</script>
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