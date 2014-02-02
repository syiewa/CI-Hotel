<h1><?php echo lang('edit_user_heading'); ?></h1>
<p><?php echo lang('edit_user_subheading'); ?></p>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="MyTab">
    <li class="active"><a href="#home" data-toggle="tab">Edit Profile</a></li>
    <li><a href="#profile" data-toggle="tab">Edit Address</a></li>
    <li><a href="#messages" data-toggle="tab">Messages</a></li>
    <li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="home">
        <?php echo form_open('', 'class="form-horizontal" role="form"'); ?>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">First Name</label>
                <div class="col-sm-2">
                    <?php
                    $prefix = array('Mr.', 'Mrs.', 'Miss.');
                    echo form_dropdown($prefix_name['name'], $prefix, $prefix_name['value'], 'class=' . $prefix_name['class']);
                    ?>
                </div>
                <div class="col-sm-3">
                    <?php
                    echo form_input($first_name);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Last Name</label>
                <div class="col-sm-5">
                    <?php
                    echo form_input($last_name);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Phone</label>
                <div class="col-sm-3">
                    <?php
                    echo form_input($phone);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Password</label>
                <div class="col-sm-3">
                    <?php
                    echo form_input($password);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Confirm Password</label>
                <div class="col-sm-3">
                    <?php
                    echo form_input($password_confirm);
                    ?>
                </div>
            </div>
            <?php if ($this->ion_auth->is_admin()): ?>
                <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                <?php foreach ($groups as $group): ?>
                    <label class="checkbox">
                        <?php
                        $gID = $group['id'];
                        $checked = null;
                        $item = null;
                        foreach ($currentGroups as $grp) {
                            if ($gID == $grp->id) {
                                $checked = ' checked="checked"';
                                break;
                            }
                        }
                        ?>
                        <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                        <?php echo $group['name']; ?>
                    </label>
                <?php endforeach ?>
            <?php endif; ?>
            <?php echo form_hidden('id', $user->id); ?>
            <?php echo form_hidden($csrf); ?>

            <?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-xs btn-default"'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div class="tab-pane" id="profile">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <?php echo form_open('admin/users/address', 'class =form-horizontal'); ?>
                    <?php echo form_hidden('user_id', $user->id); ?>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend></legend>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Address</label>
                            <?php
                            $attr = array(
                                'name' => 'alamat',
                                'data-validation' => 'required',
                                'rows' => 5,
                                'class' => 'form-control',
                            );
                            echo form_textarea($attr, set_value('address', empty($address->alamat) ? '' : $address->alamat));
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">City</label>
                            <select name="kota" id="match_list" class="form-control">
                            </select>
                            <label for="exampleInputEmail1">Zip/Postal</label>
                            <?php
                            $attr = array(
                                'name' => 'zip',
                                'data-validation' => 'number',
                                'rows' => 5,
                                'class' => 'form-control',
                            );
                            echo form_input($attr, set_value('zip', empty($address->zip) ? '' : $address->zip));
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">State/Province</label>
                            <?php
                            $js = 'id="tournament_list" class="form-control" onChange="activate_match();"';
                            echo form_dropdown('provinsi', $provinsi, empty($address->provinsi) ? 0 : $address->provinsi, $js);
                            ?>
                            <label for="exampleInputEmail1">Country</label>
                            <select class="form-control" name="negara">
                                <option value="Indonesia">Indonesia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="submit" type="submit" class="btn btn-default pull-right" value="Save">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="messages">...</div>
    <div class="tab-pane" id="settings">...</div>
</div>
<script type="text/javascript">
    $(function() {
        activate_match();
    });
    function activate_match()
    {
        var tnmt_id = $('select#tournament_list').val(); //Get the id of the tournament selected in the list
        var cct = $("input[name=csrf_test_name]").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>/admin/users/list_dropdown', //We are going to make the request to the method "list_dropdown" in the match controller
            data: {'tnmnt': tnmt_id, 'csrf_test_name': cct}, //POST parameter to be sent with the tournament id
            success: function(resp) { //When the request is successfully completed, this function will be executed
                //Activate and fill in the matches list
                $('select#match_list').attr('disabled', false).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
            }
        });
    }
</script>
<script>
    $.validate({
        modules: 'security'
    });
</script>
