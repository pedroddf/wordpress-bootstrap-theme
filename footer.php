<footer id="page-footer" class="container">
    <div class="row">

        <div class="col-xs-4">
            <?php if (is_active_sidebar('footer-left')) : ?>
                <?php dynamic_sidebar('footer-left'); ?>
            <?php endif; ?>
        </div>

        <div class="col-xs-4">
            <?php if (is_active_sidebar('footer-center')) : ?>
                <?php dynamic_sidebar('footer-center'); ?>
            <?php endif; ?>
        </div>

        <div class="col-xs-4">
            <?php if (is_active_sidebar('footer-right')) : ?>
                <?php dynamic_sidebar('footer-right'); ?>
            <?php endif; ?>
        </div>

    </div>
    <div>

        <?php if (has_action('cleansimplewhite_credits')) : ?>
            <?php do_action('cleansimplewhite_credits'); ?>
        <?php else : ?>
            <?php printf(__('Copyright &copy; %u', 'clean-simple-white'), date( 'Y' )); ?>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a>.
            <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>">
                <?php _e('Entries (RSS)', 'clean-simple-white'); ?>
            </a>.
            <p><?php bloginfo('description'); ?></p>
        <?php endif; ?>

    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
