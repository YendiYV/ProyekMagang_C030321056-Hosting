<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url();?>assets/login/images/logo1.jpg" alt="AdminLTE Logo" class="brand-image " style="opacity: .8"> <span class="brand-text font-weight-light">WEB-SMP5C</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url();?>assets/admin_lte/dist/img/account.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=$this->session->userdata('username');?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url();?>Dashboard/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Operator/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-users "></i>
                        <p>Operator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Absensi/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>Status Absensi Operator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Cuti/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Data Cuti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Gaji/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Data Total Gaji</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Rgaji/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Data Rekap THP</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Data-Data List Gaji</p>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url();?>Proyek/view_admin" style="color: black;">Proyek</a>
                        <a class="dropdown-item" href="<?= base_url();?>Jabatan/view_admin" style="color: black;">Jabatan</a>
                        <a class="dropdown-item" href="<?= base_url();?>Transport/view_admin" style="color: black;">Tunjangan Transport</a>
                        <a class="dropdown-item" href="<?= base_url();?>Komunikasi/view_admin" style="color: black;">Tunjangan Komunikasi</a>
                        <a class="dropdown-item" href="<?= base_url();?>Uang_Hadir/view_admin" style="color: black;">Tunjangan Uang Hadir</a>
                        <a class="dropdown-item" href="<?= base_url();?>Kontribusi/view_admin" style="color: black;">Tunjangan Kontribusi</a>
                        <a class="dropdown-item" href="<?= base_url();?>Insentif/view_admin" style="color: black;">Tunjangan Insentif</a>
                        <a class="dropdown-item" href="<?= base_url();?>Insfeksi/view_admin" style="color: black;">Insfeksi Pegawai</a>
                        <a class="dropdown-item" href="<?= base_url();?>Penempatan/view_admin" style="color: black;">Data Penempatan</a>
                        <a class="dropdown-item" href="<?= base_url();?>Tmk/view_admin" style="color: black;">Data TMK</a>
                        <a class="dropdown-item" href="<?= base_url();?>Bpk/view_admin" style="color: black;">Data BPK</a>
                        <a class="dropdown-item" href="<?= base_url();?>Delta/view_admin" style="color: black;">Data Delta</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Dmunit/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Data Manager Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Settings/view_admin" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>