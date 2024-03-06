<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/galeri_desa/update/' . $id) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Galeri</label>
                                <select class="form-control js-example-basic-single jenis_galeri" name="jenis_galeri"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control keterangan"><?= $keterangan; ?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input class="form-control" type="file" name="file">
                            </div>
                        </div>
                        <?php if (!empty($file)) : if (file_exists("uploads/galeri_desa/images/" . $file)) : ?>
                                <div class="col-6">
                                    <div class="md-3">
                                        <img data-bs-toggle="modal" data-bs-target="#myModal" src="<?= base_url('uploads/galeri_desa/images/' . $file); ?>" class="rounded" alt="200x200" width="200">
                                        <!-- Default Modals -->
                                        <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Galeri Desa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <img class='img-fluid' src="<?= base_url('uploads/galeri_desa/images/' . $file); ?>">
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
                                <input type="hidden" name="file_name" value="<?= $file; ?>">
                            <?php else : ?>
                                <input type="hidden" name="file_name" value="" readonly>
                        <?php endif;
                        endif; ?>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/galeri_desa/index'); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        ajaxSelectFromApi({
            id: '.jenis_galeri',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_galeri' ?>',
            selected: '<?= set_value('jenis_galeri', $jenis_galeri) ?>',
        });
    })
</script>