<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/src/img/default.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-info"><?= $this->session->level ?></span>
    </a>
    <?php
    ?>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header"> <h3>Dashboard</h3> </li>
               <?php
                    if (!empty($this->session->level)) {
                        $menus = json_decode(file_get_contents(base_url('sources/custommenu.json')));
                        if ($this->session->level == 'pelanggan') {
                            redirect('login/logout');
                        }
                        foreach ($menus->{$this->session->level} as $key => $value) {
                            if(!empty($value->menusub)){
                            ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-plus-square"></i>
                                    <p><?= $value->menu ?><i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    foreach ($value->menusub as $key => $subs) {
                                    ?>
                                        <li class="nav-item"><a href="<?= base_url(strtolower($value->link."/".$subs->link_sub)) ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?= $subs->menu_sub ?></p>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                            }else{
                                ?>
                                <li class="nav-item"><a href="<?= base_url( $value->menu."/".$value->link) ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?= $value->menu ?></p>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        
                    }
                ?>

               
            </ul>
        </nav>
    </div>
</aside>
<style>
    [class*=sidebar-dark-] {
    background-color: #eff2f5;
}
[class*=sidebar-dark-] .sidebar a {
    color: #322f20;
}
[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
    color: #e37713;
}
[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover {
    background-color: rgba(255,255,255,.1);
    color: #3924e3;
}
[class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
    background-color: rgba(255,255,255,.1);
    color: #3924e3;
}
[class*=sidebar-dark-] .nav-header {
    background-color: inherit;
    color: #322f20;
}
[class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu {
    color: #322f20;
}
</style>