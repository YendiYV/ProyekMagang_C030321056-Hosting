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
                            <h1 class="m-0">Data Rekap Gaji</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Manager</li>
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
                                <div class="card-body" style="overflow-x:auto;">
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
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
                                                <th>Nama</th>
                                                <th>NIP</th>  
                                                <th>Tanggal Gaji</th>
                                                <th>Total Gaji</th>
                                                <th>Tanggal Simpan</th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($gaji_bulan as $gaji_bulan_item) :
                                            $no++;
                                            $nama_lengkap = $gaji_bulan_item['nama_lengkap'];
                                            $id_user_detail = $gaji_bulan_item['nip'];
                                            $gaji_bulan = $gaji_bulan_item['gaji_bulan'];
                                            $total_gaji = $gaji_bulan_item['total_gaji'];
                                            $tanggal_simpan = $gaji_bulan_item['tgl_simpan'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $nama_lengkap ?></td>
                                                <td><?= $id_user_detail?></td>
                                                <td><?= date('d-m-Y', strtotime($gaji_bulan)) ?></td>
                                                <td><?= "Rp. " .number_format($total_gaji, 0, '', '.') ?></td>
                                                <td><?= date('d-m-Y', strtotime($tanggal_simpan)) ?></td>
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

    <?php $this->load->view("manager/components/js.php") ?>
</body>
</html>