<?php get_header(); 

	if (is_front_page()) {
		get_template_part( 'template-parts/index-page' );
	} 
	elseif (!is_front_page() && is_home()) {
		get_template_part( 'template-parts/news-page' );
	}
	else {
		get_template_part( 'template-parts/content-page' );
	}

get_footer(); ?>
