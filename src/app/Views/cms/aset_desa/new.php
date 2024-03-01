<div class="row">
    <div class="col-md-12">

        <?php echo view('cms/partials/show_alert') ?>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Tambah Data</h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/jabatan/create') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control nama" name="nama" placeholder="Masukan nama">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Barang</label>
                                <select class="form-control js-example-basic-single barang_kode" name="barang_kode"></select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var settings = {
    "url": "https://api.esmades.id:80/api/barang/select2",
    "method": "GET",
    "timeout": 0,
    "headers": {
        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJFc21hZGVzIEpXVCIsImF1ZCI6IkVzbWFkZXMgSldUIiwic3ViIjoiRXNtYWRlcyBKV1QiLCJrbGllbl9pZCI6IjEiLCJrbGllbl9lbWFpbCI6ImtsaWVuMDFAZ21haWwuY29tIn0.zbprHXYk34c3B9aRjCPr1RbHknlL3kaCYyAwzEikXrw"
    },
};

$.ajax(settings).done(function (response) {
  console.log(response);
});
</script>