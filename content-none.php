<div>
    <h2><?php _e( 'Nothing Found', 'clean-simple-white' ); ?></h2>
    <?php if ( is_search() ): ?>
        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clean-simple-white' ); ?></p>
    <?php else: ?>
        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'clean-simple-white' ); ?></p>
    <?php endif; ?>
    <?php get_search_form(); ?>
</div>
<div class="clear post-spt"></div>
