<style>
    .icon img {
        /* Sesuaikan tinggi gambar sesuai kebutuhan */
        width: 100px;

        object-fit: cover;
        /* Atur proporsi gambar menjadi persegi panjang */
    }

    .card-body img {
        width: 60px;
        /* Atur lebar tetap untuk logo */
        height: auto;
        /* Biarkan tinggi mengikuti proporsi asli */
    }
</style>
<div class="col-lg-12">
    <!-- Head Card: Data Apotek -->
    <div class="card bg-light">
        <div class="card-header">
            <h3 class="card-title">Data Apotek</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Small Box: Detail Apotek -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $jmlinfotoko ?></h3>
                            <p>Detail Apotek</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                        <a href="<?= base_url('InfoToko') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Small Box: Wilayah -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3><?= $jmlwilayah ?></h3>
                            <p>Wilayah</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <a href="<?= base_url('Wilayah') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Cards Apotek -->
                <?php
                // Array berisi daftar kelas warna latar belakang
                $bgColors = ['bg-primary', 'bg-danger', 'bg-dark', 'bg-warning', 'bg-success', 'bg-info'];

                $db = \Config\Database::connect();
                foreach ($toko as $key => $value) {
                    $jml = $db->table('tbl_infotoko')->where('id_merek', $value['id_merek'])->countAllResults();
                    // Ambil logo dari tabel tbl_toko berdasarkan id_merek
                    $logo = $db->table('tbl_toko')->select('logo')->where('id_merek', $value['id_merek'])->get()->getRow();

                    // Pilih secara acak kelas warna latar belakang
                    $randomBgColor = $bgColors[array_rand($bgColors)];
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <!-- small box -->
                        <div class="small-box <?= $randomBgColor ?>">
                            <div class="inner">
                                <div class="row align-items-center">
                                    <div class="col text-center">
                                        <h3><?= $jml ?></h3>
                                        <p><?= $value['merek'] ?></p>
                                    </div>
                                    <div class="col text-center">
                                        <div class="icon">
                                            <?php if ($logo && !empty($logo->logo)) { ?>
                                                <img src="<?= base_url('icon/' . $logo->logo) ?>" alt="Logo <?= $value['merek'] ?>" width="150">
                                            <?php } else { ?>
                                                <img src="<?= base_url('icon/default-logo.png') ?>" alt="Default Logo">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- End of Cards Apotek -->
            </div>
        </div>
    </div>
    <!-- End of Head Card: Data Apotek -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="col-lg-12">
    <!-- Card Data Apotek By Kecamatan -->
    <div class="card bg-light">
        <div class="card-header">
            <h3 class="card-title">Data Apotek By Kecamatan</h3>
        </div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <?php
                // Query untuk mengambil data kecamatan dari tbl_infotoko
                $query = $db->table('tbl_infotoko')
                    ->select('tbl_kecamatan.id_kecamatan, tbl_kecamatan.nama_kecamatan, COUNT(tbl_infotoko.id_merek) as jumlah')
                    ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_infotoko.id_kecamatan')
                    ->groupBy('tbl_infotoko.id_kecamatan')
                    ->get();

                foreach ($query->getResult() as $row) :
                    // Query untuk mengambil data merek dan jumlahnya dalam kecamatan tertentu
                    $merekQuery = $db->table('tbl_infotoko')
                        ->select('tbl_toko.merek, COUNT(tbl_infotoko.id_merek) as jumlah_merek, tbl_toko.logo')
                        ->join('tbl_toko', 'tbl_toko.id_merek = tbl_infotoko.id_merek')
                        ->where('tbl_infotoko.id_kecamatan', $row->id_kecamatan)
                        ->groupBy('tbl_infotoko.id_merek')
                        ->get();
                ?>
                    <!-- Card Kecamatan -->
                    <div class="col mb-3">
                        <div class="card bg-success">
                            <div class="card-header">
                                <h5 class="card-title"><?= $row->nama_kecamatan ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col text-center">
                                        <h3 style="font-size: 40px;">
                                            <?= $row->jumlah ?>
                                        </h3>
                                    </div>
                                    <div class="col text-center">
                                        <h3 style="font-size: 60px;">
                                            <i class="fas fa-database" style="opacity: 0.1;"></i>
                                        </h3>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-success col text-center" type="button" data-toggle="collapse" data-target="#collapse<?= $row->id_kecamatan ?>" aria-expanded="false" aria-controls="collapse<?= $row->id_kecamatan ?>">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                                <div class="collapse" id="collapse<?= $row->id_kecamatan ?>">
                                    <div class="card mt-3" style="background-color: #28a745;">
                                        <div class="card-body">
                                            <?php foreach ($merekQuery->getResult() as $merekRow) : ?>
                                                <div class="row align-items-center" style="font-size: 20px;">
                                                    <div class="col-auto pr-3">
                                                        <img src="<?= base_url('icon/' . $merekRow->logo) ?>" alt="Logo <?= $merekRow->merek ?>" width="60"> <!-- Lebih besar -->
                                                    </div>
                                                    <div class="col pl-0">
                                                        <div class="row align-items-center">
                                                            <div class="col"><?= $merekRow->merek ?>:</div>
                                                            <div class="col"><?= $merekRow->jumlah_merek ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- End of Card Data Apotek By Kecamatan -->
</div>

<script>
    // Memastikan animasi slider hanya dijalankan setelah DOM selesai dimua
    $(document).ready(function() {
        $('[data-toggle="collapse"]').click(function() {
            $(this).find('.fas').toggleClass('fa-arrow-circle-right fa-arrow-circle-down'); // Toggle antara icon panah ke kanan dan ke bawah
        });
    });
</script>