<section class="the-pagination">
    <?php
    get_critical_css('pagination.min.css');

    global $wp_query;

    $total_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));

    if ($total_pages > 1) : ?>
        <nav>
            <ul id="pagination">

                <?php if ($current_page > 1) : ?>
                    <li><a href="<?php echo get_pagenum_link(1); ?>" aria-label="first-page">«</a></li>
                    <li><?php previous_posts_link('Anterior'); ?></li>
                <?php endif; ?>

                <?php
                $start = max(1, $current_page - 2);
                $end = min($total_pages, $current_page + 2);

                for ($i = $start; $i <= $end; $i++) {
                    echo '<li>';
                    if ($current_page == $i) {
                        echo '<a href="#" aria-label class="active">' . $i . '</a>';
                    } else {
                        echo '<a href="' . get_pagenum_link($i) . '" aria-label>' . $i . '</a>';
                    }
                    echo '</li>';
                }
                ?>

                <?php if ($current_page < $total_pages) : ?>
                    <li><?php next_posts_link('Próximo'); ?></li>
                    <li><a href="<?php echo get_pagenum_link($total_pages); ?>" aria-label="last-page">»</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    <?php endif; ?>

</section>
