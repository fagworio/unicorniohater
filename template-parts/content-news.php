<section class="full-width content-news-s">
    <?php

    get_critical_css('content-news.min.css');

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $query = new WP_Query($args);
    $counter = 1; // Inicializa o contador

    if ($query->have_posts()) : ?>

        <div class="content-news">
            <?php $counter = 1; ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="card">
                    <a href="<?php the_permalink(); ?>" aria-label="Saiba mais sobre <?php the_title(); ?>">
                        <?php
                        $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';

                        if ($counter == 1) {
                            $size = 'large-banner';
                        } elseif ($counter == 2) {
                            $size = 'medium-banner';
                        } else {
                            $size = 'small-banner';
                        }

                        $thumbnail_id = get_post_thumbnail_id();
                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        $alt_text = $alt_text ? $alt_text : get_the_title();

                        if ($thumbnail_id) :
                            echo wp_get_attachment_image($thumbnail_id, $size, false, array('class' => 'image-lazy', 'loading' => 'eager', 'alt' => $alt_text));
                        else :
                            echo '<img width="1200" height="720" src="' . $fallback_image_url . '" class="attachment-full size-full image-lazy" alt="' . $alt_text . '" decoding="async" loading="lazy" srcset="' . $fallback_image_url . ' 1200w, ' . $fallback_image_url . ' 300w, ' . $fallback_image_url . ' 1024w, ' . $fallback_image_url . ' 768w" sizes="(max-width: 1200px) 100vw, 1200px">';
                        endif;
                        ?>
                        <h3>
                            <span><?php the_title(); ?></span>
                            <time itemprop="datePublished" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
                        </h3>
                    </a>
                </div>

                <?php $counter++; ?>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata(); ?>
</section>