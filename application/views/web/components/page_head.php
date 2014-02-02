<div class="container">
    <div class="row">
        <div class="col-lg-8 logo">
            <a href="index.html">
                <div class="row">
                    <div class="col-lg-12 logo">
                        <h1><?php echo getOptions('company_name'); ?></h1>
                        <p>★★★★☆</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 pull-right">
            <br>
            <h4>Customer service: <?php echo getOptions('company_number'); ?></h4>
            <address><small><?php echo getOptions('company_address'); ?></small></address>
        </div>
    </div>
    <div class="row">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                <?php echo get_menu(menu()); ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$this->ion_auth->logged_in()): ?>
                        <li><a href="<?php echo site_url('users/register'); ?>">Sign Up</a></li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo form_open('users/login', 'class="form" id="login-nav"'); ?>
                                            <div class="form-group col-md-12">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" name="identity" class="form-control input-sm" id="exampleInputEmail2" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" name="password" class="form-control input-sm" id="exampleInputPassword2" placeholder="Password" required>
                                            </div>
                                            <div class="checkbox">
                                                <label style="color:whitesmoke">
                                                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                                                    Remember Me
                                                    <p><small><a href="<?php echo site_url('users/forgot_password'); ?>"><?php echo lang('login_forgot_password'); ?></a></small></p>
                                                </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                              
                                                <button type="submit" class="btn btn-success btn-block btn-xs">Sign in</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome<?php echo ' ' . ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url("users/edit_user/" . $this->session->userdata('user_id')); ?>"><i class="fa fa-user"></i> Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('users/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
</div>
<script>
    $(document).ready(function() {
        //Handles menu drop down
        $('.dropdown-menu').find('form').click(function(e) {
            e.stopPropagation();
        });
    });
</script>