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
            <td>Jumlah & Satuan</td>
            <td><?= $nilai_satuan.' '.$aset_satuan_nama ?></td>
        </tr>
        <tr>
            <td>Foto Aset</td>
            <td>
                <?php if(!empty($files)): ?>
                    <?php $arrayFiles = json_decode($files, true); ?>
                    <?php foreach($arrayFiles as $row): ?>
                        <img widht="80" height="80" src="<?= base_url('uploads/aset_desa/' . $row['filename']) ?>">
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>
    </tbody>
</table>