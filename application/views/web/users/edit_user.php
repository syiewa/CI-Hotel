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
        <?php echo form_open(uri_string(), 'class="form-horizontal" role="form"'); ?>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">First Name</label>
                <div class="col-sm-3">
                    <?php
                    $class = 'form-control';
                    $first_name['class'] = $class;
                    echo form_input($first_name);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Last Name</label>
                <div class="col-sm-3">
                    <?php
                    $last_name['class'] = $class;
                    echo form_input($last_name);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Phone</label>
                <div class="col-sm-3">
                    <?php
                    $phone['class'] = $class;
                    echo form_input($phone);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Password</label>
                <div class="col-sm-3">
                    <?php
                    $password['class'] = $class;
                    echo form_input($password);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-md-2">Confirm Password</label>
                <div class="col-sm-3">
                    <?php
                    $password_confirm['class'] = $class;
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

            <p><?php echo form_submit('submit', lang('edit_user_submit_btn'),'class="btn btn-xs btn-default"'); ?></p>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="tab-pane" id="profile">...</div>
    <div class="tab-pane" id="messages">...</div>
    <div class="tab-pane" id="settings">...</div>
</div>