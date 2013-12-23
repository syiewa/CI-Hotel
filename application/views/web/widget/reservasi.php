<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Reservation:
            </h3>
        </div>
        <div class="panel-body">
            <?php echo form_open('booking'); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Check In</label>
                    <input type="text" class="form-control datepicker" id="from" placeholder="Enter date" name="from">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Check Out</label>
                    <input type="text" class="form-control datepicker" id="to" placeholder="Enter date" name="to">
                </div>
                <div class="form-group">
                    <?php echo form_submit('check','Check','class=form-control btn btn-default'); ?>
                </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>