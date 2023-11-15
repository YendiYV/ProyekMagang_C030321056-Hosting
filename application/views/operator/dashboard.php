<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view("operator/components/header.php") ?>
    <style>
    .small-box {
        border: 2px solid #333; /* Warna dan ketebalan garis tepi */
    }
    /* Tampilan di perangkat seluler */
    @media (max-width: 768px) {
        .col-12 {
            padding: 0; /* Menghilangkan padding pada kolom agar tampilan lebih baik di hp */
        }
    }

    /* Tampilan di komputer (pc) */
    @media (min-width: 769px) {
        .col-12 {
            padding: 0;  /* Menghilangkan kolom di perangkat seluler */
        }
    }

</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Berhasil!",
                text: "Anda Telah Melakukan Absen Masuk!",
                icon: "success"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('input_pulang')) { ?>
        <script>
            swal({
                title: "Berhasil!",
                text: "Anda Telah Melakukan Absen Pulang!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_pulang')) { ?>
        <script>
            swal({
                title: "Peringatan!",
                text: "Anda Hanya Bisa Absen Jam  15.4--16.00 WITA!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('eror_pagi')) { ?>
        <script>
            swal({
                title: "Peringatan!",
                text: "Anda Hanya Bisa Absen Jam 08.00-08.20 !",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        <script>
            swal({
                title: "Peringatan!",
                text: "Absensi Tidak masuk!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('mencoba_akses')) { ?>
        <script>
            swal({
                title: "Peringatan!",
                text: "Anda Tidak Berhak Merubah!",
                icon: "success"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('not_found')){ ?>
    <script>
    swal({
        title: "Tidak Boleh Akses!",
        text: "Anda Tidak boleh mengajukan cuti!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png" alt="AdminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Dashboard Operator</a>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
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
                                    <h3><?= $cuti['total_cuti'] ?></h3>

                                    <p>Data Cuti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_operator/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php
                                        if ($cuti_operator == null) {
                                            echo '-';
                                        } else {
                                            $now = time(); // or your date as well
                                            $your_date = strtotime($cuti_operator[0]['berakhir']);
                                            $datediff = $your_date - $now;

                                            $date_akhir = round($datediff / (60 * 60 * 24));



                                            $now = time(); // or your date as well
                                            $your_date = strtotime($cuti_operator[0]['mulai']);
                                            $datediff = $now - $your_date;

                                            $date_mulai = round($datediff / (60 * 60 * 24));



                                            if ($date_mulai >= 0 and $date_akhir >= 0) {
                                                echo $date_akhir . ' Hari Lagi';
                                            } else {
                                                echo "Tidak Ada";
                                            }
                                        }

                                        ?></h3>

                                    <p>Sisa Cuti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_operator/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                       <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $total_cuti['total_cuti'] ?> Hari</h3>
                                    <p>Total Hari Cuti Dalam Setahun</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-plus"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_operator/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
            </section>
            <!-- /.content -->
            <br><br><br>
            <section class="content">
                <div class="col-lg-4 col-12 mx-auto"> <!-- Menerapkan mx-auto untuk rata tengah di komputer -->
                    <!-- small box -->
                    <div class="small-box bg-white with-border">
                        <div class="inner">
                            <h3>Status Absensi</h3>
                            <h5>Informasi Absen:
                                <?php if (!empty($status_absensi)): ?>
                                    <?php foreach ($status_absensi as $status): ?>
                                        <span class="<?= $status['color_class'] ?>"><?= $status['nama_status'] ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </h5>

                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <hr>
                            <?php
                            $timezone = new DateTimeZone('Asia/Makassar');
                            $datetime = new DateTime('now', $timezone);

                            // Tambahkan 5 menit dan 13 detik
                            $datetime->modify('+5 minutes +23 seconds');

                            $waktu_sekarang = $datetime->format('H:i:s');
                            $id_user = $this->session->userdata('id_user');
                            
                            $dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

                            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
                                if($waktu_sekarang >= '07:40' && $waktu_sekarang <= '08:20'){ // Keadaan Jam 7:40 - 8:20 
                                    if (isset($ketersediaan_data2) && isset($ketersediaan_data2['status_absen'])) {
                                        $status_absen = $ketersediaan_data2['status_absen'];
                                    } else {
                                        $status_absen = 0;
                                    }
                                    if ($status_absen < 1) {
                                        if ($waktu_sekarang >= '08:01' && $waktu_sekarang <= '08:20') {
                                            // Tampilkan tombol-tombol tindakan jika waktu berada dalam rentang
                                            echo '<div class="small-box-buttons text-center mt-3">
                                                <form action="' . base_url() . 'absensi/tambah_absensi_masuk" method="POST">
                                                    <input type="text" value="' . $this->session->userdata('id_user') . '" name="id_user" hidden>
                                                    <button class="btn btn-primary mx-2" type="submit" name="action" value="hadir">Hadir</button>
                                                    <button class="btn btn-danger mx-2" type="submit" name="action" value="sakit">Sakit</button>
                                                    <button class="btn btn-warning mx-2" type of="submit" name="action" value="ijin">Ijin</button>
                                                    <button class="btn btn-info mx-2" type="submit" name="action" value="cuti">Cuti</button>
                                                </form>
                                            </div>';
                                        }elseif ($waktu_sekarang >= '07:40' && $waktu_sekarang < '08:00') {
                                            echo '<h5 style="text-align: center">Tindakan Tidak Tersedia, Karna belum jam 08:00-08:20</h5>';
                                        }else{
                                            echo '<h5 style="text-align: center">Tindakan Tidak Tersedia, Karna melewati jam 08:00-08:20</h5>';
                                        }
                                    }else{
                                        echo '<h5 style="text-align: center">Anda telah melaksanakan absensi jam 08:00-08:20</h5>';
                                    }
                                }elseif($waktu_sekarang >= '08:21' && $waktu_sekarang <= '15:39'){ // Keadaan Jam 8:21 - 15:39 
                                    if (isset($ketersediaan_data2) && isset($ketersediaan_data2['status_absen'])) {
                                        $status_absen = $ketersediaan_data2['status_absen'];
                                    } else {
                                        $status_absen = 0;
                                    }
                                    
                                    if ($status_absen === '1') {
                                        echo '<h5 style="text-align: center">Tindakan Belum Tersedia, Absen akan terbuka pada jam 15:45-16:00</h5>';
                                    } elseif ($status_absen === '2') {
                                        echo '<h5 style="text-align: center">Anda tidak perlu absen pulang karena cuti</h5>';
                                    } elseif ($status_absen === '3') {
                                        echo '<h5 style="text-align: center">Anda tidak perlu absen pulang karena sakit</h5>';
                                    } elseif ($status_absen === '4') {
                                        echo '<h5 style="text-align: center">Anda tidak perlu absen pulang karena Izin</h5>';
                                    } elseif ($status_absen === '5') {
                                        echo '<h5 style="text-align: center">Anda tidak bisa absen pulang karena Alfa</h5>';
                                    } else {
                                        // Tindakan jika nilai status_absen tidak cocok dengan salah satu kondisi di atas
                                        echo '<h5 style="text-align: center">Status tidak ada</h5>';
                                    }

                                }
                                elseif($waktu_sekarang >= '15:40' && $waktu_sekarang <= '16:00'){// Keadaan Jam 15:40 - 16:00 
                                    if ($waktu_sekarang >= '15:40' && $waktu_sekarang <= '16:00') {
                                        if ($ketersediaan_data_pulang['count']  >= 1) {
                                            echo '<div class="small-box-buttons text-center mt-3">
                                                <form action="' . base_url() . 'absensi/tambah_absensi_pulang" method="POST">
                                                    <input type="text" value="' . $this->session->userdata('id_user') . '" name="id_user" hidden>
                                                    <button class="btn btn-primary mx-2" type="submit" name="action" value="pulang">Pulang</button>
                                                </form>
                                            </div>';
                                        } else {
                                            echo '<h5 style="text-align: center">Tindakan Tidak Tersedia, Karna Anda Telah Absensi Pulang</h5>';
                                        }
                                    }elseif ($waktu_sekarang > '16:00' && $waktu_sekarang <= '16:30'){
                                        echo '<h5 style="text-align: center">Tindakan Tidak Tersedia , Karna Telah Melewati jam 15:40-16.00</h5>';
                                    }else {
                                        echo '<h5 style="text-align: center">Tindakan Tidak Tersedia, Karna belum jam 15:40-16.00</h5>';
                                    }
                                }
                                else{
                                    echo '<h5 style="text-align: center">Tindakan Tidak Tersedia</h5>';
                                }
                            }else {
                                echo '<h5 style="text-align: center">Tindakan Tidak Tersedia pada Hari Sabtu dan Minggu</h5>';
                            }
                            ?>
                        <br>
                    </div>
                </div>
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
