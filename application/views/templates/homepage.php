<div class="col-md-12">
    <div class="row">
        <?php $this->load->view('web/widget/reservasi'); ?>
        <div class="col-md-8">
            <?php $this->load->view('web/widget/slider'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3><i>Latest</i> News</h3>
            <a href="map_properties.html"><img class="img-responsive" src="<?php echo base_url('assets/img/thumbnails/'.$news->featurephoto);?>" alt="<?php echo $news->title; ?>"></a>
            <p><?php echo $news->post_entry; ?><a href="map_properties.html" class="pull-right">more...</a></p>
        </div>
        <div class="col-md-4">
            <h3><i>New</i> Promo</h3>
            <a href="listings.html"><img src="http://wbpreview.com/previews/WB02793H5/css/images/new_homes.png" alt=""></a>
            <p>Sign up for our weekly newsletter and stay up-to-date with the latest offers, and newest products.<a href="listings.html" class="pull-right">more...</a></p>
        </div>
        <div class="col-md-4">
            <h3><i>Big</i> Features</h3>
            <a href="listings.html"><img src="http://wbpreview.com/previews/WB02793H5/css/images/new_homes.png" alt=""></a>
            <p>Sign up for our weekly newsletter and stay up-to-date with the latest offers, and newest products.<a href="listings.html" class="pull-right">more...</a></p>
        </div>
    </div>
</div>
</div> 