<div class="page-header">
    <h2>Data Halaman Web</h2>
    <p class="alert alert-info">Drag untuk memilih posisi halaman web & tekan "SAVE"</p>
</div>
<a href="<?php echo base_url('index.php/admin/pages/add'); ?>" class="btn btn-primary pull-left">+ Add a New Page</a>
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