<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class='page-header'>
                <h1><?php echo $page->title; ?></h1>
                <p><?php echo $page->body; ?></p>
            </div>
            <div class='row'>
                <?php foreach ($kelas as $k) : ?>
                    <div class="col-md-4"> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo $k->title; ?>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <a href="<?php echo ($k->image == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($k->image) ); ?>" class="thumbnail fancybox">
                                    <img class="img-responsive" src='<?php echo ($k->thumb == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($k->thumb) ); ?>'></a>
                                <p><?php echo strip_tags($k->description); ?></p>
                                <p><b>Facilities</b></p>
                                <ul class="room_facilities">
                                    <?php foreach ($k->fasilitas as $f) : ?>
                                        <li class="<?php echo $f->fac; ?>"><a title="<?php echo $f->title; ?>" href="#" class="tooltip_1"><?php echo $f->title; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="<?php echo site_url('booking'); ?>"class="form-control btn btn-success">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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