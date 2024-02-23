<div id="scrollbar">
    <div class="container-fluid">


        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">

            <div class="mb-5"></div>
            
            <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModal('Profil Desa')">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                                <h5 class="fs-14 mb-1">Profil Desa</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModal('Profil Desa')">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                                <h5 class="fs-14 mb-1">Kepala Desa</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModalSO('Profil Desa')">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                            </a>
                            <h5 class="fs-14 mb-1">Struktur Organisasi</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModalKelembagaan('Profil Desa')">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                                <h5 class="fs-14 mb-1">Kelembagaan</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModalGalery()">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                                <h5 class="fs-14 mb-1">Galeri</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="text-center">
                            <a href="javascript:showModalNews()">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="<?= base_url('dist/') ?>assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-md material-shadow">
                                </div>
                                <h5 class="fs-14 mb-1">Kabar Desa</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5"></div>
            <div class="dropdown sidebar-user m-1 rounded">
                <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <span class="text-start">
                            <span class="d-block fw-medium sidebar-user-name-text">PETA DESA</span>
                        </span>
                    </span>
                </button>
            </div>
            
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalSO()">
                    <i class=" ri-stackshare-line text-danger"></i> <span data-key="t-layouts">Aset Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalGalery()">
                    <i class=" ri-gallery-fill text-secondary"></i> <span data-key="t-layouts">Tanah Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalNews()">
                    <i class="ri-newspaper-fill text-warning"></i> <span data-key="t-layouts">Kependudukan</span> <span
                        class="badge badge-pill bg-danger" data-key="t-hot">Baru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalNews()">
                    <i class="ri-newspaper-fill text-secondary"></i> <span data-key="t-layouts">Cagar Budaya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalNews()">
                    <i class="ri-newspaper-fill text-info"></i> <span data-key="t-layouts">Objek Wisata</span>
                </a>
            </li>
            <div class="dropdown sidebar-user m-1 rounded">
                <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <span class="text-start">
                            <span class="d-block fw-medium sidebar-user-name-text">Rekapitulasi Data</span>
                        </span>
                    </span>
                </button>
            </div>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalRekap()">
                    <i class=" ri-stackshare-line text-danger"></i> <span data-key="t-layouts">Aset Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalRekap()">
                    <i class=" ri-gallery-fill text-secondary"></i> <span data-key="t-layouts">Tanah Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalRekap()">
                    <i class="ri-newspaper-fill text-warning"></i> <span data-key="t-layouts">Kependudukan</span> <span
                        class="badge badge-pill bg-danger" data-key="t-hot">Baru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalRekap()">
                    <i class="ri-newspaper-fill text-secondary"></i> <span data-key="t-layouts">Cagar Budaya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:showModalRekap()">
                    <i class="ri-newspaper-fill text-info"></i> <span data-key="t-layouts">Objek Wisata</span>
                </a>
            </li>


        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>



