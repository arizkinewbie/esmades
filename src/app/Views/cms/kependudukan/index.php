<div class="row">
    <div class="col-lg-12">
        <?php echo view('cms/partials/alerts', array('tipe' => 'success')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'error')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'listErrors')) ?>        
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
                <div>
                    <a data-bs-toggle="collapse" href="#multiCollapseExample1"
                    role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-success">Pencarian</a>
                    <a href="<?= site_url('admin/aset_desa/new') ?>" class="btn btn-primary">Add New Row</a>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <form action="#">
                        <div class="card card-body mb-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Pengadaan</label>
                                        <select class="form-control js-example-basic-single tahun_pengadaan" name="tahun_pengadaan"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Golongan</label>
                                        <select class="form-control js-example-basic-single barang_golongan_kode" name="barang_golongan_kode"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bidang</label>
                                        <select class="form-control js-example-basic-single barang_bidang_kode" name="barang_bidang_kode"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Kelompok</label>
                                        <select class="form-control js-example-basic-single barang_kelompok_kode" name="barang_kelompok_kode"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Sub Kelompok</label>
                                        <select class="form-control js-example-basic-single barang_kode" name="barang_kode"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Register</label>
                                        <select class="form-control js-example-basic-single status_registrasi" name="status_registrasi"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="table" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>No.</th>
                            <th class="w-50">Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Register</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end row-->
