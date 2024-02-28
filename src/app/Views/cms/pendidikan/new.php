<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/alerts', array('tipe' => 'success')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'error')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'listErrors')) ?>     

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Add New Rows</h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/pendidikan/create') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama</label>
                                <input type="text" class="form-control nama" name="nama" placeholder="Masukan nama">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
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