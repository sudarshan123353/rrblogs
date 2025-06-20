<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<?php if (get_theme_mod('lms_education_study_slider_section_setting', true) != '') { ?>
  <section id="top-slider">
    <div class="main-slider">
      <div class="container">
        <?php $lms_education_study_slide_pages = array();
          for ( $lms_education_study_count = 1; $lms_education_study_count <= 3; $lms_education_study_count++ ) {
            $lms_education_study_mod = intval( get_theme_mod( 'lms_education_study_top_slider_page' . $lms_education_study_count ));
            if ( 'page-none-selected' != $lms_education_study_mod ) {
              $lms_education_study_slide_pages[] = $lms_education_study_mod;
            }
          }
          if( !empty($lms_education_study_slide_pages) ) :
            $lms_education_study_args = array(
              'post_type' => 'page',
              'post__in' => $lms_education_study_slide_pages,
              'orderby' => 'post__in'
            );
            $lms_education_study_query = new WP_Query( $lms_education_study_args );
            if ( $lms_education_study_query->have_posts() ) :
              $i = 1;
          ?>
        <div class="owl-carousel" role="listbox">
          <?php  while ( $lms_education_study_query->have_posts() ) : $lms_education_study_query->the_post(); ?>
            <div class="slide-box row m-0 pt-5">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 align-self-center">
                <div class="slider-inner-box">
                  <?php if(get_theme_mod('lms_education_study_slider_short_heading') != ''){ ?>
                    <h5 class="slider-short mb-3"><i class="fas fa-star me-3"></i><?php echo esc_html(get_theme_mod('lms_education_study_slider_short_heading')); ?></h5>
                  <?php }?>
                  <h3 class="m-0"><?php the_title(); ?></h3>
                  <p class="content mt-3 pb-3"><?php echo esc_html( wp_trim_words( get_the_content(), esc_attr(get_theme_mod('lms_education_study_slider_excerpt_length', 15)) )); ?></p>
                  <div class="slide-btn mt-4">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('Show & More','lms-education-study'); ?></a>
                  </div>
                </div>
              </div>
              <div class="slider-image col-lg-6 col-md-6 col-sm-12 col-12 align-self-center">
                <?php if (has_post_thumbnail()) { ?><img class="sider-img" src="<?php the_post_thumbnail_url('full'); ?>" /><?php } else { ?><img class="sider-img" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" /> <?php } ?>
              <?php if(get_theme_mod('lms_education_study_acitve_student_number') != '' ){ ?>
              <div class="image-box-1">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-3 align-self-center image-box-1-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-9 align-self-center image-box-1-heading">
                    <h6 class="mb-0 contact-text"><?php echo esc_html(get_theme_mod('lms_education_study_acitve_student_number','')); ?></h6>
                    <p class="mb-0"><?php echo esc_html(get_theme_mod('lms_education_study_active_student_text','')); ?></p>
                  </div>
                </div>
                </div>
              <?php }?>
              <?php if(get_theme_mod('lms_education_study_online_courses_number') != '' ){ ?>
                <div class="image-box-2">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 align-self-center image-box-2-icon">
                      <i class="fas fa-book-open"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-9 align-self-center image-box-2-heading">
                     <h6 class="mb-0 contact-text"><?php echo esc_html(get_theme_mod('lms_education_study_online_courses_number','')); ?></h6>
                      <p class="mb-0"><?php echo esc_html(get_theme_mod('lms_education_study_online_courses_text','')); ?></p>
                    </div>
                  </div>
                </div>
              <?php }?>
              <?php if(get_theme_mod('lms_education_study_right_image_box_3_text') != '' ){ ?>
                <div class="image-box-3">
                  <div class="image-box-3-heading">
                    <div class="image-team">
                      <?php if (get_theme_mod( 'lms_education_study_slider_team_image_1' )) { ?>
                        <img class="team-img-small-1" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_slider_team_image_1' )); ?>">
                      <?php } ?>
                      <?php if (get_theme_mod( 'lms_education_study_slider_team_image_2' )) { ?>
                        <img class="team-img-small-2" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_slider_team_image_2' )); ?>">
                      <?php } ?>
                      <?php if (get_theme_mod( 'lms_education_study_slider_team_image_3' )) { ?>
                        <img class="team-img-small-3" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_slider_team_image_3' )); ?>">
                      <?php } ?>
                      <?php if (get_theme_mod( 'lms_education_study_slider_team_image_4' )) { ?>
                        <img class="team-img-small-4" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_slider_team_image_4' )); ?>">
                      <?php } ?>
                    </div>
                    <p class="mb-0"><?php echo esc_html(get_theme_mod('lms_education_study_right_image_box_3_text','')); ?></p>
                  </div>
                </div>
              <?php }?>
              </div>
            </div>
          <?php $i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
      </div>
    </div>
  </section>
<?php } ?>

<?php if (get_theme_mod('lms_education_study_activities_section_setting', true) != '') { ?>
  <section id="skip-content" class="featured py-5">
    <div class="container">
      <div class="row m-0">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12 align-self-center about-image">
          <?php if (get_theme_mod( 'lms_education_study_about_us_image' )) { ?>
            <img class="about-img" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_about_us_image' )); ?>">
          <?php } else { ?>
            <img class="about-img" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" />
          <?php } ?>
          <?php if (get_theme_mod( 'lms_education_study_about_us_small_image' )) { ?>
            <img class="about-img-small" src="<?php echo esc_url( get_theme_mod( 'lms_education_study_about_us_small_image' )); ?>">
          <?php } else { ?>
            <img class="about-img-small" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" />
          <?php } ?>
          <?php if(get_theme_mod('lms_education_study_about_us_box_number') != '' || get_theme_mod('lms_education_study_about_us_box_title') != ''){ ?>
            <div class="box-heading">
              <div class="box-icon">
                <i class="fas fa-trophy"></i>
              </div>
              <?php if(get_theme_mod('lms_education_study_about_us_box_number') != ''){ ?>
                <h5 class="box-title mb-2"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_box_number')); ?></h5>
              <?php }?>
              <?php if(get_theme_mod('lms_education_study_about_us_box_title') != ''){ ?>
                <h6 class="box-short m-0"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_box_title')); ?></h6>
              <?php }?>
            </div>
          <?php } ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 align-self-center content-box">
          <div class="heading text-lg-start mb-4">
            <?php if(get_theme_mod('lms_education_study_about_us_title') != ''){ ?>
              <h5 class="main-title mb-3"><i class="fas fa-star me-3"></i><?php echo esc_html(get_theme_mod('lms_education_study_about_us_title')); ?></h5>
            <?php }?>
            <?php if(get_theme_mod('lms_education_study_about_us_heading') != ''){ ?>
              <h3 class="main-heading mb-3"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_heading')); ?></h3>
            <?php }?>
            <?php if(get_theme_mod('lms_education_study_about_us_content_1') != ''){ ?>
              <p class="content"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_content_1')); ?></p>
            <?php }?>
            <div class="row my-4">
              <?php if(get_theme_mod('lms_education_study_about_us_service_heading_1') != '' || get_theme_mod('lms_education_study_about_us_service_content_1') != ''){ ?>
                <div class="col-lg-6 col-md-12 col-sm-6 col-12 align-self-center service-box">
                  <div class="service-image-main">
                    <div class="service-image">
                      <img src="<?php echo esc_url( get_theme_mod( 'lms_education_study_about_us__service_image_1' )); ?>">
                    </div>
                  </div>
                  <div class="service-content">
                    <?php if(get_theme_mod('lms_education_study_about_us_service_heading_1') != ''){ ?>
                      <h5 class="service-title"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_service_heading_1')); ?></h5>
                    <?php }?>
                    <?php if(get_theme_mod('lms_education_study_about_us_service_content_1') != ''){ ?>
                      <p class="service-heading m-0"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_service_content_1')); ?></p>
                    <?php }?>
                  </div>
                </div>
              <?php }?>
              <?php if(get_theme_mod('lms_education_study_about_us_service_heading_2') != '' || get_theme_mod('lms_education_study_about_us_service_content_2') != ''){ ?>
                <div class="col-lg-6 col-md-12 col-sm-6 col-12 align-self-center service-box">
                  <div class="service-image-main">
                    <div class="service-image">
                      <img src="<?php echo esc_url( get_theme_mod( 'lms_education_study_about_us__service_image_2' )); ?>">
                    </div>
                  </div>
                  <div class="service-content">
                    <?php if(get_theme_mod('lms_education_study_about_us_service_heading_2') != ''){ ?>
                      <h5 class="service-title"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_service_heading_2')); ?></h5>
                    <?php }?>
                    <?php if(get_theme_mod('lms_education_study_about_us_service_content_2') != ''){ ?>
                      <p class="service-heading m-0"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_service_content_2')); ?></p>
                    <?php }?>
                  </div>
                </div>
              <?php }?>
            </div>
            <?php if(get_theme_mod('lms_education_study_about_us_content_2') != ''){ ?>
              <p class="about-content-2"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_content_2')); ?></p>
            <?php }?>
            <?php if(get_theme_mod('lms_education_study_about_us_button_url') != '' || get_theme_mod('lms_education_study_about_us_button_text') != ''){ ?>
              <div class="about-btn mt-4">
                <a href="<?php echo esc_url(get_theme_mod('lms_education_study_about_us_button_url')); ?>"><?php echo esc_html(get_theme_mod('lms_education_study_about_us_button_text')); ?></a>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php }?>
  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>