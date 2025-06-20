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
                  <p class="content mt-3 pb-3"><?php echo esc_html( wp_trim_words( get_the_content(),esc_attr(get_theme_mod('lms_education_study_slider_excerpt_length', 30)) )); ?></p>
                  <div class="btn-team">
                    <div class="slide-btn mt-4">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('Show & More','personal-coach-lite'); ?></a>
                    </div>
                    <?php if(get_theme_mod('lms_education_study_right_image_box_3_text') != '' ){ ?>
                      <div class="image-box-3 mt-4">
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
              </div>
              <div class="slider-image col-lg-6 col-md-6 col-sm-12 col-12 align-self-center">
                <?php if (has_post_thumbnail()) { ?><img class="sider-img" src="<?php the_post_thumbnail_url('full'); ?>" /><?php } else { ?><img class="sider-img default-img" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/img/slider.png" alt="" /> <?php } ?>
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
          <div class="heading text-lg-left mb-4">
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
<section id="event-sec" class="featured py-5">
  <div class="container">
    <div class="ser-heading text-center mb-4">
      <?php if(get_theme_mod('personal_coach_lite_services_content') != ''){ ?>
        <h4 class="main-heading mt-3"><i class="fas fa-star me-2"></i><?php echo esc_html(get_theme_mod('personal_coach_lite_services_content')); ?></h4>
      <?php }?>
      <?php if(get_theme_mod('personal_coach_lite_services_heading') != ''){ ?>
        <h3 class="main-heading "><?php echo esc_html(get_theme_mod('personal_coach_lite_services_heading')); ?></h3>
      <?php }?>
    </div>
     <div class="owl-carousel">
      <?php
        $personal_coach_lite_services_cat = get_theme_mod('personal_coach_lite_services_sec_category','');
        if($personal_coach_lite_services_cat){
          $personal_coach_lite_page_query5 = new WP_Query(array( 'category_name' => esc_html($personal_coach_lite_services_cat,'personal-coach-lite'),'posts_per_page' => 6));
          $i=1;
          while( $personal_coach_lite_page_query5->have_posts() ) : $personal_coach_lite_page_query5->the_post(); ?>
            <?php if(get_theme_mod('personal_coach_lite_services_icon'.$i,'fas fa-stethoscope')){ ?>
              <div class="main-de">
                <div class="feature-box mb-4 m-0">
                  <div class="feature-img">
                    <?php if (has_post_thumbnail()) { ?><img src="<?php the_post_thumbnail_url('full'); ?>" /><?php } else { ?><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/img/course1.png" alt="" /> <?php } ?>
                  </div>
                  <div class="ser-content mt-2">
                    <?php 
                      $category = get_the_category(); 
                      if ( ! empty( $category ) ) {
                        echo '<span class="category-div">' . esc_html( $category[0]->name ) . '</span>'; 
                      }
                    ?>
                    <h4 class="mt-2 mb-3 text-left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <div class="rating-box row">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9 align-self-center">
                          <?php 
                            // Dynamically retrieve the rating value based on $i
                            $personal_coach_lite_rating_value = get_theme_mod('personal_coach_lite_courses_rating_number' . $i);

                            // Ensure there's a valid rating value, else default to 0
                            if ($personal_coach_lite_rating_value === false) {
                              $personal_coach_lite_rating_value = 0; // Default value if no theme mod is found
                            }

                            // Proceed only if there's a valid rating value (greater than 0)
                            if($personal_coach_lite_rating_value){ ?>
                              <span class="star-rating">
                                <?php 
                                  // Display the stars based on the retrieved rating value
                                  for ($j = 1; $j <= 5; $j++) {
                                    if ($j <= floor($personal_coach_lite_rating_value)) {
                                      echo '<span class="star" title="' . $j . ' star">&#9733;</span>'; 
                                    } else {
                                      echo '<span class="star" title="' . $j . ' star">&#9734;</span>';
                                    }
                                  } ?>
                                
                                <span class="course-rating"> 
                                  <?php echo esc_html($personal_coach_lite_rating_value); ?>
                                </span>
                              </span>
                          <?php } ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 course-price align-self-center">
                          <?php if(get_theme_mod('personal_coach_lite_course_price'.$i) != ''){ ?>
                            <h6 class="price m-0"><?php echo esc_html(get_theme_mod('personal_coach_lite_course_price'.$i)); ?></h6>
                          <?php }?>
                        </div>
                      </div>
                    <div class="row time-box mt-3">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <?php if(get_theme_mod('personal_coach_lite_course_time'.$i) != ''){ ?>
                          <p class="couse-time m-0"><i class="fas fa-clock"></i><?php echo esc_html(get_theme_mod('personal_coach_lite_course_time'.$i)); ?></p>
                        <?php }?>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <?php if(get_theme_mod('personal_coach_lite_course_no_of_student'.$i) != ''){ ?>
                         <p class="couse-student m-0"><i class="fas fa-calendar-alt"></i><?php echo esc_html(get_theme_mod('personal_coach_lite_course_no_of_student'.$i)); ?></p>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }?>
          <?php $i++; endwhile;
        wp_reset_postdata();
      } ?>
    </div>
  </div>
</section>
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