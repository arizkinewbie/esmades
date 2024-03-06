<style>
    .pac-container, .pac-container2 {
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
                <form action="<?= site_url('admin/aset_desa/create') ?>" method="post" id="form1">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control nama_barang" name="nama_barang" value="<?= set_value('nama_barang') ?>" placeholder="Masukan nama barang">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalBarang">Cari Kode Barang</button>
                                    <input type="text" class="form-control barang_kode" name="barang_kode" value="<?= set_value('barang_kode') ?>" readonly placeholder="Kode barang">
                                    <input type="text" class="form-control barang_nama" name="barang_nama" value="<?= set_value('barang_nama') ?>" readonly placeholder="Nama barang">
                                    <!-- <input type="text" class="form-control nomor_urut" name="nomor_urut" value="<?= set_value('nomor_urut') ?>" readonly placeholder="Nomor Urut"> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Identitas Barang</label>
                                <textarea name="identitas_barang" class="form-control" placeholder="Masukan identitas barang"><?= set_value('identitas_barang') ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tahun Pengadaan</label>
                                <input type="text" class="form-control tahun_pengadaan yearpicker" readonly name="tahun_pengadaan" value="<?= set_value('tahun_pengadaan') ?>" placeholder="Masukan tahun pengadaan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tanggal Perolehan</label>
                                <input type="text" class="form-control tanggal_perolehan datepicker" readonly name="tanggal_perolehan" value="<?= set_value('tanggal_perolehan') ?>" placeholder="Masukan Tanggal Perolehan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nilai</label>
                                <input type="text" class="form-control nilai_satuan cleave-numeral" name="nilai_satuan" value="<?= set_value('nilai_satuan') ?>" placeholder="Masukan nilai">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Satuan</label>
                                <select class="form-control js-example-basic-single aset_satuan_id" name="aset_satuan_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nilai Kekayaan</label>
                                <input type="text" class="form-control nilai_kekayaan cleave-numeral" name="nilai_kekayaan" value="<?= set_value('nilai_kekayaan') ?>" placeholder="Masukan Nilai Kekayaan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Asal Usul</label>
                                <select class="form-control js-example-basic-single aset_asal_usul_id" name="aset_asal_usul_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 aset_bidang">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Bidang</label>
                                <select class="form-control js-example-basic-single aset_bidang_kode" name="aset_bidang_kode"></select>
                            </div>
                        </div>
                    </div>
                    <div class="aset_sub_bidang" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Sub Bidang</label>
                                    <select class="form-control js-example-basic-single aset_subbidang_kode" name="aset_subbidang_kode"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Sub Bidang Kegiatan</label>
                                    <select class="form-control js-example-basic-single aset_subbidang_kegiatan_kode" name="aset_subbidang_kegiatan_kode"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kondisi Barang</label>
                                <select class="form-control js-example-basic-single kondisi_barang"
                                    name="kondisi_barang"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fisik Barang</label>
                                <select class="form-control js-example-basic-single fisik_barang"
                                    name="fisik_barang"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Koordinat</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalMap1">Tampilkan Peta</button>
                                    <input type="text" class="form-control lat_lng" name="lat_lng" value="<?= set_value('lat_lng') ?>" placeholder="Garis Bujur & lintang">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row poligonInput" hidden>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Polygon</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalPoligon">Tampilkan Peta</button>
                                    <textarea class="form-control poligon" name="poligon" id="poligon" readonly cols="30" rows="10"></textarea>
                                    <!-- <input type="text" class="form-control lat_lng" name="lat_lng" value="<?= set_value('lat_lng') ?>" placeholder="Garis Bujur & lintang"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <textarea name="files" id="files" cols="30" rows="10" hidden></textarea>
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

                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end row-->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
<div class="modal fade modalMap1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
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
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade modalPoligon" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
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
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
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


$(document).on('click', '.btnModalMap1', function(data){
    $('.modalMap1').modal('show')
});

$(document).on('click', '.btnModalPoligon', function(data){
    $('.modalPoligon').modal('show')
});

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
    id: '.aset_satuan_id',
    headers: {
        "Authorization": "Bearer <?= $token ?>"
    },
    url: '<?= $apiDomain . '/api/select2/satuan_aset' ?>',
    selected: '<?= set_value('aset_satuan_id') ?>',
});

