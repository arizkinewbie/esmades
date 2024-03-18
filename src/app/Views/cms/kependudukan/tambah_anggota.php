<div class="row">
    <div class="col-md-12">
        <form action="javascript:save()" method="post" id="form1">

            <input type="hidden" value="<?= $id ?>" name="kependudukan_id">

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">NIK</label>
                        <input type="text" class="form-control nik" name="nik" value="<?= set_value('nik') ?>"
                            placeholder="NIK">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control nama" name="nama"
                            value="<?= set_value('nama') ?>" placeholder="Nama">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Jenis Kelamin</label>
                        <select class="form-control js-example-basic-single jenis_kelamin"
                            name="jenis_kelamin"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Status Hubungan</label>
                        <select class="form-control js-example-basic-single status_hubungan"
                            name="status_hubungan"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control tempat_lahir" name="tempat_lahir"
                            value="<?= set_value('tempat_lahir') ?>" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control tanggal_lahir datepicker" name="tanggal_lahir"
                            value="<?= set_value('tanggal_lahir') ?>" placeholder="Tanggal Lahir">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Agama</label>
                        <select class="form-control js-example-basic-single agama_id" name="agama_id"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Pendidikan</label>
                        <select class="form-control js-example-basic-single pendidikan_id"
                            name="pendidikan_id"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Jenis Pekerjaan</label>
                        <select class="form-control js-example-basic-single jenis_pekerjaan_id"
                            name="jenis_pekerjaan_id"></select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Golongan Darah</label>
                        <input type="text" class="form-control goldar" name="goldar" value="<?= set_value('goldar') ?>"
                            placeholder="Golongan Darah">
                    </div>
                </div>
            </div>


            <!--end row-->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        <a href="<?= site_url('admin/kependudukan/index') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        btnSpinnerShow();

        $.ajax({
            url: '<?= $apiDomain ?>/api/kependudukan_detail/create',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer <?= $token ?>');
            },
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                swal.fire({
                    allowOutsideClick: false,
                    type: 'success',
                    title: 'Sukses',
                    text: 'Data berhasil disimpan',
                }).then((res) => {
                    $('.modalTambahAnggota').modal('hide');
                    detailData('<?= $id ?>');
                });
            },
            error: function() {
                swal.fire({
                    allowOutsideClick: false,
                    type: 'error',
                    title: 'Kesalahan',
                    text: 'Internal server error',
                }).then((res) => {
                    btnSpinnerHide();
                });
            }
        });
    }

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });

    $('.modalTambahAnggota').on('hidden.bs.modal', function () {
        detailData('<?= $id ?>');
    })
    
    ajaxSelectFromApi({
        id: '.jenis_pajak_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/jenis_pajak' ?>',
        selected: '<?= set_value('jenis_pajak_id') ?>',
    });
    ajaxSelectFromApi({
        id: '.agama_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/agama' ?>',
        selected: '<?= set_value('agama_id') ?>',
    });
    ajaxSelectFromApi({
        id: '.jenis_pekerjaan_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/jenis_pekerjaan' ?>',
        selected: '<?= set_value('jenis_pekerjaan_id') ?>',
    });
    ajaxSelectFromApi({
        id: '.pendidikan_id',
        headers: { "Authorization": "Bearer <?= $token ?>" },
        url: '<?= $apiDomain . '/api/select2/pendidikan' ?>',
        selected: '<?= set_value('pendidikan_id') ?>',
    });
    $('.jenis_kelamin').select2({
        placeholder: 'Pilih Opsi',
        data: [
            {id: 'Laki-laki', text: 'Laki-laki'},
            {id: 'Perempuan', text: 'Perempuan'},
        ]
    }).val('<?= set_value('jenis_kelamin') ?>').trigger('change')
    $('.status_hubungan').select2({
        placeholder: 'Pilih Opsi',
        data: [
            {id: 'Istri', text: 'Istri'},
            {id: 'Anak', text: 'Anak'},
        ]
    }).val('<?= set_value('status_hubungan') ?>').trigger('change')
    
</script>