<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>
            
            

            <div class="card-body">
                <form action="<?= site_url('admin/galeri_desa/create') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Galeri</label>
                                <select class="form-control js-example-basic-single jenis_galeri" name="jenis_galeri"></select>
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
            id: '.jenis_galeri',
            url: '<?= site_url('admin/select2/jenis_galeri') ?>',
            selected: '<?= set_value('jenis_galeri') ?>'
        });
    })

    
</script>