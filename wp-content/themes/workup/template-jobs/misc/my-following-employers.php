<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>
<div class="widget widget-following-employers box-dashboard-wrapper">
	<div class="inner-list">
		<h3 class="widget-title"><?php echo esc_html__('Following Employers','workup') ?></h3>
		<div class="search-orderby-wrapper flex-middle-sm">
			<div class="search-following-employer-form widget-search">
				<form action="" method="get">
					<div class="input-group">
						<input type="text" placeholder="<?php esc_attr_e( 'Search ...', 'workup' ); ?>" class="form-control" name="search" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
						<span class="input-group-btn">
							<button class="search-submit btn btn-sm btn-search" name="submit">
								<i class="flaticon-magnifying-glass"></i>
							</button>
						</span>
					</div>
					<input type="hidden" name="paged" value="1" />
				</form>
			</div>
			<div class="sort-following-employer-form sortby-form">
				<?php
					$orderby_options = apply_filters( 'wp_job_board_my_jobs_orderby', array(
						'menu_order'	=> esc_html__( 'Default', 'workup' ),
						'newest' 		=> esc_html__( 'Newest', 'workup' ),
						'oldest'     	=> esc_html__( 'Oldest', 'workup' ),
					) );

					$orderby = isset( $_GET['orderby'] ) ? wp_unslash( $_GET['orderby'] ) : 'newest'; 
				?>

				<div class="orderby-wrapper flex-middle">
					<span class="text-sort">
						<?php echo esc_html__('Sort by: ','workup'); ?>
					</span>
					<form class="my-jobs-ordering" method="get">
						<select name="orderby" class="orderby">
							<?php foreach ( $orderby_options as $id => $name ) : ?>
								<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="paged" value="1" />
						<?php WP_Job_Board_Mixes::query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
					</form>
				</div>
			</div>
		</div>
		<?php if ( !empty($employers) && !empty($employers->have_posts()) ) {
			
			while ( $employers->have_posts() ) : $employers->the_post(); global $post;?>
				<div class="following-employer-wrapper">
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'employers-styles/inner-list', array('unfollow' => true) ); ?>
				</div>
			<?php endwhile;
			wp_reset_postdata();

			WP_Job_Board_Mixes::custom_pagination( array(
				'wp_query' => $employers,
				'max_num_pages' => $employers->max_num_pages,
				'prev_text'     => esc_html__( 'Previous page', 'workup' ),
				'next_text'     => esc_html__( 'Next page', 'workup' ),
			));
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('No following employer found.', 'workup'); ?></div>
		<?php } ?>
	</div>
</div>