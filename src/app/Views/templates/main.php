<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<?= view('templates/head'); ?>


<body id="kt_body" class="page-bg">

    <?= view('templates/header') ?>

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid me-lg-0 pt-0 mb-0" id="kt_page">
            <div class="d-flex flex-row" style="width:100%;">
                <?= view('templates/sidebar'); ?>
                <div id="right-container" class="flex-row-fluid ml-lg-8">
                    <div id="map" style="height:calc(100vh - 8.5em);width:100%;display:inline-block;margin:0"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var APP = {
        "HOST": "https://sadayapadu.cimahikota.go.id/"
    };
    </script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/js/scripts.bundle.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/custom/ol/ol.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/custom/ol/ol-layerswitcher.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/js/jquery.serializejson.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/plugins/custom/yhs/YHS.js"></script>
    <script src="<?= base_url('templates/01/') ?>assets/app/js/app.js"></script>
    <script type="text/javascript">
    (() => {
        const s = $('.yhs-ajax[href="' + window.location.href + '"]');
        if (s.length) s.trigger('click');
        else $('#menu-peta-budaya').trigger('click')
    })();
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <?= view('templates/peta'); ?>
</body>
<!-- Mirrored from sadayapadu.cimahikota.go.id/objek_budaya by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Jan 2024 15:12:50 GMT -->

</html>