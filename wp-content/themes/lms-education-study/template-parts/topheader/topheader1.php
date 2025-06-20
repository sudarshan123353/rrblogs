<?php
/**
 * Displays top header
 *
 * @package LMS Education Study
 */
?>

<div class="top-info-1">
	<div class="container">
		<div class="row top-header-1 m-0">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 align-self-center bottom-header-box">
				<?php if(get_theme_mod('lms_education_study_top_header_text') != '' ){ ?>
			        <div class="header-text">
						<p class="my-2"><?php echo esc_html('POLICY UPDATE: ','lms-education-study'); ?><?php echo esc_html(get_theme_mod('lms_education_study_top_header_text','')); ?></p>
			        </div>
		        <?php }?>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-0 text-lg-start text-center align-self-center">
            </div>
		</div>
	</div>
</div>