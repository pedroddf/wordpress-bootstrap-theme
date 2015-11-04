<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (is_single() || is_page()) {
        the_title('<h2>', '</h2>');
    } else {
        the_title(sprintf('<h2><a href="%s">', esc_url( get_permalink())), '</a></h2>');
    }
    ?>
    <?php if (!is_page()) : ?>
        <div class="post-meta">
            <?php
            $categories_list = get_the_category_list(__(', ', 'clean-simple-white'));
            if ($categories_list) {
                printf(__('Posted in %s - ', 'clean-simple-white'), $categories_list);
            }
            echo '<a href="' . esc_url(get_permalink()) . '">' . get_the_date() . '</a> - ';
            comments_number(__('0 Comment', 'clean-simple-white'), __('1 Comment', 'clean-simple-white'), __('% Comments', 'clean-simple-white'));
            ?>
        </div>
    <?php endif; ?>
    <?php
    if (has_post_thumbnail()) {
        the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
    }
    the_content(__('Read more', 'clean-simple-white'));
    
    $tag_list = get_the_tag_list('', __(', ', 'clean-simple-white'));
    if ($tag_list) {
        printf('<div>%s<span>%s</span></div>', __('Tags : ', 'clean-simple-white'), $tag_list);
    }
    
    wp_link_pages(array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'clean-simple-white') . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'clean-simple-white') . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ));
    ?>
</article>
