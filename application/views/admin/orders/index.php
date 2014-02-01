<div class="page-header">
    <h1>Data Order</h1>
</div>
<div id = 'result_table'>
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
        <tbody id="data">
        <div class="log"></div>
        <?php if ($orders): ?>
            <?php
//                $i = 1;
//                foreach ($orders as $p) :
//                    
            ?>
        <!--                <tr class="data">
                        <td id="order_id"><?php // echo $p->order_id;      ?></td>
                <td id="order_name"><?php // echo $p->first_name . ' ' . $p->last_name;      ?></td>
                <td id="class_title"><?php // echo $p->class_title;      ?></td>
                <td id="tgl_order"><?php // echo $p->tgl_order;      ?></td>
                <td id="order_status"><?php // echo $status[$p->order_status];      ?></td>
                <td>
                    <a href="<?php // echo base_url('index.php/admin/orders/edit/' . $p->order_id);    ?>" class="btn btn-default btn-xs btn-primary" data-target="#telo" role="button" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="<?php // echo base_url('index.php/admin/orders/gambar/' . $p->order_id);    ?>" class="btn btn-default btn-xs btn-primary" ><span class="glyphicon glyphicon-edit"></span> Galery</a>
            <?php // echo btn_delete('admin/orders/delete/' . $p->order_id); ?>
                </td>
            </tr>-->
            <?php
//                    $i++;
//                endforeach;
//                
            ?>
        <?php else: ?>
            <tr><td>Belum ada data !</td></tr> 
        <?php endif; ?>
        </tbody>
    </table>
    <!-- Modal -->

    <div class="modal fade bs-modal-sm" id="telo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <div id="paging">
    </div>
</div>
<script>
    var base_url = "<?php echo site_url('admin/order'); ?>";</script>
<script>
    $('#telo').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });</script>
<script>
    $(document).ready(function() {
        $(document).ajaxStart(function() {
            $('#telo').modal('show');

        });
        $(document).ajaxStop(function() {
            $('#telo').modal('hide');
        });
        var source = $("#result_table").html();
        if (source) {
            function load_result(index) {
                index = index || 0;
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + '/get_ajax/' + index, //"/index/" + index,
                    data: {ajax: true},
                    success: function(returnedData) {
                        //returnedData will now be an array Object
                        var data = returnedData['result'];
                        var html = '';
                        for (var i = 0, len = data.length; i < len; ++i) {
                            html += '<tr>';
                            html += '<td>' + data[i].order_id + '</td>';
                            html += '<td>' + data[i].first_name + ' ' + data[i].last_name + '</td>';
                            html += '<td>' + data[i].class_title + '</td>';
                            html += '<td>' + data[i].tgl_order + '</td>';
                            html += '<td>' + returnedData['status'][data[i].order_status] + '</td>';
                            html += '<td><a href="' + base_url + '/details/' + data[i].order_id + '" class="btn btn-default btn-xs btn-primary" >Detail</a> ';
                            html += '<a href="' + base_url + '/delete/' + data[i].order_id + '" class="btn btn-default btn-xs btn-danger" >Delete</a></td>'
                            html += "</tr>";
                        }
                        console.log(html);
                        $('#data').html(html);
                        $('#paging').html(returnedData['pagination']);
//                        $('#order_id').html(returnedData['result'][0].order_id);
//                        $('#order_name').html(returnedData['result'][0].first_name + ' ' + returnedData['result'][0].last_name);
//                        $('#class_title').html(returnedData['result'][0].class_title);
//                        $('#tgl_order').html(returnedData['result'][0].tgl_order);
//                        $('#order_status').html(returnedData['status'][returnedData['result'][0].order_status]);
                    },
                    error: function() {
                        alert("failure");
                        $("#result").html('error while submitting');
                    }
                });
//                $.post(base_url + "/index/" + index, {ajax: true}, function(data) {
//                    $("#result_table").html(data.result);
//                    // pagination
//                    $('#pagination').html(data.pagination);
//                }, "json");


            }

            //calling the function 
            load_result();
        }
        //pagination update
        $('#paging').on('click', '.pagination a', function(e) {
            e.preventDefault();
            //grab the last paramter from url
            var link = $(this).attr("href").split(/\//g).pop();
            load_result(link);
            return false;
        });
    });
</script>
