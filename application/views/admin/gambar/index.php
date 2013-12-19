<div id="containerHolder">
    <div id="container">
        <div style="padding-bottom:10px;">
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
            <h3>Upload Foto Produk</h3>
        </div>
        <div class="clear"></div>
    </div>
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