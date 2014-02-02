<div class="col-md-12">
    <?php if ($news): ?> 
        <?php foreach ($news as $n): ?>
            <h1><?php echo ucfirst($n->title); ?></h1>
            <p><?php echo ucfirst(limit_to_numwords($n->post_entry, 100)); ?></p>
            <div>
                <span class="badge">Posted <?php echo $n->create_date; ?></span></div>         
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        Tidak ada berita
    <?php endif; ?>
</div>