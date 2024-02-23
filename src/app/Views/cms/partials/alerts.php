<?php if($tipe == 'listErrors'): ?>
    <?php $listErrors = session()->getFlashdata('listErrors'); ?>
    <?php if($listErrors): ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($listErrors as $error): ?>
                <strong>Error!</strong> <?= $error ?> <br>
            <?php endforeach ?>
        </div>
    <?php endif ?>
<?php elseif($tipe == 'success'): ?>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif ?>
<?php elseif($tipe == 'error'): ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif ?>
<?php endif ?>