<?php

get_header();
get_critical_css('page.min.css');

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content-page' );

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

    endwhile; // End of the loop.

get_footer();