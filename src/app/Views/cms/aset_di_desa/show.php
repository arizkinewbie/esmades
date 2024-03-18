<table class="table w-100 table-borderd table-striped table-hover table-sm">
    <tbody>
        <tr>
            <td>Nik</td>
            <td><?= $nik ?></td>
        </tr>
        <tr>
            <td>Nama Pemilik</td>
            <td><?= $nama_pemilik ?></td>
        </tr>
        <tr>
            <td>No Npwp</td>
            <td><?= $no_npwp ?></td>
        </tr>
        <tr>
            <td>Letak Objek Pajak</td>
            <td><?= $letak_objek_pajak ?></td>
        </tr>
        <tr>
            <td>Jenis Pajak</td>
            <td><?= $nama_jenis_pajak; ?></td>
        </tr>
        <tr>
            <td>Perkiraan Nilai Objek Pajak</td>
            <td><?= $perkiraan_nilai_objek_pajak; ?></td>
        </tr>
        <tr>
            <td>Bulan Jatuh Tempo</td>
            <td><?= $bulan_jatuh_tempo; ?></td>
        </tr>
        <tr>
            <td>Penggunaan Lahan Desa</td>
            <td><?= $nama_penggunaan_lahan; ?></td>
        </tr>
        <tr>
            <td>Jenis Aset Desa</td>
            <td><?= $nama_jenis_aset; ?></td>
        </tr>
        <tr>
            <td>Status Pemilik</td>
            <td><?= $nama_status_pemilik; ?></td>
        </tr>
        <tr>
            <td>Penduduk Asli</td>
            <td><?= $penduduk_asli; ?></td>
        </tr>
        <tr>
            <td>Luas Lahan</td>
            <td><?= $luas_lahan; ?></td>
        </tr>
        <tr>
            <td>Koordinat</td>
            <td><?= $koordinat; ?></td>
        </tr>
        <tr>
            <td>Poligon</td>
            <td><?= $poligon; ?></td>
        </tr>
        <tr>
            <td>Pengamanan Fisik</td>
            <td><?= $pengamanan_fisik; ?></td>
        </tr>
        <tr>
            <td>Keterangan Fisik</td>
            <td><?= $keterangan_fisik; ?></td>
        </tr>
        <tr>
            <td>Pengamanan Hukum</td>
            <td><?= $pengamanan_hukum; ?></td>
        </tr>
        <tr>
            <td>Keterangan Hukum</td>
            <td><?= $keterangan_hukum; ?></td>
        </tr>
        <tr>
            <td>Nomor Bukti Kepemilikan</td>
            <td><?= $nomor_bukti_kepemilikan; ?></td>
        </tr>
        <tr>
            <td>File Surat Kepemilikan</td>
            <td>
                <?php if (file_exists("uploads/aset_di_desa/pdf/" . $file_surat_kepemilikan)) : ?>
                    <a href="<?= base_url('uploads/aset_di_desa/pdf/' . $file_surat_kepemilikan) ?>">Lihat File Kepemilikan</a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Foto Kabar Desa</td>
            <td>
                <?php if (!empty($foto)) : ?>
                    <?php $arrayFiles = json_decode($foto, true); ?>
                    <?php foreach ($arrayFiles as $row) : ?>
                        <?php if (file_exists("uploads/aset_di_desa/images/" . $row['nama_file'])) : ?>
                            <img widht="80" height="80" src="<?= base_url('uploads/aset_di_desa/images/' . $row['nama_file']) ?>" onclick="return showImage(this.src)">
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