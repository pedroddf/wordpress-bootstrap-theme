<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<h2><?php printf( __( 'Search Results for: %s', 'clean-simple-white' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<?php
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous', 'clean-simple-white' ),
		'next_text'          => __( 'Next', 'clean-simple-white' ),
		'before_page_number' => '',
	) );
	//cleansimplewhite_the_posts_pagination();
	?>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