$(document).on('change', '.aset_satuan_id', function(data) {
    var val = $(this).val()
    if(val == '2') {
        $('.poligonInput').attr('hidden', true)
        $('.poligon').val('')
    } else {
        $('.poligonInput').attr('hidden', false)
    }
});

ajaxSelectFromApi({
    id: '.aset_asal_usul_id',
    headers: {
        "Authorization": "Bearer <?= $token ?>"
    },
    url: '<?= $apiDomain . '/api/select2/asal_usul_aset' ?>',
    selected: '<?= set_value('aset_asal_usul_id') ?>',
});

ajaxSelectFromApi({
    id: '.aset_bidang_kode',
    headers: {
        "Authorization": "Bearer <?= $token ?>"
    },
    url: '<?= $apiDomain . '/api/select2/bidang_aset' ?>',
    selected: '<?= set_value('aset_bidang_kode') ?>',
});



$('.aset_subbidang_kode').select2({placeholder: 'Pilih Opsi'});
$('.aset_subbidang_kegiatan_kode').select2({placeholder: 'Pilih Opsi'});

$(document).on('change', '.aset_bidang_kode', function(data) {
    var val = $(this).val()
    $('.aset_subbidang_kode').val('').trigger('change');
    ajaxSelectFromApi({
        id: '.aset_subbidang_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/sub_bidang_aset' ?>',
        selected: '<?= set_value('aset_subbidang_kode') ?>',
        optionalSearch: {aset_bidang_kode : val}
    });
})

$(document).on('change', '.aset_subbidang_kode', function(data) {
    var val = $(this).val()
    $('.aset_subbidang_kegiatan_kode').val('').trigger('change');
    ajaxSelectFromApi({
        id: '.aset_subbidang_kegiatan_kode',
        headers: {
            "Authorization": "Bearer <?= $token ?>"
        },
        url: '<?= $apiDomain . '/api/select2/sub_bidang_kegiatan_aset' ?>',
        selected: '<?= set_value('aset_subbidang_kegiatan_kode') ?>',
        optionalSearch: {aset_subbidang_kode : val}
    });
})

$(document).on('change', '.aset_asal_usul_id', function(data) {
    var val = $(this).val()
    if(val == '2') {
        $('.aset_sub_bidang').attr('hidden', false)
        $('.aset_subbidang_kode').select2({
            placeholder: 'Pilih Opsi'
        }).val('').trigger('change');
    } else {
        $('.aset_sub_bidang').attr('hidden', true)
        $('.aset_subbidang_kode').select2().val('').trigger('change');
    }
})



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
}).val('<?= set_value('kondisi_barang') ?>').trigger('change');

$('.fisik_barang').select2({
    placeholder: 'Pilih Opsi',
    data: [{
            id: 'Ada',
            text: 'Ada'
        },
        {
            id: 'Tidak Ada',
            text: 'Tidak Ada'
        },
    ]
}).val('<?= set_value('fisik_barang') ?>').trigger('change');

var formData = new FormData();
var dataFiles = [];
var textareaFiles = $("#files");
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
if(dropzonePreviewNode){
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone", {
        autoQueue: true,
        url: '<?= site_url('admin/aset_desa/') ?>upload_file',
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview",
        success: function(file, response) {
            dataFiles.push(response);
            textareaFiles.val(JSON.stringify(dataFiles));
        },
        error: function(file, respon) {
            this.removeFile(file)
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: respon.message.file,
            });
        },

        init: function() {
            
            this.on("removedfile", function (file) {
                console.log(file.upload.uuid);
            });
            this.on("addedfile", function (file) {
                // var myForm = document.getElementById('form1');
                // formData = new FormData(myForm);
                // console.log(formData);
            });
            this.on("sendingmultiple", function (file, xhr, formData) {
                
            });
        }
    });
}

function base64ToImage(base64Image, filename) {
    // Buat elemen <a> untuk menampilkan file
    var a = document.createElement('a');
    a.href = base64Image;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>