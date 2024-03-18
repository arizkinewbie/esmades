<div class="row">
    <div class="col-md-12">
        <form action="<?= site_url('admin/kependudukan/update/' . $id) ?>" method="post" id="form1"
            enctype='multipart/form-data'>

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
                        <label for="firstNameinput" class="form-label">Nama Anggota</label>
                        <input type="text" class="form-control nama_kepala_keluarga" name="nama_kepala_keluarga"
                            value="<?= set_value('nama_kepala_keluarga') ?>" placeholder="Nama Kepala Keluarga">
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
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="firstNameinput" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control tempat_lahir" name="tempat_lahir"
                            value="<?= set_value('tempat_lahir') ?>" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="col-md-3">
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