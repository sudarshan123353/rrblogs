<?php
/**
 * Displays top header
 *
 * @package LMS Education Study
 */
?>

<div class="top-info text-end">
	<div class="container">
		<div class="row top-header m-0">
			<div class="col-xl-4 col-lg-3 col-md-2 col-sm-0 text-lg-start text-center align-self-center">
            </div>
			<div class="col-xl-8 col-lg-9 col-md-10 col-sm-12 align-self-center contact-box">
				<div class="row contact">
					<div class="col-lg-4 col-md-4 col-sm-6 col-12 align-self-center mail-box my-2">
			            <?php if(get_theme_mod('lms_education_study_email') != '' ){ ?>
			            	<span><i class="fas fa-envelope"></i></span>
			                <a href="mailto:<?php echo esc_attr(get_theme_mod('lms_education_study_email','')); ?>"><?php echo esc_html(get_theme_mod('lms_education_study_email','')); ?></a>
			            <?php }?>
			        </div>
					<?php if(get_theme_mod('lms_education_study_topbar_timming') != '' ){ ?>
				        <div class="col-lg-5 col-md-4 col-sm-6 col-12 align-self-center phone-box">
			            	<span><i class="far fa-clock"></i></span>
							<?php echo esc_html(get_theme_mod('lms_education_study_topbar_timming','')); ?>
				        </div>
			        <?php }?>
			        <div class="col-lg-3 col-md-4 col-sm-6 col-12 align-self-center phone-box ">
		            	<div class="social-link">
		                    <?php if(get_theme_mod('lms_education_study_facebook_url') != ''){ ?>
		                        <a href="<?php echo esc_url(get_theme_mod('lms_education_study_facebook_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('lms_education_study_facebook_icon') ); ?>"></i></a>
		                    <?php }?>
		                    <?php if(get_theme_mod('lms_education_study_twitter_url') != ''){ ?>
		                        <a href="<?php echo esc_url(get_theme_mod('lms_education_study_twitter_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('lms_education_study_twitter_icon') ); ?>"></i></a>
		                    <?php }?>
		                    <?php if(get_theme_mod('lms_education_study_intagram_url') != ''){ ?>
		                        <a href="<?php echo esc_url(get_theme_mod('lms_education_study_intagram_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('lms_education_study_intagram_icon') ); ?>"></i></a>
		                    <?php }?>
		                    <?php if(get_theme_mod('lms_education_study_linkedin_url') != ''){ ?>
		                        <a href="<?php echo esc_url(get_theme_mod('lms_education_study_linkedin_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('lms_education_study_linkedin_icon') ); ?>"></i></a>
		                    <?php }?>
		                    <?php if(get_theme_mod('lms_education_study_pintrest_url') != ''){ ?>
		                        <a href="<?php echo esc_url(get_theme_mod('lms_education_study_pintrest_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('lms_education_study_pintrest_icon') ); ?>"></i></a>
		                    <?php }?>
		                </div>
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>