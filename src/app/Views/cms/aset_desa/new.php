<div class="row">
    <div class="col-md-12">

        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/jabatan/create') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalBarang">Cari Kode Barang</button>
                                    <input type="text" class="form-control barang_kode" name="barang_kode" readonly placeholder="Kode barang">
                                    <input type="text" class="form-control barang_nama" name="barang_nama" readonly placeholder="Nama barang">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Identitas Barang</label>
                                <input type="text" class="form-control identitas_barang" name="identitas_barang" placeholder="Identitas Barang">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tahun Pengadaan</label>
                                <input type="text" class="form-control tahun_pengadaan" name="tahun_pengadaan"
                                    placeholder="Masukan tahun pengadaan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tanggal Perolehan</label>
                                <input type="text" class="form-control tanggal_perolehan" name="tanggal_perolehan"
                                    placeholder="Masukan Tanggal Perolehan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nilai Kekayaan</label>
                                <input type="text" class="form-control nilai_kekayaan" name="nilai_kekayaan"
                                    placeholder="Masukan Nilai Kekayaan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Opsi Satuan</label>
                                <select class="form-control js-example-basic-single opsi_satuan" name="opsi_satuan"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nilai Satuan</label>
                                <input type="text" class="form-control nilai_satuan" name="nilai_satuan" placeholder="Nilai Satuan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Asal Usul Aset</label>
                                <select class="form-control js-example-basic-single asal_usul_aset_id" name="asal_usul_aset_id"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Bidang Aset</label>
                                <select class="form-control js-example-basic-single bidang_aset_id" name="bidang_aset_id"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kondisi Barang</label>
                                <select class="form-control js-example-basic-single kondisi_barang"
                                    name="kondisi_barang"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>

                                    <h4>Drop files here or click to upload.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalBarang" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
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
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var tableBarang;
$(document).on('click', '.btnModalBarang', function(data){
    $('.modalBarang').modal('show')

    tableBarang = $('#tblBarang').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        destroy: true,
        ajax: {
            url: '<?= $apiDomain ?>/api/datatable/barang_bantu',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer <?= $token ?>');
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'barang_kode'},
            {data: 'barang_nama'},
            {data: 'nama'},
            {data: 'kode'},
        ]
    });
})

$('#tblBarang tbody').on('click', 'tr', function () {
    var data = tableBarang.row(this).data();
    var barangKode = data['barang_kode'];
    var barangNama = data['barang_nama'];
    $('.barang_kode').val(barangKode);
    $('.barang_nama').val(barangNama);
    $('.modalBarang').modal('hide')
});

ajaxSelectFromApi({
    id: '.asal_usul_aset_id',
    headers: {
        "Authorization": "Bearer <?= $token ?>"
    },
    url: '<?= $apiDomain . '/api/select2/asal_usul_aset' ?>',
});

ajaxSelectFromApi({
    id: '.bidang_aset_id',
    headers: {
        "Authorization": "Bearer <?= $token ?>"
    },
    url: '<?= $apiDomain . '/api/select2/bidang_aset' ?>',
});

$('.opsi_satuan').select2({
    placeholder: 'Pilih Opsi',
    data: [{
            id: 'Jumlah',
            text: 'Jumlah'
        },
        {
            id: 'Luas',
            text: 'Luas'
        },
    ]
});

$('.kondisi_barang').select2({
    placeholder: 'Pilih Opsi',
    data: [{
            id: 'Baik',
            text: 'Baik'
        },
        {
            id: 'Rusak Ringan',
            text: 'Rusak Ringan'
        },
        {
            id: 'Rusak Berat',
            text: 'Rusak Berat'
        },
    ]
});

var barang_bidang_kode = $('.barang_bidang_kode').select2({
    placeholder: 'Pilih Opsi'
});
var barang_kelompok_kode = $('.barang_kelompok_kode').select2({
    placeholder: 'Pilih Opsi'
});
// var barang_kode = $('.barang_kode').select2({ placeholder: 'Pilih Opsi' });
var barang_bantu_kode = $('.barang_bantu_kode').select2({
    placeholder: 'Pilih Opsi'
});



$(document).on('change', '.barang_golongan_kode', function() {
    barang_bidang_kode.val('').trigger('change');
    barang_kelompok_kode.val('').trigger('change');
    barang_kode.val('').trigger('change');
    barang_bantu_kode.val('').trigger('change');

    var val = $(this).val();
    ajaxSelectFromApi({
        id: '.barang_bidang_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/barang_bidang' ?>',
        optionalSearch: {
            barang_golongan_kode: val
        },
    });
});

$(document).on('change', '.barang_bidang_kode', function() {
    barang_kelompok_kode.val('').trigger('change');
    barang_kode.val('').trigger('change');
    barang_bantu_kode.val('').trigger('change');

    var val = $(this).val();
    ajaxSelectFromApi({
        id: '.barang_kelompok_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/barang_kelompok' ?>',
        optionalSearch: {
            barang_bidang_kode: val
        },
    });
});

$(document).on('change', '.barang_kelompok_kode', function() {
    barang_kode.val('').trigger('change');
    barang_bantu_kode.val('').trigger('change');

    var val = $(this).val();
    ajaxSelectFromApi({
        id: '.barang_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/barang' ?>',
        optionalSearch: {
            barang_kelompok_kode: val
        },
    });
});

$(document).on('change', '.barang_kode', function() {
    barang_bantu_kode.val('').trigger('change');
    var val = $(this).val();
    ajaxSelectFromApi({
        id: '.barang_bantu_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/barang_bantu' ?>',
        optionalSearch: {
            barang_kode: val
        },
    });
});
</script>