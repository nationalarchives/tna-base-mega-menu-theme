<a title="Go back to top" href="#" id="goTop"></a>
<?php
global $post;
if (!has_category('hide-newsletter',$post->ID)) : ?>
    <div class="container">
        <?php get_template_part( 'inc/content/footer-newsletter' );?>
    </div>
<?php endif;
?>
<footer id="footer" class="breather-top-bottom" role="contentinfo">
    <div class="container">
        <?php get_template_part( 'inc/content/footer-content' ); ?>
    </div>
</footer>

<?php wp_footer(); ?>
<?php get_template_part( 'inc/content/tna', 'footer' ); ?>

</body>
</html>