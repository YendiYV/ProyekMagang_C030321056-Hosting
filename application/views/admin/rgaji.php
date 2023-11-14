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
                            <h1 class="m-0">Data Rekap Gaji</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Rekap Gaji</li>
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
                                    <h3 class="card-title">Data Rekap Gaji</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="Cetak Options">
                                                    <button type="button" class="btn btn-primary" id="exportButton">Cetak Rekap</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data Rekap</button>
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

                                        // Mendapatkan tanggal saat ini
                                        var currentDate = new Date();
                                        var year = currentDate.getFullYear();
                                        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Bulan (01-12)
                                        var day = currentDate.getDate().toString().padStart(2, '0'); // Hari (01-31)

                                        // Membuat format nama file dengan tanggal saat ini
                                        var fileName = "Rekap Total THP - " + day + "-" + month + "-" + year + ".xlsx";

                                        // Membuat file Excel dan mengunduhnya dengan nama yang sudah dibuat
                                        XLSX.writeFile(wb, fileName);
                                    });
                                    </script>
                                    <hr>
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>  
                                                <th>Tanggal Gaji</th>
                                                <th>Total Gaji</th>
                                                <th>Tanggal Simpan</th>
                                                <th>Aksi</th>      
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($gaji_bulan as $gaji_bulan_item) :
                                            $no++;
                                            $id_user_detail = $gaji_bulan_item['id_user_detail'];
                                            $gaji_bulan = $gaji_bulan_item['gaji_bulan'];
                                            $total_gaji = $gaji_bulan_item['total_gaji'];
                                            $tanggal_simpan = $gaji_bulan_item['tgl_simpan'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $id_user_detail?></td>
                                                <td><?= date('d-m-Y', strtotime($gaji_bulan)) ?></td>
                                                <td><?= number_format($total_gaji, 0, ',', '.') ?></td>
                                                <td><?= date('d-m-Y', strtotime($tanggal_simpan)) ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover">
                                                            <a href="#" data-toggle="modal" data-target="#edit_gaji_bulan<?= $id_user_detail ?>" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#hapus_gaji_bulan<?= $id_user_detail ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                                <!-- Modal Hapus Data jabatan -->
                                                    <div class="modal fade" id="hapus_gaji_bulan<?= $id_user_detail ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Gaji Rekap</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() ?>rgaji/delete_gaji_bulan/<?=$id_user_detail ?>" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <input type="hidden" name="id_level" value="<?=$id_user_detail ?>" />
                                                                                <p>Apakah Anda yakin ingin menghapus Data Gaji ini?</p>
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
                                                <!-- Modal Edit Data Delta -->
                                                <div class="modal fade" id="edit_gaji_bulan<?= $id_user_detail?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Rekap Gajii</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for editing project data -->
                                                                <form action="<?= base_url() ?>rgaji/edit_gaji_bulan/<?= $id_user_detail ?>" method="post">
                                                                    <input type="hidden" name="id_user_detail" value="<?= $id_user_detail ?>">
                                                                    <div class="form-group">
                                                                        <label for="gaji_bulan">Tanggal Gaji</label>
                                                                        <input type="date" class="form-control" id="gaji_bulan" name="gaji_bulan" value="<?= htmlspecialchars($gaji_bulan) ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="total_gaji">Total Gaji</label>
                                                                        <input type="text" class="form-control" id="total_gaji" name="total_gaji" value="<?= htmlspecialchars($total_gaji) ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <?php
                                                                            $tanggal_hari_ini = date('Y-m-d');
                                                                            ?>
                                                                            <input type="date" name="tanggal_input" value="<?= $tanggal_hari_ini; ?>" style="display: none;">
                                                                        </div>
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
            <!-- Modal Tambah Delta -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data THP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url(); ?>rgaji/tambah_rgaji" method="POST">
                                <div class="form-group">
                                    <label for="username">NIP Pegawai</label>
                                    <select class="form-control" id="username"
                                        name="username" required>
                                        <?php foreach($username as $u)
                                        :
                                        $id = $u["username"];
                                        $username = $u["username"];
                                        ?>
                                            <option value="<?= $id ?>" <?php if($id == $username){
                                                echo 'selected';
                                            }else{
                                                echo '';
                                            }?>
                                            ><?= $username ?>
                                            </option>

                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_gaji">Tanggal Gaji</label>
                                    <div class="input-group">
                                        <?php
                                        $currentDate = date('Y-m-01');
                                        $minDate = date('2000-m-01');
                                        $maxDate = date('Y-m-1');
                                        ?>
                                        <input type="date" name="tanggal_gaji" value="<?= $currentDate ?>" min="<?= $minDate ?>" max="<?= $maxDate ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="total_gaji">Total Gaji Bersih</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" aria-describedby="total_gaji" id="total_gaji" name="total_gaji">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $tanggal_hari_ini = date('Y-m-d');
                                        ?>
                                        <input type="date" name="tanggal_input" value="<?= $tanggal_hari_ini; ?>" style="display: none;">
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