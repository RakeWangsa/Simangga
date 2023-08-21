<!DOCTYPE html>
<html lang="en">

<head>
    <!-- head section here -->
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/custom.css') ?>">
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/custom.js') ?>"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        
    <div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-header text-center">
        <img src="<?= base_url('assets/logo-djpb.png') ?>" alt="Logo DJPB" width="150" height="75" style="margin-right: 30px;">
    </div>
    <div class="list-group list-group-flush mt-4">
        <a href="https://lookerstudio.google.com/reporting/ce66d3d5-2d10-4114-84b8-072ac162d29d/page/p_uad788b61c?s=s3u7Y5cno7k" class="list-group-item list-group-item-action bg-dark text-light d-flex align-items-center">
        <i class="fa fa-bars me-3" aria-hidden="true"></i>Dashboard
        </a>
        <a href="<?= site_url('/') ?>" class="list-group-item list-group-item-action bg-dark text-light d-flex align-items-center">
        <i class="fa fa-search me-3" aria-hidden="true"></i>Anggaran
        </a>
        <a href="<?= base_url('Laporan Fa Detail (16 Segmen).pdf') ?>" class="list-group-item list-group-item-action bg-dark text-light d-flex align-items-center" download>
        <i class="fa fa-download me-3" aria-hidden="true"></i>FA Detail
        </a>
        <a href="<?= site_url('/logout') ?>" class="list-group-item list-group-item-action bg-dark text-light d-flex align-items-center">
            <i class="fa fa-arrow-right me-3" aria-hidden="true"></i>Logout
        </a>
    </div>
