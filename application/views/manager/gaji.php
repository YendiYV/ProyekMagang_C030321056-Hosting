<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
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
                            <h1 class="m-0">Data THP Operator</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Manager</li>
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
                                <div class="card-body" style="overflow-x:auto;">
                                     <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap Total Gaji</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    document.getElementById("exportButton").addEventListener("click", function() {
                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example1");

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Mendapatkan tanggal saat ini
                                        var currentDate = new Date();
                                        var year = currentDate.getFullYear();
                                        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Bulan (01-12)
                                        var day = currentDate.getDate().toString().padStart(2, '0'); // Hari (01-31)

                                        // Membuat format nama file dengan tanggal saat ini
                                        var fileName = "Rekap Total Gaji - " + day + "-" + month + "-" + year + ".xlsx";

                                        // Membuat file Excel dan mengunduhnya dengan nama yang sudah dibuat
                                        XLSX.writeFile(wb, fileName);
                                    });
                                    </script>
                                    <hr>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="17">Total Gaji</th>
                                            </tr>
                                            <tr class="header-row"> 
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama Lengkap</th>
                                                <th>Gaji UMK/UMP</th>
                                                <th>TMK</th>
                                                <th style="background-color: #80ff80;">UPOK</th>
                                                <th>Gaji Jabatan</th>
                                                <th>Gaji Proyek</th>
                                                <th>BPK</th>
                                                <th>Delta</th> 
                                                <th>Transport</th>
                                                <th>Komunikasi</th>  
                                                <th>Uang Hadir</th>  
                                                <th>Kontribusi</th>
                                                <th>Insentif</th>
                                                <th>Insfeksi(Opsional)</th>
                                                <th style="background-color: #33bbff;">Total Bersih / Orang</th>               
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
                                                $total_komunikasi = 0;
                                                $total_uang_hadir = 0;
                                                $total_kontribusi = 0;
                                                $total_insentif = 0;
                                                $total_insfeksi = 0;
                                                $upok=0;
                                                $total_upok=0;
                                                $total_semua = 0;

                                                foreach ($operator as $i) :
                                                    $no++;
                                                    $username = $i['username'];
                                                    $id_user_detail= $i['id_user_detail'];
                                                    $nama_lengkap = $i['nama_lengkap'];
                                                    $penempatan = $i['gaji_penempatan'];
                                                    $nama_proyek = $i['gaji_proyek'];
                                                    $operator_level = $i['gaji_level'];
                                                    $tahun_tmk = $i['rupiah_tmk'];
                                                    $status_bpk = $i['gaji_bpk'];
                                                    $transport = $i['tunjangan_transport'];
                                                    $total_gaji = $i['total_gaji'];
                                                    $komunikasi= $i['tunjangan_komunikasi'];
                                                    $uang_hadir= $i['tunjangan_uang_hadir'];
                                                    $kontribusi = $i['tunjangan_kontribusi'];
                                                    $insentif = $i['tunjangan_insentif'];
                                                    $insfeksi =$i['gaji_insfeksi'];
                                                    $upok = ($penempatan + $tahun_tmk) * 0.04;
                                                    $status_delta = $total_gaji-($penempatan + $status_bpk + $tahun_tmk - $upok);
                                                    if($status_delta <0){
                                                        $status_delta =0;
                                                    }
                                                    // Hitung total gaji per orang
                                                    $total_operator_level += $operator_level;
                                                    $total_nama_proyek += $nama_proyek;
                                                    $total_penempatan += $penempatan;
                                                    $total_tahun_tmk += $tahun_tmk;
                                                    $total_status_bpk += $status_bpk;
                                                    $total_status_delta += $status_delta;
                                                    $total_transport+= $transport;
                                                    $total_komunikasi+= $komunikasi;
                                                    $total_uang_hadir+= $uang_hadir;
                                                    $total_kontribusi+= $kontribusi;
                                                    $total_insentif+= $insentif;
                                                    $total_insfeksi +=$insfeksi;
                                                    $total_upok += $upok;
                                                    $total_gaji_sekarang = $penempatan + $status_bpk + $tahun_tmk - $upok;

                                                    $total_per_orang = $operator_level + $nama_proyek +$penempatan + $tahun_tmk+ $status_bpk + $status_delta + $transport+$komunikasi+ $uang_hadir + $kontribusi + $insentif + $insfeksi - $upok;
                                                    $total_semua += $total_per_orang;
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $username ?></td>
                                                            <td><?= $nama_lengkap ?></td>
                                                            <td><?= "Rp. " . number_format($penempatan, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($tahun_tmk, 0, ',', '.') ?></td>
                                                            <td style="background-color: #80ff80;"><?= "Rp. " .number_format($total_upok, 0, '', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($operator_level, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($nama_proyek, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($status_bpk, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($status_delta, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($transport, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($komunikasi, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($uang_hadir, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($kontribusi, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($insentif, 0, ',', '.') ?></td>
                                                            <td><?= "Rp. " . number_format($insfeksi, 0, ',', '.') ?></td>
                                                            <td style="background-color: <?= ($total_per_orang == 0) ? '#ff0000' : '#33bbff'; ?>">
                                                                <span style="font-weight: bold;" id="total_per_orang_<?= $username ?>">
                                                                    <?= "Rp. " . number_format($total_per_orang, 0, ',', '.') ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                <?php endforeach; ?>
                                                <tr style="font-weight: bold;">
                                                    <td colspan="3" style="text-align: center; font-weight: bold;">Total Menyeluruh</td>
                                                    <td><?= "Rp. " .number_format($total_penempatan, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_tahun_tmk, 0, '', '.') ?></td>
                                                    <td style="background-color: #80ff80;"><?= "Rp. " .number_format($total_upok, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_operator_level, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_nama_proyek, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_status_bpk, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_status_delta, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_transport, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_komunikasi, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_uang_hadir, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_kontribusi, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_insentif, 0, '', '.') ?></td>
                                                    <td><?= "Rp. " .number_format($total_insfeksi, 0, '', '.') ?></td>
                                                    <?php
                                                    $formatted_total = "Rp. " . number_format($total_semua, 0, '', '.');
                                                    ?>
                                                    <td style="background-color: #33bbff;"><?= $formatted_total ?></td>
                                                </tr>
                                        </tbody>

                                    </table>
                                    <br>
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
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Baru THP Operator </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="overflow-x:auto;">
                                <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <button type="button" class="btn btn-primary" id="exportButton2">Cetak Rekap Operator Baru</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    document.getElementById("exportButton2").addEventListener("click", function() {
                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example2");

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Mendapatkan tanggal saat ini
                                        var currentDate = new Date();
                                        var year = currentDate.getFullYear();
                                        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Bulan (01-12)
                                        var day = currentDate.getDate().toString().padStart(2, '0'); // Hari (01-31)

                                        // Membuat format nama file dengan tanggal saat ini
                                        var fileName = "Rekap Total Gaji Operator Baru - " + day + "-" + month + "-" + year + ".xlsx";

                                        // Membuat file Excel dan mengunduhnya dengan nama yang sudah dibuat
                                        XLSX.writeFile(wb, fileName);
                                    });
                                    </script>
                                    <hr>
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="17">Total Gaji Baru</th>
                                                </tr>
                                                <tr class="header-row"> 
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Gaji UMK/UMP</th>
                                                    <th>TMK</th>
                                                    <th style="background-color: #80ff80;">UPOK</th>
                                                    <th>Gaji Jabatan</th>
                                                    <th>Gaji Proyek</th>
                                                    <th>BPK</th>
                                                    <th>Delta</th> 
                                                    <th>Transport</th>
                                                    <th>Komunikasi</th>  
                                                    <th>Uang Hadir</th>  
                                                    <th>Kontribusi</th>
                                                    <th>Insentif</th> 
                                                    <th>Insfeksi(Opsional)</th>
                                                    <th style="background-color: #33bbff;">Total Bersih / Orang</th>            
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
                                                    $total_komunikasi = 0;
                                                    $total_uang_hadir = 0;
                                                    $total_kontribusi = 0;
                                                    $total_insentif = 0;
                                                    $total_insfeksi = 0;
                                                    
                                                    $upok=0;
                                                    $total_upok=0;
                                                    $total_semua = 0;
                                                    foreach ($operator2 as $a) :
                                                        $no++;
                                                        $username = $a['username'];
                                                        $id_user_detail = $a['id_user_detail'];
                                                        $nama_lengkap = $a['nama_lengkap'];
                                                        $penempatan = $a['gaji_penempatan'];
                                                        $nama_proyek = $a['gaji_proyek'];
                                                        $operator_level = $a['gaji_level'];
                                                        $tahun_tmk = $a['rupiah_tmk'];
                                                        $status_bpk = $a['gaji_bpk'];
                                                        $transport = $a['tunjangan_transport'];
                                                        $komunikasi= $a['tunjangan_komunikasi'];
                                                        $uang_hadir= $a['tunjangan_uang_hadir'];
                                                        $kontribusi = $a['tunjangan_kontribusi'];
                                                        $insentif = $a['tunjangan_insentif'];
                                                        $insfeksi =$a['gaji_insfeksi'];
                                                        $upok = ($penempatan + $tahun_tmk) * 0.04;
                                                        $status_delta = $a['gaji_delta'];
                                                        // Hitung total gaji per orang
                                                        $total_operator_level += $operator_level;
                                                        $total_nama_proyek += $nama_proyek;
                                                        $total_penempatan += $penempatan;
                                                        $total_tahun_tmk += $tahun_tmk;
                                                        $total_status_bpk += $status_bpk;
                                                        $total_status_delta += $status_delta;
                                                        $total_transport+= $transport;
                                                        $total_komunikasi+= $komunikasi;
                                                        $total_uang_hadir+= $uang_hadir;
                                                        $total_kontribusi+= $kontribusi;
                                                        $total_insentif+= $insentif;
                                                        $total_insfeksi += $insfeksi;
                                                        $total_upok += $upok;

                                                        $total_per_orang = $operator_level + $nama_proyek +$penempatan + $tahun_tmk+ $status_bpk + $status_delta + $transport+ $komunikasi + $uang_hadir + $kontribusi + $insentif + $insfeksi- $upok;
                                                        $total_semua += $total_per_orang;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $username ?></td>
                                                                <td><?= $nama_lengkap ?></td>
                                                                <td><?= "Rp. " . number_format($penempatan, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($tahun_tmk, 0, ',', '.') ?></td>
                                                                <td style="background-color: #80ff80;"><?= "Rp. " .number_format($total_upok, 0, '', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($operator_level, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($nama_proyek, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_bpk, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_delta, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($transport, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($komunikasi, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($uang_hadir, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($kontribusi, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($insentif, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($insfeksi, 0, ',', '.') ?></td>
                                                                <td style="background-color: <?= ($total_per_orang == 0) ? '#ff0000' : '#33bbff'; ?>">
                                                                    <span style="font-weight: bold;" id="total_per_orang_<?= $username ?>">
                                                                        <?= "Rp. " . number_format($total_per_orang, 0, ',', '.') ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                    <?php endforeach; ?>
                                                    <tr style="font-weight: bold;">
                                                        <td colspan="3" style="text-align: center; font-weight: bold;">Total Menyeluruh</td>
                                                        <td><?= "Rp. " .number_format($total_penempatan, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_tahun_tmk, 0, '', '.') ?></td>
                                                        <td style="background-color: #80ff80;"><?= "Rp. " .number_format($total_upok, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_operator_level, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_nama_proyek, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_status_bpk, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_status_delta, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_transport, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_komunikasi, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_uang_hadir, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_kontribusi, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_insentif, 0, '', '.') ?></td>
                                                        <td><?= "Rp. " .number_format($total_insfeksi, 0, '', '.') ?></td>
                                                        <?php
                                                        $formatted_total = "Rp. " . number_format($total_semua, 0, '', '.');
                                                        ?>
                                                        <td style="background-color: #33bbff;"><?= $formatted_total ?></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    <br>
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

    <?php $this->load->view("manager/components/js.php"); ?>
</body>
</html>