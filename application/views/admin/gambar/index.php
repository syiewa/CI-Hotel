      
<div class="col-lg-12">
    <h1 class="page-header">Gallery Kamar</h1>
</div>
<?php if ($gambar) : ?>
    <?php foreach ($gambar as $g): ?>
        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url() . $g->image; ?>"><img class="img-responsive" src="<?php echo base_url() . $g->thumb; ?>"></a>
            <?php echo btn_delete('admin/kelas/hapus_foto/' . $g->idclass . '/' . $g->id_foto_produk); ?>
            <?php echo _toaktif('admin/kelas/set_default/' . $g->idclass . '/', $g->id_foto_produk, $g->default); ?>
        </div>
    <?php endforeach;
else: ?>
    <div class="col-lg-12">
        Belum ada Gambar
    </div>
<?php endif; ?>

<div class="col-lg-12">
    <h3 class="page-header">Tambah Gambar</h3>
</div>
<div class="col-lg-12">
    <?php
    if (isset($status)) {
        echo $status;
    }
    ?>
    <?php
    if (isset($error_notification)) {
        echo $error_notification . '<br /><br />';
    }
    ?>
    <?php
    if (isset($thepicture)) {
        echo '<div class="imageborder">Crop area untuk dijadikan thumbnail <br /><br /><img src="' . $thepicture . '" id="cropbox" alt="cropbox"></div>';
    }
    ?>
    <?php
    if (isset($thepicture)) {
        echo '<div style="clear:both; margin-bottom:20px;"></div>';
    }
    ?>
    <?php
    if (isset($form)) {
        echo $form;
    }
    ?>
</div>


<script type="text/javascript">
<?php if (isset($ratio) && isset($orig_w) && isset($orig_h) && isset($target_w) && isset($target_h)): ?>
        jQuery(document).ready(function($) {
            $(function() {
                $('#cropbox').Jcrop({
                    aspectRatio: <?php echo $ratio ?>,
                    setSelect: [0, 0,<?php echo $orig_w . ',' . $orig_h; ?>],
                    onSelect: updateCoords,
                    onChange: updateCoords
                });
            });

            function updateCoords(c)
            {
                showPreview(c);
                $("#x").val(c.x);
                $("#y").val(c.y);
                $("#w").val(c.w);
                $("#h").val(c.h);
            }
            ;

            function showPreview(coords)
            {
                var rx = <?php echo $target_w; ?> / coords.w;
                var ry = <?php echo $target_h; ?> / coords.h;

                $("#preview img").css({
                    width: Math.round(rx *<?php echo $orig_w; ?>) + 'px',
                    height: Math.round(ry *<?php echo $orig_h; ?>) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
            }
            ;
        });
<?php endif; ?>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox-thumb").fancybox({
            prevEffect: 'none',
            nextEffect: 'none',
            helpers: {
                title: {
                    type: 'outside'
                },
                thumbs: {
                    width: 50,
                    height: 50
                }
            }
        });
    });
</script>