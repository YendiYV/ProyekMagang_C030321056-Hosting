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
                            <h1 class="m-0">Data Insentif</h1>
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Tambah Insentif</button>
                            <button type="button" class="btn btn-primary mt-3" id="exportButton">Cetak Rekap</button>
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
                            var fileName = "Rekap Insentif -" + day + "-" + month + "-" + year + ".xlsx";

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
                                <li class="breadcrumb-item active">Insentif</li>
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
                                    <h3 class="card-title">Data Insentif</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Insentif</th>  
                                                <th>Gaji Insentif</th>  
                                                <th>Aksi</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($insentif as $insentif_item) :
                                            $no++;
                                            $id_level = $insentif_item['id_insentif'];
                                            $nama_insentif = $insentif_item['nama_insentif'];
                                            $gaji_insentif = $insentif_item['tunjangan_insentif'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $nama_insentif ?></td>
                                                <td><?= number_format($gaji_insentif, 0, ',', '.') ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover">
                                                            <a href="#" data-toggle="modal" data-target="#edit_data_insentif<?= $id_level ?>" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#hapus_insentif<?= $id_level ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                                <!-- Modal Hapus Data jabatan -->
                                                <div class="modal fade" id="hapus_insentif<?= $id_level ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Insentif</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url() ?>insentif/delete_insentif/<?=$id_level ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="id_level" value="<?=$id_level ?>" />
                                                                            <p>Apakah Anda yakin ingin menghapus Insentif ini?</p>
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

                                                <!-- Modal Edit Data Insentif -->
                                                <div class="modal fade" id="edit_data_insentif<?= $id_level?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Insentif</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for editing project data -->
                                                                <form action="<?= base_url() ?>insentif/edit_insentif/<?= $id_level ?>" method="post">
                                                                    <input type="hidden" name="id_level" value="<?= $id_level ?>">
                                                                    <div class="form-group">
                                                                        <label for="nama_insentif">Nama Insentif</label>
                                                                        <input type="text" class="form-control" id="nama_insentif" name="nama_insentif" value="<?= htmlspecialchars($nama_insentif) ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gaji_insentif">Gaji</label>
                                                                        <input type="text" class="form-control" id="gaji_insentif" name="gaji_insentif" oninput="formatCurrency(this)" value="<?= htmlspecialchars($gaji_insentif) ?>" required>
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
            <!-- Modal Tambah Insentif -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Insentif</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>insentif/tambah_insentif" method="POST">
                                <div class="form-group">
                                    <label for="nama_insentif">Nama Insentif</label>
                                    <input type="text" class="form-control" id="nama_insentif"
                                        aria-describedby="nama_insentif" name="nama_insentif" required>
                                </div>
                                <div class="form-group">
                                    <label for="gaji_insentif">Gaji</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" aria-describedby="gaji_insentif" id="gaji_insentif" name="gaji_insentif"">
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