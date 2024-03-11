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

                        <div class="row">
                            <textarea name="files" id="files" cols="30" rows="10" hidden><?= set_value('files', $foto) ?></textarea>
                            <div class="col-md-6">
                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                        </div>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </div>

                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                    <li class="mt-2" id="dropzone-preview-list">
                                        <!-- This is used as the file preview template -->
                                        <div class="border rounded">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm bg-light rounded">
                                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="pt-1">
                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                        <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-3">
                                                    <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

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


    var formData = new FormData();
    var dataFiles = [];
    var textareaFiles = $("#files");
    var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
    if (dropzonePreviewNode) {
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            autoQueue: true,
            url: '<?= site_url('admin/kabar_desa/') ?>upload_file',
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
            success: function(file, response) {
                dataFiles.push(response);
                textareaFiles.val(JSON.stringify(dataFiles));
            },
            error: function(file, respon) {
                this.removeFile(file)
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: respon.message.file,
                });
            },

            init: function() {

                thisDropzone = this;
                var jsonString = '<?= $foto ?>';
                var data = JSON.parse(jsonString);

                $.each(data, function(key, value) {
                    var mockFile = {
                        name: value.filename,
                        size: 0
                    }; // Jika ukuran file tidak diketahui, atur ke 0 atau sesuaikan dengan kebutuhan Anda
                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "<?= base_url() ?>/uploads/kabar_desa/images/" + value.filename);
                });


                this.on("removedfile", function(file) {
                    var jsonString = $('#files').val();
                    var data = JSON.parse(jsonString);
                    // Filter array untuk menghapus elemen dengan filename yang sesuai
                    var newData = data.filter(function(item) {
                        return item.filename !== file.name;
                    });
                    // newData sekarang berisi array yang telah dihapus
                    $('#files').val(JSON.stringify(newData));
                });
            }
        });
    }
</script>