<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="jobs-pagination-wrapper">
	<?php
		WP_Job_Board_Mixes::custom_pagination( array(
			'max_num_pages' => $jobs->max_num_pages,
			'prev_text'     => esc_html__( 'Previous page', 'wp-job-board' ),
			'next_text'     => esc_html__( 'Next page', 'wp-job-board' ),
			'wp_query' => $jobs
		));
	?>
</div>
