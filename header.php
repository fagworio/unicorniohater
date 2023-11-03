<?php

/**
 * The header.
 */
?>

<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/unicorniohater-ico.png" type="image/x-icon">

    <?php
    wp_head();
    get_critical_css('base.min.css');
    ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header>
        <?php
        get_critical_css('header.min.css');
        if ( !is_front_page() ) {
            get_template_part('template-parts/sidebars/global-header-sidebar');
        }

        if( is_front_page() ) {
            get_template_part('template-parts/sidebars/template-page-sidebar');
        }

        ?>
        <div class="topbar">
            <div class="container">
                <div class="topbar-right">
                    <?php get_template_part('template-parts/sidebars/global-search-sidebar'); ?>
                </div>
            </div>
        </div>
        <div class="main-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img width="150" height="124" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?>" class="image-lazy" alt="<?php bloginfo('name'); ?>" decoding="async" loading="lazy" srcset="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?> 150w" sizes="(max-width: 150px) 100vw, 150px">
            </a>
        </div>

        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unicornio_main_menu',
                'container'      => false,
                'items_wrap'     => '<ul>%3$s</ul>',
                'depth'          => 1,
            ));
            ?>
        </nav>

        <div class="inner-header">

            <?php 
                if(!is_front_page() ) {
                    if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs();
                }
            ?>
        </div>

    </header>