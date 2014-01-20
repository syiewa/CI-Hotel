<div class="col-md-4">
    <div class="well" id="panel-home">
        <?php echo form_open('booking'); ?>
        <fieldset>
            <legend>Reservation</legend>
            <div class="form-group">
                <label for="exampleInputEmail1">Check In</label>
                <input type="text" class="form-control datepicker input-sm" data-validation="date" data-validation-format="yyyy/mm/dd" id="from" placeholder="Enter date" name="from">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Check Out</label>
                <input type="text" class="form-control datepicker input-sm" data-validation="date" data-validation-format="yyyy/mm/dd" id="to" placeholder="Enter date" name="to">
            </div>
            <div class="form-group">
                <?php echo form_submit('check', 'Check', 'class=form-control btn btn-default'); ?>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $.validate({
    });
</script>
<script>
    $(function() {
        var currentDate = new Date();
        $("#from").datepicker({
            defaultDate: currentDate,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            minDate: currentDate,
            dateFormat: "yy/mm/dd",
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: "yy/mm/dd",
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>