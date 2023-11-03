<section class="full-width">

    <?php
    get_critical_css('post.min.css');
    ?>
    <div class="post-content">

        <article>
            <div class="post-header">
                <ul class="post-category">
                    <?php
                    $post_categories = get_the_category();
                    if ($post_categories) {
                        foreach ($post_categories as $category) {
                            if ($category->parent === 0) { // Verificar se é uma categoria principal
                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                            }
                        }
                    }
                    ?>
                </ul>

                <h1 class="post-title"><?php the_title(); ?></h1>
                <?php
                $subtitle = get_post_meta($post->ID, 'td_post_theme_settings', true);
                if (!empty($subtitle['td_subtitle'])) {
                    echo '<span class="subtitle">' . $subtitle['td_subtitle'] . '</span>';
                }

                ?>
                <div class="post-meta">
                    <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                    <span>/ <?php the_author(); ?></span>
                </div>

                <div class="social-share">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>&t=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512">
                                    <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="x-twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512">
                                    <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php the_post_thumbnail_url(); ?>&description=<?php the_title(); ?>" target="_blank" class="pinterest">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512">
                                    <path d="M448 80v352c0 26.5-21.5 48-48 48H154.4c9.8-16.4 22.4-40 27.4-59.3 3-11.5 15.3-58.4 15.3-58.4 8 15.3 31.4 28.2 56.3 28.2 74.1 0 127.4-68.1 127.4-152.7 0-81.1-66.2-141.8-151.4-141.8-106 0-162.2 71.1-162.2 148.6 0 36 19.2 80.8 49.8 95.1 4.7 2.2 7.1 1.2 8.2-3.3.8-3.4 5-20.1 6.8-27.8.6-2.5.3-4.6-1.7-7-10.1-12.3-18.3-34.9-18.3-56 0-54.2 41-106.6 110.9-106.6 60.3 0 102.6 41.1 102.6 99.9 0 66.4-33.5 112.4-77.2 112.4-24.1 0-42.1-19.9-36.4-44.4 6.9-29.2 20.3-60.7 20.3-81.8 0-53-75.5-45.7-75.5 25 0 21.7 7.3 36.5 7.3 36.5-31.4 132.8-36.1 134.5-29.6 192.6l2.2.8H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/unicornio_hater/" target="_blank" class="instagran">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512">
                                    <path d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="copyToClipboard('<?php the_permalink(); ?>')" class="copy-andshare">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 576 512">
                                    <path d="M352 224H305.5c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8h-2.5c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144h80V34.7C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2H384c-17.7 0-32-14.3-32-32V224zM80 96c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16H400c8.8 0 16-7.2 16-16V384c0-17.7 14.3-32 32-32s32 14.3 32 32v48c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V112C0 67.8 35.8 32 80 32h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H80z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <a class="respond" href="#respond">
                        <?php
                        $comments_number = get_comments_number();
                        echo esc_html($comments_number);
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                            <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z" />
                        </svg>
                    </a>

                </div>
                <div class="featured-image">
                    <?php
                    $fallback_image_url = get_template_directory_uri() . '/assets/images/fallback-image.webp';
                    if (has_post_thumbnail()) {
                        $image_id = get_post_thumbnail_id();
                        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        $alt_text = $alt_text ? $alt_text : get_the_title(); // fallback para alt text
                        echo wp_get_attachment_image($image_id, 'featured-banner', false, array('class' => 'image-lazy', 'loading' => 'eager', 'alt' => $alt_text));
                    } else {
                        // Fallback para a imagem
                        echo '<img width="1200" height="720" src="' . $fallback_image_url . '" class="attachment-full size-full image-lazy" alt="' . get_the_title() . '" decoding="async" loading="lazy" srcset="' . $fallback_image_url . ' 1200w, ' . $fallback_image_url . ' 300w, ' . $fallback_image_url . ' 1024w, ' . $fallback_image_url . ' 768w" sizes="(max-width: 1200px) 100vw, 1200px">';
                    }
                    ?>
                </div>

            </div>
            <div class="the-content">
                <?php the_content(); ?>

                <?php
                /*
                    * Output comments wrapper if it's a post, or if comments are open,
                    * or if there's a comment number – and check for password.
                    */
                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                ?>

                    <div class="comments-wrapper section-inner">

                        <?php comments_template(); ?>

                    </div><!-- .comments-wrapper -->

                <?php
                }
                ?>

            </div>

        </article>
        <!-- sidebar -->
        <?php
        get_template_part('template-parts/sidebars/right-sidebar');
        ?>
    </div>
</section>