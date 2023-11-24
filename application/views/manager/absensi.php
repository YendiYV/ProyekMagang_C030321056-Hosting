<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("manager/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("manager/components/sidebar.php") ?>

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
                                <li class="breadcrumb-item"></a>Manager</li>
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
                                    
                                        <div class="row mb-2">
                                            <!-- "Cetak Rekap" button -->
                                            <div class="col-sm-1 text-sm-right">
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group" role="group" aria-label="Cetak Options">
                                                        <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- "Bulan" input -->
                                            <div class="col-lg-2 text-lg-right">
                                                <form action="<?= base_url() ?>Absensi/view_manager" method="GET">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="cari_bulan">Bulan</label>
                                                        </div>
                                                        <input type="month" id="cari_bulan" name="cari_bulan" class="form-control">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary">Cari</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <hr>
                                    <br>
                                    <script>
                                    document.getElementById("exportButton").addEventListener("click", function() {
                                        // Mendapatkan tanggal saat tombol ditekan
                                        var currentDate = new Date();

                                        // Mengambil bulan dalam format dua digit (01, 02, ..., 12)
                                        var month = String(currentDate.getMonth() + 1).padStart(2, '0');

                                        // Mengambil tahun empat digit (contoh: 2023)
                                        var year = currentDate.getFullYear();

                                        // Menggabungkan bulan dan tahun ke dalam nama file
                                        var fileName = "Rekap Absensi Bulan-" + month + "-" + year + ".xlsx";

                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example1");

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Membuat file Excel dan mengunduhnya dengan nama file yang telah dibuat
                                        XLSX.writeFile(wb, fileName);
                                    });

                                    </script>    
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="font-size: 20px;">
                                                <th>Nama Pegawai</th>
                                                <th>NIP Pegawai</th>
                                                <?php
                                                $cari_bulan = $this->input->get('cari_bulan');

                                                // Set nilai default jika tidak ada input dari formulir
                                                $bulan_ini = ($cari_bulan) ? date('m', strtotime($cari_bulan)) : date('m');
                                                $tahun_ini = ($cari_bulan) ? date('Y', strtotime($cari_bulan)) : date('Y');

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
                                                    case 'HS':
                                                        return 'black';
                                                    case 'A':
                                                        return 'red';
                                                    default:
                                                        return 'black';

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
                                                                
                                                               
                                                                echo "<td style='text-align: center; $style'>" . strtoupper($status) ."</td>";
                                                            } else {
                                                                // Jika tidak ada data, tampilkan tanda '-'
                                                                echo "<td>- ";

                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <div id="edit-container">
                                                        <!-- Editing form or modal content goes here -->
                                                    </div>
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
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("manager/components/js.php") ?>
</body>
</html>