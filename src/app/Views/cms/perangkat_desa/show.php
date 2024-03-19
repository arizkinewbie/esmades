<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Nama</td>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><?= date("d-m-Y", strtotime($tanggal_lahir)) ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><?= $tempat_lahir; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td><?= $nama_jabatan; ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td><?= $telepon; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $alamat; ?></td>
        </tr>
        <tr>
            <td>Nomor Sk</td>
            <td><?= $nomor_sk; ?></td>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td><?= $nama_pendidikan; ?></td>
        </tr>
        <tr>
            <td>Tanggal SK</td>
            <td><?= date("d-m-Y", strtotime($tanggal_sk)); ?></td>
        </tr>
        <tr>
            <td>Tanggal Mulai Menjabat</td>
            <td><?= date("d-m-Y", strtotime($tanggal_mulai_menjabat)); ?></td>
        </tr>
        <tr>
            <td>Tanggal Selesai Menjabat</td>
            <td><?= date("d-m-Y", strtotime($tanggal_selesai_menjabat)); ?></td>
        </tr>
        <tr>
            <td>Desa ID</td>
            <td><?= $desa_id; ?></td>
        </tr>
        <tr>
            <td>Surat Keputusan</td>
            <td>
                <?php if (!empty($surat_keputusan)) : ?>
                    <?php if (file_exists("uploads/perangkat_desa/pdf" . $surat_keputusan)) : ?>
                        <a href="<?= base_url('uploads/perangkat_desa/pdf' . $surat_keputusan) ?>">Lihat Surat Keputusan</a>
                    <?php endif; ?>
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>
                <?php if (!empty($foto)) : ?>
                    <?php if (file_exists("uploads/perangkat_desa/images" . $foto)) : ?>
                        <img widht="80" height="80" src="<?= base_url('uploads/perangkat_desa/images' . $foto) ?>" onclick="return showImage(this.src)">
                    <?php endif; ?>
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