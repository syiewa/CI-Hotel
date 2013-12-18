<div class="page-header">
    <h1>Data Class Room Hotel</h1>
</div>
<a href="<?php echo base_url('index.php/admin/kelas/add'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#telo">
    Tambah Data
</a>
<br /><br />
<table class="table table-hover table-responsive">
    <thead>
        <tr class="success">
            <th>Nama</th>
            <th>Harga</th>    
            <th>Photo</th>
            <th>LCD</th>
            <th>WIFI</th>
            <th>Breakfast</th>
            <th>Safe</th>
            <th>Bath</th>
            <th>Dinner</th>
            <th>Parking</th>
            <th>Laundry</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($kelas): ?>
            <?php
            $i = 1;
            foreach ($kelas as $p) :
                ?>
                <tr>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo $p->price; ?></td>
                    <td><?php echo $p->photoclass; ?></td>
                    <?php if ($p->fasilitas): ?>
                        <?php foreach ($p->fasilitas as $f): ?>
                            <td><?php echo _toimg($f->status, 0); ?></td>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php for ($i = 0; $i < 8; $i++) : ?>
                            <td><?php echo _toimg('0', 0); ?></td>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <td>
                        <a href="<?php echo base_url('index.php/admin/kelas/edit/' . $p->idclass); ?>" class="btn btn-default btn-xs btn-primary" data-target="#telo" role="button" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        <?php echo btn_delete('admin/kelas/delete/' . $p->idclass); ?>
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