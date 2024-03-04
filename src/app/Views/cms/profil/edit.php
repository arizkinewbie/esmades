<div class="row">
    <div class="col-md-12">

        <?php echo view('cms/partials/show_alert') ?>
        
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Add New Rows</h5>
            </div>
            
            <div class="card-body">
                <form action="<?= site_url('admin/profil/update/' . $id) ?>" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Visi Misi</label>
                                <textarea name="visi_misi" class="form-control"><?= set_value('visi_misi', $visi_misi) ?></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Sejarah</label>
                                <textarea name="sejarah" class="form-control"><?= set_value('sejarah', $sejarah) ?></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="desa_id" value="<?= set_value('desa_id', $desa_id) ?>">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/profil/index'); ?>" class="btn btn-primary">Cancel</a>
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