<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>
            <div class="card-body">
                <form id="form1" action="<?= site_url('admin/kabar_desa/update/' . $id) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Berita</label>
                                <select class="form-control js-example-basic-single jenis_berita" name="jenis_berita"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control judul_berita" name="judul_berita" value="<?= $judul_berita; ?>" placeholder="Masukan judul berita">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Isi Berita</label>
                                <textarea name="isi_berita" class="form-control ckeditor-classic"><?= $isi_berita; ?></textarea>
                            </div>
                        </div>

                        <?php if (!empty($foto)) : foreach (json_decode($foto) as $f) : ?>

                                <?php if (file_exists("uploads/kabar_desa/images/" . $f->nama_file)) : ?>
                                    <div class="col-3 show_data">
                                        <div class="md-3">
                                            <label data-id="<?= $f->nama_file; ?>" for="varchar" class="btn btn-danger hapus la la-trash-o"></label>
                                            <img data-bs-toggle="modal" data-bs-target="#myModal" src="<?= base_url($f->path_file); ?>" class="rounded" alt="200x200" width="200">
                                            <!-- Default Modals -->
                                            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Kabar Desa Desa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                <img class='img-fluid' src="<?= base_url($f->path_file); ?>">
                                                            </center>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>

                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </div>
                                    </div>
                                    <input type="hidden" name="file_name[]" value="<?= $f->nama_file; ?>">
                                <?php endif; ?>

                        <?php endforeach;
                        endif; ?>

                        <div class="col-12 tambah">
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
            selected: '<?= set_value('jenis_berita', $jenis_berita) ?>',
        });
    })

    let clicks = 0;

    function addItem() {
        clicks += 1;
        $('.tambah').after(`
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Foto ` + clicks + `</label>
                    <input class="form-control" type="file" name="file[]" required>
                </div>
            </div>
        `);
    }

    $("body").on("click", ".hapus", function(e) {
        var nama_file = $(this).attr("data-id");
        $.ajax({
            url: '<?php echo site_url("admin/kabar_desa/hapus_gambar"); ?>',
            type: 'POST',
            data: {
                nama_file: nama_file,
            }
        })
        $(this).parents('.show_data').remove();
    });

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