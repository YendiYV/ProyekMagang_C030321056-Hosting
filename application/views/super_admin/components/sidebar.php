<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url();?>assets/login/images/logo1.jpg" alt="adminLTE Logo"
            class="brand-image " style="opacity: .8"> <span class="brand-text font-weight-light">WEB-SMP3C</span>
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
                    <a href="<?= base_url();?>Dashboard/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Operator/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-users "></i>
                        <p>Operator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Absensi/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>Status Absensi Operator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Cuti/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Data Cuti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Gaji/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Data Total Gaji</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Rgaji/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Data Rekap THP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Proyek/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Data Proyek</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Jabatan/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-people-arrows"></i>
                        <p>Data Jabatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Transport/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-motorcycle"></i>
                        <p>Tunjangan Transport</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Komunikasi/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>Tunjangan Komunikasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Uang_Hadir/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p>Tunjangan Uang Hadir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Kontribusi/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-child"></i>
                        <p>Tunjangan Kontribusi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Insentif/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                            <p>Tunjangan Insentif</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Insfeksi/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-plug"></i>
                            <p>Insfeksi Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Penempatan/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-map"></i>
                        <p>Data Penempatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Tmk/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Data TMK</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Bpk/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>Data BPK</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Delta/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Data Delta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Dmunit/view_super_admin" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Data Manager Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>Settings/view_super_admin" class="nav-link">
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