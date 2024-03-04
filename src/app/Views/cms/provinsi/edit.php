<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>
        
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/provinsi/update/' . $id) ?>" method="post">
                    <div class="row">
                    <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Kode Provinsi</label>
                                <input type="text" class="form-control kode" name="kode" value="<?= $kode ?>" placeholder="Masukan kode">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Provinsi</label>
                                <input type="text" class="form-control nama" name="nama" value="<?= $nama ?>" placeholder="Masukan nama">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/provinsi/index'); ?>" class="btn btn-primary">Cancel</a>
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