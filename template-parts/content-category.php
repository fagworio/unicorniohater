<section class="full-width-x content-category-s">
    <?php
    get_critical_css('content-category.min.css');
    $options = get_option('unicorniohater_settings');

    if ($options['featured_title']) {
        $featured_title = $options['featured_title'];
    }

    if ($options['featured_category']) {
        $featured_category = $options['featured_category'];
    }
    ?>
    <div class="content-category">
        <h3 class="category-title"><a href="/<?php echo strtolower($featured_category); ?>" aria-label="<?php echo $featured_title; ?>"><?php echo $featured_title; ?></a></h3>
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 7, // Número de posts a serem exibidos
            'category_name' =>  $featured_category, // Nome da categoria
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $query = new WP_Query($args);

        $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';

        if ($query->have_posts()) : ?>

            <div class="featured-category" id="featured-category">

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <div class="card">
                        <a href="<?php the_permalink(); ?>" aria-label="Saiba mais sobre <?php the_title(); ?>">
                            <?php
                            $thumbnail_id = get_post_thumbnail_id();
                            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            $alt_text = $alt_text ? $alt_text : get_the_title();

                            if ($thumbnail_id) :
                                echo wp_get_attachment_image($thumbnail_id, 'game-banner', false, array('class' => 'image-lazy', 'loading' => 'lazy', 'alt' => $alt_text, 'width' => 254, 'height' => 400));
                            else :
                                echo '<img width="254" height="400" src="' . $fallback_image_url . '" class="attachment-full size-full image-lazy" alt="' . $alt_text . '" decoding="async" loading="lazy" srcset="' . $fallback_image_url . ' 254w, ' . $fallback_image_url . ' 300w, ' . $fallback_image_url . ' 400w" sizes="(max-width: 254px) 100vw, 254px">';
                            endif;
                            ?>
                        </a>
                        <h3><a href="<?php the_permalink(); ?>" aria-label="Saiba mais sobre <?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    </div>

                <?php endwhile; ?>

            </div>

        <?php endif;
        wp_reset_postdata(); ?>
    </div>


</section>