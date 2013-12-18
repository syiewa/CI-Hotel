<div class="page-header">
    <h1>Data News & Artikel</h1>
</div>
<a href="<?php echo base_url('index.php/admin/news/add'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#telo">
    Tambah Data
</a>
<br /><br />
<table class="table table-hover table-responsive">
    <thead>
        <tr class="success">
            <th>Title</th>
            <th>Dibuat</th>    
            <th>Tgl</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($news): ?>
            <?php
            $i = 1;
            foreach ($news as $p) :
                ?>
                <tr>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo $p->create_by; ?></td>
                    <td><?php echo $p->create_date; ?></td>
                    <td>
                        <a href="<?php echo base_url('index.php/admin/news/edit/' . $p->post_id); ?>" class="btn btn-default btn-xs btn-primary" data-target="#telo" role="button" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        <?php echo btn_delete('admin/news/delete/' . $p->post_id); ?>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        <?php else: ?>
            <tr><td>Belum ada data !</td></tr> 
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal -->

<div class="modal fade" id="telo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Event</h4>
            </div>
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
</div><!-- /.modal-dialog -->
<script>
    $('#telo').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
</script>