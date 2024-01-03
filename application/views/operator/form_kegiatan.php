<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed" >
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
    <?php if ($this->session->flashdata('foto_upload')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Foto Kegiatan Berhasil Diupload!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_gagal')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Foto Kegiatan Gagal Diupload!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Foto Kegiatan Berhasil dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_gagal_hapus')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Foto Kegiatan Gagal dihapus!",
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
                            <h1 class="m-0">Form Kegiatan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Form Kegiatan</li>
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
                                    <h3 class="card-title">Form Kegiatan Operator</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body container-fluid" style="overflow-x:auto;">
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleCetak">Cetak Bukti Visual</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($kegiatan as $kegiatan_item) :
                                        $username = $kegiatan_item['username'];
                                        $kegiatan1 = $kegiatan_item['kegiatan1'];
                                        $kegiatan2 = $kegiatan_item['kegiatan2'];
                                        $kegiatan3 = $kegiatan_item['kegiatan3']; 
                                        $kegiatan4 = $kegiatan_item['kegiatan4'];
                                        ?>
                                        <thead>
                                            <tr>
                                                <th colspan="5" style="text-align: center; font-size: 20px;">List Kegiatan Pegawai <b><?= $kegiatan_item['nip'] ?></b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align: center;">
                                                <th>List Kegiatan</th>
                                                <th>-</th>
                                                <th>Deskripsi Kegiatan</th>
                                                <th>Dokumentasi Kegiatan</th>
                                            </tr>
                                            <!-- Kolom K1 -->
                                            <tr>
                                                <th>Kegiatan 1</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan1']) ? $kegiatan_item['kegiatan1'] : '-' ?></td>
                                                <td>
                                                    <?php
                                                    $imagePath1 = 'assets/kegiatan/k1-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath1)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath1) . '" alt="Kegiatan1" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <!-- Kolom K2 -->
                                            <tr>
                                                <th>Kegiatan 2</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan2']) ? $kegiatan_item['kegiatan2'] : '-' ?></td>
                                                <td>
                                                    <?php
                                                    $imagePath1 = 'assets/kegiatan/k2-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath1)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath1) . '" alt="Kegiatan2" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <!-- Kolom K3 -->
                                            <tr>
                                                <th>Kegiatan 3</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan3']) ? $kegiatan_item['kegiatan3'] : '-' ?></td>
                                                <td>
                                                    <?php
                                                    $imagePath1 = 'assets/kegiatan/k3-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath1)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath1) . '" alt="Kegiatan3" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <!-- Kolom K4 -->
                                            <tr>
                                                <th>Kegiatan 4</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan4']) ? $kegiatan_item['kegiatan4'] : '-' ?></td>
                                                <td>
                                                    <?php
                                                    $imagePath1 = 'assets/kegiatan/k4-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath1)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath1) . '" alt="Kegiatan4" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
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
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.Cetak Bukti Visual -->
            <div class="modal fade" id="exampleCetak" tabindex="-1" aria-labelledby="exampleCetak" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleKegiatan">Bukti Visual Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url(); ?>Cetak/bukti_visual_ops" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="username" value="<?=$username ?>" />
                                        <input type="hidden" name="kegiatan1" value="<?=$kegiatan1?>" />
                                        <input type="hidden" name="kegiatan2" value="<?=$kegiatan2?>" />
                                        <input type="hidden" name="kegiatan3" value="<?=$kegiatan3?>" />
                                        <input type="hidden" name="kegiatan4" value="<?=$kegiatan4?>" />
                                        <p>Anda yakin ingin mencetak bukti visual kegiatan?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                </div>
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

    <?php $this->load->view("operator/components/js.php") ?>

</body>

</html>