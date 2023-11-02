<div class="card">
    <a href="<?php the_permalink(); ?>" aria-label="<?php echo get_the_title(); ?>">
        <?php
        $thumbnail_id = get_post_thumbnail_id();
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        $alt_text = $alt_text ? $alt_text : get_the_title(); // Fallback para o título do post se não houver texto alternativo

        if ($thumbnail_id) {
            echo wp_get_attachment_image($thumbnail_id, 'featured-banner-random-post', false, array('class' => 'image-lazy', 'loading' => 'lazy', 'alt' => $alt_text));
        } else {
            $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';
            echo '<img width="145" height="180" src="' . $fallback_image_url . '" alt="' . esc_attr($alt_text) . '" loading="lazy" />';
        }
        ?>

    </a>
    <div class="inner-card">
        <h3><a href="<?php the_permalink(); ?>" aria-label="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h3>
        <div class="summary">
            <?php
            $excerpt = get_the_excerpt();
            $excerpt = explode(' ', $excerpt, 36);
            if (count($excerpt) >= 36) {
                array_pop($excerpt);
                $excerpt = implode(" ", $excerpt) . '...';
            } else {
                $excerpt = implode(" ", $excerpt);
            }
            $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
            echo $excerpt;
            ?>
        </div>
        <time itemprop="datePublished" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('d/m/Y'); ?></time>
    </div>
</div>