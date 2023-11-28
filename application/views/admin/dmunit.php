<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
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
    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('ttd_upload')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Tanda Tangan Berhasil di Upload!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('ttd_gagal')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Tanda Tangan Gagal di Upload!",
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
                            <h1 class="m-0">Setting</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Admin</li>
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
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Ganti Data</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleTtd">Upload Tanda Tangan</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
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
                                                        echo '<img src="' . base_url($imagePath) . '" width="120" height="60" alt="Tanda Tangan">';
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
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ganti Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>Dmunit/edit_data" method="POST">
                                <input type="hidden" class="form-control" id="nip_awal" name="nip_awal" value="<?= $nip ?>" aria-describedby="nip_awal" required>
                                <div class="form-group">
                                    <label for="nama_manager_u">Nama</label>
                                    <input type="text" class="form-control" id="nama_manager_u" name="nama_manager_u" value="<?= $nama ?>"
                                        aria-describedby="nama_manager_u" required>
                                </div>
                                <div class="form-group">
                                    <label for="nip_manager_u">NIP</label>
                                    <input type="text" class="form-control" id="nip_manager_u" name="nip_manager_u" value="<?= $nip ?>"
                                        aria-describedby="nip_manager_u" pattern="^\d{7}[A-Z]{3}$" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin" required>
                                        <?php foreach($jk as $u)
                                        :
                                        $id = $u["id_jenis_kelamin"];
                                        $jenis_kelamin = $u["jenis_kelamin"];
                                        ?>
                                            <option value="<?= $id ?>" <?php if($id == $jk_m){
                                                echo 'selected';
                                            }else{
                                                echo '';
                                            }?>
                                            ><?= $jenis_kelamin ?>
                                            </option>

                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telp">No.Telp</label>
                                    <input type="text" class="form-control" id="nomor_telp" name="nomor_telp" value="<?= $nomor_telp ?>"
                                        aria-describedby="nomor_telp" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_manager_u">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_manager_u" name="alamat_manager_u" value="<?= $alamat ?>"
                                        aria-describedby="alamat_manager_u" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleTtd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Tanda Tangan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!-- Add your form for signature upload -->
                        <form action="<?= base_url(); ?>Dmunit/upload_ttd_mng_u" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="signatureFile">Pilih File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="signatureFile" name="signatureFile" accept=".png, .jpg, .jpeg" onchange="displayFileName()">
                                    <label class="custom-file-label" for="signatureFile" id="fileLabel">Pilih File</label>
                                    <small><b>Ukuran Max 1024 KB</b></small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                        <script>
                        function displayFileName() {
                            var input = document.getElementById('signatureFile');
                            var label = document.getElementById('fileLabel');
                            if (input.files.length > 0) {
                                label.innerText = input.files[0].name;
                            } else {
                                label.innerText = 'Choose file';
                            }
                        }
                        </script>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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