<?php $pageTitle = isset($title) ? $title : 'noTitle' ?>
<?php $pageSubTitle = isset($subTitle) ? $subTitle : 'noSubTitle' ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0"><?= $pageTitle ?></h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?= view($view); ?>
            
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?= view('cms/templates/footer') ?>
</div>