<?php
get_template_part('template-parts/sidebars/global-footer-sidebar');
get_critical_css('footer.min.css');
?>

<footer>
    <h2>Unicórnio Hater</h2>
    <div class="footer-desc">
        <div class="footer-desc-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img width="150" height="124" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?>" class="image-lazy" alt="<?php bloginfo('name'); ?>" decoding="async" loading="lazy" srcset="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?> 150w" sizes="(max-width: 150px) 100vw, 150px">
            </a>
            <div class="footer-desc-text">
                <?php get_template_part('template-parts/sidebars/footer-sidebar'); ?>
            </div>
        </div>

    </div>
    <div class="footer-links">
        <div class="footer-links-item">
            <h3 id="menuTitle1">Links rápidos <span class="icon-chevron"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg></span></h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unicornio_footer_menu',
                'container'      => false,
                'menu_id'        => 'menu1',
                'menu_class'     => 'nav-footer',
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 1,
                'walker'         => new class extends Walker_Nav_Menu
                {
                    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
                    {
                        $output .= '<li class="nav-item">';
                        $output .= '<a href="' . esc_url($item->url) . '" class="link">' . esc_html($item->title) . '</a>';
                        $output .= '</li>';
                    }
                }
            ));
            ?>
        </div>

        <div class="footer-links-item">
            <h3 id="menuTitle2">Redes Sociais<span class="icon-chevron"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg></span></h3>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'unicornio_footer_s_menu',
                'container'      => false,
                'menu_id'        => 'menu2',
                'menu_class'     => 'nav-footer',
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 1,
                'walker'         => new class extends Walker_Nav_Menu
                {
                    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
                    {
                        $output .= '<li class="nav-item">';
                        $output .= '<a href="' . esc_url($item->url) . '" class="link">' . esc_html($item->title) . '</a>';
                        $output .= '</li>';
                    }
                }
            ));
            ?>
        </div>
    </div>
    <div class="text-copyright">©UnicórnioHater <?php echo date('Y'); ?></div>
</footer>

<script defer>
    <?php

    $main_theme_js_path = get_template_directory() . '/assets/js/main-theme.min.js';
    if (file_exists($main_theme_js_path)) {
        echo file_get_contents($main_theme_js_path);
    }

    if (is_front_page()) {
        $drag_elements_path = get_template_directory() . '/assets/js/drag-elements.min.js';
        if (file_exists($drag_elements_path)) {
            echo file_get_contents($drag_elements_path);
        }
    }

    ?>
</script>

</body>

</html>