<div class="row">
    <div class="col-md-12">

        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1"><?= $subTitle; ?></h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/jabatan/create') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Golongan Barang</label>
                                <select class="form-control js-example-basic-single barang_golongan_kode" name="barang_golongan_kode"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Bidang Barang</label>
                                <select class="form-control js-example-basic-single barang_bidang_kode" name="barang_bidang_kode"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kelompok Barang</label>
                                <select class="form-control js-example-basic-single barang_kelompok_kode" name="barang_kelompok_kode"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Barang</label>
                                <select class="form-control js-example-basic-single barang_kode" name="barang_kode"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Barang Bantu</label>
                                <select class="form-control js-example-basic-single barang_bantu_kode" name="barang_bantu_kode"></select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control nama" name="nama" placeholder="Masukan nama">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tahun Pengadaan</label>
                                <input type="text" class="form-control tahun_pengadaan" name="tahun_pengadaan" placeholder="Masukan tahun pengadaan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Tanggal Perolehan</label>
                                <input type="text" class="form-control tanggal_perolehan" name="tanggal_perolehan" placeholder="Masukan Tanggal Perolehan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nilai Kekayaan</label>
                                <input type="text" class="form-control nilai_kekayaan" name="nilai_kekayaan" placeholder="Masukan Nilai Kekayaan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Identitas Barang</label>
                                <input type="text" class="form-control identitas_barang" name="identitas_barang" placeholder="Masukan Identitas Barang">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control kode" name="kode" placeholder="Masukan Kode Barang">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Luas</label>
                                <input type="text" class="form-control luas" name="luas" placeholder="Masukan Luas">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Jumlah</label>
                                <input type="text" class="form-control jumlah" name="jumlah" placeholder="Masukan Jumlah">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kondisi Barang</label>
                                <select class="form-control js-example-basic-single kondisi_barang" name="kondisi_barang"></select>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $('.kondisi_barang').select2({
        placeholder: 'Pilih Opsi',
        data: [
            {id: 'Baik', text: 'Baik'},
            {id: 'Rusak Ringan', text: 'Rusak Ringan'},
            {id: 'Rusak Berat', text: 'Rusak Berat'},
        ]
    });

    var barang_bidang_kode = $('.barang_bidang_kode').select2({ placeholder: 'Pilih Opsi' });
    var barang_kelompok_kode = $('.barang_kelompok_kode').select2({ placeholder: 'Pilih Opsi' });
    var barang_kode = $('.barang_kode').select2({ placeholder: 'Pilih Opsi' });
    var barang_bantu_kode = $('.barang_bantu_kode').select2({ placeholder: 'Pilih Opsi' });

    ajaxSelectFromApi({
        id: '.barang_golongan_kode',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/barang_golongan' ?>',
    });

    $(document).on('change', '.barang_golongan_kode', function(){
        barang_bidang_kode.val('').trigger('change');
        barang_kelompok_kode.val('').trigger('change');
        barang_kode.val('').trigger('change');
        barang_bantu_kode.val('').trigger('change');

        var val = $(this).val();
        ajaxSelectFromApi({
            id: '.barang_bidang_kode',
            headers: { "Authorization": "Bearer <?= $token ?>" },
            url: '<?= $apiDomain . '/api/select2/barang_bidang' ?>',
            optionalSearch: { barang_golongan_kode: val },
        }); 
    });
    
    $(document).on('change', '.barang_bidang_kode', function(){
        barang_kelompok_kode.val('').trigger('change');
        barang_kode.val('').trigger('change');
        barang_bantu_kode.val('').trigger('change');

        var val = $(this).val();
        ajaxSelectFromApi({
                id: '.barang_kelompok_kode',
                headers: { "Authorization": "Bearer <?= $token ?>" },
                url: '<?= $apiDomain . '/api/select2/barang_kelompok' ?>',
                optionalSearch: { barang_bidang_kode: val },
        }); 
    });
    
    $(document).on('change', '.barang_kelompok_kode', function(){
        barang_kode.val('').trigger('change');
        barang_bantu_kode.val('').trigger('change');

        var val = $(this).val();
        ajaxSelectFromApi({
            id: '.barang_kode',
            headers: { "Authorization": "Bearer <?= $token ?>" },
            url: '<?= $apiDomain . '/api/select2/barang' ?>',
            optionalSearch: { barang_kelompok_kode: val },
        }); 
    });
    
    $(document).on('change', '.barang_kode', function(){
        barang_bantu_kode.val('').trigger('change');
        var val = $(this).val();
        ajaxSelectFromApi({
            id: '.barang_bantu_kode',
            headers: { "Authorization": "Bearer <?= $token ?>" },
            url: '<?= $apiDomain . '/api/select2/barang_bantu' ?>',
            optionalSearch: { barang_kode: val },
        }); 
    });

</script>