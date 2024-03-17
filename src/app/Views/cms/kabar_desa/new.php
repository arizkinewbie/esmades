<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>
            <div class="card-body">
                <form id="form1" action="<?= site_url('admin/kabar_desa/create') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Berita</label>
                                <select class="form-control js-example-basic-single jenis_berita" name="jenis_berita"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control judul_berita" name="judul_berita" placeholder="Masukan judul berita">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Isi Berita</label>
                                <textarea name="isi_berita" class="form-control ckeditor-classic"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row tambah">
                        <div class="col-12">
                            <div class="mb-3">
                                <a href="javascript:addItem()" class="btn btn-primary"><i class="mdi mdi-plus btn-icon-prepend"></i> Buat File Upload</a>
                            </div>
                        </div>
                    </div>



                    <!--end row-->

                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/kabar_desa/index'); ?>" class="btn btn-primary">Cancel</a>
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
            id: '.jenis_berita',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_berita' ?>',
            selected: '<?= set_value('jenis_berita') ?>',
        });
    })

    let clicks = 0;

    function addItem() {
        clicks += 1;
        $('.tambah').after(`
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Foto ` + clicks + `</label>
                        <input class="form-control" type="file" name="file[]">
                    </div>
                </div>
            </div>
        `);
    }

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