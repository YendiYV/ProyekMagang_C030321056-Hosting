<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Ditambahkan!",
        icon: "error"
    });
    </script>
    <?php } ?>
    
    <?php if ($this->session->flashdata('erorpass')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Password Salah!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Dihapus !",
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
        <?php $this->load->view("admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Absensi Operator</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin</li>
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
                                        <thead>
                                            <tr style="font-size: 20px;">
                                                <th>Nama Pegawai</th>
                                                <th>NIP Pegawai</th>
                                                <?php
                                                $bulan_ini = date('m');
                                                $tahun_ini = date('Y');
                                                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);

                                                for ($day = 1; $day <= $jumlah_hari; $day++) {
                                                    // Periksa apakah hari ini adalah Sabtu (6) atau Minggu (0)
                                                    $dayOfWeek = date('w', strtotime("$tahun_ini-$bulan_ini-$day"));

                                                    // Beri warna merah jika Sabtu atau Minggu, jika tidak, beri warna hitam
                                                    $cellColor = ($dayOfWeek == 0 || $dayOfWeek == 6) ? 'red' : 'black';

                                                    echo "<th style='color: $cellColor;'>$day</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uniqueNIPs = array(); // Array untuk melacak NIP yang telah ditampilkan

                                            // Fungsi untuk menentukan warna berdasarkan status
                                            function getStatusColor($status) {
                                                switch ($status) {
                                                    case 'H':
                                                        return 'black';
                                                    case 'C':
                                                        return 'blue';
                                                    case 'S':
                                                        return 'brown';
                                                    case 'I':
                                                        return 'purple';
                                                    default:
                                                        return 'red';

                                                }
                                            }

                                            foreach ($absensi as $pegawai):
                                                $nip = $pegawai['nip'];
                                                if (!in_array($nip, $uniqueNIPs)):
                                                    $uniqueNIPs[] = $nip; // Tambahkan NIP ke daftar yang telah ditampilkan
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $pegawai['nama_lengkap']; ?></td>
                                                        <td><?php echo $nip; ?></td>
                                                        <?php
                                                        for ($day = 1; $day <= $jumlah_hari; $day++) {
                                                            $tanggal = "$tahun_ini-$bulan_ini-" . str_pad($day, 2, '0', STR_PAD_LEFT); // Format tanggal

                                                            // Periksa apakah ada data absensi untuk tanggal ini
                                                            if (array_key_exists($tanggal, $data_absensi) && array_key_exists($nip, $data_absensi[$tanggal])) {
                                                                $status = $data_absensi[$tanggal][$nip];
                                                                $style = "color: " . getStatusColor($status) . "; font-size: 18px;";
                                                                
                                                                // Cek jika hari ini adalah Sabtu (6) atau Minggu (0)
                                                                if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                                                                    // Hari Minggu atau Sabtu, berikan warna khusus
                                                                    $style .= " background-color: yellow;"; // Contoh warna latar belakang kuning
                                                                }
                                                                
                                                                echo "<td style='" . $style . "'>" . strtoupper($status) . "</td>";
                                                            } else {
                                                                // Jika tidak ada data, tampilkan tanda '-'
                                                                echo "<td>-</td>";
                                                            }
                                                        }


                                                        ?>
                                                    </tr>
                                            <?php
                                            endif;
                                            endforeach;
                                            ?>
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
            <!-- Modal Tambah operator -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Proyek</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>proyek/tambah_proyek" method="POST">
                                <div class="form-group">
                                    <label for="nama_proyek">Nama Proyek</label>
                                    <input type="text" class="form-control" id="nama_proyek"
                                        aria-describedby="nama_proyek" name="nama_proyek" required>
                                </div>
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" id="gaji" name="gaji">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("admin/components/js.php") ?>
</body>
</html>