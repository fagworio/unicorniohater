<?php
/* Template Name: HomePage - UnicornioHater */
get_header();
?>

<?php
get_template_part('template-parts/content-news');
?>
<section class="full-width">
    <?php if (is_active_sidebar('global-top-banner')) : ?>
        <?php dynamic_sidebar('global-top-banner'); ?>
    <?php endif; ?>
</section>

<?php
get_template_part('template-parts/content-category');
?>

<?php
get_template_part('template-parts/content-radom');
?>

<?php
get_footer();
?>