<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo $meta_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sb-admin.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-wysihtml5.css'); ?>">
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jcrop.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/fancybox/jquery.fancybox.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('assets/fancybox/helpers/jquery.fancybox-thumbs.css'); ?>" type="text/css" media="screen" />
        <script src="<?php echo base_url('assets/js/wysihtml5-0.3.0.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.js'); ?>" ></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap3-wysihtml5.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.27/jquery.form-validator.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="<?php echo base_url('assets/js/jcrop.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mjs.nestedSortable.js'); ?>"></script>
<!--        <script type="text/javascript" src="<?php echo base_url('assets/js/tiny_mce/tiny_mce.js'); ?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url('assets/fancybox/jquery.fancybox.pack.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/fancybox/helpers/jquery.fancybox-thumbs.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/respond.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
    </head>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="col-lg-12">
                <?php if (!empty($content)): ?>
                    <?php $this->load->view($content); ?>
                <?php else: ?>
                    <?php echo 'Halaman tidak ada'; ?>
                <?php endif; ?>
                <!-- End Content -->
            </div>
        </div>

        <!-- Footer -->
        <?php // $this->load->view('components/footer'); ?>
        <!-- End Footer -->
    </div>
</body>
<script type="text/javascript">
    $('textArea').wysihtml5({
        "stylesheets": ["<?php echo base_url('assets/css/bootstrap3-wysiwyg5-color.css'); ?>"]
    });
</script>
</html>
