<?php
if (post_password_required()) {
    return;
}
?>


<?php
get_critical_css('comments.min.css');
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            Deixe seu comentário
        </h2>

        <div class="comment-icon">
            <span class="comment-number">

                <?php
                $comments_number = get_comments_number();
                echo esc_html($comments_number);
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                    <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z" />
                </svg>
            </span>
        </div>


        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'textdomain'); ?></h2>
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'textdomain')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'textdomain')); ?></div>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'textdomain'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply' => __('Deixe seu comentário', 'textdomain'),
        'title_reply_to' => __('Deixe seu comentário %s', 'textdomain'),
        'comment_notes_before' => '',
        'comment_notes_after' => '',
    ));
    ?>
</div>