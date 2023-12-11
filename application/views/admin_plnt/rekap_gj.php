<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin_plnt/components/header.php") ?>
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
        <?php $this->load->view("admin_plnt/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("admin_plnt/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Rekap GJ</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin PLNT</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Rekap GJ</li>
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
                                    <h3 class="card-title">Rekap GJ</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="overflow-x:auto;">
                                    <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap</button> 
                                    <script>
                                    document.getElementById("exportButton").addEventListener("click", function() {
                                        // Mendapatkan tanggal saat tombol ditekan
                                        var currentDate = new Date();

                                        // Mengambil hari dalam format dua digit (01, 02, ..., 31)
                                        var day = String(currentDate.getDate()).padStart(2, '0');

                                        // Mengambil bulan dalam format dua digit (01, 02, ..., 12)
                                        var month = String(currentDate.getMonth() + 1).padStart(2, '0');

                                        // Mengambil tahun empat digit (contoh: 2023)
                                        var year = currentDate.getFullYear();

                                        // Menggabungkan hari, bulan, dan tahun ke dalam nama file
                                        var fileName = "Rekap GJ- " + day + "-" + month + "-" + year + ".xlsx";

                                        // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                                        var table = document.getElementById("example1");

                                        // Membuat objek Workbook Excel
                                        var wb = XLSX.utils.table_to_book(table);

                                        // Membuat file Excel dan mengunduhnya dengan nama file yang telah dibuat
                                        XLSX.writeFile(wb, fileName);
                                    });
                                    </script>
                                    <hr>
                                    <table id="example1" class="table table-bordered table-striped">
                                       <thead>
                                            <tr style="text-align:center">
                                                <th>No</th>
                                                <th>No. SPK</th>  
                                                <th>Total Operator</th>         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($count_data_gj as $cdg_item) :
                                                $no++;
                                                $nama_no_spk = ($cdg_item->nama_no_spk) ? $cdg_item->nama_no_spk : '<span style="color: red;">Operator Tanpa No. SPK</span>';

                                                $total_operator = $cdg_item->count_no_spk;
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $nama_no_spk ?></td>
                                                    <td><?= $total_operator ?> Orang</td>
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

    <?php $this->load->view("admin_plnt/components/js.php") ?>
</body>
</html>