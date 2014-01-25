<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class='page-header'>
                <h1><?php echo $page->title; ?></h1>
                <p><?php echo $page->body; ?></p>
            </div>
            <div class="col-md-12">
                <div class='row'>
                    <?php foreach ($kelas as $k) : ?>
                        <div class="col-md-4">
                            <h3><?php echo $k->title; ?></h3>
                            <a href="<?php echo ($k->image == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($k->image) ); ?>" class="fancybox">
                                <img class="img-responsive" src='<?php echo ($k->thumb == '' ? 'http://placehold.it/280x185&text=Belum+ada+gambar' : base_url($k->thumb) ); ?>'></a>
                            <ul class="room_facilities thumbnails hotel-options no_margin_left">
                                <?php foreach ($k->fasilitas as $f) : ?>
                                    <li class="<?php echo $f->fac; ?>"><a title="<?php echo $f->title; ?>" href="#" class="tooltip_1"><?php echo $f->title; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <p> Wake up to this traditional room with 25-inch TV and on-demand movies. The comfortable room, with opening windows, has 1 single bed. Sleeps 1 adult. </p>
                            <div class="row center">
                                <a href="<?php echo site_url('booking'); ?>"class="form-control btn btn-success">Order Now</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: 'elastic',
            closeEffect: 'elastic',
            helpers: {
                title: {
                    type: 'inside'
                }
            }
        });
    });
</script>