<div class="row">
    <div class="col-lg-12">
        <?php echo view('cms/partials/alerts', array('tipe' => 'success')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'error')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'listErrors')) ?>     

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Add Rows</h5>
                <div>
                    <a href="<?= site_url('admin/kecamatan/new') ?>" class="btn btn-primary">Add New Row</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Provinsi Kode</th>
                            <th>Kabupaten Kode</th>
                            <th>Kode</th>
                            <th class="w-75">Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($result)): $no = 1; foreach($result as $k): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $k->provinsiKode; ?></td>
                            <td><?= $k->kabupatenKode; ?></td>
                            <td><?= $k->kode; ?></td>
                            <td><?= $k->nama; ?></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="<?= site_url('admin/kecamatan/edit/' . $k->id) ?>" class="dropdown-item"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:deleteData('<?= $k->id ?>')" class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<script>
$('#table').DataTable();
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
                        url: "<?= site_url('admin/kecamatan/delete/') ?>" + id,
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