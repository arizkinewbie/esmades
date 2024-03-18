<div class="row">
    <div class="col-lg-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
                <div>
                    <a href="<?= site_url('admin/kabar_desa/new') ?>" class="btn btn-primary">Add New Row</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No.</th>
                            <th>Jenis Berita</th>
                            <th>Judul Berita</th>
                            <th>Isi Berita</th>
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

<!--end row-->
<div class="modal fade modalDetail" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Detail <?= $title; ?></h5>
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
        ajax: {
            url: '<?= $apiDomain ?>/api/datatable/kabar_desa',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer <?= $token ?>');
            }
        },
        columns: [{
                data: 'id',
                visible: false
            },
            {
                data: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'jenis_berita'
            },
            {
                data: 'judul_berita'
            },
            {
                data: 'isi_berita'
            },
            {
                data: 'id',
                orderable: false,
                className: 'text-center',
                width: '100px',
                render: function(data, type, row) {
                    var html = `<div class="dropdown d-inline-block">
            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-fill align-middle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">`;
                    html += `<li><a href="javascript:detailData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Detail</a></li>`;
                    html += `<li><a href="<?= site_url('admin/kabar_desa/') ?>edit/` + data + `" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>`;
                    html += `<li><a href="javascript:deleteData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>`;
                    html += `</ul></div>`;
                    return html;
                }
            },
        ]
    });


    function detailData(id) {
        $('.formDetail').load('<?= site_url('admin/kabar_desa/show/') ?>' + id, function(response, status, xhr) {
            if (status == "error") {
                alert('Error:', xhr.statusText)
                return;
            }
            $('.modalDetail').modal('show');
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
            preConfirm: function(email) {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: "<?= site_url('admin/kabar_desa/delete/') ?>" + id,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(res) {
                            if (res.status) {
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