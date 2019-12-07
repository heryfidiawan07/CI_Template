<?php if ($auth): ?>
    <nav id="sidebar">
        <div class="sidebar-header text-center pt-3">
            <a href="#">
                <!-- <img src="<?= base_url().'=========.png'; ?>" height="40" id="sidebar-brand"> -->
                <h2 id="sidebar-brand">LOGO</h2>
            </a>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="<?= base_url().'dashboard'; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <i class="fas fa-tachometer-alt sidebar-icon"></i>
                    <span class="dsh-text">Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="#dropdown_1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users-cog sidebar-icon"></i> <span class="dsh-text">User</span>
                </a>
                <ul class="collapse list-unstyled" id="dropdown_1">
                    <?php foreach ($auth as $user): ?>
                        <?php if ($user->parentId == 1): ?>
                            <li>
                                <a href="<?= base_url().$user->url; ?>" data-toggle="tooltip" data-placement="right" title="<?= $user->menuName; ?>">
                                    <i class="<?= $user->icon; ?> sidebar-icon"></i>
                                    <span class="dsh-text"><?= $user->menuName; ?></span>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </li>
        </ul>
        <p class="text-center font-12">
            &copy;
            <i>TEMPLATE SYSTEM</i>
        </p>
    </nav>
<?php endif ?>