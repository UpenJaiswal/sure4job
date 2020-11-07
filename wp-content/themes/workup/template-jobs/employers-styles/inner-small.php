<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_before_employer_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="employer-list-small">
        <div class="flex-middle">
            <?php workup_employer_display_logo($post); ?>
            <div class="employer-information">
                <?php the_title( sprintf( '<h2 class="employer-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php workup_employer_display_open_position($post); ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_after_employer_content', $post->ID ); ?>