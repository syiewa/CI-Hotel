<div class="container noPrint">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url('index.php/dashboard'); ?>"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
                <li class="dropdown"><a href="arnosa.net" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span>Entry Data<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/admin/kelas/'); ?>">Data Class Room Hotel</a></li>
                        <li><a href="<?php echo base_url('index.php/admin/rooms'); ?>">Data Kamar</a></li>
                        <li><a href="<?php echo base_url('index.php/admin/promo'); ?>">Data Promo</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('admin/news'); ?>">Data News/Article</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url('index.php/pelatihan'); ?>"><span class="glyphicon glyphicon-book"></span>Data Pelatihan</a></li>
                <li><a href="<?php echo base_url('index.php/k_jabatan'); ?>"><span class="glyphicon glyphicon-arrow-up"></span>Data Kenaikan Jabatan</a></li>
                <li class="dropdown"><a href="arnosa.net" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span>Laporan<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/pegawai/cetak'); ?>" target="_blank" >Laporan Data Pegawai</a></li>
                        <li><a href="<?php echo base_url('index.php/dashboard/absen_periode'); ?>" >Laporan Data Absensi</a></li>
                        <li><a href="<?php echo base_url('index.php/pelatihan/cetak'); ?>" target="_blank">Laporan Data Pelatihan</a></li>
                        <li><a href="<?php echo base_url('index.php/k_jabatan/cetak'); ?>" target="_blank">Laporan Data Kenaikan Pangkat</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span>Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/login/logout'); ?>"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>
