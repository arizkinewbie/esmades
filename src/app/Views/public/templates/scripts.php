<!-- JAVASCRIPT -->
<script src="<?= base_url('dist/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/libs/feather-icons/feather.min.js"></script>
<script src="<?= base_url('dist/') ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="<?= base_url('dist/') ?>assets/js/plugins.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php if(isset($dataTable)): ?>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="<?= base_url('dist/') ?>assets/js/pages/datatables.init.js"></script>
<?php endif ?>
    


<!-- Chart JS -->
<!-- <script src="<?= base_url('dist/') ?>assets/libs/chart.js/chart.umd.js"></script> -->

<!-- chartjs init -->
<!-- <script src="<?= base_url('dist/') ?>assets/js/pages/chartjs.init.js"></script> -->



<!-- App js -->
<script src="<?= base_url('dist/') ?>assets/js/pages/home.js"></script>
<script src="<?= base_url('dist/') ?>assets/js/app.js"></script>