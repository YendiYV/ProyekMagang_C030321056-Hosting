<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("super_admin/components/header.php") ?>
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
        <?php $this->load->view("super_admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("super_admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data TMK</h1>
                            <button type="button" class="btn btn-primary mt-3" id="exportButton">Cetak Rekap</button> 
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Tambah TMK</button>
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
                            var fileName = "Rekap TMK - " + day + "-" + month + "-" + year + ".xlsx";

                            // Mendapatkan referensi ke tabel HTML (ganti "example1" dengan ID tabel Anda)
                            var table = document.getElementById("example1");

                            // Membuat objek Workbook Excel
                            var wb = XLSX.utils.table_to_book(table);

                            // Membuat file Excel dan mengunduhnya dengan nama file yang telah dibuat
                            XLSX.writeFile(wb, fileName);
                        });
                        </script>
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
                                    <h3 class="card-title">Data TMK</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun TMK</th>  
                                                <th>Rupiah TMK</th>  
                                                <th>Aksi</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($tmk as $tmk_item) :
                                            $no++;
                                            $id_status_tmk = $tmk_item['id_status_tmk'];
                                            $tahun_tmk = $tmk_item['tahun_tmk'];
                                            $rupiah_tmk = $tmk_item['rupiah_tmk'];
                                            // Tambahkan kolom lain yang diperlukan sesuai dengan data penempatan
                                            
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $tahun_tmk ?></td>
                                                <td><?= "Rp. " .number_format($rupiah_tmk, 0, '', '.') ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover">
                                                            <a href="#" data-toggle="modal" data-target="#edit_data_tmk<?= $id_status_tmk ?>" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                                <!-- Modal Edit Data TMK -->
                                                <div class="modal fade" id="edit_data_tmk<?= $id_status_tmk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data TMK</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for editing project data -->
                                                                <form action="<?= base_url() ?>tmk/edit_tmk/<?= $id_status_tmk ?>" method="post">
                                                                    <input type="hidden" name="id_status_tmk" value="<?= $id_status_tmk ?>">
                                                                    <div class="form-group">
                                                                        <label for="rupiah_tmk">Rupiah TMK</label>
                                                                        <input type="text" class="form-control" id="rupiah_tmk" name="rupiah_tmk" value="<?= htmlspecialchars($rupiah_tmk) ?>" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah TMK</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>tmk/tambah_tmk" method="POST">
                                <div class="form-group">
                                    <label for="rupiah_tmk">Rupiah TMK</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" aria-describedby="rupiah_tmk" id="rupiah_tmk" name="rupiah_tmk"">
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

    <?php $this->load->view("super_admin/components/js.php") ?>
</body>
</html>