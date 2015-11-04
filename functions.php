<?php

if ( ! isset( $content_width ) ) {
    $content_width = 550;
}

if ( ! function_exists( 'cleansimplewhite_setup' ) ) {
    function cleansimplewhite_setup() {
        
        load_theme_textdomain( 'clean-simple-white', get_template_directory() . '/languages' );
        
        add_theme_support( 'automatic-feed-links' );
        
        add_theme_support( 'title-tag' );
        
        add_theme_support( 'post-thumbnails' );
        
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );
        
        add_theme_support( 'custom-header', array(
            'default-image' => '',
            'width'         => 940,
            'height'        => 300,
            'flex-height'   => true,
            'uploads'       => true,
            'wp-head-callback' => 'cleansimplewhite_header_style',
        ) );
        
        add_theme_support( 'custom-background', array(
            'default-color' => 'fcfcfc',
        ) );
        
        register_nav_menus( array(
            'primary' => __( 'Primary Navigation', 'clean-simple-white' ),
        ));
        
        add_editor_style( 'css/editor-style.css?v1' );
    }
}
add_action( 'after_setup_theme', 'cleansimplewhite_setup' );

function cleansimplewhite_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'clean-simple-white' ),
        'id'            => 'sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar( array(
        'name'          => __( 'Footer Left', 'clean-simple-white' ),
        'id'            => 'footer-left',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar( array(
        'name'          => __( 'Footer Center', 'clean-simple-white' ),
        'id'            => 'footer-center',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'clean-simple-white' ),
        'id'            => 'footer-right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'cleansimplewhite_widgets_init' );

function cleansimplewhite_scripts() {
    wp_enqueue_style( 'cleansimplewhite-style', get_stylesheet_uri(), array(), '1.4.2' );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'cleansimplewhite_scripts' );

require get_template_directory() . '/inc/customizer.php';

function cleansimplewhite_header_style() {
    $header_image = get_header_image();
    ?>
    <style>
    
    #header a:link,
    #header a:visited {
        color: <?php echo get_theme_mod( 'header_link_color' ); ?> !important;
    }
    #header div {
        color: <?php echo get_theme_mod( 'header_text_color' ); ?> !important;
    }
    
    <?php if ( ! empty( $header_image ) ) : ?>
    #header {
        background-image: url(<?php echo $header_image; ?>);
        height: <?php echo get_custom_header()->height; ?>px;
    }
    <?php endif; ?>
    
    <?php if ( ! display_header_text() ) : ?>
    #header * {
        text-indent: -9999px;
    }
    <?php endif; ?>
    
    </style>
    <?php
}

// ----------------------------------------------

if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function theme_slug_render_title() {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
    
    function cleansimplewhite_wp_title( $title, $sep ) {
        global $paged, $page;
        
        if ( is_feed() ) {
            return $title;
        }
        
        // Add the site name.
        $title .= get_bloginfo( 'name', 'display' );
        
        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title = "$title $sep $site_description";
        }
        
        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 ) {
            $title = "$title $sep " . sprintf( __( 'Page %s', 'clean-simple-white' ), max( $paged, $page ) );
        }
        
        return $title;
    }
    add_filter( 'wp_title', 'cleansimplewhite_wp_title', 10, 2 );
}

if ( function_exists( 'the_posts_pagination' ) ) {
    the_posts_pagination( array(
        'prev_text'          => __( 'Previous', 'clean-simple-white' ),
        'next_text'          => __( 'Next', 'clean-simple-white' ),
        'before_page_number' => '',
    ) );
} else {
    function the_posts_pagination() {
        ?>
        <div class="navigation">
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'clean-simple-white' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'clean-simple-white' ) ); ?></div>
        </div>
        <?php
    }
}

if ( function_exists( 'the_post_navigation' ) ) {
    the_post_navigation( array(
        'prev_text' => '%title',
        'next_text' => '%title',
        'screen_reader_text' => '',
    ) );
} else {
    function the_post_navigation() {
        ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&larr;', 'clean-simple-white' ) . '</span> %title' ); ?></div>
            <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&rarr;', 'clean-simple-white' ) . '</span>' ); ?></div>
        </div><!-- #nav-below -->
        <?php
    }
}

/* ------------------------------------------ */

/*
function cleansimplewhite_the_posts_pagination() {
    if ( function_exists( 'the_posts_pagination' ) ) {
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'clean-simple-white' ),
            'next_text'          => __( 'Next', 'clean-simple-white' ),
            'before_page_number' => '',
        ) );
    } else {
        ?>
        <div class="navigation">
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'clean-simple-white' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'clean-simple-white' ) ); ?></div>
        </div>
        <?php
    }
}

function cleansimplewhite_the_post_navigation() {
    if ( function_exists( 'the_post_navigation' ) ) {
        the_post_navigation( array(
            'prev_text' => '%title',
            'next_text' => '%title',
            'screen_reader_text' => '',
        ) );
    } else {
        ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&larr;', 'clean-simple-white' ) . '</span> %title' ); ?></div>
            <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&rarr;', 'clean-simple-white' ) . '</span>' ); ?></div>
        </div><!-- #nav-below -->
        <?php
    }
}
*/
