<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

    <?php if ($this->session->flashdata('edit2')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Ditambahkan!",
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
                                    <div class="row mb-2">
                                        <div class="col-sm-4 text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <input type="month" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                        var fileName = "Rekap Absensi " + month + "-" + year + ".xlsx";

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
                                                    case 'HS':
                                                        return 'black';
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
                                                                
                                                                // Tambahkan tombol "Edit" untuk mengedit data
                                                                echo "<td style='text-align: center; $style'>" . strtoupper($status) . " <button class='edit-button' data-nip='$nip' data-tanggal='$tanggal'><i class='fas fa-edit'></i></button></td>";
                                                            } else {
                                                                // Jika tidak ada data, tampilkan tanda '-'
                                                                echo "<td>- <button class='edit-button' data-nip='$nip' data-tanggal='$tanggal'><i class='fas fa-edit'></i></button>";

                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <script>
                                                        document.addEventListener('click', function (event) {
                                                            if (event.target.classList.contains('edit-trigger')) {
                                                                var nip = event.target.getAttribute('data-nip');
                                                                var tanggal = event.target.getAttribute('data-tanggal');

                                                                // Tampilkan formulir pengeditan di dalam elemen dengan ID edit-container
                                                                document.getElementById('edit-container').innerHTML = 
                                                                    '<form action="proses_edit_absensi.php" method="POST">' +
                                                                    '<input type="hidden" name="nip" value="' + nip + '">' +
                                                                    '<input type="hidden" name="tanggal" value="' + tanggal + '">' +
                                                                    'New Status: <input type="text" name="new_status" value=""><br>' +
                                                                    '<input type="submit" value="Edit">' +
                                                                    '</form>';
                                                            }
                                                        });
                                                    </script>


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
            <!-- Modal Edit Absensi -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Absensi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form id="editForm" method="post" action="<?=base_url();?>absensi/edit_absensi_admin">
                                <div class="form-group">
                                    <label for="status">Status Absensi</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Hadir</option>
                                        <option value="2">Cuti</option>
                                        <option value="3">Sakit</option>
                                        <option value="4">Izin</option>
                                        <option value="5">Alfa</option>
                                        <option value="6">Hadir Masuk-Pulang</option>
                                        <!-- Tambahkan pilihan status lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <input type="hidden" id="editNip" name="nip">
                                <input type="hidden" id="editTanggal" name="tanggal">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Tangani klik tombol "Edit" untuk menampilkan modal
                    document.querySelectorAll('.edit-button').forEach(function (button) {
                        button.addEventListener('click', function () {
                            var nip = button.getAttribute('data-nip');
                            var tanggal = button.getAttribute('data-tanggal');

                            document.getElementById('editNip').value = nip;
                            document.getElementById('editTanggal').value = tanggal;

                            // Tampilkan modal
                            $('#editModal').modal('show');
                        });
                    });
                });
            </script>
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