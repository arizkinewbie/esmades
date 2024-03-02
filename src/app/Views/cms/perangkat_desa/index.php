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
                    <tbody>
                        <?php if(!empty($result)): $no = 1; foreach($result as $k): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $k->nama; ?></td>
                            <td><?= $k->tanggal_lahir; ?></td>
                            <td><?= $k->tempat_lahir; ?></td>
                            <td><?= $k->jabatan_nama; ?></td>
                            <td><?= $k->telepon; ?></td>
                            <td><?= $k->alamat; ?></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="#!" class="dropdown-item"><i
                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        </li>
                                        <li>
                                            <a href="<?= site_url('admin/perangkat_desa/edit/' . $k->id) ?>" class="dropdown-item"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
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
</script>