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
                    <div class="d-block border-top border-dark border-2 p-2 px-3 fs-5 bg-dark text-white">
                        <i class="bi bi-table"></i> Master
                    </div>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('kelas') ?>">
                        <i class="bi bi-file-person"></i> Kelas
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('matakuliah') ?>">
                        <i class="bi bi-bookmark"></i> Mata Kuliah
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('dosen') ?>">
                        <i class="bi bi-file-person"></i> Dosen
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('ruang') ?>">
                        <i class="bi bi-bookmark"></i> Ruangan
                    </a>
                    <div class="d-block border-top border-dark border-2 p-2 px-3 fs-5 bg-dark text-white">
                        <i class="bi bi-table"></i> Greedy
                    </div>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('jam_kuliah') ?>">
                        <i class="bi bi-bookmark"></i> Jam Kuliah
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('maping_ruangan') ?>">
                        <i class="bi bi-bookmark"></i> Maping Ruangan
                    </a>
                    <a class="btn btn-light rounded-0 text-start px-3 ps-4 fs-5 w-100" href="<?= site_url('maping_pengampu') ?>">
                        <i class="bi bi-bookmark"></i> Maping Pengampu
                    </a>
                </div>
            </div>
        </div>
        <div class="flex-fill p-3 h-100 nav-toggler">

        </div>
    </div>

</div>