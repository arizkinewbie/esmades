<div class="row">
    <div class="col-lg-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
                <div>
                    <a href="<?= site_url('admin/galeri_desa/new') ?>" class="btn btn-primary">Add New Row</a>
                </div>
            </div>
            <div class="card-body">

                <table id="table" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No.</th>
                            <th>Jenis Galeri</th>
                            <th>Keterangan</th>
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

<script>
    var table;

    table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= $apiDomain ?>/api/datatable/galeri_desa',
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
                data: 'jenis_galeri'
            },
            {
                data: 'keterangan'
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
                    html += `<li><a href="<?= site_url('admin/galeri_desa/') ?>edit/` + data + `" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>`;
                    html += `<li><a href="javascript:deleteData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>`;
                    html += `</ul></div>`;
                    return html;
                }
            },
        ]
    });


    function detailData(id) {
        $('.formDetail').load('<?= site_url('admin/galeri_desa/show/') ?>' + id, function(response, status, xhr) {
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
                        url: "<?= site_url('admin/galeri_desa/delete/') ?>" + id,
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