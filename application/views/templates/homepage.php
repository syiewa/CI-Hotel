<div class="col-md-12">
    <div class="row">
        <?php $this->load->view('web/widget/reservasi'); ?>
        <div class="col-md-8">
            <?php $this->load->view('web/widget/slider'); ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-5 text-left'>
            <h2>Latest Promo</h2>
        </div>
        <div class='col-md-5 text-left'>
            <h2>Testimonial</h2>
        </div>
    </div>
    <?php if ($promo) : ?>
        <div class="row">
            <?php foreach ($promo as $p) : ?>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <div class="offer offer-success">
                        <div class="shape">
                            <div class="shape-text">
                                Disc <?php echo $p->discount; ?> %								
                            </div>
                        </div>
                        <div class="offer-content">
                            <h5 class="lead">
                                <?php echo $p->prom . ' ' . $p->nmclass; ?><br>
                                <small><?php echo date('d M Y', strtotime($p->start_date)) . ' s/d ' . date('d M Y', strtotime($p->end_date)); ?></small>
                            </h5>
                            <p>
                                <?php echo limit_to_numwords(strip_tags($p->desc),50); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php $this->load->view('web/widget/promo'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class='col-md-8 text-left'>
            <h2>Latest News</h2>
        </div>
    </div>
    <div class="row">
        <?php if ($news) : ?>
            <?php foreach ($news as $new): ?>
                <div class="col-md-4">
                    <h5><i><?php echo $new->title; ?></h5>
                    <img class="img-responsive" src="<?php echo empty($new->featurephoto) || $new->featurephoto == "" ? 'http://placehold.it/300x100&text=News' : base_url('assets/img/thumbnails/' . $new->featurephoto); ?>" alt="<?php echo $new->title; ?>">
                    <p><?php echo limit_to_numwords(strip_tags($new->post_entry),25); ?><a href="map_properties.html" class="pull-right">more...</a></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>