<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>
            <div class="card-body">
                <form id="form1" action="<?= site_url('admin/aset_di_desa/update/' . $id) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Nik</label>
                                <input type="text" class="form-control nik" readonly value="<?= set_value('nik', $nik) ?>" name="nik" placeholder="Masukan NIK">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control nama_pemilik" name="nama_pemilik" value="<?= set_value('nama_pemilik', $nama_pemilik) ?>" placeholder="Masukan Nama Pemilik">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">No NPWP</label>
                                <input type="text" readonly class="form-control no_npwp" name="no_npwp" value="<?= set_value('no_npwp', $no_npwp) ?>" placeholder="Masukan No NPWP">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Letak Objek Pajak</label>
                                <input type="text" class="form-control letak_objek_pajak" name="letak_objek_pajak" value="<?= set_value('letak_objek_pajak', $letak_objek_pajak) ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Pajak</label>
                                <select class="form-control js-example-basic-single jenis_pajak" name="jenis_pajak"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Perkiraan Nilai Objek Pajak</label>
                                <input type="text" onkeyup="formatRupiah(this)" class="form-control perkiraan_nilai_objek_pajak" name="perkiraan_nilai_objek_pajak" placeholder="Masukan Perkiraan Nilai Objek Pajak" value="<?= set_value('perkiraan_nilai_objek_pajak', $perkiraan_nilai_objek_pajak) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Bulan Jatuh Tempo</label>
                                <select class="form-control js-example-basic-single bulan_jatuh_tempo" name="bulan_jatuh_tempo">
                                    <?php
                                    $bulan = array(
                                        'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember'
                                    );

                                    for ($i = 0; $i < count($bulan); $i++) :
                                    ?>
                                        <option value="<?= $bulan[$i]; ?>" <?= ($bulan_jatuh_tempo == $bulan[$i]) ? 'selected' : ''; ?>><?= $bulan[$i]; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Aset</label>
                                <select class="form-control js-example-basic-single jenis_aset" name="jenis_aset"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Status Pemilik</label>
                                <select class="form-control js-example-basic-single status_pemilik" name="status_pemilik"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <!-- Base Radios -->
                                <label class="form-label">Penduduk Asli Desa</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('penduduk_asli', $penduduk_asli) == 'ya') ? 'checked' : ''; ?> class="form-check-input penduduk_asli" type="radio" name="penduduk_asli" value="ya">
                                        <label class="form-check-label"> Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('penduduk_asli', $penduduk_asli) == 'tidak') ? 'checked' : ''; ?> class="form-check-input penduduk_asli" type="radio" name="penduduk_asli" value="tidak">
                                        <label class="form-check-label"> Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Luas Lahan</label>
                                <input type="text" class="form-control luas_lahan" name="luas_lahan" value="<?= set_value('luas_lahan', $luas_lahan); ?>" placeholder="Masukan Luas Lahan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Koordinat</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalMap1">Tampilkan Peta</button>
                                    <input type="text" class="form-control lat_lng" name="koordinat" value="<?= set_value('koordinat', $koordinat) ?>" placeholder="Garis Bujur & lintang">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row poligonInput">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Polygon</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalPoligon">Tampilkan Peta</button>
                                    <textarea class="form-control poligon" name="poligon" id="poligon" readonly cols="30" rows="10"><?= set_value('poligon', $poligon); ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <!-- Base Radios -->
                                <label class="form-label">Pengamanan Fisik</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('pengamanan_fisik', $pengamanan_fisik) == 'ada') ? 'checked' : ''; ?> class="form-check-input pengamanan_fisik" type="radio" name="pengamanan_fisik" value="ada">
                                        <label class="form-check-label"> Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('pengamanan_fisik', $pengamanan_fisik) == 'tidak') ? 'checked' : ''; ?> class="form-check-input pengamanan_fisik" type="radio" name="pengamanan_fisik" value="tidak">
                                        <label class="form-check-label"> Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan_fisik" class="form-control keterangan_fisik"><?php echo set_value('keterangan_fisik', $keterangan_fisik) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <!-- Base Radios -->
                                <label class="form-label">Pengamanan Hukum</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('pengamanan_hukum', $pengamanan_hukum) == 'ada') ? 'checked' : ''; ?> class="form-check-input pengamanan_hukum" type="radio" name="pengamanan_hukum" value="ada">
                                        <label class="form-check-label"> Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input <?= (set_value('pengamanan_hukum', $pengamanan_hukum) == 'tidak') ? 'checked' : ''; ?> class="form-check-input pengamanan_hukum" type="radio" name="pengamanan_hukum" value="tidak">
                                        <label class="form-check-label"> Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form_hukum" <?= (set_value('pengamanan_hukum', $pengamanan_hukum) == 'tidak') ? 'hidden' : ''; ?>>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Surat Bukti Kemelikan</label>
                                    <input type="text" class="form-control nomor_bukti_kepemilikan" name="nomor_bukti_kepemilikan" value="<?= set_value('nomor_bukti_kepemilikan', $nomor_bukti_kepemilikan) ?>" placeholder="Masukan nomor sertifikat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div>
                                        <label for="formFile" class="form-label">Upload Surat
                                            <?php if (file_exists("uploads/aset_di_desa/pdf/" . $file_surat_kepemilikan)) : ?>
                                                <a target="_blank" href="<?= site_url("uploads/aset_di_desa/pdf/" . $file_surat_kepemilikan); ?>">Lihat PDF yang sudah diupload</a>
                                            <?php endif; ?>
                                        </label>
                                        <input class="form-control" type="file" name="file_surat_kepemilikan">
                                        <input type="hidden" name="nama_file_pdf" value="<?= $file_surat_kepemilikan; ?>">
                                        <span class="text-muted">File pdf maksimal size 2mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan_hukum" class="form-control keterangan_hukum" placeholder="Masukan keterangan hukum"><?= set_value('keterangan_hukum', $keterangan_hukum) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($foto)) : foreach (json_decode($foto) as $f) : ?>

                            <?php if (file_exists("uploads/aset_di_desa/images/" . $f->nama_file)) : ?>
                                <div class="col-3 show_data">
                                    <div class="md-3">
                                        <label data-id="<?= $f->nama_file; ?>" for="varchar" class="btn btn-danger hapus la la-trash-o"></label>
                                        <img data-bs-toggle="modal" data-bs-target="#myModal" src="<?= base_url($f->path_file); ?>" class="rounded" alt="200x200" width="200">
                                        <!-- Default Modals -->
                                        <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Kabar Desa Desa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <img class='img-fluid' src="<?= base_url($f->path_file); ?>">
                                                        </center>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                                <input type="hidden" name="file_name[]" value="<?= $f->nama_file; ?>">
                            <?php endif; ?>

                    <?php endforeach;
                    endif; ?>
                    <!--end col-->

                    <div class="row">
                        <div class="col-12 tambah">
                            <div class="mb-3">
                                <a href="javascript:addItem()" class="btn btn-primary"><i class="mdi mdi-plus btn-icon-prepend"></i> Buat File Upload</a>
                            </div>
                        </div>
                    </div>


                    <!--end row-->

                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/aset_di_desa/index'); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalMap1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Peta</h5>
            </div>
            <div class="modal-body">
                <p class="fs-15 text-info mb-5">Klik pada peta atau lakukan pencarian lokasi untuk mendapatkan koordinat</p>
                <div class="mb-5" id="pac-card">
                    <div class="input-group" id="pac-container">
                        <input type="text" class="form-control" id="pac-input" placeholder="address...">
                    </div>
                </div>
                <div style="height:350px;" id="map1"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade modalPoligon" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Peta</h5>
            </div>
            <div class="modal-body">
                <p class="fs-15 text-info mb-5">Klik pada peta atau lakukan pencarian lokasi untuk mendapatkan koordinat</p>
                <div class="mb-5" id="pac-card3">
                    <div class="input-group" id="pac-container">
                        <input type="text" class="form-control" id="pac-input3" placeholder="address...">
                    </div>
                </div>
                <div style="height:350px;" id="polygonmap"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= base_url('dist/') ?>assets/js/app.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCynBKMoc3o3YGdscEYadjoFFyqtXhqjuY&libraries=places,geometry,drawing"></script>
