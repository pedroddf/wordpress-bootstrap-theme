<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
    <?php if ( function_exists( 'the_archive_title' ) ): ?>
        <?php the_archive_title( '<h2>', '</h2>' ); ?>
    <?php else: ?>
        <?php if ( is_category() ): ?>
            <h2><?php printf( __( 'Category Archives: %s', 'clean-simple-white' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>
        <?php elseif ( is_tag() ): ?>
            <h2><?php printf( __( 'Tag Archives: %s', 'clean-simple-white' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>
        <?php elseif ( is_author() ): ?>
            <h2><?php printf( __( 'Author Archives: %s', 'clean-simple-white' ), "<span><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "'>" . get_the_author() . "</a></span>" ); ?></h2>
        <?php elseif ( is_day() ): ?>
            <h2><?php printf( __( 'Daily Archives: %s', 'clean-simple-white' ), '<span>' . get_the_date() . '</span>' ); ?></h2>
        <?php elseif ( is_month() ): ?>
            <h2><?php printf( __( 'Monthly Archives: %s', 'clean-simple-white' ), '</span>' . get_the_date( 'F Y' ) . '</span>' ); ?></h2>
        <?php elseif ( is_year() ): ?>
            <h2><?php printf( __( 'Yearly Archives: %s', 'clean-simple-white' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?></h2>
        <?php else: ?>
            <h2><?php _e( 'Blog Archives', 'clean-simple-white' ); ?></h2>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if ( function_exists( 'the_archive_description' ) ): ?>
        <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
    <?php else: ?>
        <?php
        $category_description = category_description();
        if ( ! empty( $category_description ) ) {
            echo '<div class="taxonomy-description">' . $category_description . '</div>';
        }
        ?>
    <?php endif; ?>
    
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
<?php else: ?>
    <?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
