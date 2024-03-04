<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/alerts', array('tipe' => 'success')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'error')) ?>
        <?php echo view('cms/partials/alerts', array('tipe' => 'listErrors')) ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>
            
            

            <div class="card-body">
                <form action="<?= site_url('admin/perangkat_desa/create') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Perangkat Desa</label>
                                <input type="text" class="form-control nama" name="nama" value="<?= set_value('nama') ?>" placeholder="Masukan nama">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>" placeholder="Masukan tanggal lahir">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control tempat_lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>" placeholder="Masukan tempat lahir">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <select class="form-control js-example-basic-single jabatan_id" name="jabatan_id"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" class="form-control telepon" name="telepon" value="<?= set_value('telepon') ?>" placeholder="Masukan telepon">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control alamat" name="alamat" value="<?= set_value('alamat') ?>" placeholder="Masukan alamat">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor SK</label>
                                <input type="text" class="form-control nomor_sk" name="nomor_sk" value="<?= set_value('nomor_sk') ?>" placeholder="Masukan Nomor SK">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal SK</label>
                                <input type="text" class="form-control tanggal_sk" name="tanggal_sk" 
                                data-provider="flatpickr" data-date-format="Y-m-d"
                                value="<?= set_value('tanggal_sk') ?>"
                                placeholder="Masukan tanggal SK">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Mulai Menjabat</label>
                                <input type="text" class="form-control tanggal_mulai_menjabat" name="tanggal_mulai_menjabat" value="<?= set_value('tanggal_mulai_menjabat') ?>" placeholder="Masukan tanggal mulai">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai Menjabat</label>
                                <input type="text" class="form-control tanggal_selesai_menjabat" name="tanggal_selesai_menjabat" value="<?= set_value('tanggal_selesai_menjabat') ?>" placeholder="Masukan tanggal selesai">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Pendidikan</label>
                                <select class="form-control js-example-basic-single pendidikan_id" name="pendidikan_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <div>
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <div>
                                    <label for="formFile" class="form-label">Surat Keputusan</label>
                                    <input class="form-control" type="file" name="surat_keputusan">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/perangkat_desa/index'); ?>" class="btn btn-primary">Cancel</a>
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