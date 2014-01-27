<div class="col-md-12">
    <div class="row">
        <?php $this->load->view('web/widget/reservasi'); ?>
        <div class="col-md-8">
            <?php $this->load->view('web/widget/slider'); ?>
        </div>
    </div>
    <div class="row">
        <?php if ($news) : ?>
            <div class="col-md-4">
                <h3><i>Latest</i> News</h3>
                <img class="img-responsive" src="<?php echo empty($news->featurephoto) || $news->featurephoto == "" ? 'http://placehold.it/300x100&text=News' : base_url('assets/img/thumbnails/' . $news->featurephoto) ; ?>" alt="<?php echo $news->title; ?>">
                
                <p><?php echo $news->post_entry; ?><a href="map_properties.html" class="pull-right">more...</a></p>
            </div>
        <?php endif; ?>
        <div class="col-md-4">
            <h3><i>New</i> Promo</h3>
            <a href="listings.html"><img src="http://placehold.it/300x100&text=Promo" alt=""></a>
            <p>Sign up for our weekly newsletter and stay up-to-date with the latest offers, and newest products.<a href="listings.html" class="pull-right">more...</a></p>
        </div>
        <div class="col-md-4">
            <h3><i>Big</i> Features</h3>
            <a href="listings.html"><img src="http://placehold.it/300x100&text=Features" alt=""></a>
            <p>Sign up for our weekly newsletter and stay up-to-date with the latest offers, and newest products.<a href="listings.html" class="pull-right">more...</a></p>
        </div>
    </div>
</div>
</div> 