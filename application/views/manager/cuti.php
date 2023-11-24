<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Status Cuti Berhasil Diubah!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Status Cuti Gagal Diubah!",
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
                            <h1 class="m-0">Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Manajer</li>
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
                                    <h3 class="card-title">Data Cuti Operator</h3>
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
                                            XLSX.writeFile(wb, "Rekap Cuti.xlsx");
                                        });
                                    </script>
                                    <hr>
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Tipe Cuti</th>
                                                <th>Alasan</th>
                                                <th>Tanggal Diajukan</th>
                                                <th>Mulai</th>
                                                <th>Berakhir</th>
                                                <th>Perihal Cuti</th>
                                                <th>Status Cuti 1</th>
                                                <th>Status Cuti 2</th>
                                                <th>Status Cuti 3</th>
                                                <th>Cetak Surat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                        $no = 0;
                                        foreach($cuti as $i)
                                        :
                                        $no++;
                                        $id_cuti_detail= $i['id_cuti_detail'];
                                        $id_cuti = $i['id_cuti'];
                                        $id_user = $i['id_user'];
                                        $tipe_cuti = $i['jenis_cuti'];
                                        $id_tipe_cuti = $i['id_tipe_cuti'];
                                        $nama_lengkap = $i['nama_lengkap'];
                                        $alasan = $i['alasan'];
                                        $tgl_diajukan = $i['tgl_diajukan'];
                                        $mulai = $i['mulai'];
                                        $berakhir = $i['berakhir'];
                                        $id_status_cuti1 = $i['id_status_cuti1'];
                                        $id_status_cuti2 = $i['id_status_cuti2'];
                                        $id_status_cuti3 = $i['id_status_cuti3'];
                                        $perihal_cuti = $i['perihal_cuti'];

                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $id_cuti ?></td>
                                                <td><?= $nama_lengkap ?></td>
                                                <td><?= $tipe_cuti?></td>
                                                <td><?= $alasan ?></td>
                                                <td><?= $tgl_diajukan ?></td>
                                                <td><?= $mulai ?></td>
                                                <td><?= $berakhir ?></td>
                                                <td><?=$perihal_cuti?></td>
                                                <td><?php if($id_status_cuti1 == 1){ ?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-warning" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Menunggu Konfirmasi
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti1 == 2) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-info" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Diterima
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti1 == 3) {?>
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
                                                <td><?php if($id_status_cuti2 == 1){ ?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-warning" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Menunggu Konfirmasi
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }elseif($id_status_cuti2 == 2) {?>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a class="btn btn-info" data-toggle="modal"
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
                                                            <a class="btn btn-danger" data-toggle="modal"
                                                                data-target="#edit_data_operator">
                                                                Izin Cuti Ditolak
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php if ($id_status_cuti1 == 2 && $id_status_cuti2 == 2) { ?>
                                                        <a href="<?= base_url(); ?>Cetak/surat_cuti_pdf/<?= $id_cuti_detail ?>" target="_blank" class="btn btn-info">
                                                            Cetak Surat Cuti
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-danger">
                                                            Belum Dapat Mencetak
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($id_status_cuti1 == 2  && $id_status_cuti2 == 2) { ?>
                                                        <?php if ($id_status_cuti3 != 2) { ?>
                                                        <div class="table-responsive">
                                                            <div class="table table-striped table-hover ">
                                                                <a class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#setuju<?= $id_cuti_detail ?>">
                                                                    <i class="fas fa-check"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <?php if ($id_status_cuti3 != 3) { ?>
                                                        <div class="table-responsive">
                                                            <div class="table table-striped table-hover ">
                                                                <a data-toggle="modal"
                                                                    data-target="#tidak_setuju<?= $id_cuti_detail ?>"
                                                                    class="btn btn-danger"><i class="fas fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    <?php }else{?>
                                                        <p style="text-align: center;">Aksi Tidak Tersedia</p>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <!-- Modal Setuju Cuti -->
                                            <div class="modal fade" id="setuju<?= $id_cuti_detail ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Setujui Data
                                                                Cuti
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>Cuti/acc_cuti_manager" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_cuti_detail" value="<?php echo $id_cuti_detail?>" />
                                                                        <input type="hidden" name="id_user" value="<?php echo $id_user?>" />
                                                                        <input type="hidden" name="id_tipe_cuti" value="<?php echo $id_tipe_cuti?>" />
                                                                        <input type="hidden" name="mulai" value="<?php echo $mulai?>" />
                                                                        <input type="hidden" name="berakhir" value="<?php echo $berakhir?>" />
                                                                        <p>Apakah kamu yakin ingin Menyetujui Izin Cuti
                                                                            ini?</i></b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple" data-dismiss="modal" name="confirmation" value="Tidak">Tidak</button>
                                                                    <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Tidak Setuju Cuti -->
                                            <div class="modal fade" id="tidak_setuju<?= $id_cuti_detail ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Data
                                                                Cuti
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url()?>Cuti/tolak_cuti_manager"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_cuti_detail" value="<?php echo $id_cuti_detail?>" />
                                                                        <input type="hidden" name="id_user" value="<?php echo $id_user?>" />
                                                                        <input type="hidden" name="id_tipe_cuti" value="<?php echo $id_tipe_cuti?>" />
                                                                        <input type="hidden" name="mulai" value="<?php echo $mulai?>" />
                                                                        <input type="hidden" name="berakhir" value="<?php echo $berakhir?>" />
                                                                        <input type="hidden" name="id_status_cuti3" value="<?php echo $id_status_cuti3?>" />
                                                                        <p>Apakah kamu yakin ingin Menolak Izin Cuti ini?</i></b></p>
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