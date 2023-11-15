<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
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
    
    <?php if ($this->session->flashdata('input_baru')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Baru Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_baru')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Baru Gagal Ditambahkan!",
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
                                <li class="breadcrumb-item"></a>Admin</li>
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
                                    <form action="<?= base_url('gaji/save_total_semua') ?>" method="post">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="12">Total Gaji</th>
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
                                                    $upok=0;
                                                    $total_upok=0;
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
                                                        $transport = $i['tunjangan_transport'];
                                                        $total_gaji = $i['total_gaji'];
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
                                                        $total_upok += $upok;
                                                        $total_gaji_sekarang = $penempatan + $status_bpk + $tahun_tmk - $upok;

                                                        $total_per_orang = $operator_level + $nama_proyek +$penempatan + $tahun_tmk+ $status_bpk + $status_delta + $transport- $upok;
                                                        $total_semua += $total_per_orang;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $username ?></td>
                                                                <td><?= $nama_lengkap ?></td>
                                                                <td><?= "Rp. " . number_format($penempatan, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($tahun_tmk, 0, ',', '.') ?></td>
                                                                <td style="background-color: #80ff80;"><?= "Rp. " . number_format($upok, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($operator_level, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($nama_proyek, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_bpk, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_delta, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($transport, 0, ',', '.') ?></td>
                                                                <td style="background-color: #33bbff;">
                                                                    <span style="font-weight: bold;" id="total_per_orang_<?= $username ?>">
                                                                        <?= "Rp. " . number_format($total_per_orang, 0, ',', '.') ?>
                                                                    </span>
                                                                    <?php
                                                                    $tanggal_hari_ini = date('Y-m-d');
                                                                    ?>
                                                                    <input type="date" name="tanggal_input[]" value="<?= $tanggal_hari_ini; ?>" style="display: none;">
                                                                    <input type="hidden" name="username[]" value="<?= $username?>">
                                                                    <input type="hidden" name="total_per_orang[]" value="<?= $total_per_orang ?>">
                                                                </td>
                                                                <td style="display: none;">
                                                                    <input type="date" name="gaji_bulan[]" value="<?= date('Y-m-01'); ?>" min="<?= date('2000-m-01'); ?>" max="<?= date('Y-m-1'); ?>" style="display: none;" />
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
                                                        <?php
                                                        $formatted_total = "Rp. " . number_format($total_semua, 0, '', '.');
                                                        ?>
                                                        <td style="background-color: #33bbff;"><?= $formatted_total ?></td>
                                                    </tr>
                                            </tbody>

                                        </table>
                                        <button type="submit" class="btn btn-primary">Simpan Semua</button>
                                    </form>
                                    <br>
                                    <hr>
                                    <br>
                                    <form action="<?= base_url('gaji/save_total_semua_baru') ?>" method="post">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="12">Total Gaji Baru</th>
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
                                                    $upok=0;
                                                    $total_upok=0;
                                                    $total_semua = 0;

                                                    foreach ($operator2 as $a) :
                                                        $no++;
                                                        $username = $a['username'];
                                                        $nama_lengkap = $a['nama_lengkap'];
                                                        $penempatan = $a['gaji_penempatan'];
                                                        $nama_proyek = $a['gaji_proyek'];
                                                        $operator_level = $a['gaji_level'];
                                                        $tahun_tmk = $a['rupiah_tmk'];
                                                        $status_bpk = $a['gaji_bpk'];
                                                        $transport = $a['tunjangan_transport'];
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
                                                        $total_upok += $upok;

                                                        $total_per_orang = $operator_level + $nama_proyek +$penempatan + $tahun_tmk+ $status_bpk + $status_delta + $transport- $upok;
                                                        $total_semua += $total_per_orang;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $username ?></td>
                                                                <td><?= $nama_lengkap ?></td>
                                                                <td><?= "Rp. " . number_format($penempatan, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($tahun_tmk, 0, ',', '.') ?></td>
                                                                <td style="background-color: #80ff80;"><?= "Rp. " . number_format($upok, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($operator_level, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($nama_proyek, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_bpk, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($status_delta, 0, ',', '.') ?></td>
                                                                <td><?= "Rp. " . number_format($transport, 0, ',', '.') ?></td>
                                                                <td style="background-color: #33bbff;">
                                                                    <span style="font-weight: bold;" id="total_per_orang_<?= $username ?>">
                                                                        <?= "Rp. " . number_format($total_per_orang, 0, ',', '.') ?>
                                                                    </span>
                                                                    <?php
                                                                    $tanggal_hari_ini = date('Y-m-d');
                                                                    ?>
                                                                    <input type="date" name="tanggal_input2[]" value="<?= $tanggal_hari_ini; ?>" style="display: none;">
                                                                    <input type="hidden" name="username2[]" value="<?= $username?>">
                                                                    <input type="hidden" name="total_per_orang2[]" value="<?= $total_per_orang ?>">
                                                                </td>
                                                                <td style="display: none;">
                                                                    <input type="date" name="gaji_bulan2[]" value="<?= date('Y-m-01'); ?>" min="<?= date('2000-m-01'); ?>" max="<?= date('Y-m-1'); ?>" style="display: none;" />
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
                                                        <?php
                                                        $formatted_total = "Rp. " . number_format($total_semua, 0, '', '.');
                                                        ?>
                                                        <td style="background-color: #33bbff;"><?= $formatted_total ?></td>
                                                    </tr>
                                            </tbody>

                                        </table>
                                        <button type="submit" class="btn btn-primary">Simpan Semua</button>
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