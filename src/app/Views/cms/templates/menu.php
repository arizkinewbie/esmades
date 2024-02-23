<div id="scrollbar">
    <div class="container-fluid">


        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <?php $module1 = getListModule(['level' => 1]); ?>
            <?php if($module1): ?>
                <?php foreach($module1 as $row): ?>
                    <?php if(countSubMenu($row['id']) > 0): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebar<?= $row['id'] ?>" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebar<?= $row['id'] ?>">
                                <?= $row['icon'] ?> <span data-key="t-<?= $row['modul_nama'] ?>"><?= $row['modul_nama'] ?></span>
                            </a>
                            <?php $module2 = getListModule(['sub_modul_id' => $row['id']]); ?>
                            <?php if($module2): ?>
                                <div class="collapse menu-dropdown" id="sidebar<?= $row['id'] ?>">
                                    <ul class="nav nav-sm flex-column">
                                        <?php foreach($module2 as $row2): ?>
                                            <?php if(countSubMenu($row2['id']) > 0): ?>
                                                <li class="nav-item">
                                                    <a href="#sidebar<?= $row2['id'] ?>" class="nav-link" data-bs-toggle="collapse" role="button"
                                                        aria-expanded="false" aria-controls="sidebar<?= $row2['id'] ?>" data-key="t-<?= $row2['id'] ?>"> <?= $row2['modul_nama'] ?>
                                                    </a>
                                                    <?php $module3 = getListModule(['sub_modul_id' => $row2['id']]); ?>
                                                    <?php if($module3): ?>
                                                        <div class="collapse menu-dropdown" id="sidebar<?= $row2['id'] ?>">
                                                            <ul class="nav nav-sm flex-column">
                                                                <?php foreach($module3 as $row3): ?>
                                                                    <li class="nav-item"> <a href="<?= site_url($row3['modul_url']) ?>" class="nav-link" data-key="t-<?= $row3['id'] ?>"> <?= $row3['modul_nama'] ?> </a> </li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="nav-item">
                                                    <a href="<?= site_url($row2['modul_url']) ?>" class="nav-link" data-key="t-<?= $row2['modul_nama'] ?>"> <?= $row2['modul_nama'] ?> </a>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= site_url($row['modul_url']) ?>" class="nav-link" data-key="t-<?= $row['modul_nama'] ?>"> <?= $row['icon'] ?> <?= $row['modul_nama'] ?> </a>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>

        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>