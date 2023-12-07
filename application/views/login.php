<!DOCTYPE html>
<html lang="en">

<head>
    <title>WEB-SMP5C</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url();?>assets/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url();?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url();?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/css/main.css">
    <!--===============================================================================================-->
    <!-- Sweetalert -->
    <script src="<?= base_url() ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!--===============================================================================================-->
    <style>
        @keyframes colorChange {
            0%, 60% { color: red; }
            20%, 80% { color: blue; }
            40% { color: yellow; }
        }

        .login100-form-title.color-changing-text {
            display: inline-block;
            animation: colorChange 5s infinite; /* Mengubah warna setiap 5 detik */
        }

        .hover-effect:hover {
            color: blue;
            cursor: pointer;
        }

        .smp5c-char {
            display: inline-block;
        }

        .s {
            color: red;
        }

        .m {
            color: blue;
        }

        .p {
            color: yellow;
        }
        .tiga {
            color: red;
        }
        .c {
            color: blue;
        }
    </style>

</head>

<body>

    <?php if($this->session->flashdata('success_log_out')){?>
    <script>
    swal({
        title: "Success!",
        text: "Anda Berhasil Log Out!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Berhasil Terdaftar!",
        text: "Silahkan Anda Login!",
        icon: "success"
    });
    </script>
    <?php } ?>
    
    <?php if ($this->session->flashdata('eror')){ ?>
    <script>
    swal({
        title: "Eror!",
        text: "Terjadi Kesalahan Dalam Proses data!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('loggin_err_no_user')){?>
    <script>
    swal({
        title: "Error!",
        text: "Anda Tidak Terdaftar!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('loggin_err_pass')){?>
    <script>
    swal({
        title: "Error!",
        text: "Password Yang Anda Masukan Salah!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('loggin_err_no_access')){?>
    <script>
    swal({
        title: "Error!",
        text: "Anda Belum Memiliki Akses!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('loggin_err')){?>
    <script>
    swal({
        title: "Error!",
        text: "Sesi Anda Habis!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img id="logo" src="<?= base_url();?>assets/login/images/logo.jpg" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="<?= base_url();?>Login/proses" method="POST">
                    <span class="login100-form-title color-changing-text">
                        <span class="smp5c-char s">S</span>
                        <span class="smp5c-char m">M</span>
                        <span class="smp5c-char p">P</span>
                        <span class="smp5c-char tiga">5</span>
                        <span class="smp5c-char c">C</span><br>
                        PLN Nusa Daya X PCN
                    </span>
                    
                   <div class="wrap-input100 validate-input" data-validate="Masukkan NIP yang terdiri dari 7 Angka 3 Huruf">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <!-- Tombol Butuh Bantuan dengan Ikon -->
                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Butuh Bantuan?
                        </span>
                        <a class="hover-effect" href="mailto:yendiyv3903@gmail.com">
                            Hubungi Administrator
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?= base_url();?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url();?>assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url();?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url();?>assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url();?>assets/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url();?>assets/login/js/main.js"></script>

</body>

</html>
