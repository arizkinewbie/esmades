<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Nama Wisata</td>
            <td><?= $nama_wisata ?></td>
        </tr>
        <tr>
            <td>Jenis Wisata</td>
            <td><?= $nama_jenis_wisata ?></td>
        </tr>
        <tr>
            <td>Alamat Wisata</td>
            <td><?= $alamat_wisata ?></td>
        </tr>
        <tr>
            <td>Nomor Kontak</td>
            <td><?= $nomor_kontak; ?></td>
        </tr>
        <tr>
            <td>Keterangan Wisata</td>
            <td><?= $keterangan_wisata; ?></td>
        </tr>
        <tr>
            <td>Lokasi Wisata</td>
            <td><?= $lokasi_wisata; ?></td>
        </tr>
        <tr>
            <td>Instagram</td>
            <td><?= $instagram; ?></td>
        </tr>
        <tr>
            <td>Facebook</td>
            <td><?= $facebook; ?></td>
        </tr>
        <tr>
            <td>Whatsapp</td>
            <td><?= $whatsapp; ?></td>
        </tr>
        <tr>
            <td>Foto Wisata Desa</td>
            <td>
                <?php if (!empty($foto_wisata)) : ?>
                    <?php $arrayFiles = json_decode($foto_wisata, true); ?>
                    <?php foreach ($arrayFiles as $row) : ?>
                        <?php if (file_exists("uploads/wisata/images/" . $row['nama_file'])) : ?>
                            <img widht="80" height="80" src="<?= base_url('uploads/wisata/images/' . $row['nama_file']) ?>" onclick="return showImage(this.src)">
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