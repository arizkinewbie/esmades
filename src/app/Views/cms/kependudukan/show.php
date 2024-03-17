<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Nama Aset</td>
            <td><?= $nama_barang ?></td>
        </tr>
        <tr>
            <td>Kode Aset</td>
            <td><?= $barang_kode.$nomor_urut_barang ?></td>
        </tr>
        <tr>
            <td>Nomor Register</td>
            <td><?= $nomor_registrasi ?></td>
        </tr>
        <tr>
            <td>Tanggal Perolehan</td>
            <td><?= date('d/m/Y', strtotime($tanggal_perolehan)) ?></td>
        </tr>
        <tr>
            <td>Nilai Kekayaan</td>
            <td><?= number_format($nilai_kekayaan) ?></td>
        </tr>
        <tr>
            <td>Jumlah & Satuan</td>
            <td><?= $nilai_satuan.' '.$aset_satuan_nama ?></td>
        </tr>
        <tr>
            <td>Foto Aset</td>
            <td>
                <?php if(!empty($files)): ?>
                    <?php $arrayFiles = json_decode($files, true); ?>
                    <?php foreach($arrayFiles as $row): ?>
                        <img widht="80" height="80" src="<?= base_url('uploads/aset_desa/' . $row['filename']) ?>" onclick="return showImage(this.src)">
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