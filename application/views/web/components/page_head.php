<div class="container">
    <div class="row">
        <div class="col-lg-8 logo">
            <a href="index.html">
                <div class="row">
                    <div class="col-lg-4 logo">
                        <h1><?php echo getOptions('company_name'); ?></h1>
                        <p>★★★★☆</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 pull-right">
            <br>
            <h4>Customer service: <?php echo getOptions('company_number'); ?></h4>
            <address><small><?php echo getOptions('company_address'); ?></small></address>
        </div>
    </div>
    <div class="row">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                <?php echo get_menu(menu()); ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
</div>
