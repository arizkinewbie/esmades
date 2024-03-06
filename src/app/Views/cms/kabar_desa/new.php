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
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control judul_berita" name="judul_berita" placeholder="Masukan judul berita">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Isi Berita</label>
                                <textarea name="isi_berita" class="form-control isi_berita"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <textarea name="files" id="files" cols="30" rows="10" hidden></textarea>
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
        });
    })

    var formData = new FormData();
    var dataFiles = [];
    var textareaFiles = $("#files");
    var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
    if (dropzonePreviewNode) {
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            autoQueue: false,
            url: 'https://httpbin.org/post',
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
            success: function(file, response) {

                // dataFiles.push({uuid: file.upload.uuid, file: file.upload.filename});
                // textareaFiles.val(JSON.stringify(file.upload));
                // alert('File uploaded successfully!');
            },

            init: function() {

                this.on("removedfile", function(file) {
                    console.log(file.upload.uuid);
                });
                this.on("addedfile", function(file) {
                    var myForm = document.getElementById('form1');
                    formData = new FormData(myForm);
                    console.log(formData);
                });
                this.on("sendingmultiple", function(file, xhr, formData) {
                    formData.append('name', jQuery('#name').val());

                    $("form").find("input").each(function() {
                        formData.append($(this).attr("name"), $(this).val());
                    });
                });
            }
        });
    }

    function base64ToImage(base64Image, filename) {
        // Buat elemen <a> untuk menampilkan file
        var a = document.createElement('a');
        a.href = base64Image;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>