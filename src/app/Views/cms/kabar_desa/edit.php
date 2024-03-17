<style>
    img.rounded:hover {
        cursor: pointer;
    }
</style>

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
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control judul_berita" name="judul_berita" value="<?= $judul_berita; ?>" placeholder="Masukan judul berita">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Isi Berita</label>
                                <textarea name="isi_berita" class="form-control ckeditor-classic"><?= $isi_berita; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($foto)) : ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <?php
                                    $chunks = array_chunk(json_decode($foto), 4);

                                    if (count(end($chunks)) < 4) {
                                        $missingCount = 4 - count(end($chunks));
                                        for ($i = 0; $i < $missingCount; $i++) {
                                            $chunks[count($chunks) - 1][] = (object) ['nama_file' => '', 'path_file' => '']; // Tambahkan elemen kosong ke potongan terakhir
                                        }
                                    }

                                    $no = 1;
                                    foreach ($chunks as $f) : ?>
                                        <tr>
                                            <td width='200' height='200'>
                                                <?php if (!empty($f[0]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[0]->nama_file)) :
                                                ?>
                                                        <img onmouseover="this.style.opacity = '0.7';" onmouseout="this.style.opacity = '1';" stye="transition: opacity 0.3s;" data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '0'; ?>" src="<?= base_url($f[0]->path_file); ?>" class="rounded form-control hapus<?= $no . '0'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '0'; ?>" class="hapus<?= $no . '0'; ?> modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Kabar Desa Gambar</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <center>
                                                                            <img class='img-fluid' src="<?= base_url($f[0]->path_file); ?>">
                                                                        </center>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                        <input type="hidden" class="hapus<?= $no . '0'; ?>" name="file_name[]" value="<?= $f[0]->nama_file; ?>">
                                                <?php endif;
                                                endif;
                                                ?>
                                            </td>
                                            <td width='200' height='200'>
                                                <?php if (!empty($f[1]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[1]->nama_file)) :
                                                ?>
                                                        <img onmouseover="this.style.opacity = '0.7';" onmouseout="this.style.opacity = '1';" stye="transition: opacity 0.3s;" data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '1'; ?>" src="<?= base_url($f[1]->path_file); ?>" class="rounded form-control hapus<?= $no . '1'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '1'; ?>" class="modal fade hapus<?= $no . '1'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Kabar Desa Gambar</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <center>
                                                                            <img class='img-fluid' src="<?= base_url($f[1]->path_file); ?>">
                                                                        </center>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                        <input type="hidden" class="hapus<?= $no . '1'; ?>" name="file_name[]" value="<?= $f[1]->nama_file; ?>">
                                                <?php endif;
                                                endif;
                                                ?>
                                            </td>
                                            <td width='200' height='200'>
                                                <?php if (!empty($f[2]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[2]->nama_file)) :
                                                ?>
                                                        <img onmouseover="this.style.opacity = '0.7';" onmouseout="this.style.opacity = '1';" stye="transition: opacity 0.3s;" data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '2'; ?>" src="<?= base_url($f[2]->path_file); ?>" class="rounded form-control hapus<?= $no . '2'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '2'; ?>" class="modal fade hapus<?= $no . '2'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Kabar Desa Gambar</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <center>
                                                                            <img class='img-fluid' src="<?= base_url($f[2]->path_file); ?>">
                                                                        </center>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                        <input type="hidden" class="hapus<?= $no . '2'; ?>" name="file_name[]" value="<?= $f[2]->nama_file; ?>">
                                                <?php endif;
                                                endif;
                                                ?>
                                            </td>
                                            <td width='200' height='200'>
                                                <?php if (!empty($f[3]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[3]->nama_file)) :
                                                ?>
                                                        <img onmouseover="this.style.opacity = '0.7';" onmouseout="this.style.opacity = '1';" stye="transition: opacity 0.3s;" data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '3'; ?>" src="<?= base_url($f[3]->path_file); ?>" class="rounded form-control hapus<?= $no . '3'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '3'; ?>" class="modal fade hapus<?= $no . '3'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Kabar Desa Gambar</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <center>
                                                                            <img class='img-fluid' src="<?= base_url($f[3]->path_file); ?>">
                                                                        </center>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                        <input type="hidden" class="hapus<?= $no . '3'; ?>" name="file_name[]" value="<?= $f[3]->nama_file; ?>">
                                                <?php endif;
                                                endif;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='200'>
                                                <?php if (!empty($f[0]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[0]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[0]->nama_file; ?>" href="#" id="<?= $no . '0'; ?>" class="delete hapus<?= $no . '0'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[1]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[1]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[1]->nama_file; ?>" href="#" id="<?= $no . '1'; ?>" class="delete hapus<?= $no . '1'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[2]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[2]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[2]->nama_file; ?>" id="<?= $no . '2'; ?>" href="#" class="delete hapus<?= $no . '2'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[3]->nama_file)) : if (file_exists("uploads/kabar_desa/images/" . $f[3]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[3]->nama_file; ?>" href="#" id="<?= $no . '3'; ?>" class="delete hapus<?= $no . '3'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                        </tr>

                                    <?php $no++;
                                    endforeach; ?>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row tambah">
                        <div class="col-12 ">
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

    $("body").on("click", ".delete", function(e) {
        var nama_file = $(this).attr("data-id");
        var id = $(this).attr("id");
        $('.hapus' + id).remove();
        $.ajax({
            url: '<?php echo site_url("admin/kabar_desa/hapus_gambar"); ?>',
            type: 'POST',
            data: {
                nama_file: nama_file,
            }
        })
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