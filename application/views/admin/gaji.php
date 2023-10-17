<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.13/xlsx.full.min.js"></script>
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
                            <h1 class="m-0">Data THP Operator</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Gaji</li>
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
                                    <h3 class="card-title">Data THP Operator</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-6 text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    document.getElementById("exportButton").addEventListener("click", function () {
                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example1");

                                        // Mengekstrak data uang dari tabel
                                        var monetaryData = [];
                                        var rows = table.getElementsByTagName('tr');
                                        for (var i = 1; i < rows.length; i++) {  // Mulai dari 1 untuk menghindari header
                                            var cells = rows[i].getElementsByTagName('td');  // Sesuaikan ini sesuai dengan struktur tabel Anda
                                            var monetaryValue = cells[1].innerText;  // Menggunakan innerText
                                            monetaryData.push(monetaryValue);
                                        }

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Menyertakan data uang ke dalam objek buku Excel
                                        wb.Sheets[wb.SheetNames[0]]['A2'] = { t: 's', v: 'Total Uang' };
                                        wb.Sheets[wb.SheetNames[0]]['B2'] = { t: 's', v: monetaryData.join(', ') };

                                        // Membuat file Excel dan mengunduhnya
                                        XLSX.writeFile(wb, "Rekap Gaji.xlsx");
                                    });
                                    </script>
                                    <form action="<?= base_url('gaji/save_total_per_orang') ?>" method="post">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Gaji UMK/UMP</th>
                                                    <th>Gaji Jabatan</th>
                                                    <th>Gaji Proyek</th>
                                                    <th>TMK</th>
                                                    <th>BPK</th>
                                                    <th>Delta</th> 
                                                    <th>Transport</th> 
                                                    <th>Total / Orang</th>              
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 0;

                                                    $total_operator_level = 0;
                                                    $total_nama_proyek = 0;
                                                    $total_penempatan = 0;
                                                    $total_tahun_tmk = 0;
                                                    $total_status_bpk = 0;
                                                    $total_status_delta = 0;
                                                    $total_transport = 0;
                                                    $total_semua = 0;

                                                    foreach ($operator as $i) :
                                                        $no++;
                                                        $username = $i['username'];
                                                        $nama_lengkap = $i['nama_lengkap'];
                                                        $penempatan = $i['gaji_penempatan'];
                                                        $nama_proyek = $i['gaji_proyek'];
                                                        $operator_level = $i['gaji_level'];
                                                        $tahun_tmk = $i['rupiah_tmk'];
                                                        $status_bpk = $i['gaji_bpk'];
                                                        $status_delta = $i['gaji_delta'];
                                                        $transport = $i['tunjangan_transport'];

                                                        // Hitung total gaji per orang
                                                        $total_operator_level += $operator_level;
                                                        $total_nama_proyek += $nama_proyek;
                                                        $total_penempatan += $penempatan;
                                                        $total_tahun_tmk += $tahun_tmk;
                                                        $total_status_bpk += $status_bpk;
                                                        $total_status_delta += $status_delta;
                                                        $total_transport+= $transport;

                                                        $total_per_orang = $operator_level + $nama_proyek + $penempatan + $tahun_tmk + $status_bpk + $status_delta + $transport;

                                                        ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $username ?></td>
                                                            <td><?= $nama_lengkap ?></td>
                                                            <td><?= "Rp. " . number_format($penempatan, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($operator_level, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($nama_proyek, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($tahun_tmk, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($status_bpk, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($status_delta, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($transport, 0, ',', '.') ?></td>
                                                            <td>
                                                                <span style="font-weight: bold;" id="total_per_orang_<?= $username ?>">
                                                                    <?= "Rp. " . number_format($total_per_orang, 0, ',', '.') ?>
                                                                </span>
                                                                <input type="hidden" name="username[]" value="<?= $username?>">
                                                                <input type="hidden" name="total_per_orang[]" value="<?= $total_per_orang ?>">
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    <tr style="font-weight: bold;">
                                                        <td colspan="3" style="text-align: center; font-weight: bold;">Total Menyeluruh</td>
                                                        <td><?= number_format($total_penempatan, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_operator_level, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_nama_proyek, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_tahun_tmk, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_status_bpk, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_status_delta, 0, '', '.') ?></td>
                                                        <td><?= number_format($total_transport, 0, '', '.') ?></td>
                                                        <?php
                                                        $total_semua = $total_operator_level + $total_nama_proyek + $total_penempatan + $total_tahun_tmk + $total_status_bpk + $total_status_delta+$total_transport;
                                                        $formatted_total = "Rp. " . number_format($total_semua, 0, '', '.');
                                                        ?>
                                                        <td><?= $formatted_total ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12">
                                                            <button type="submit" class="btn btn-primary">Simpan Semua</button>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </form>
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
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("admin/components/js.php"); ?>
</body>
</html>