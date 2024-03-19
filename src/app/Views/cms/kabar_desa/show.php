<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Jenis Berita</td>
            <td><?= $nama_jenis_berita ?></td>
        </tr>
        <tr>
            <td>Judul Berita</td>
            <td><?= $judul_berita ?></td>
        </tr>
        <tr>
            <td>Isi Berita</td>
            <td><?= $isi_berita ?></td>
        </tr>
        <tr>
            <td>Foto Kabar Desa</td>
            <td>
                <?php if (!empty($foto)) : ?>
                    <?php $arrayFiles = json_decode($foto, true); ?>
                    <?php foreach ($arrayFiles as $row) : ?>
                        <?php if (file_exists("uploads/kabar_desa/images/" . $row['nama_file'])) : ?>
                            <img widht="80" height="80" src="<?= base_url('uploads/kabar_desa/images/' . $row['nama_file']) ?>" onclick="return showImage(this.src)">
                        <?php endif; ?>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>
    </tbody>
</table>

<div class="modal fade modalShowImage" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Lihat Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="#" width="100%" class="preview-image">
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function showImage(src) {
        $('.preview-image').attr('src', src);
        $('.modalShowImage').modal('show');
    }
</script>