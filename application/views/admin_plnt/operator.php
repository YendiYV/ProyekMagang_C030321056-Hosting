<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin_plnt/components/header.php") ?>
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
    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error_edit')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Data Gagal Diedit!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="adminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Data Operator</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin PLNT</li>
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
                                <div class="card-body" style="overflow-x:auto;">
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
                                                <th>No.</th>
                                                <th>NIP</th>
                                                <th>Nama Lengkap</th>
                                                <th>NIK</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Penempatan</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
                                                <th>SPK(PCN)</th>
                                                <th style="background-color: #87CEFA;">No. SPK PLNT</th>
                                                <th>No. Sertifikat</th>
                                                <th>No. Registrasi</th>
                                                <th>Tanggal Berlaku</th>
                                                <th>Tanggal Berakhir</th>
                                                <th>Sisa Hari</th>
                                                <th>Kategori</th>
                                                <th>Wajib / Tidak</th>
                                                <th>Kegiatan 1</th>
                                                <th>Kegiatan 2</th>
                                                <th>Kegiatan 3</th>
                                                <th>Kegiatan 4</th>
                                                <th>Cetak Fakta Intregitas</th>
                                                <th>Cetak Format Perpanjangan</th>
                                                <th>Cetak Bukti Visual</th>
                                                <th>Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($operator as $i)
                                            :
                                            $no++;
                                            $username = $i['username'];
                                            $jabatan =$i['operator_level'];
                                            $penempatan =$i['nama_penempatan'];
                                            $nama_lengkap = $i['nama_lengkap'];
                                            $nik =$i['nik'];
                                            $jenis_kelamin = $i['jenis_kelamin'];
                                            $alamat = $i['alamat'];
                                            $no_telp = $i['no_telp'];
                                            $no_spk = $i['no_spk'];
                                            $spk = $i['spk'];
                                            $no_serti = $i['no_serti'];
                                            $no_regis = $i['no_regis'];
                                            $tgl_berlaku = $i['tgl_berlaku'];
                                            $tgl_berakhir = $i['tgl_berakhir'];
                                            $user_kategori = $i['kategori'];
                                            $kategori = $i['nama_kategori'];
                                            $jenis_wajib = $i['jenis_wajib'];
                                            $kode_wajib = $i['kode_wajib'];

                                            $kegiatan1 = $i['kegiatan1'];
                                            $kegiatan2 = $i['kegiatan2'];
                                            $kegiatan3 = $i['kegiatan3'];
                                            $kegiatan4 = $i['kegiatan4'];

                                            $now = time();
                                            $date_berakhir = strtotime($i['tgl_berakhir']);
                                            $datediff = $date_berakhir - $now;
                                            $date_akhir = round($datediff / (60 * 60 * 24));

                                            $your_date = strtotime($i['tgl_berlaku']);
                                            $datediff = $now - $your_date;
                                            $date_mulai = round($datediff / (60 * 60 * 24));

                                            if ($date_mulai >= 0 && $date_akhir >= 0) {
                                                $sisa_hari = $date_akhir +1; // Subtract 1 day
                                            } else {
                                                $sisa_hari = null;
                                            }

                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td style="<?= $username ? '' : 'color: red;' ?>"><?= $username ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_lengkap ? '' : 'color: red;' ?>"><?= $nama_lengkap ?: "Data Kosong" ?></td>
                                                <td style="<?= $nik ? '' : 'color: red;' ?>"><?= $nik ?: "Data Kosong" ?></td>
                                                <td style="<?= $jenis_kelamin ? '' : 'color: red;' ?>"><?= $jenis_kelamin ?: "Data Kosong" ?></td>
                                                <td style="<?= $jabatan ? '' : 'color: red;' ?>"><?= $jabatan ?: "Data Kosong" ?></td>
                                                <td style="<?= $penempatan ? '' : 'color: red;' ?>"><?= $penempatan ?: "Data Kosong" ?></td>
                                                <td style="<?= $alamat ? '' : 'color: red;' ?>"><?= $alamat ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_telp ? '' : 'color: red;' ?>"><?= $no_telp ?: "Data Nomor Kosong" ?></td>
                                                <td style="<?= $spk ? '' : 'color: red;' ?>"><?= $spk ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_spk ? '' : 'color: red;' ?>"><?= $no_spk ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_serti ? '' : 'color: red;' ?>"><?= $no_serti ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_regis ? '' : 'color: red;' ?>"><?= $no_regis ?: "Data Kosong" ?></td>
                                                <td style="<?= $tgl_berlaku ? '' : 'color: red;' ?>"><?= $tgl_berlaku ? date('d-m-Y', strtotime($tgl_berlaku)) : "Data Kosong" ?></td>
                                                <td style="<?= $tgl_berakhir ? '' : 'color: red;' ?>"><?= $tgl_berakhir ? date('d-m-Y', strtotime($tgl_berakhir)) : "Data Kosong" ?></td>
                                                <td style="<?= $sisa_hari ? '' : 'color: red;' ?>"><?= $sisa_hari ?: "-" ?></td>
                                                <td style="<?= $kategori ? '' : 'color: red;' ?>"><?= $kategori ?: "Data Kosong" ?></td>
                                                <td style="<?= $jenis_wajib ? '' : 'color: red;' ?>"><?= $jenis_wajib ?: "Data Kosong" ?></td>
                                                <td style="<?= $kegiatan1 ? '' : 'color: red;' ?>"><?= $kegiatan1 ?: "Data Kosong" ?></td>
                                                <td style="<?= $kegiatan2 ? '' : 'color: red;' ?>"><?= $kegiatan2 ?: "Data Kosong" ?></td>
                                                <td style="<?= $kegiatan3 ? '' : 'color: red;' ?>"><?= $kegiatan3 ?: "Data Kosong" ?></td>
                                                <td style="<?= $kegiatan4 ? '' : 'color: red;' ?>"><?= $kegiatan4 ?: "Data Kosong" ?></td>
                                                <td style="text-align: center;">
                                                    <form action="<?php echo base_url()?>Cetak/cetak_fakta_integritas/<?= $username ?>" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="nama_lengkap" value="<?php echo $nama_lengkap?>" />
                                                                <input type="hidden" name="nik" value="<?php echo $nik?>" />
                                                                <input type="hidden" name="alamat" value="<?php echo $alamat?>" />
                                                                <button type="submit" class="btn btn-info">Cetak</button>
                                                            </div>
                                                        </div>
                                                    </form>   
                                                </td>
                                                <td style="text-align: center;">
                                                    <form action="<?php echo base_url()?>Cetak/cetak_perpanjangan/<?= $username ?>" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="nama_lengkap" value="<?php echo $nama_lengkap?>" />
                                                                <input type="hidden" name="nik" value="<?php echo $nik?>" />
                                                                <input type="hidden" name="alamat" value="<?php echo $alamat?>" />
                                                                <input type="hidden" name="jenis_kelamin" value="<?php echo $jenis_kelamin?>" />
                                                                <input type="hidden" name="no_telp" value="<?php echo $no_telp?>" />
                                                                <input type="hidden" name="jabatan" value="<?php echo $jabatan?>" />
                                                                <input type="hidden" name="no_regis" value="<?php echo $no_regis?>" />
                                                                <input type="hidden" name="kegiatan1" value="<?php echo $kegiatan1?>" />
                                                                <input type="hidden" name="kegiatan2" value="<?php echo $kegiatan2?>" />
                                                                <input type="hidden" name="kegiatan3" value="<?php echo $kegiatan3?>" />
                                                                <input type="hidden" name="kegiatan4" value="<?php echo $kegiatan4?>" />
                                                                <button type="submit" class="btn btn-info">Cetak</button>
                                                            </div>
                                                        </div>
                                                    </form>   
                                                </td>
                                                <td style="text-align: center;">
                                                    <form action="<?php echo base_url()?>Cetak/bukti_visual/<?= $username ?>" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="kegiatan1" value="<?php echo $kegiatan1?>" />
                                                                <input type="hidden" name="kegiatan2" value="<?php echo $kegiatan2?>" />
                                                                <input type="hidden" name="kegiatan3" value="<?php echo $kegiatan3?>" />
                                                                <input type="hidden" name="kegiatan4" value="<?php echo $kegiatan4?>" />
                                                                <button type="submit" class="btn btn-info">Cetak</button>
                                                            </div>
                                                        </div>
                                                    </form>   
                                                </td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a href="" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#edit_data_plnt<?=$username?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit operator -->
                                            <div class="modal fade" id="edit_data_plnt<?=$username?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Operator</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?=base_url();?>operator/edit_data_plnt"
                                                                method="POST">
                                                                <input type="text" value="<?= $username?>" name="username" hidden>
                                                                <div class="form-group">
                                                                    <label for="no_spk">No. SPK (PLN-T)</label>
                                                                    <input type="text" class="form-control" id="no_spk" aria-describedby="no_spk" name="no_spk" value="<?= $no_spk ?>" placeholder="Inputkan No. SPK dari PLN-T">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="spk">SPK(PCN)</label>
                                                                    <input type="text" class="form-control" id="spk" aria-describedby="spk" name="spk" value="<?= $spk ?>" placeholder="Inputkan No.SPK dari PCN">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_serti">No. Sertifikasi</label>
                                                                    <input type="text" class="form-control" id="no_serti" name="no_serti" value="<?= $no_serti?>" placeholder="Input No. Sertifikat">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_regis">No. Registrasi</label>
                                                                    <input type="text" class="form-control" id="no_regis" name="no_regis" value="<?= $no_regis?>" placeholder="Input No. Registrasi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tgl_berlaku">Tanggal Berlaku</label>
                                                                    <input type="date" class="form-control" id="tgl_berlaku" name="tgl_berlaku" value="<?= $tgl_berlaku?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tgl_berakhir">Tanggal Berakhir</label>
                                                                    <input type="date" class="form-control" id="tgl_berakhir" name="tgl_berakhir" value="<?= $tgl_berakhir?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="id_kategori">Kategori</label>
                                                                    <select class="form-control" id="id_kategori" name="id_kategori" >
                                                                        <option value="null">Tidak Ada</option>
                                                                        <?php foreach($data_kategori as $dk) : ?>
                                                                            <?php
                                                                            $id = $dk["id_kategori"];
                                                                            $nama_kategori = $dk["nama_kategori"];
                                                                            ?>
                                                                            <option value="<?= $id ?>" <?php
                                                                                if ($id == $user_kategori) {
                                                                                    echo 'selected';
                                                                                }
                                                                            ?>>
                                                                                <?= $nama_kategori ?>
                                                                            </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="$id_wajib">Wajib / Tidak Wajib</label>
                                                                    <select class="form-control" id="id_wajib" name="id_wajib">
                                                                        <option value="null">Tidak Ada</option>
                                                                        <?php foreach($data_wajib as $w)
                                                                        :
                                                                        $id = $w["id_wajib"];
                                                                        $pilih_wajib = $w["jenis_wajib"];
                                                                        ?>
                                                                            <option value="<?= $id ?>" <?php if($id == $kode_wajib ){
                                                                                echo 'selected';
                                                                            }else{
                                                                                echo '';
                                                                            }?>
                                                                            ><?= $pilih_wajib ?>
                                                                            </option>

                                                                        <?php endforeach?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kegiatan1">Kegiatan 1</label>
                                                                    <input type="text" class="form-control" id="kegiatan1" name="kegiatan1" value="<?= $kegiatan1?>" placeholder="Inputkan Kegiatan 1 Operator" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kegiatan2">Kegiatan 2</label>
                                                                    <input type="text" class="form-control" id="kegiatan2" name="kegiatan2" value="<?= $kegiatan2?>" placeholder="Inputkan Kegiatan 2 Operator" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kegiatan3">Kegiatan 3</label>
                                                                    <input type="text" class="form-control" id="kegiatan3" name="kegiatan3" value="<?= $kegiatan3?>" placeholder="Inputkan Kegiatan 3 Operator" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kegiatan4">Kegiatan 4</label>
                                                                    <input type="text" class="form-control" id="kegiatan4" name="kegiatan4" value="<?= $kegiatan4?>" placeholder="Inputkan Kegiatan 4 Operator" >
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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