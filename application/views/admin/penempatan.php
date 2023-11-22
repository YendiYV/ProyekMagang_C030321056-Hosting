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
                            <h1 class="m-0">Data Penempatan</h1>
                            <button type="button" class="btn btn-primary mt-3" id="exportButton">Cetak Rekap</button>
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Tambah Penempatan</button>
                        </div><!-- /.col -->
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
                            var fileName = "Rekap Penempatan - " + day + "-" + month + "-" + year + ".xlsx";

                            // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                            var table = document.getElementById("example1");

                            // Membuat objek Workbook Excel
                            var wb = XLSX.utils.table_to_book(table);

                            // Membuat file Excel dan mengunduhnya dengan nama file yang telah dibuat
                            XLSX.writeFile(wb, fileName);
                        });
                        </script>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Penempatan</li>
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
                                    <h3 class="card-title">Data Penempatan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Penempatan</th>  
                                                <th>Gaji Penempatan</th>
                                                <th>Tipe UM</th>  
                                                <th>Aksi</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($penempatan as $penempatan_item) :
                                            $no++;
                                            $id_penempatan = $penempatan_item['id_penempatan'];
                                            $nama_penempatan = $penempatan_item['nama_penempatan'];
                                            $gaji = $penempatan_item['gaji_penempatan'];
                                            $tipe_um_penempatan = $penempatan_item['tipe_um'];
                                            // Tambahkan kolom lain yang diperlukan sesuai dengan data penempatan
                                            
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $nama_penempatan ?></td>
                                                <td><?= "Rp. " .number_format($gaji, 0, '', '.') ?></td>
                                                <td><?= $tipe_um_penempatan?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover">
                                                            <a href="#" data-toggle="modal" data-target="#edit_data_penempatan<?= $id_penempatan ?>" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#hapus_penempatan<?= $id_penempatan ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>     
                                            </tr>
                                                <!-- Modal Hapus Data Penempatan -->
                                                <div class="modal fade" id="hapus_penempatan<?= $id_penempatan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penempatan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url() ?>penempatan/delete_penempatan/<?=$id_penempatan ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="id_penempatan" value="<?=$id_penempatan ?>" />
                                                                            <p>Apakah Anda yakin ingin menghapus penempatan ini?</p>
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

                                                <!-- Modal Edit Data Penempatan -->
                                                <div class="modal fade" id="edit_data_penempatan<?= $id_penempatan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Penempatan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for editing project data -->
                                                                <form action="<?= base_url() ?>penempatan/edit_penempatan/<?= $id_penempatan ?>" method="post">
                                                                    <input type="hidden" name="id_penempatan" value="<?= $id_penempatan ?>">
                                                                    <div class="form-group">
                                                                        <label for="nama_penempatan">Nama Penempatan</label>
                                                                        <input type="text" class="form-control" id="nama_penempatan" name="nama_penempatan" value="<?= htmlspecialchars($nama_penempatan) ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tipe_um">Tipe UM</label>
                                                                            <select class="form-control" id="tipe_um" name="tipe_um" required>
                                                                                <option value="0">Tidak ada</option>

                                                                                    <?php foreach ($tipe_um as $tu) : 
                                                                                        $id_um = $tu["id_status_um"];
                                                                                        $nama_um = $tu["tipe_um"];
                                                                                    ?>
                                                                                <option value="<?= $id_um ?>"><?= $nama_um ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gaji">Gaji</label>
                                                                        <input type="text" class="form-control" id="gaji" name="gaji" value="<?= htmlspecialchars($gaji) ?>" required>
                                                                    </div>

                                                                    <!-- Add more form fields for editing other data if needed -->
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
            <!-- Modal Tambah operator -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Penempatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>penempatan/tambah_penempatan" method="POST">
                                <div class="form-group">
                                    <label for="nama_penempatan">Nama Penempatan</label>
                                    <input type="text" class="form-control" id="nama_penempatan"
                                        aria-describedby="nama_penempatan" name="nama_penempatan" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipe_um">Tipe UM</label>
                                        <select class="form-control" id="tipe_um" name="tipe_um" required>
                                            <option value="0">Tidak ada</option>
                                                <?php foreach ($tipe_um as $tu) : 
                                                $id_um = $tu["id_status_um"];
                                                $nama_um = $tu["tipe_um"];
                                                ?>
                                            <option value="<?= $id_um ?>"><?= $nama_um ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" aria-describedby="gaji" id="gaji" name="gaji"">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>
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

    <?php $this->load->view("admin/components/js.php") ?>
</body>
</html>