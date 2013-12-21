<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <h2><?php echo $page->title; ?></h2>
            <?php echo $page->body; ?>
            <hr>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Promo <?php echo $promo[0]->nmclass; ?></h3>
                        <p><?php echo $promo[0]->desc; ?><br />
                            Discount <?php echo $promo[0]->discount; ?> % <br />
                            hingga <?php echo date('d F M', strtotime($promo[0]->end_date)); ?><br /></p>
                        <a href="" class="btn btn-default">Order Now!</a>
                    </div>
                    <div class="col-md-6">
                        <h3>Location</h3>
                        <p>We are located in the center of Prague surrounded by malls and boutiques.</p>
                        <dl class="contacts-list">
                            <dt>Gazek st., 210</dt>
                            <dd>1-800-412-4556</dd>
                            <dd>1-800-542-6448</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('web/widget/reservasi'); ?>
    </div>
</div>
<hr>
<div class="col-md-12">
    <div class="row">
        <div class="page-header">
            <h3>News</h3>
        </div>
        <div class="col-sm-2 col-md-2">
            <img src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg"
                 alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-4 col-md-4">
            <blockquote>
                <p>Bruce Wayne</p> <small><cite title="Source Title">Gotham, United Kingdom  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> <i class="glyphicon glyphicon-envelope"></i> masterwayne@batman.com
                <br
                    /> <i class="glyphicon glyphicon-globe"></i> www.bootsnipp.com
                <br /> <i class="glyphicon glyphicon-gift"></i> January 30, 1974</p>
        </div>
        <div class="col-sm-2 col-md-2">
            <img src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg"
                 alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-2 col-md-4">
            <blockquote>
                <p>Bruce Wayne</p> <small><cite title="Source Title">Gotham, United Kingdom  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> <i class="glyphicon glyphicon-envelope"></i> masterwayne@batman.com
                <br
                    /> <i class="glyphicon glyphicon-globe"></i> www.bootsnipp.com
                <br /> <i class="glyphicon glyphicon-gift"></i> January 30, 1974</p>
        </div>
    </div>
</div>