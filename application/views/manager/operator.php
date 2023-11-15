<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
    <style>
        .responsive-table {
            width: 100%;
            max-width: 100%;
            table-layout: auto;
        }
        @media screen and (max-width: 768px) {
            /* Aturan CSS untuk layar yang lebih kecil */
            .responsive-table {
                font-size: 14px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="adminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Data Operator</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Manajer</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Operator</li>
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
                                    <h3 class="card-title">Data Operator</h3>
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
                                    document.getElementById("exportButton").addEventListener("click", function() {
                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example1");

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Membuat file Excel dan mengunduhnya
                                        XLSX.writeFile(wb, "Rekap Data Operator.xlsx");
                                    });
                                    </script>
                                    <hr>
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama Lengkap</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telp</th>
                                                <th>Alamat</th>
                                                <th>Proyek</th>
                                                <th>Jabatan</th>
                                                <th>Penempatan</th>
                                                <th>BPK</th>
                                                <th>Delta</th>
                                                <th>Tunjangan Transport</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($operator as $i)
                                            :
                                            $no++;
                                            $id_user = $i['id_user'];
                                            $username = $i['username'];
                                            $password = $i['password'];
                                            $nama_lengkap = $i['nama_lengkap'];
                                            $tanggal_masuk = $i['tanggal_masuk'];
                                            $jenis_kelamin = $i['jenis_kelamin'];
                                            $id_jenis_kelamin = $i['id_jenis_kelamin'];
                                            $no_telp = $i['no_telp'];
                                            $alamat = $i['alamat'];
                                            $penempatan = $i['nama_penempatan'];
                                            $nama_proyek = $i['nama_proyek'];
                                            $operator_level = $i['operator_level'];
                                            $nama_bpk = $i['nama_bpk'];
                                            $nama_delta = $i['nama_delta'];
                                            $transport = $i['nama_transport'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td style="<?= $username ? '' : 'color: red;' ?>"><?= $username ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_lengkap ? '' : 'color: red;' ?>"><?= $nama_lengkap ?: "Data Kosong" ?></td>
                                                <td style="<?= $tanggal_masuk ? '' : 'color: red;' ?>"><?= $tanggal_masuk ?: "Data Kosong" ?></td>
                                                <td style="<?= $jenis_kelamin ? '' : 'color: red;' ?>"><?= $jenis_kelamin ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_telp ? '' : 'color: red;' ?>"><?= $no_telp ?: "Data Kosong" ?></td>
                                                <td style="<?= $alamat ? '' : 'color: red;' ?>"><?= $alamat ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_proyek ? '' : 'color: red;' ?>"><?= $nama_proyek ?: "Data Kosong" ?></td>
                                                <td style="<?= $operator_level ? '' : 'color: red;' ?>"><?= $operator_level ?: "Data Kosong" ?></td>
                                                <td style="<?= $penempatan ? '' : 'color: red;' ?>"><?= $penempatan ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_bpk ? '' : 'color: red;' ?>"><?= $nama_bpk ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_delta ? '' : 'color: red;' ?>"><?= $nama_delta ?: "Data Kosong" ?></td>
                                                <td style="<?= $transport ? '' : 'color: red;' ?>"><?= $transport ?: "Data Kosong" ?></td>
                                            </tr>
                                            <?php endforeach; ?>
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