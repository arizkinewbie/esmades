<div class="page-title-right">
    <ol class="breadcrumb m-0">
        <?php foreach($data as $b): ?>
            <?php if($b['url']): ?>
                <li class="breadcrumb-item"><a href="<?= site_url($b['url']) ?>"><?= $b['title'] ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item active"><?= $b['title'] ?></li>
            <?php endif ?>
        <?php endforeach ?>
    </ol>
</div>