<div class="row mb-3">
    <div class="col-md-6">
        <table class="table w-100 table-borderless table-sm">
            <tbody>
                <tr>
                    <td>Nomor KK</td>
                    <td>: <?= $nomor_kk ?></td>
                </tr>
                <tr>
                    <td>Nama Kepala Keluarga</td>
                    <td>: <?= $nama_kepala_keluarga ?></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>: <?= $npwp ?></td>
                </tr>
                <tr>
                    <td>Jenis Pajak</td>
                    <td>: <?= $jenis_pajak_nama ?></td>
                </tr>
                <tr>
                    <td>RT/RW</td>
                    <td>: <?= $rt ?>/<?= $rw ?></td>
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>: <?= $alamat ?></td>
                </tr>
                <tr>
                    <td>Luas Tanah</td>
                    <td>: <?= $luas_tanah.$satuan_luas_tanah ?></td>
                </tr>
                <tr>
                    <td>Luas Bangunan</td>
                    <td>: <?= $luas_bangunan.$satuan_luas_bangunan ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <?php if(!empty($files)): ?>
            <?php $arrayFiles = json_decode($files, true); ?>
            <?php foreach($arrayFiles as $row): ?>
                <img widht="80" height="80" src="<?= base_url('uploads/kependudukan/' . $row['filename']) ?>" onclick="return showImage(this.src)">
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="text-start mb-3">
            <a href="javascript:tambahAnggota('<?= $id ?>')" class="btn btn-primary">Tambah Anggota</a>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table w-100 table-bordered table-sm">
            <thead>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Status Hubungan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Gol. Darah</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($resultDetail as $row): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['status_hubungan'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['tempat_lahir'] ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td><?= $row['agama_nama'] ?></td>
                        <td><?= $row['pendidikan_nama'] ?></td>
                        <td><?= $row['jenis_pekerjaan_nama'] ?></td>
                        <td><?= $row['goldar'] ?></td>
                    </tr>
                <?php $no++; endforeach ?>
            </tbody>
        </table>
    </div>
</div>

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