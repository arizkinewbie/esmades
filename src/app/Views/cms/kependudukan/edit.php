<style>
    .pac-container,
    .pac-container2 {
        z-index: 1099;
        position: fixed !important;
        top: 25% !important;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/kependudukan/update/' . $id) ?>" method="post" id="form1" enctype='multipart/form-data'>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nomor KK</label>
                                <input type="text" class="form-control nomor_kk" name="nomor_kk" value="<?= set_value('nomor_kk', $nomor_kk) ?>" placeholder="Nomor KK">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">NIK</label>
                                <input type="text" class="form-control nik" name="nik" value="<?= set_value('nik', $nik) ?>" placeholder="NIK">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control nama_kepala_keluarga" name="nama_kepala_keluarga" value="<?= set_value('nama_kepala_keluarga', $nama_kepala_keluarga) ?>" placeholder="Nama Kepala Keluarga">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Jenis Kelamin</label>
                                <select class="form-control js-example-basic-single jenis_kelamin" name="jenis_kelamin"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control tempat_lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir', $tempat_lahir) ?>" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control tanggal_lahir datepicker" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $tanggal_lahir) ?>" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Agama</label>
                                <select class="form-control js-example-basic-single agama_id" name="agama_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Pendidikan</label>
                                <select class="form-control js-example-basic-single pendidikan_id" name="pendidikan_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Jenis Pekerjaan</label>
                                <select class="form-control js-example-basic-single jenis_pekerjaan_id" name="jenis_pekerjaan_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Golongan Darah</label>
                                <input type="text" class="form-control goldar" name="goldar" value="<?= set_value('goldar', $goldar) ?>" placeholder="Golongan Darah">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap"><?= set_value('alamat', $alamat) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">RT</label>
                                <input type="text" class="form-control rt" name="rt" value="<?= set_value('rt', $rt) ?>" placeholder="RT">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">RW</label>
                                <input type="text" class="form-control rw" name="rw" value="<?= set_value('rw', $rw) ?>" placeholder="RW">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Desa</label>
                                <input type="text" readonly class="form-control desa_nama" name="desa_nama" value="<?= set_value('desa_nama') ?>" placeholder="Desa">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Kecamatan</label>
                                <input type="text" readonly class="form-control kecamatan_nama" name="kecamatan_nama" value="<?= set_value('kecamatan_nama') ?>" placeholder="Kecamatan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Kabupaten</label>
                                <input type="text" readonly class="form-control kabupaten_nama" name="kabupaten_nama" value="<?= set_value('kabupaten_nama') ?>" placeholder="Kabupaten">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Provinsi</label>
                                <input type="text" readonly class="form-control provinsi_nama" name="provinsi_nama" value="<?= set_value('provinsi_nama') ?>" placeholder="Provinsi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Kode Pos</label>
                                <input type="text" required class="form-control kode_pos" name="kode_pos" value="<?= set_value('kode_pos', $kode_pos) ?>" placeholder="Kode Pos">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Koordinat</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalMap1">Tampilkan Peta</button>
                                    <input type="text" class="form-control lat_lng" name="lat_lng" value="<?= set_value('lat_lng', $lat_lng) ?>" placeholder="Garis Bujur & lintang">
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
                                    <textarea class="form-control poligon" name="poligon" id="poligon" readonly cols="30" rows="10"><?= set_value('poligon', $poligon) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--end row-->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                <a href="<?= site_url('admin/kependudukan/index') ?>" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalBarang" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Table Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fs-15 text-info mb-5">Silahkan klik pada baris barang yang akan dipilih</h6>

                <table class="table w-100 table-borderd table-striped table-hover table-sm" id="tblBarang">
                    <thead>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang Bantu</th>
                        <th>Nama Barang Bantu</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
    var tableBarang;

    $.ajax({
        url: '<?= $apiDomain ?>/api/profil/29198',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer <?= $token ?>');
        },
        "method": "GET",
    }).done(function (response) {
        var data = response;
        $('.desa_nama').val(data.desa_nama);
        $('.kecamatan_nama').val(data.kecamatan_nama);
        $('.kabupaten_nama').val(data.kabupaten_nama);
        $('.provinsi_nama').val(data.provinsi_nama);
    });

    $(document).on('click', '.btnModalMap1', function(data) {
        $('.modalMap1').modal('show')
    });

    $(document).on('click', '.btnModalPoligon', function(data) {
        $('.modalPoligon').modal('show')
    });


    ajaxSelectFromApi({
        id: '.agama_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/agama' ?>',
        selected: '<?= set_value('agama_id', $agama_id) ?>',
    });
    ajaxSelectFromApi({
        id: '.jenis_pekerjaan_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/jenis_pekerjaan' ?>',
        selected: '<?= set_value('jenis_pekerjaan_id', $jenis_pekerjaan_id) ?>',
    });
    ajaxSelectFromApi({
        id: '.pendidikan_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/pendidikan' ?>',
        selected: '<?= set_value('pendidikan_id', $pendidikan_id) ?>',
    });
    $('.jenis_kelamin').select2({
        placeholder: 'Pilih Opsi',
        data: [
            {id: 'Laki-laki', text: 'Laki-laki'},
            {id: 'Perempuan', text: 'Perempuan'},
        ]
    }).val('<?= set_value('jenis_kelamin', $jenis_kelamin) ?>').trigger('change')
</script>