<div class="modal fade modalDetail" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Detail Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formDetail"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var table;

    table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        draw: true,
        ajax: {
            url: '<?= $apiDomain ?>/api/datatable/aset_desa',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer <?= $token ?>');
            }
        },
        columns: [
            { data: 'id', visible: false, searchable: false},
            { data: 'barang_golongan_kode', visible: false},
            { data: 'barang_bidang_kode', visible: false},
            { data: 'barang_kelompok_kode', visible: false},
            { data: 'barang_kode', visible: false},
            { data: 'tahun_pengadaan', visible: false},
            { data: 'status_registrasi', visible: false},
            { data: 'no', orderable: false, searchable: false},
            { data: 'nama_barang', searchable: false},
            { data: 'barang_kode', searchable: false},
            {
                data: 'nomor_urut_barang',
                searchable: false,
                render: function(data, type, row) {
                    return row.barang_kode + ' | ' + data;
                }
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-center',
                width: '100px',
                render: function(data, type, row) {
                    var html = `<div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">`;
                    html += `<li><a href="javascript:detailData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Detail</a></li>`;
                    if(row.status_registrasi == '1') {
                        html += `<li><a href="javascript:registerData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-external-link-fill align-bottom me-2 text-muted"></i> Register</a></li>`;
                    }
                    html += `<li><a href="javascript:tutupTransaksi(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-book-fill align-bottom me-2 text-muted"></i> Tutup Transaksi</a></li>`;
                    html += `<li><a href="<?= site_url('admin/aset_desa/') ?>edit/` + data + `" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>`;
                    html += `<li><a href="javascript:deleteData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>`;
                    html += `</ul></div>`;
                    return html;
                }
            },
        ]
    });

    function detailData(id) {
        $('.formDetail').load('<?= site_url('admin/aset_desa/show/') ?>' + id, function(response, status, xhr) {
            if (status == "error") {
                alert('Error:', xhr.statusText)
                return;
            }
            $('.modalDetail').modal('show');
        });
    }

    $('.barang_golongan_kode').on('change', function() {
        table.column(1).search(this.value).draw();
    });
    $('.barang_bidang_kode').on('change', function() {
        table.column(2).search(this.value).draw();
    });
    $('.barang_kelompok_kode').on('change', function() {
        table.column(3).search(this.value).draw();
    });
    $('.barang_kode').on('change', function() {
        table.column(4).search(this.value).draw();
    });
    $('.tahun_pengadaan').on('change', function() {
        table.column(5).search(this.value).draw();
    });
    $('.status_registrasi').on('change', function() {
        table.column(6).search(this.value).draw();
    });


    // create select2 years 
    var currentYear = new Date().getFullYear();
    var data = [];
    for (var i = currentYear - 5; i <= currentYear; i++) {
        data.push({ id: i, text: i });
    }
    $('.tahun_pengadaan').select2({
        placeholder: 'Pilih Opsi',
        data: data,
    }).val(currentYear).trigger('change')
    
    // create select2 registrasi
    $('.status_registrasi').select2({
        placeholder: 'Pilih Opsi',
        data: [{id: '2', text: 'Sudah'},{id: '1', text: 'Belum'}],
    }).val('').trigger('change')

    var barang_bidang_kode = $('.barang_bidang_kode').select2({placeholder: 'Pilih Opsi'});
    var barang_kelompok_kode = $('.barang_kelompok_kode').select2({placeholder: 'Pilih Opsi'});
    var barang_kode = $('.barang_kode').select2({placeholder: 'Pilih Opsi'});

    ajaxSelectFromApi({
        id: '.barang_golongan_kode',
        headers: { "Authorization": "Bearer <?= $token ?>"},
        url: '<?= $apiDomain . '/api/select2/barang_golongan' ?>',
    });
    $(document).on('change', '.barang_golongan_kode', function(){
        barang_bidang_kode.val('').trigger('change');
        barang_kelompok_kode.val('').trigger('change');
        barang_kode.val('').trigger('change');
        ajaxSelectFromApi({
            id: '.barang_bidang_kode',
            headers: { "Authorization": "Bearer <?= $token ?>"},
            url: '<?= $apiDomain . '/api/select2/barang_bidang' ?>',
            optionalSearch: {barang_golongan_kode: $(this).val()},
        });
    })
    $(document).on('change', '.barang_bidang_kode', function(){
        barang_kelompok_kode.val('').trigger('change');
        barang_kode.val('').trigger('change');
        ajaxSelectFromApi({
            id: '.barang_kelompok_kode',
            headers: { "Authorization": "Bearer <?= $token ?>"},
            url: '<?= $apiDomain . '/api/select2/barang_kelompok' ?>',
            optionalSearch: {barang_bidang_kode: $(this).val()},
        });
    })
    $(document).on('change', '.barang_kelompok_kode', function(){
        barang_kode.val('').trigger('change');
        ajaxSelectFromApi({
            id: '.barang_kode',
            headers: { "Authorization": "Bearer <?= $token ?>"},
            url: '<?= $apiDomain . '/api/select2/barang' ?>',
            optionalSearch: {barang_kelompok_kode: $(this).val()},
        });
    })
    
    function registerData(id) {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda akan meregistrasi data aset!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Ya, registrasi aset!",
            cancelButtonText: "Batal",
            buttonsStyling: false,
            showCloseButton: true,
            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "<?= site_url('admin/aset_desa/register/') ?>" + id,
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        success: function(res) {
                            if(res.status) {
                                resolve();
                                Swal.fire('Success!', res.message, 'success').then((result) => {
                                    location.reload();
                                });
                            } else {
                                reject(res.message);
                                Swal.fire('Error!', res.message, 'error');
                            }
                        }
                    });
                })
            },
            allowOutsideClick: false
        });
    }
    function deleteData(id) {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data yang telah dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Ya, hapus data!",
            cancelButtonText: "Batal",
            buttonsStyling: false,
            showCloseButton: true,
            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "<?= site_url('admin/aset_desa/delete/') ?>" + id,
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        success: function(res) {
                            if(res.status) {
                                resolve();
                                Swal.fire('Success!', res.message, 'success').then((result) => {
                                    location.reload();
                                });
                            } else {
                                reject(res.message);
                                Swal.fire('Error!', res.message, 'error');
                            }
                        }
                    });
                })
            },
            allowOutsideClick: false
        });
    }
</script>