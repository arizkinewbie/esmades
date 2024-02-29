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
                <form action="<?= site_url('admin/kecamatan/update/' . $id) ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama</label>
                                <input type="text" class="form-control nama" name="nama" value="<?= $nama ?>" placeholder="Masukan nama">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Provinsi Kode</label>
                                <select class="form-control js-example-basic-single provinsiKode"></select>
                                <input type="hidden" name="provinsiKode" value="<?= $provinsiKode; ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kabupaten Kode</label>
                                <select class="form-control js-example-basic-single kabupatenKode"></select>
                                <input type="hidden" name="kabupatenKode" value="<?= $kabupatenKode; ?>">
                            </div>
                        </div>

                        <div class="col-1">
                            <div class="mb-3">
                                <label for="kodeinput" class="form-label">Kode</label>
                                <input type="text" readonly class="form-control kode1" name="kode" value="<?= $kode ?>">
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
            id: '.provinsiKode',
            url: '<?= site_url('admin/select2/provinsi') ?>',
            selected: '<?= set_value('provinsiKode', $provinsiKode) ?>',
            disabled:'readonly'
        });

        ajaxSelect({
            id: '.kabupatenKode',
            url: '<?= site_url('admin/select2/kabupaten') ?>',
            selected: '<?= set_value('kabupatenKode', $kabupatenKode) ?>',
            disabled: 'readonly'
        });
    })
</script>