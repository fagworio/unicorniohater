<?php
get_header();
?>

<section class="full-with-sidebar content-random-a category">

    <?php
    get_critical_css('content-radom.min.css');
    ?>

    <h1 class="section-title"><?php single_cat_title(); ?></h1>

    <div class="nested-content">
        <div class="content-random latest-news-offset">

            <?php if (have_posts()) : ?>
                <?php $count = 0; ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php $count++; ?>
                    <?php if ($count == 1 || ($count - 1) % 4 == 0) : ?>
                        <div class="card-grid">
                        <?php endif; ?>

                        <!-- Início do Card -->
                        <div class="card">
                            <a href="<?php the_permalink(); ?>" aria-label="Saiba mais sobre <?php the_title(); ?>">
                                <?php
                                $image_id = get_post_thumbnail_id();
                                $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';

                                if ($image_id) {
                                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                                    if (!$image_alt) {
                                        $image_alt = get_the_title();
                                    }
                                    echo wp_get_attachment_image($image_id, 'featured-banner-random-post', false, array('width' => '145', 'height' => '180', 'alt' => $image_alt, 'loading' => 'lazy'));
                                } else {
                                    echo '<img width="145" height="180" src="' . $fallback_image_url . '" alt="' . get_the_title() . '" loading="lazy" />';
                                }
                                ?>
                            </a>
                            <div class="inner-card">
                                <h3><a href="<?php the_permalink(); ?>" aria-label="Saiba mais sobre <?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d/m/Y'); ?></time>
                            </div>
                        </div>
                        <!-- Fim do Card -->

                        <?php if ($count % 4 == 0) : ?>
                        </div> <!-- Fechando o div .card-grid -->
                    <?php endif; ?>

                <?php endwhile; ?>

                <?php if ($count % 4 != 0) : ?>
        </div> <!-- Fechando o último .card-grid caso ainda não tenha sido fechado -->
    <?php endif; ?>
<?php else : ?>
    <h2 class="center">Não encontrado</h2>
    <p class="center"><?php _e("Desculpe, mas você está procurando por algo que não está aqui."); ?></p>
<?php endif; ?>
    </div> <!-- Fechando o div .content-random.latest-news-offset -->

    <?php
    get_template_part('template-parts/sidebars/sidebar-archive');
    ?>

    </div>

    </div>

</section>

<?php
get_template_part('template-parts/pagination');
get_footer();
?>