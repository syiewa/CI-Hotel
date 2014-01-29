    <div id="data">
        <table class="table table-hover table-responsive" id="containerid">
            <thead>
                <tr class="success">
                    <th>ID Order</th>
                    <th>Order Name</th>    
                    <th>Type Class</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($orders): ?>
                    <?php
                    $i = 1;
                    foreach ($orders as $p) :
                        ?>
                        <tr>
                            <td><?php echo $p->order_id; ?></td>
                            <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>
                            <td><?php echo $p->class_title; ?></td>
                            <td><?php echo $p->tgl_order; ?></td>
                            <td><?php echo $status[$p->order_status]; ?></td>
                            <td>
                                <a href="<?php echo base_url('index.php/admin/orders/edit/' . $p->order_id); ?>" class="btn btn-default btn-xs btn-primary" data-target="#telo" role="button" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                <a href="<?php echo base_url('index.php/admin/orders/gambar/' . $p->order_id); ?>" class="btn btn-default btn-xs btn-primary" ><span class="glyphicon glyphicon-edit"></span> Galery</a>
                                <?php echo btn_delete('admin/orders/delete/' . $p->order_id); ?>
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
    </div>

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
</div>
<div id="ajax_paging">
    <?php
    echo $pagination
    ?>  
</div>