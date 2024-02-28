<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/alerts', array('tipe' => 'success')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'error')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'listErrors')) ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Tambah Data</h5>
            </div>
            
            

            <div class="card-body">
                <form action="<?= site_url('admin/perangkat_desa/testing') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <div>
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="foto">
                                </div>
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

<script>

    $(document).ready(function(){
        
        ajaxSelect({
            id: '.jabatan_id',
            url: '<?= site_url('admin/select2/jabatan') ?>',
            selected: '<?= set_value('jabatan_id') ?>'
        });
        
        ajaxSelect({
            id: '.pendidikan_id',
            url: '<?= site_url('admin/select2/pendidikan') ?>',
            selected: '<?= set_value('pendidikan_id') ?>'
        });
    })

    
</script>