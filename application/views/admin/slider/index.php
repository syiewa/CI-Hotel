<div class="col-md-12">
    <div class="row">

        <div class="col-md-12">
            <?php echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
            <?php
            if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('message') . '</div>';
            }
            if ($this->session->flashdata('error')) {
                echo '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '</div>';
            }
            ?>
        </div>
        <div class="col-md-12">
            <a href="<?php echo base_url('index.php/admin/slides/add') ; ?>" class="btn btn-primary pull-left">+ Add a New Slide</a>
            <br><br>
        </div>
        <div class="col-md-12">
            <h2>Order Slides Position</h2>
            <p class="alert alert-info">Drag to order slides and then click 'Save'</p>
            <div id="orderResult"></div>
            <input type="button" id="save" value="Save" class="btn btn-primary" />
        </div>
    </div>
</div>

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