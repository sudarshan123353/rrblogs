<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LMS Education Study
 */

get_header(); ?>

    <div id="skip-content" class="container">
        <div class="row">
            <?php if (get_theme_mod('lms_education_study_single_post_sidebar_position','Right Side') == 'Left Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
            <div id="primary" class="content-area col-lg-9 col-md-8">
                <main id="main" class="site-main module-border-wrap mb-4">
                    <?php while (have_posts()) : the_post();
                        get_template_part('template-parts/content', 'single'); ?>

                        <?php if (!is_singular('attachment')):
                            the_post_navigation();
                            endif;
                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif; ?>
                        <?php endwhile; // End of the loop.
                    ?>
                </main>
            </div>
            <?php if (get_theme_mod('lms_education_study_single_post_sidebar_position','Right Side') == 'Right Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
        </div>
    </div>

<?php get_footer();