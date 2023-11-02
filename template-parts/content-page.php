<section class="full-width page-content">

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php
        the_content();
        ?>
    </article>
</section>