<script src="<?= base_url('dist/') ?>assets/libs/gmaps/gmaps.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/js/pages/map_aset_desa.js"></script>

<script>
    $(document).ready(function() {

        $('.bulan_jatuh_tempo').select2();

        $('.pengamanan_hukum').change(function() {
            if ($(this).val() === 'ada') {
                $('.form_hukum').attr('hidden', false);
            } else {
                $('.form_hukum').attr('hidden', true);
            }
        });

        ajaxSelectFromApi({
            id: '.jenis_pajak',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_pajak' ?>',
            selected: '<?= set_value('jenis_pajak', $jenis_pajak) ?>',
        });

        ajaxSelectFromApi({
            id: '.jenis_aset',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_aset' ?>',
            selected: '<?= set_value('jenis_aset', $jenis_aset) ?>',
        });

        ajaxSelectFromApi({
            id: '.status_pemilik',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/status_pemilik' ?>',
            selected: '<?= set_value('status_pemilik', $status_pemilik) ?>',
        });
    })

    $(document).on('click', '.btnModalMap1', function(data) {
        $('.modalMap1').modal('show')
    });

    $(document).on('click', '.btnModalPoligon', function(data) {
        $('.modalPoligon').modal('show')
    });

    let clicks = 0;

    function addItem() {
        clicks += 1;
        $('.tambah').after(`
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Foto ` + clicks + `</label>
                        <input class="form-control" type="file" name="foto[]">
                    </div>
                </div>
            </div>
        `);
    }

    $("body").on("click", ".hapus", function(e) {
        var nama_file = $(this).attr("data-id");
        $.ajax({
            url: '<?php echo site_url("admin/aset_di_desa/hapus_gambar"); ?>',
            type: 'POST',
            data: {
                nama_file: nama_file,
            }
        })
        $(this).parents('.show_data').remove();
    });

    function formatRupiah(input) {
        var angka = input.value.replace(/[^\d]/g, '');

        var rupiah = '';
        var angkaRev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkaRev.length; i++) {
            if (i % 3 == 0) rupiah += '.';
            rupiah += angkaRev[i];
        }

        var result = 'Rp ' + rupiah.split('').reverse().join('');

        input.value = result;
    }
</script>