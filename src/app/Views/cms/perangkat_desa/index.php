<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
                <div>
                    <a href="<?= site_url('admin/perangkat_desa/new') ?>" class="btn btn-primary">Add New Row</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Jabatan</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
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
    // $('#table').DataTable();

    var table;

    table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= $apiDomain ?>/api/datatable/perangkat_desa',
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
                data: 'nama'
            },
            {
                data: 'tanggal_lahir'
            },
            {
                data: 'tempat_lahir'
            },
            {
                data: 'jabatan_nama'
            },
            {
                data: 'telepon'
            },
            {
                data: 'alamat'
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
                    html += `<li><a href="<?= site_url('admin/perangkat_desa/') ?>edit/` + data + `" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>`;
                    html += `<li><a href="javascript:deleteData(` + data + `)" class="dropdown-item remove-item-btn"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>`;
                    html += `</ul></div>`;
                    return html;
                }
            },
        ]
    });
</script>