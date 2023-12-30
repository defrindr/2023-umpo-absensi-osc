<div class="w-100 h-100 bg-black-50 fixed-top" style="z-index: 10;display: none;" id="nav-side">
    <div class="d-flex justify-content-between align-items-center h-100 w-100">
        <div class="d-flex flex-column h-100">
            <div class="d-flex justify-content-between align-items-center p-2 bg-white mb-0">
                <span class="fs-5 fw-bold text-white ms-2">
                    spacer
                </span>
            </div>
            <div class="d-flex flex-column p-0 pt-3 bg-light flex-fill" style="width: 300px;overflow-y: hidden;">
                <div class="vstack gap-0">
                    <a class="btn btn-light rounded-0 text-start px-3 fs-5 w-100" href="<?= site_url('dashboard') ?>">
                        <i class="bi bi-house-fill"></i> Dashboard
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 fs-5 w-100 d-none" href="<?= site_url('jadwalkuliah') ?>">
                        <i class="bi bi-calendar"></i> View Jadwal
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 fs-5 w-100" href="<?= site_url('jadwalkuliah2') ?>">
                        <i class="bi bi-cpu"></i> Jadwal Kuliah
                    </a>
                    <div class="d-block border-top border-dark border-2 p-2 px-3 fs-5 bg-dark text-white">
                        <i class="bi bi-table"></i> Data
                    </div>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('ruang') ?>">
                        <i class="bi bi-door-open"></i> Ruang
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('kelas') ?>">
                        <i class="bi bi-cast"></i> Kelas
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('mahasiswa') ?>">
                        <i class="bi bi-person"></i> Mahasiswa
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('dosen') ?>">
                        <i class="bi bi-file-person"></i> Dosen
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('jadwal') ?>">
                        <i class="bi bi-calendar"></i> Jadwal
                    </a>
                    
                </div>
            </div>
        </div>
        <div class="flex-fill p-3 h-100 nav-toggler">
            
        </div>
    </div>

</div>