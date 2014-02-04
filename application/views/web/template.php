<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo $meta_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/styles_1.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jcrop.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/fancybox/jquery.fancybox.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('assets/fancybox/helpers/jquery.fancybox-thumbs.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sinister.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
        <script src="<?php echo base_url('assets/js/jquery.js'); ?>" ></script>
        <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.form-validator.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jcrop.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mjs.nestedSortable.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/fancybox/jquery.fancybox.pack.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/fancybox/helpers/jquery.fancybox-thumbs.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/respond.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
        <style>
            .ImageWrapper .ImageOverlayH {
                background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
                bottom: 0;
                display: block;
                height: 100%;
                left: 0;
                opacity: 0;
                position: absolute;
                right: 0;
                top: 0;
                transition: all 0.2s ease 0s;
                width: 100%;
            }
            .ImageWrapper:hover .ImageOverlayH {
                opacity: 1;
            }

            .ImageWrapper .StyleH {
                visibility: hidden;
                margin: 0;
                opacity: 0;
                position: absolute;
                text-align: center;
                width: 100%;
                top: 50%;
                margin-top: -20px;
            }
            .ImageWrapper:hover .StyleH {
                opacity: 1;
                visibility: visible;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- Content -->
            <!-- Header -->
            <?php $this->load->view('web/components/page_head'); ?>
            <!-- End Header -->

            <!-- Sidebar -->
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="container">
                <div class="row">
                    <?php echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
                    <?php
                    if ($this->session->flashdata('success')) {
                        echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('success') . '</div>';
                    }
                    if ($this->session->flashdata('error')) {
                        echo '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '</div>';
                    }
                    if ($this->session->flashdata('message')) {
                        echo '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('message') . '</div>';
                    }
                    ?>
                    <?php if (!empty($content)): ?>
                        <?php $this->load->view($content); ?>
                    <?php else: ?>
                        <?php echo 'Halaman tidak ada'; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Content -->
            <!-- Head tags to include FontAwesome -->


            <!-- Footer -->
            <div class="row">
                <hr>
                <?php $this->load->view('web/components/page_footer'); ?>
            </div>
            <!-- End Footer -->
        </div>
    </body>

</html>
