<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
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
                            <h1 class="m-0">Setting</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Manager</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manager Unit</li>
                            </ol>
                        </div><!-- /.col -->
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
                                    <h3 class="card-title">Data Manager Unit</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body container-fluid">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($manager_u as $mu) : 
                                        $nama = $mu['nama_manager_u'];
                                        $nip = $mu['nip_manager_u'];
                                        $nomor_telp = $mu['nomor_telp'];
                                        $jk_m = $mu['jk'];
                                        $alamat = $mu['alamat_manager_u'];

                                        ?>
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align: center; font-size: 20px;">Biodata Manager Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Nama</th><td>:</td><td><?= !empty($mu['nama_manager_u']) ? $mu['nama_manager_u'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIP</th><td>:</td><td><?= !empty($mu['nip_manager_u']) ? $mu['nip_manager_u'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th><td>:</td><td><?= !empty($mu['jenis_kelamin']) ? $mu['jenis_kelamin'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Telepon</th><td>:</td><td><?= !empty($mu['nomor_telp']) ? $mu['nomor_telp'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th><td>:</td><td><?= !empty($mu['alamat_manager_u']) ? $mu['alamat_manager_u'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                 <th>Tanda Tangan</th><td>:</td>
                                                 <td>
                                                    <?php
                                                    $imagePath = 'assets/ttd/ttd-mng-u.jpg';

                                                    if (file_exists($imagePath)) {

                                                        // Display the image
                                                        echo 'Tanda Tangan Tersedia.';
                                                    } else {
                                                        // Show an error message if the file doesn't exist
                                                        echo 'Tanda Tangan tidak Tersedia atau ada masalah dengan path/file.';
                                                    }
                                                    ?>
                                                </td>
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