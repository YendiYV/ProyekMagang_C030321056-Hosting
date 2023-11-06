<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('masuk')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Anda Telah Melakukan Absen Masuk!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('gagal_masuk')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Anda Gagal Melakukan Absen Masuk!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('pulang')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Anda Telah Melakukan Absen Pulang!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('gagal_pulang')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Anda Gagal Melakukan Absen Pulang!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("operator/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("operator/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Absensi Operator</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Absensi</li>
                            </ol>
                        </div><!-- /.col -->
                        <br>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Absensi</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php
                                                $bulan_ini = date('m');
                                                $tahun_ini = date('Y');
                                                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);
                                        ?>
                                        <thead>
                                            <tr>
                                                <td colspan="<?php echo $jumlah_hari; ?>" style="text-align: center; font-size: 20px; font-weight: bold;">
                                                    Data Absensi Bulan <?php echo $bulan_ini; ?> Tahun <?php echo $tahun_ini; ?>
                                                </td>
                                            </tr>
                                            <tr style="font-size: 20px;">
                                                <?php
                                                $bulan_ini = date('m');
                                                $tahun_ini = date('Y');
                                                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);

                                                for ($day = 1; $day <= $jumlah_hari; $day++) {
                                                    // Periksa apakah hari ini adalah Sabtu (6) atau Minggu (0)
                                                    $dayOfWeek = date('w', strtotime("$tahun_ini-$bulan_ini-$day"));

                                                    // Beri warna merah jika Sabtu atau Minggu, jika tidak, beri warna hitam
                                                    $cellColor = ($dayOfWeek == 0 || $dayOfWeek == 6) ? 'red' : 'black';

                                                    // Tambahkan atribut aria-controls untuk menghilangkan opsi filtering
                                                    echo "<th style='color: $cellColor;' class='no-sort'>$day</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            // Fungsi untuk menentukan warna berdasarkan status
                                            function getStatusColor($status) {
                                                switch ($status) {
                                                    case 'H':
                                                        return 'black';
                                                    case 'Cuti':
                                                        return 'blue';
                                                    case 'S':
                                                        return 'brown';
                                                    case 'I':
                                                        return 'purple';
                                                    default:
                                                        return 'red';

                                                }
                                            }
                                            ?>
                                            <tr>
                                               <?php
                                                // Loop through each date
                                                for ($day = 1; $day <= $jumlah_hari; $day++) {
                                                    $tanggal = "$tahun_ini-$bulan_ini-" . str_pad($day, 2, '0', STR_PAD_LEFT); // Format tanggal
                                                    $status = isset($absensi[$tanggal]) ? $absensi[$tanggal] : '-';
                                                    
                                                    // Ensure $status is a string
                                                    if (is_array($status)) {
                                                        $status = implode(", ", $status); // Convert array elements to a comma-separated string
                                                    }
                                                    
                                                    $cellColor = ($status == '-') ? 'black' : getStatusColor($status);
                                                    echo "<td style='color: $cellColor; font-size: 18px;'><img src='" . getStatusColor($status) . "' alt='$status' /></td>";
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
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

    <?php $this->load->view("operator/components/js.php") ?>
</body>
</html>