<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LMS Education Study
 */

get_header(); ?>

    <div id="skip-content" class="container">
        <div class="row">
            <?php if (get_theme_mod('lms_education_study_blog_sidebar_position','Right Side') == 'Left Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
            <div id="primary" class="content-area col-lg-9 col-lg-8">
                <main id="main" class="site-main module-border-wrap">
                    <?php if (have_posts()) { ?>

                        <header class="page-header">
                            <?php
                            the_archive_title('<h2 class="page-title">', '</h2>');
                            the_archive_description('<div class="archive-description">', '</div>');
                            ?>
                        </header>

                        <div class="row">
                            <?php /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                                
                                get_template_part( 'template-parts/content',get_post_format());

                            endwhile; ?>
                        </div>
                            
                        <?php if( get_theme_mod('lms_education_study_post_page_pagination',1) == 1){ 
                            lms_education_study_blog_posts_pagination(); 
                        }

                    }else {

                        get_template_part('template-parts/content', 'none');

                    } ?>
                    
                </main>
            </div>
            <?php if (get_theme_mod('lms_education_study_blog_sidebar_position','Right Side') == 'Right Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
        </div>
    </div>

<?php get_footer();