</div>


        <div id="page-content-wrapper" class="container-fluid" style="height: calc(100vh - 56px); overflow-y: auto;">
            <header class="bg-white p-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                
                <h4 class="mt-2">Anggaran Tersedia</h4>
            </div>
                <div>
                    <span class="text-right">
                        <!-- <a href="<?= site_url('/logout') ?>" style="color: #FFA500;" class="text-decoration-none">Logout <i class="fa fa-arrow-right" aria-hidden="true"></i></a> -->
                    </span>
                </div>
            </header>

            <div class="container-fluid mt-3 flex-grow-1 overflow-auto">
                <div class="box-flex" style="background-color: #f4f4f4; padding:24px">
                    <div class="row">
                        <div class="col-md-3">

                        <form action="<?= site_url('/home/filter') ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="bidang" class="form-label">Bidang/Bagian</label>
                                    <select class="form-select" id="bidang" name="bidang" <?php if (isset($result)) echo 'disabled'; ?> required>
                                    <?php if (isset($result)): ?>
                                        <option value="<?= $selectedBidang ?>"><?= $selectedBidang ?></option>
                                    <?php else: ?>
                                        <?php foreach ($bidangData as $bidangRow) : ?>
                                            <option value="<?= esc($bidangRow['bidang']) ?>"><?= esc($bidangRow['bidang']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="program" class="form-label">Program</label>
                                    <select class="form-select" id="program" name="program" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedProgram ?>"><?= $selectedProgram ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 2 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <select class="form-select" id="kegiatan" name="kegiatan" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedKegiatan ?>"><?= $selectedKegiatan ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 3 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="kro" class="form-label">KRO</label>
                                    <select class="form-select" id="kro" name="kro" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <<?php if (isset($result)): ?>
                                            <option value="<?= $selectedKro ?>"><?= $selectedKro ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 4 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="ro" class="form-label">RO</label>
                                    <select class="form-select" id="ro" name="ro" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedRo ?>"><?= $selectedRo ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 5 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="komponen" class="form-label">Komponen</label>
                                    <select class="form-select" id="komponen" name="komponen" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedKomponen ?>"><?= $selectedKomponen ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 6 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="subkomponen" class="form-label">Subkomponen</label>
                                    <select class="form-select" id="subkomponen" name="subkomponen" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedSubkomponen ?>"><?= $selectedSubkomponen ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 7 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="kdakun" class="form-label">Kd akun</label>
                                    <select class="form-select" id="kdakun" name="kdakun" <?php if (isset($result)) echo 'disabled'; ?> required>
                                        <?php if (isset($result)): ?>
                                            <option value="<?= $selectedSubkomponen ?>"><?= $selectedSubkomponen ?></option>
                                        <?php else: ?>
                                            <!-- Options for Form 7 -->
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <!-- <button type="button" name="filter" id="filter" class="btn btn-dark">Filter</button> -->
                            <button type="submit" class="btn btn-dark text-dark" style="background-color: #f9e8b2; border-color: #FFA500;">Filter</button>
                            <!-- <button type="button" name="reset" id="reset" class="btn btn-dark">Reset</button> -->
                            <a href="<?= site_url('/') ?>" class="btn btn-dark text-dark" style="background-color: #f9e8b2; border-color: #FFA500;">Reset</a>
                        </div>
                    </div>
                    </form>

                </div>
                <!-- Data Tabel 2 -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

                <style>
                    .dashboard-box:hover {
                        background-color: #f9e8b2;
                        /* Warna latar belakang saat hover */
                        border-width: 2px;
                        /* Lebar border saat hover */
                    }

                    .dashboard-box {
                        transition: background-color 0.3s, border-width 0.1s;
                        /* Efek transisi saat hover */
                        background-color: #FFF9EC;
                        /* Warna latar belakang putih */
                        border: 1.5px solid #FFB72F;
                        /* Border abu-abu */
                        padding: 28px;
                        border-radius: 8px;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .dashboard-box-icon {
                        font-size: 24px;
                        color: #f39c12;
                        padding-right: 8px;
                    }

                    .dashboard-box-label {
                        font-size: 16px;
                        margin-top: 12px;
                        margin-bottom: 4px;
                    }

                    .dashboard-box-value {
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 0px;
                        /* Atur jarak bawah nilai */

                    }
                </style>

                <div class="row mt-4">
                    <div class="col-md-3 mb-4">
                        <div class="dashboard-box">
                            <i class="fas fa-money-bill-wave dashboard-box-icon"></i>
                            <p class="dashboard-box-label">Pagu</p>
                            <?php if (isset($result)): ?>
                                <p class="dashboard-box-value"><?= $result[0]['pagu'] ?></p>
                            <?php else: ?>
                                <p class="dashboard-box-value">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="dashboard-box">
                            <i class="fas fa-chart-line dashboard-box-icon"></i>
                            <p class="dashboard-box-label">Realisasi</p>
                            <?php if (isset($result)): ?>
                                <p class="dashboard-box-value"><?= $result[0]['e_realisasi'] ?></p>
                            <?php else: ?>
                                <p class="dashboard-box-value">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="dashboard-box">
                            <i class="fas fa-coins dashboard-box-icon"></i>
                            <p class="dashboard-box-label">Sisa Pagu</p>
                            <?php if (isset($result)): ?>
                                <p class="dashboard-box-value"><?= $result[0]['sisa_pagu'] ?></p>
                            <?php else: ?>
                                <p class="dashboard-box-value">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="dashboard-box">
                            <i class="fas fa-percent dashboard-box-icon"></i>
                            <p class="dashboard-box-label">Persentase</p>
                            <?php if (isset($result)): ?>
                                <p class="dashboard-box-value"><?= $result[0]['realisasi'] ?></p>
                            <?php else: ?>
                                <p class="dashboard-box-value">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 tabel">
                <div class="col">
                    <table class="table caption-top">
                        <thead>
                            <tr>
                                <th scope="col">Program</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">KRO</th>
                                <th scope="col">RO</th>
                                <th scope="col">Komponen</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($result)): ?>
                                <?php foreach ($result as $row): ?>
                                    <tr>
                                        <td><?= $row['program'] ?></td>
                                        <td><?= $row['kegiatan'] ?></td>
                                        <td><?= $row['kro'] ?></td>
                                        <td><?= $row['ro'] ?></td>
                                        <td><?= $row['komponen'] ?></td>
                                        <td><?= $row['detail'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="bg-light p-3 fixed-bottom">
                <p>&copy; 2023 Simangga. Hak Cipta Dilindungi.</p>
            </footer>
        </div>
    </div>
</body>

</html>

<script>
    const bidangSelect = document.getElementById('bidang');
    const programSelect = document.getElementById('program');

    bidangSelect.addEventListener('change', () => {
        const selectedBidang = bidangSelect.value;

        fetch(`home/get-programs?bidang=${selectedBidang}`)
            .then(response => response.json())
            .then(data => {
                programSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                programSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_program;
                    option.text = program.kd_program; // Use kd_program as option text
                    programSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching programs:', error);
            });
    });
</script>

<script>
    const bidangSelect2 = document.getElementById('bidang');
    const programSelect2 = document.getElementById('program');
    const kegiatanSelect = document.getElementById('kegiatan');

    programSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect2.value;
        const selectedProgram = programSelect2.value;

        fetch(`home/get-kegiatan?bidang=${selectedBidang}&program=${selectedProgram}`)
            .then(response => response.json())
            .then(data => {
                kegiatanSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                kegiatanSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_kegiatan;
                    option.text = program.kd_kegiatan; // Use kd_program as option text
                    kegiatanSelect.appendChild(option);
                });
            })

    });
</script>

