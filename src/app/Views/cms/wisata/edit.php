<div class="row">
    <div class="col-md-12">
        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/wisata/update/' . $id) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Wisata</label>
                                <input type="text" class="form-control nama_wisata" value="<?= set_value('nama_wisata', $nama_wisata); ?>" name="nama_wisata" placeholder="Masukan nama wisata">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Wisata</label>
                                <select class="form-control js-example-basic-single jenis_wisata" name="jenis_wisata"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Alamat Wisata</label>
                                <textarea name="alamat_wisata" class="form-control alamat_wisata"><?= set_value('alamat_wisata', $alamat_wisata); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nomor Kontak</label>
                                <input type="text" class="form-control nomor_kontak" value="<?= set_value('nomor_kontak', $nomor_kontak); ?>" name="nomor_kontak" placeholder="Masukan nomor Kontak">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Keterangan wisata</label>
                                <textarea name="keterangan_wisata" class="form-control keterangan_wisata"><?= set_value('keterangan_wisata', $keterangan_wisata); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi Wisata</label>
                                <div class="input-group">
                                    <button type="button" class="input-group-text btnModalMap1">Tampilkan Peta</button>
                                    <input type="text" class="form-control lat_lng" name="lokasi_wisata" value="<?= set_value('lokasi_wisata', $lokasi_wisata) ?>" placeholder="Garis Bujur & lintang">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Instagram</label>
                                <input type="text" class="form-control instagram" value="<?= set_value('instagram', $instagram); ?>" name="instagram" placeholder="Masukan instagram">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Facebook</label>
                                <input type="text" class="form-control facebook" value="<?= set_value('facebook', $facebook); ?>" name="facebook" placeholder="Masukan Facebook">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Whatsapp</label>
                                <input type="text" class="form-control whatsapp" value="<?= set_value('whatsapp', $whatsapp); ?>" name="whatsapp" placeholder="Masukan Whatsapp">
                            </div>
                        </div>
                    </div>

                    <div class="row tambah">
                        <div class="col-12">
                            <div class="mb-3">
                                <a href="javascript:addItem()" class="btn btn-primary"><i class="mdi mdi-plus btn-icon-prepend"></i> Klik Untuk Upload Foto Wisata</a>
                            </div>
                        </div>
                    </div>



                    <?php if (!empty($foto_wisata)) : ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <?php
                                    $chunks = array_chunk(json_decode($foto_wisata), 4);

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
                                                <?php if (!empty($f[0]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[0]->nama_file)) :
                                                ?>
                                                        <img data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '0'; ?>" src="<?= base_url($f[0]->path_file); ?>" class="rounded form-control hapus<?= $no . '0'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '0'; ?>" class="hapus<?= $no . '0'; ?> modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Wisata Desa Gambar</h5>
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
                                                <?php if (!empty($f[1]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[1]->nama_file)) :
                                                ?>
                                                        <img data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '1'; ?>" src="<?= base_url($f[1]->path_file); ?>" class="rounded form-control hapus<?= $no . '1'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '1'; ?>" class="modal fade hapus<?= $no . '1'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Wisata Desa Gambar</h5>
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
                                                <?php if (!empty($f[2]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[2]->nama_file)) :
                                                ?>
                                                        <img data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '2'; ?>" src="<?= base_url($f[2]->path_file); ?>" class="rounded form-control hapus<?= $no . '2'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '2'; ?>" class="modal fade hapus<?= $no . '2'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Wisata Desa Gambar</h5>
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
                                                <?php if (!empty($f[3]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[3]->nama_file)) :
                                                ?>
                                                        <img data-bs-toggle="modal" data-bs-target="#myModal<?= $no . '3'; ?>" src="<?= base_url($f[3]->path_file); ?>" class="rounded form-control hapus<?= $no . '3'; ?>" alt="200x200" height="200">
                                                        <!-- Default Modals -->
                                                        <div id="myModal<?= $no . '3'; ?>" class="modal fade hapus<?= $no . '3'; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel">Wisata Desa Gambar</h5>
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
                                                <?php if (!empty($f[0]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[0]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[0]->nama_file; ?>" href="#" id="<?= $no . '0'; ?>" class="delete hapus<?= $no . '0'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[1]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[1]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[1]->nama_file; ?>" href="#" id="<?= $no . '1'; ?>" class="delete hapus<?= $no . '1'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[2]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[2]->nama_file)) :
                                                ?>
                                                        <a data-id="<?= $f[2]->nama_file; ?>" id="<?= $no . '2'; ?>" href="#" class="delete hapus<?= $no . '2'; ?> btn btn-danger form-control">Hapus Gambar</a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                            <td width='200'>
                                                <?php if (!empty($f[3]->nama_file)) : if (file_exists("uploads/wisata/images/" . $f[3]->nama_file)) :
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


                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin/wisata/index'); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalMap1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Peta</h5>
            </div>
            <div class="modal-body">
                <p class="fs-15 text-info mb-5">Klik pada peta atau lakukan pencarian lokasi untuk mendapatkan koordinat</p>
                <div class="mb-5" id="pac-card">
                    <div class="input-group" id="pac-container">
                        <input type="text" class="form-control" id="pac-input" placeholder="address...">
                    </div>
                </div>
                <div style="height:350px;" id="map1"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= base_url('dist/') ?>assets/js/app.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCynBKMoc3o3YGdscEYadjoFFyqtXhqjuY&libraries=places,geometry,drawing"></script>
<script src="<?= base_url('dist/') ?>assets/libs/gmaps/gmaps.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/js/pages/map_aset_desa.js"></script>

<script>
    $(document).ready(function() {
        ajaxSelectFromApi({
            id: '.jenis_wisata',
            headers: {
                "Authorization": "Bearer <?= $token ?>"
            },
            url: '<?= $apiDomain . '/api/select2/jenis_wisata' ?>',
            selected: '<?= set_value('jenis_wisata', $jenis_wisata) ?>',
        });
    })

    $(document).on('click', '.btnModalMap1', function(data) {
        $('.modalMap1').modal('show')
    });

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
            url: '<?php echo site_url("admin/wisata/hapus_gambar"); ?>',
            type: 'POST',
            data: {
                nama_file: nama_file,
            }
        })
        $(this).parents('.show_data').remove();
    });
</script>