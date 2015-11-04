<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>
    <?php if ( comments_open() || get_comments_number() ) : ?>
        <?php comments_template(); ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
