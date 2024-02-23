<body>
    <div id="layout-wrapper">
        <?= view('templates/header'); ?>
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url('dist/') ?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('dist/') ?>assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url('dist/') ?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('dist/') ?>assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
            </div>
            <?= view('templates/sidebar'); ?>
        </div>
    </div>
    <?= view($view); ?>
    <?= view('templates/scripts'); ?>
</body>