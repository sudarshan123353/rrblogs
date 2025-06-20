<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Personal Coach Lite
 */

do_action('personal_coach_lite_before_footer_content_action');
?>

		<footer id="colophon" class="site-footer border-top">
			<div class="footer-widgets">
			    <div class="container">
			    	<div class="footer-column">
			    		<div class="row">
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				          	<?php if (is_active_sidebar('lms-education-study-footer1')) : ?>
		                  <?php dynamic_sidebar('lms-education-study-footer1'); ?>
		                <?php else : ?>
		                  <aside id="search" class="widget" role="complementary" aria-label="<?php esc_attr_e( 'firstsidebar', 'personal-coach-lite' ); ?>">
		                    <h5 class="widget-title"><?php esc_html_e( 'About Us', 'personal-coach-lite' ); ?></h5>
		                    <div class="textwidget">
		                    	<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', 'personal-coach-lite' ); ?></p>
		                    </div>
		                  </aside>
		                <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('lms-education-study-footer2')) : ?>
		                    <?php dynamic_sidebar('lms-education-study-footer2'); ?>
		                  <?php else : ?>
		                    <aside id="pages" class="widget">
		                      <h5 class="widget-title"><?php esc_html_e( 'Useful Links', 'personal-coach-lite' ); ?></h5>
		                      <ul class="mt-4">
		                      	<li><?php esc_html_e( 'Home', 'personal-coach-lite' ); ?></li>
		                      	<li><?php esc_html_e( 'Courses', 'personal-coach-lite' ); ?></li>
		                      	<li><?php esc_html_e( 'Reviews', 'personal-coach-lite' ); ?></li>
		                      	<li><?php esc_html_e( 'About Us', 'personal-coach-lite' ); ?></li>
		                      </ul>
		                    </aside>
		                  <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('lms-education-study-footer3')) : ?>
			                        <?php dynamic_sidebar('lms-education-study-footer3'); ?>
			                    <?php else : ?>
			                        <aside id="pages" class="widget">
			                            <h5 class="widget-title"><?php esc_html_e( 'Information', 'personal-coach-lite' ); ?></h5>
			                            <ul class="mt-4">
			                            	<li><?php esc_html_e( 'FAQ', 'personal-coach-lite' ); ?></li>
			                            	<li><?php esc_html_e( 'Site Maps', 'personal-coach-lite' ); ?></li>
			                            	<li><?php esc_html_e( 'Privacy Policy', 'personal-coach-lite' ); ?></li>
			                            	<li><?php esc_html_e( 'Contact Us', 'personal-coach-lite' ); ?></li>
			                            </ul>
			                        </aside>
			                    <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('lms-education-study-footer4')) : ?>
			                        <?php dynamic_sidebar('lms-education-study-footer4'); ?>
			                    <?php else : ?>
			                        <aside id="pages" class="widget">
			                            <h5 class="widget-title"><?php esc_html_e( 'Get In Touch', 'personal-coach-lite' ); ?></h5>
			                            <ul class="mt-4">
			                            	<li class="mb-2"><i class="fas fa-map-marker me-2"></i><?php esc_html_e( 'Via Carlo Montù 78', 'personal-coach-lite' ); ?><br><?php esc_html_e( '22021 Bellagio CO, Italy', 'personal-coach-lite' ); ?></li>
			                            	<li class="mb-2"><i class="fas fa-phone-volume me-2"></i><?php esc_html_e( '+11 6254 7855', 'personal-coach-lite' ); ?></li>
			                            	<li class="mb-2"><i class="fas fa-envelope me-2"></i><?php esc_html_e( 'support@example.com', 'personal-coach-lite' ); ?></li>
			                            </ul>
			                        </aside>
			                    <?php endif; ?>
					        </div>
				      	</div>
					</div>
			    </div>
			</div>
			<?php if (get_theme_mod('lms_education_study_show_hide_copyright', true)) {?>
				<div class="footer_info">
					<div class="container">
				        <div class="site-info">
				            <div class="footer-menu-left">
				            	<?php if(! get_theme_mod('lms_education_study_footer_text_setting') ){ ?>
								    <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>">
										<?php
										/* translators: %s: CMS name, i.e. WordPress. */
										printf( esc_html__( 'Proudly powered by %s', 'personal-coach-lite' ), 'WordPress' );
										?>
								    </a>
								    <span class="sep me-1"> | </span>
								     <span>
								     	<a href="https://www.themagnifico.net/products/free-coach-wordpress-theme">
								           	<?php
								            	/* translators: 1: Educational WordPress Theme,  */
								            	printf( esc_html__( ' %1$s', 'personal-coach-lite' ),'Educational WordPress Theme' );
								            ?>
							            </a>
								        <?php
								        	/* translators: 1: TheMagnifico. */
								        	printf( esc_html__( 'By %1$s.', 'personal-coach-lite' ),'TheMagnifico'  );
								        ?>
							        </span>
								<?php }?>
								<?php echo esc_html(get_theme_mod('lms_education_study_footer_text_setting','')); ?>
				            </div>
				        </div>
					</div>
				</div>
			<?php } ?>
		    <?php if(get_theme_mod('lms_education_study_scroll_hide','')){ ?>
		      <a id="button"><?php esc_html_e('TOP','personal-coach-lite'); ?></a>
		    <?php } ?>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>