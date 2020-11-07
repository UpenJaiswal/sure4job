<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_candidate = workup_get_config('register_form_enable_candidate', true);
$show_employer = workup_get_config('register_form_enable_employer', true);
if ( !$show_candidate && !$show_employer ) {
	return;
}

wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>


<div class="box-employer">
  	<div class="register-form-wrapper">
	  	<div class="container-form">
          	<form name="registerForm" method="post" class="register-form">
          		<div class="form-group space-25 text-center">
					<ul class="role-tabs <?php echo esc_attr((!$show_candidate || !$show_employer) ? 'hidden' : ''); ?>">
						<?php
						$checked = 'checked="checked"';
						$active_class = 'active';
						if ( $show_candidate ) {
						?>
							<li class="<?php echo esc_attr($active_class); ?>"><input id="cadidate" type="radio" name="role" value="wp_job_board_candidate" <?php echo trim($checked); ?>><label for="cadidate"><i class="ti-user"></i><?php esc_html_e('Candidate', 'workup'); ?></label></li>
						<?php
							$checked = '';
							$active_class = '';
						} ?>
						<?php if ( $show_employer ) { ?>
							<li class="<?php echo esc_attr($active_class); ?>"><input type="radio" id="employer" name="role" value="wp_job_board_employer" <?php echo trim($checked); ?>><label for="employer"><i class="ti-user"></i><?php esc_html_e('Employer', 'workup'); ?></label></li>
						<?php } ?>
					</ul>
				</div>
				<div class="form-group">
					<label><?php esc_attr_e('Username *','workup'); ?></label>
					<input type="text" class="form-control" name="username" id="register-username" placeholder="<?php esc_attr_e('Username *','workup'); ?>">
				</div>
				<div class="form-group">
					<label><?php esc_attr_e('Email *','workup'); ?></label>
					<input type="text" class="form-control" name="email" id="register-email" placeholder="<?php esc_attr_e('Email *','workup'); ?>">
				</div>
				<div class="form-group">
					<label><?php esc_attr_e('Password *','workup'); ?></label>
					<input type="password" class="form-control" name="password" id="password" placeholder="<?php esc_attr_e('Password *','workup'); ?>">
				</div>
				<div class="form-group">
					<label><?php esc_attr_e('Confirm Password *','workup'); ?></label>
					<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="<?php esc_attr_e('Confirm Password *','workup'); ?>">
				</div>

				<?php if ( workup_get_config('register_form_enable_employer_company') ) { ?>
					<div class="form-group wp_job_board_employer_show">
						<label><?php esc_attr_e('Company Name','workup'); ?></label>
						<input type="text" class="form-control" name="company_name" id="register-company-name" placeholder="<?php esc_attr_e('Company Name','workup'); ?>">
					</div>
				<?php } ?>

				<?php if ( workup_get_config('register_form_enable_phone') ) { ?>
					<div class="form-group">
						<label><?php esc_attr_e('Phone','workup'); ?></label>
						<input type="text" class="form-control" name="phone" id="register-phone" placeholder="<?php esc_attr_e('Phone','workup'); ?>">
					</div>
				<?php } ?>
				<?php
					if ( workup_get_config('register_form_enable_candidate_category') ) {
						$candidate_args = array(
				            'taxonomy' => 'candidate_category',
				            'orderby' => 'name',
				            'order' => 'ASC',
				            'hide_empty' => false,
				            'number' => false,
					    );
					    $terms = get_terms($candidate_args);

					    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					    	?>
					    	<div class="form-group space-25 wp_job_board_candidate_show select2-wrapper">
					    		<label><?php esc_html_e('Category', 'workup'); ?></label>
					    		<div>
									<select id="register-candidate-category" class="register-category" name="candidate_category">
										<option value=""><?php esc_html_e('Select Category', 'workup'); ?></option>
										<?php foreach ($terms as $term) { ?>
											<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
					    	<?php
					    }
				    }
				?>
				<?php
					if ( workup_get_config('register_form_enable_employer_category') ) {
						$employer_args = array(
				            'taxonomy' => 'employer_category',
				            'orderby' => 'name',
				            'order' => 'ASC',
				            'hide_empty' => false,
				            'number' => false,
					    );
					    $terms = get_terms($employer_args);

					    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					    	?>
					    	<div class="form-group space-25 wp_job_board_employer_show select2-wrapper ">
					    		<label><?php esc_html_e('Category', 'workup'); ?></label>
					    		<div>
									<select id="register-employer-category" class="register-category" name="employer_category">
										<option value=""><?php esc_html_e('Select Category', 'workup'); ?></option>
										<?php foreach ($terms as $term) { ?>
											<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
					    	<?php
					    }
				    }
				?>
				<?php wp_nonce_field('ajax-register-nonce', 'security_register'); ?>

				<?php if ( WP_Job_Board_Recaptcha::is_recaptcha_enabled() ) { ?>
		            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_job_board_get_option( 'recaptcha_site_key' )); ?>"></div>
		      	<?php } ?>
		      	
		      	<?php
				$page_id = wp_job_board_get_option('terms_conditions_page_id');
				if ( !empty($page_id) ) {
					$page_url = $page_id ? get_permalink($page_id) : home_url('/');
				?>
					<div class="form-group">
						<label for="register-terms-and-conditions">
							<input type="checkbox" name="terms_and_conditions" value="on" id="register-terms-and-conditions" required>
							<?php
								echo sprintf(__('You accept our <a href="%s">Terms and Conditions and Privacy Policy</a>', 'workup'), esc_url($page_url));
							?>
						</label>
					</div>
				<?php } ?>

				<div class="form-group text-center">
					<button type="submit" class="btn btn-success" name="submitRegister">
						<?php echo esc_html__('Register now', 'workup'); ?>
					</button>
				</div>

				<?php do_action('register_form'); ?>
          	</form>
	    </div>

  	</div>
 </div>
