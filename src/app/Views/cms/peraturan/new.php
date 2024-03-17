<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/peraturan/create') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Judul Peraturan</label>
                                <input type="text" class="form-control judul_peraturan" value="<?= set_value('judul_peraturan'); ?>" name="judul_peraturan" placeholder="Masukan Judul Peraturan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nomor Peraturan</label>
                                <input type="text" class="form-control nomor_peraturan" value="<?= set_value('nomor_peraturan'); ?>" name="nomor_peraturan" placeholder="Masukan Nomor Peraturan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Peraturan</label>
                                <select class="form-control js-example-basic-single jenis_peraturan" name="jenis_peraturan"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Isi Peraturan</label>
                                <textarea name="isi_peraturan" class="form-control ckeditor-classic"><?= set_value('isi_peraturan'); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Ditetapkan Oleh</label>
                                <select class="form-control js-example-basic-single ditetapkan_oleh" name="ditetapkan_oleh"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">File Upload PDF</label>
                                <input type="file" class="form-control file_upload" name="file_upload">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Di Tetapkan</label>
                                <input type="date" class="form-control tanggal_ditetapkan" name="tanggal_ditetapkan" value="<?= set_value('tanggal_ditetapkan'); ?>" placeholde="Masukin Tanggal Di Tetapkan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Diundangkan</label>
                                <input type="date" class="form-control tanggal_diundangkan" name="tanggal_diundangkan" value="<?= set_value('tanggal_diundangkan'); ?>" placeholde="Masukin Tanggal Di Undangkan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Keyword</label>
                                <input type="text" class="form-control keyword" name="keyword" value="<?= set_value('keyword'); ?>" placeholde="Masukin Keyword">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/peraturan/index'); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        ajaxSelectFromApi({
            id: '.jenis_peraturan',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_peraturan' ?>',
            selected: '<?= set_value('jenis_peraturan') ?>',
        });

        ajaxSelectFromApi({
            id: '.ditetapkan_oleh',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jabatan' ?>',
            selected: '<?= set_value('ditetapkan_oleh') ?>',
        });
    })

    //script ckeditor
    var ckClassicEditor = document.querySelectorAll(".ckeditor-classic")
    ckClassicEditor.forEach(function() {
        ClassicEditor
            .create(document.querySelector('.ckeditor-classic'))
            .then(function(editor) {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(function(error) {
                console.error(error);
            });
    });
</script>