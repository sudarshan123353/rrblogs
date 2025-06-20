<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LMS Education Study
 */
do_action('lms_education_study_before_footer_content_action');
?>


		<footer id="colophon" class="site-footer border-top">
		    <div class="container">
		    	<div class="footer-column">
		    		<div class="row">
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				          	<?php if (is_active_sidebar('lms-education-study-footer1')) : ?>
		                        <?php dynamic_sidebar('lms-education-study-footer1'); ?>
		                    <?php else : ?>
		                        <aside id="search" class="widget" role="complementary" aria-label="firstsidebar">
		                            <h5 class="widget-title"><?php esc_html_e( 'About Us', 'lms-education-study' ); ?></h5>
		                            <div class="textwidget">
		                            	<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', 'lms-education-study' ); ?></p>
		                            </div>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('lms-education-study-footer2')) : ?>
		                        <?php dynamic_sidebar('lms-education-study-footer2'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Useful Links', 'lms-education-study' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'Home', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'Courses', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'Reviews', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'About Us', 'lms-education-study' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('lms-education-study-footer3')) : ?>
		                        <?php dynamic_sidebar('lms-education-study-footer3'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Information', 'lms-education-study' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'FAQ', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'Site Maps', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'Privacy Policy', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'Contact Us', 'lms-education-study' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('lms-education-study-footer4')) : ?>
		                        <?php dynamic_sidebar('lms-education-study-footer4'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Get In Touch', 'lms-education-study' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'Via Carlo Montù 78', 'lms-education-study' ); ?><br><?php esc_html_e( '22021 Bellagio CO, Italy', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( '+11 6254 7855', 'lms-education-study' ); ?></li>
		                            	<li><?php esc_html_e( 'support@example.com', 'lms-education-study' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
			      	</div>
				</div>
		    	<?php if (get_theme_mod('lms_education_study_show_hide_copyright', true)) {?>
				        <div class="site-info text-center">
				            <div class="footer-menu-left">
				            	<?php  if( ! get_theme_mod('lms_education_study_footer_text_setting') ){ ?>
								    <a target="_blank" href="<?php echo esc_url('https://wordpress.org/', 'lms-education-study' ); ?>">
										<?php
										/* translators: %s: CMS name, i.e. WordPress. */
										printf( esc_html__( 'Proudly powered by %s', 'lms-education-study' ), 'WordPress' );
										?>
								    </a>
								    <span class="sep mr-1"> | </span>

								    <span>
								    	<a target="_blank" href="<?php echo esc_url( 'https://www.themagnifico.net/products/free-lms-wordpress-theme'); ?>">
							              	<?php
							                /* translators: 1: Theme name,  */
							                printf( esc_html__( ' %1$s ', 'lms-education-study' ),'Education WordPress Theme' );
							              	?>
						              	</a>
							          	<?php
							              /* translators: 1: Theme author. */
							              printf( esc_html__( 'by %1$s.', 'lms-education-study' ),'TheMagnifico'  );
							            ?>
				        			</span>
								<?php }?>
								<?php echo esc_html(get_theme_mod('lms_education_study_footer_text_setting')); ?>
				            </div>
				        </div>
				<?php } ?>
			    <?php if(get_theme_mod('lms_education_study_scroll_hide','')){ ?>
			    	<a id="button"><?php esc_html_e('TOP','lms-education-study'); ?></a>
			    <?php } ?>
		    </div>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>