
<section class="full-with-sidebar content-random-s">
    <?php
    get_critical_css('content-radom.min.css');
    $options = get_option('unicorniohater_settings');

    if ($options['random_title']) {
        $title = $options['random_title'];
    }

    if ($options['random_category']) {
        $random_category = $options['random_category'];
        $random_category_array = explode(',', $random_category);
        $random_category_array = array_map('trim', $random_category_array);
    }

    ?>

    <h2 class="section-title"><?php echo $title; ?></h2>
    <div class="nested-content">
        <div class="content-random latest-news-offset">
            <?php
            $categories = $random_category_array;
            shuffle($categories);
            $selected_categories = array_slice($categories, 0, 2);

            $all_posts = [];
            $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';

            foreach ($selected_categories as $category) {
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'category_name' => $category,
                    'orderby' => 'rand',
                    'offset' => 1
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $thumbnail_id = get_post_thumbnail_id();
                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        $alt_text = $alt_text ? $alt_text : get_the_title();

                        $all_posts[] = [
                            'category' => $category,
                            'permalink' => get_permalink(),
                            'thumbnail_id' => $thumbnail_id,
                            'title' => get_the_title(),
                            'date' => get_the_date('c'),
                            'formatted_date' => get_the_date(),
                            'alt_text' => $alt_text
                        ];
                    endwhile;
                endif;
                wp_reset_postdata();
            }

            shuffle($all_posts);

            $post_count = 0;
            $max_posts_per_col = 3;
            foreach ($all_posts as $post_data) {
                if ($post_count % $max_posts_per_col == 0) {
                    echo ($post_count > 0 ? '</div>' : '') . '<div class="card-grid">';
                }
                $post_count++;
            ?>
                <div class="card">
                    <a href="<?php echo $post_data['permalink']; ?>" aria-label="Saiba mais sobre <?php echo $post_data['title']; ?>">
                        <?php
                        if ($post_data['thumbnail_id']) :
                            echo wp_get_attachment_image($post_data['thumbnail_id'], 'featured-banner-random-post', false, array('class' => 'image-lazy', 'loading' => 'lazy', 'alt' => $post_data['alt_text']));
                        else :
                            echo '<img width="1200" height="720" src="' . $fallback_image_url . '" class="attachment-full size-full image-lazy" alt="' . $post_data['alt_text'] . '" decoding="async" loading="lazy" srcset="' . $fallback_image_url . ' 1200w, ' . $fallback_image_url . ' 300w, ' . $fallback_image_url . ' 1024w, ' . $fallback_image_url . ' 768w" sizes="(max-width: 1200px) 100vw, 1200px">';
                        endif;
                        ?>
                        <div class="inner-card">
                            <a href="<?php echo get_category_link(get_cat_ID($post_data['category'])); ?>" aria-label="Saiba mais sobre <?php echo ucfirst($post_data['category']); ?>" class="category-badge category"><i class="circle"></i><?php echo ucfirst($post_data['category']); ?></a>
                            <h3><a href="<?php echo $post_data['permalink']; ?>"  aria-label="Saiba mais sobre <?php echo $post_data['title']; ?>"><?php echo $post_data['title']; ?></a></h3>
                            <time itemprop="datePublished" datetime="<?php echo $post_data['date']; ?>"><?php echo $post_data['formatted_date']; ?></time>
                        </div>
                    </a>
                </div>
            <?php
            }
            echo '</div>'; // Close last card-grid if any
            ?>
        </div>

        <aside class="right-sidebar">
            <?php if (is_active_sidebar('template-home-right-sidebar')) : ?>
                <?php dynamic_sidebar('template-home-right-sidebar'); ?>
            <?php endif; ?>
        </aside>
    </div>

    </div>

</section>