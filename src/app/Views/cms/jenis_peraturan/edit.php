<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/jenis_peraturan/update/' . $id) ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama</label>
                                <input type="text" class="form-control nama" name="nama" value="<?= set_value('nama', $nama); ?>" placeholder="Masukan nama">
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/jenis_peraturan/index'); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>