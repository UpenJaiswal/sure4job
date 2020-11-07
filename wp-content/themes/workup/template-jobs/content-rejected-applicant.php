<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$candidate_id = get_post_meta( $post->ID, WP_JOB_BOARD_APPLICANT_PREFIX.'candidate_id', true );
$candidate = get_post($candidate_id);

$candidate_url = get_permalink($candidate_id);
$candidate_url = add_query_arg( 'applicant_id', $post->ID, $candidate_url );
$candidate_url = add_query_arg( 'candidate_id', $candidate_id, $candidate_url );
$candidate_url = add_query_arg( 'action', 'view-profile', $candidate_url );

$rating_avg = WP_Job_Board_Review::get_ratings_average($candidate_id);

$viewed = get_post_meta( $post->ID, WP_JOB_BOARD_APPLICANT_PREFIX.'viewed', true );
$classes = $viewed ? 'viewed' : '';
?>

<?php do_action( 'wp_job_board_before_applicant_content', $post->ID ); ?>

<article <?php post_class('applicants-job job-applicant-wrapper clearfix '.$classes); ?>>

    <?php if ( has_post_thumbnail($candidate_id) ) { ?>
        <div class="applicant-thumbnail">
            <div class="inner">
                <a href="<?php echo esc_url( $candidate_url ); ?>" rel="bookmark">
                    <?php echo get_the_post_thumbnail( $candidate_id, 'thumbnail' ); ?>
                </a>
            </div>
            <?php if ( !empty($rating_avg) ) { ?>
                <div class="rating-avg"><?php echo round($rating_avg,1,PHP_ROUND_HALF_UP); ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="applicant-information">
        <div class="flex-middle">
            <div class="left-info">
                <div class="flex-bottom-sm">
                    <h2 class="applicant-title">
                        <a href="<?php echo esc_url( $candidate_url ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>

                    <?php
                        $rejected = WP_Job_Board_Applicant::get_post_meta($post->ID, 'rejected', true);
                        $approved = WP_Job_Board_Applicant::get_post_meta($post->ID, 'approved', true);

                        if ( $approved ) {
                            echo '<span class="application-status-label label label-success approved">'.esc_html__('Approved', 'workup').'</span>';
                        } elseif ( $rejected ) {
                            echo '<span class="application-status-label label label-danger rejected">'.esc_html__('Rejected', 'workup').'</span>';
                        } else {
                            echo '<span class="application-status-label label label-default pending">'.esc_html__('Pending', 'workup').'</span>';
                        }
                    ?>
                </div>
                
                <div class="flex-bottom-sm">
                    <?php if ( !empty($rating_avg) ) { ?>
                        <div class="rating-avg-star hidden-xs"><?php echo WP_Job_Board_Review::print_review($rating_avg); ?></div>
                    <?php } ?>
                    <div class="applicant-date text-theme">
                        <?php if ( !empty($rating_avg) ) { ?>
                            <span class="space hidden-xs"> - </span>
                        <?php } ?>
                        <?php the_time( get_option('date_format', 'd M, Y') ); ?>
                    </div>
                </div>
                
                <div class="metas flex-middle-sm">
                    <?php workup_candidate_display_categories($candidate,'icon'); ?>
                    <div class="visible-lg"><?php workup_candidate_display_short_location($candidate); ?></div>
                    <div class="hidden-xs"><?php WP_Job_Board_Candidate::display_shortlist_link($candidate_id); ?></div>
                </div>
            </div>
            <div class="right-info ali-right hidden-xs">
                <div class="flex-middle">
                    <div class="applicant-action-button">
                        
                        <a data-toggle="tooltip" href="javascript:void(0);" class="btn-undo-reject-job-applied btn-action-icon reject" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-undo-reject-applied-nonce' )); ?>" title="<?php esc_html_e('Undo Rejected', 'workup'); ?>"><i class="fa fa-undo"></i></a>

                        <a data-toggle="tooltip" title="<?php esc_attr_e('Remove', 'workup'); ?>" href="javascript:void(0);" class="btn-action-icon btn-remove-job-applied remove" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-applied-nonce' )); ?>"><i class="ti-close"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right-info bottom-info visible-xs">
        <div class="flex-middle">
            <div class="applicant-action-button">
                
                <a data-toggle="tooltip" href="javascript:void(0);" class="btn-undo-reject-job-applied btn-action-icon reject" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-undo-reject-applied-nonce' )); ?>" title="<?php esc_html_e('Undo Rejected', 'workup'); ?>"><i class="fa fa-undo"></i></a>

                <a data-toggle="tooltip" title="<?php esc_attr_e('Remove', 'workup'); ?>" href="javascript:void(0);" class="btn-action-icon btn-remove-job-applied remove" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-applied-nonce' )); ?>"><i class="ti-close"></i></a>
            </div>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_applicant_content', $post->ID );