<script>
    const bidangSelect3 = document.getElementById('bidang');
    const programSelect3 = document.getElementById('program');
    const kegiatanSelect2 = document.getElementById('kegiatan');
    const kroSelect = document.getElementById('kro');

    kegiatanSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect3.value;
        const selectedProgram = programSelect3.value;
        const selectedKegiatan = kegiatanSelect2.value;

        fetch(`home/get-kro?bidang=${selectedBidang}&program=${selectedProgram}&kegiatan=${selectedKegiatan}`)
            .then(response => response.json())
            .then(data => {
                kroSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                kroSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_kro;
                    option.text = program.kd_kro;
                    kroSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching kro:', error);
            });
    });
</script>

<script>
    const bidangSelect4 = document.getElementById('bidang');
    const programSelect4 = document.getElementById('program');
    const kegiatanSelect3 = document.getElementById('kegiatan');
    const kroSelect2 = document.getElementById('kro');
    const roSelect = document.getElementById('ro');

    kroSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect4.value;
        const selectedProgram = programSelect4.value;
        const selectedKegiatan = kegiatanSelect3.value;
        const selectedKRO = kroSelect2.value;

        fetch(`home/get-ro?bidang=${selectedBidang}&program=${selectedProgram}&kegiatan=${selectedKegiatan}&kro=${selectedKRO}`)
            .then(response => response.json())
            .then(data => {
                roSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                roSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_ro;
                    option.text = program.kd_ro;
                    roSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching ro:', error);
            });
    });
</script>

<script>
    const bidangSelect5 = document.getElementById('bidang');
    const programSelect5 = document.getElementById('program');
    const kegiatanSelect4 = document.getElementById('kegiatan');
    const kroSelect3 = document.getElementById('kro');
    const roSelect2 = document.getElementById('ro');
    const komponenSelect = document.getElementById('komponen');

    roSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect5.value;
        const selectedProgram = programSelect5.value;
        const selectedKegiatan = kegiatanSelect4.value;
        const selectedKRO = kroSelect3.value;
        const selectedRO = roSelect2.value;

        fetch(`home/get-komponen?bidang=${selectedBidang}&program=${selectedProgram}&kegiatan=${selectedKegiatan}&kro=${selectedKRO}&ro=${selectedRO}`)
            .then(response => response.json())
            .then(data => {
                komponenSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                komponenSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_komponen;
                    option.text = program.kd_komponen;
                    komponenSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching komponen:', error);
            });
    });
</script>

<script>
    const bidangSelect6 = document.getElementById('bidang');
    const programSelect6 = document.getElementById('program');
    const kegiatanSelect5 = document.getElementById('kegiatan');
    const kroSelect4 = document.getElementById('kro');
    const roSelect3 = document.getElementById('ro');
    const komponenSelect2 = document.getElementById('komponen');
    const subKomponenSelect = document.getElementById('subkomponen');

    komponenSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect6.value;
        const selectedProgram = programSelect6.value;
        const selectedKegiatan = kegiatanSelect5.value;
        const selectedKRO = kroSelect4.value;
        const selectedRO = roSelect3.value;
        const selectedKomponen = komponenSelect2.value;

        fetch(`home/get-subkomponen?bidang=${selectedBidang}&program=${selectedProgram}&kegiatan=${selectedKegiatan}&kro=${selectedKRO}&ro=${selectedRO}&komponen=${selectedKomponen}`)
            .then(response => response.json())
            .then(data => {
                subKomponenSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                subKomponenSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_sub_komponen;
                    option.text = program.kd_sub_komponen;
                    subKomponenSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching subkomponen:', error);
            });
    });
</script>

<script>
    const bidangSelect7 = document.getElementById('bidang');
    const programSelect7 = document.getElementById('program');
    const kegiatanSelect6 = document.getElementById('kegiatan');
    const kroSelect5 = document.getElementById('kro');
    const roSelect4 = document.getElementById('ro');
    const komponenSelect3 = document.getElementById('komponen');
    const subKomponenSelect2 = document.getElementById('subkomponen');
    const kdAkunSelect = document.getElementById('kdakun');

    subKomponenSelect2.addEventListener('change', () => {
        const selectedBidang = bidangSelect7.value;
        const selectedProgram = programSelect7.value;
        const selectedKegiatan = kegiatanSelect6.value;
        const selectedKRO = kroSelect5.value;
        const selectedRO = roSelect4.value;
        const selectedKomponen = komponenSelect3.value;
        const selectedSubKomponen = subKomponenSelect2.value;

        fetch(`home/get-kdAkun?bidang=${selectedBidang}&program=${selectedProgram}&kegiatan=${selectedKegiatan}&kro=${selectedKRO}&ro=${selectedRO}&komponen=${selectedKomponen}&subkomponen=${selectedSubKomponen}`)
            .then(response => response.json())
            .then(data => {
                kdAkunSelect.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Salah Satu';
                kdAkunSelect.appendChild(defaultOption);

                data.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.kd_akun;
                    option.text = program.kd_akun;
                    kdAkunSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching kdakun:', error);
            });
    });
</script>