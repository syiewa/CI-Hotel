<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h2>Order Slides Position</h2>
            <p class="alert alert-info">Drag to order slides and then click 'Save'</p>
            <a href="<?php echo base_url('index.php/admin/slider/add'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#telo">
                Tambah Data
            </a>
            <br /><br />
            <div id="orderResult"></div>
            <input type="button" id="save" value="Save" class="btn btn-primary" />
        </div>
    </div>
</div>

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
    $.validate({
        form: '#myForm',
        modules: 'file'
    });
</script>
<script>
    $(function() {
        $.post('<?php echo site_url('admin/slider/order_ajax'); ?>', {}, function(data) {
            $('#orderResult').html(data);
        });

        $('#save').click(function() {
            oSortable = $('.sortableslide').nestedSortable('toArray');

            $('#orderResult').slideUp(function() {
                $.post('<?php echo site_url('admin/slider/order_ajax'); ?>', {sortableslide: oSortable}, function(data) {
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });

        });
    });
</script>