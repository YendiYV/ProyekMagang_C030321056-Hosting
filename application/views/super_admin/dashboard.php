<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("super_admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="adminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("super_admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("super_admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard-Supervisior</a>
							</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?=$cuti['total_cuti']?></h3>

                                    <p>Data Cuti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a href="<?=base_url();?>Cuti/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?=$cuti_acc['total_cuti']?></h3>

                                    <p>Data Cuti Diterima</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-round"></i>
                                </div>
                                <a href="<?=base_url();?>Cuti/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?=$cuti_reject['total_cuti']?></h3>

                                    <p>Data Cuti Ditolak</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-close-round"></i>
                                </div>
                                <a href="<?=base_url();?>Cuti/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?=$cuti_confirm['total_cuti']?></h3>

                                    <p>Data Cuti Tertunda</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-loop"></i>
                                </div>
                                <a href="<?=base_url();?>Cuti/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?=$proyek['total_proyek']?></h3>

                                    <p>Total Proyek</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-settings"></i>
                                </div>
                                <a href="<?=base_url();?>proyek/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?=$jabatan['total_jabatan']?></h3>
                                    <p>Total Jabatan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-briefcase"></i>
                                </div>
                                <a href="<?=base_url();?>jabatan/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?=$penempatan['total_penempatan']?></h3>

                                    <p>Total Penempatan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-location"></i>
                                </div>
                                <a href="<?=base_url();?>penempatan/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?=$operator['total_user']?></h3>

                                    <p>Total Operator</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker"></i>
                                </div>
                                <a href="<?=base_url();?>operator/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?=$tmk['total_tmk']?></h3>

                                    <p>Data TMK</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?=base_url();?>BPK/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?=$bpk['total_bpk']?></h3>

                                    <p>Data BPK</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-card"></i>
                                </div>
                                <a href="<?=base_url();?>BPK/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?=$delta['total_delta']?></h3>

                                    <p>Data Delta</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <a href="<?=base_url();?>Delta/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?=$rgaji['total_rgaji']?></h3>

                                    <p>Total Rekap THP</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cash"></i>
                                </div>
                                <a href="<?=base_url();?>rgaji/view_admin" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?=$rgaji_bulan_ini['total_data_gaji']?>/<?=$operator['total_user']?></h3>
                                    <p class="m-0"><b>Monitor Data</b></p>
                                    <p class="m-0">Rekap THP / Pekerja</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-monitor"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("super_admin/components/js.php") ?>
</body>

</html>
