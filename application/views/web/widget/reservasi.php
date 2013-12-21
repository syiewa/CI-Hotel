<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Reservation:
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Check In</label>
                    <input type="email" class="form-control datepicker" id="from" placeholder="Enter date">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Check Out</label>
                    <input type="email" class="form-control datepicker" id="to" placeholder="Enter date">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Kelas</label>
                    <?php echo form_dropdown('idclass', $class, '', 'class="form-control"'); ?>

                </div>
                <div class="form-group">
                    <button class="form-control btn btn-default">Check</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>