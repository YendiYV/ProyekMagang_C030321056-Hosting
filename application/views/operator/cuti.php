<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

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

    <?php if ($this->session->flashdata('gagal_tambah')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Cuti yang diambil Lebih dari 12 Hari !",
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
                            <h1 class="m-0">Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cuti</li>
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
                                    <h3 class="card-title">Data Cuti</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="overflow-x:auto;">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Cuti</th>
                                                <th>Tipe Cuti</th>
                                                <th>Alasan</th>
                                                <th>Tanggal Diajukan</th>
                                                <th>Mulai</th>
                                                <th>Berakhir</th>
                                                <th>Status Cuti 1</th>
                                                <th>Status Cuti 2</th>
                                                <th>Status Cuti 3</th>
                                                <th>Cetak Surat</th>
                                                <th>Cetak Surat Polosan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                        $no = 0;
                                        foreach($cuti as $i)
                                        :
                                        $no++;
                                        $id_cuti_detail = $i['id_cuti_detail'];
                                        $id_cuti = $i['id_cuti'];
                                        $id_user = $i['id_user'];
                                        $jenis_cuti = $i['jenis_cuti'];
                                        $alasan = $i['alasan'];
                                        $tgl_diajukan = $i['tgl_diajukan'];
                                        $mulai = $i['mulai'];
                                        $berakhir = $i['berakhir'];
                                        $id_status_cuti1 = $i['id_status_cuti1'];
                                        $id_status_cuti2 = $i['id_status_cuti2'];
                                        $id_status_cuti3 = $i['id_status_cuti3'];

                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $id_cuti ?></td>
                                                <td><?= $jenis_cuti?></td>
                                                <td><?= $alasan ?></td>
                                                <td><?= $tgl_diajukan ?></td>
                                                <td><?= $mulai ?></td>
                                                <td><?= $berakhir ?></td>
                                                <td><?php if($id_status_cuti1 == 1){ ?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-warning" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Menunggu Konfirmasi
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti1 == 2) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-info" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Diterima
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti1 == 3) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-danger" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Ditolak
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td><?php if($id_status_cuti2 == 1){ ?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-warning" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Menunggu Konfirmasi
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti2 == 2) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-info" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Diterima
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti2 == 3) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-danger" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Ditolak
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td><?php if($id_status_cuti3 == 1){ ?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-warning" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Menunggu Konfirmasi
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti3 == 2) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-info" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Diterima
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti3 == 3) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a  class="btn btn-danger" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Ditolak
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php if ($id_status_cuti1 == 2 && $id_status_cuti2 == 2) { ?>
                                                        <a href="<?= base_url(); ?>Cetak/surat_cuti_pdf/<?= $id_cuti ?>" target="_blank" class="btn btn-info">
                                                            Cetak Surat Pengajuan
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-danger">
                                                            Belum Dapat Mencetak
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($id_status_cuti1 == 2) { ?>
                                                        <a href="<?= base_url(); ?>CetakAcc/surat_cuti_acc_pdf/<?= $id_cuti ?>" target="_blank" class="btn btn-info">
                                                            Cetak Surat Konfirmasi
                                                        </a>
                                                    <?php } else { ?>
                                                        <a  class="btn btn-danger">
                                                            Belum Dapat Mencetak
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($id_status_cuti1 == 2 || $id_status_cuti2 == 2 || $id_status_cuti3 == 2 ||$id_status_cuti1 == 3 || $id_status_cuti2 == 3 || $id_status_cuti3 == 3) { ?>
                                                                <!-- Tampilkan pesan bahwa cuti tidak dapat dihapus karena status cuti 1-3 adalah 2 -->
                                                                <p style="text-align: center;">Data cuti tidak dapat dihapus karena ada status cuti yang telah dikonfirmasi.</p>
                                                    <?php } else { ?>
                                                        <div class="table-responsive">
                                                            <div class="table table-striped table-hover ">
                                                                <a href="" data-toggle="modal"
                                                                    data-target="#hapus<?= $id_cuti_detail ?>"
                                                                    class="btn btn-danger"><i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                            <!-- Modal Hapus Data Cuti -->
                                            <div class="modal fade" id="hapus<?= $id_cuti_detail ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                Cuti
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <?php if ($id_status_cuti1 == 2 || $id_status_cuti2 == 2 || $id_status_cuti3 == 2 ||$id_status_cuti1 == 3 || $id_status_cuti2 == 3 || $id_status_cuti3 == 3) { ?>
                                                            <!-- Tampilkan pesan bahwa cuti tidak dapat dihapus karena status cuti 1-3 adalah 2 -->
                                                            <p style="text-align: center;">Data cuti tidak dapat dihapus karena status cuti 1 atau 2 atau 3 telah dikonfirmasi.</p>
                                                        <?php } else { ?>
                                                            <!-- Tampilkan form penghapusan jika status cuti memungkinkan penghapusan -->
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url() ?>Cuti/hapus_cuti" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="id_cuti_detail" value="<?php echo $id_cuti_detail ?>" />
                                                                            <input type="hidden" name="id_user" value="<?php echo $id_user ?>" />

                                                                            <p>Apakah kamu yakin ingin menghapus data ini?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                                                        <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach;?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <!-- Modal -->

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