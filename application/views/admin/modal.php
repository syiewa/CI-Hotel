<?php if (!empty($content)): ?>
    <?php $this->load->view($content); ?>
<?php else: ?>
    <?php echo 'Halaman tidak ada'; ?>
<?php endif; ?>
<script type="text/javascript">
    $('textArea').wysihtml5({
        "stylesheets": ["<?php echo base_url('assets/css/bootstrap3-wysiwyg5-color.css'); ?>"]
    });
</script>