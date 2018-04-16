<div class="menu d-flex justify-content-center align-items-center">
    <nav class="navbar navbar-expand-lg navbar-light">
        <span class="navbar-brand d-block d-lg-none">Menu</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php wp_nav_menu( array( 'menu' => 'header-menu',
                'theme_location'    => 'primary',
                'depth'             => 0,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'navbarSupportedContent',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
        
    </nav>
</div>
