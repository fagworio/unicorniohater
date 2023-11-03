<?php
get_header();
?>
<section class="full-width">
    <?php
    get_critical_css('search-form.min.css');
    ?>
    <div class="search-header">
        <h1 class="page-title">
            <?php printf(esc_html__('Resultados da pesquisa por: %s', 'unicornioHater'), '<span class="search-query">"' . get_search_query() . '"</span>'); ?>
        </h1>

        <div class="search-form">
            <?php get_search_form(); ?>
        </div>
    </div>
</section>
<section class="full-with-sidebar content-random-a">
    <?php
    get_critical_css('search.min.css');
    ?>
    <div class="nested-content">
        <div class="content-random latest-news-offset">
            <div class="card-grid">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/search-list');
                    endwhile;
                    ?>
            </div>


        </div>
        <?php
                    get_template_part('template-parts/sidebar-search');
        ?>
    </div>
</section>

<?php else : ?>

    <p><?php esc_html_e('Desculpe, nenhum resultado encontrado.', 'unicornioHater'); ?></p>

<?php endif; ?>

</section>

<?php
get_template_part('template-parts/pagination');
get_template_part('template-parts/sidebars/sidebar-footer-global');
get_footer();
?>