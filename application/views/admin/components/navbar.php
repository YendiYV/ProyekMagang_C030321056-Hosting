<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Jam Online dan Tanggal -->
        <li class="nav-item">
            <a class="nav-link" id="jamTanggal"></a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?= base_url(); ?>Login/log_out" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>

<script>
    function updateJamTanggal() {
        const sekarang = new Date();
        const jam = sekarang.getHours().toString().padStart(2, '0');
        const menit = sekarang.getMinutes().toString().padStart(2, '0');
        const tanggal = sekarang.toLocaleDateString();
        const jamTanggal = `${jam}:${menit} - ${tanggal}`;
        document.getElementById('jamTanggal').textContent = jamTanggal;
    }

    // Pembaruan jam dan tanggal setiap detik
    setInterval(updateJamTanggal, 1000);

    // Membuat jam dan tanggal pertama kali saat halaman dimuat
    updateJamTanggal();
</script>
