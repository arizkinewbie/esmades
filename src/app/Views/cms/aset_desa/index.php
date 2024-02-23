<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Datatables</h5>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">ID.</th>
                            <th data-ordering="false">Jenis Aset</th>
                            <th data-ordering="false">Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('admin/aset_desa/datatable') ?>',
            columns: [
                {data: 'id'},
                {data: 'jenis_aset'},
                {data: 'deskripsi'},
                {data: 'deskripsi'},
            ]
        });
    });
</script>