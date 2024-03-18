<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Jenis Galeri</td>
            <td><?= $jenis_galeri ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><?= $keterangan ?></td>
        </tr>
        <tr>
            <td>File</td>
            <td>
                <?php if (!empty($file)) : if (file_exists("uploads/galeri_desa/images/" . $file)) : ?>
                        <img widht="80" height="80" src="<?= base_url('uploads/galeri_desa/images/' . $file) ?>" onclick="return showImage(this.src)">
                <?php endif;
                endif; ?>
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