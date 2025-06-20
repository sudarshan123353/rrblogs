<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Personal Coach Lite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open();} else { do_action( 'wp_body_open' ); } ?>

<?php if(get_theme_mod('lms_education_study_preloader_hide','')){ ?>
    <?php if(get_theme_mod('lms_education_study_preloader_type','Preloader 1') == 'Preloader 1'){ ?>
        <div class="loading">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    <?php } elseif(get_theme_mod('lms_education_study_preloader_type','Preloader 2') == 'Preloader 2') {?>
        <div class="loading2">
            <div class="load">
                <hr/><hr/><hr/><hr/>
            </div>
        </div>
    <?php }?>
<?php } ?>
<div id="page" class="site">
    <div class="<?php if(get_theme_mod('lms_education_study_site_width_layout','Full Width') == 'Wide Width'){?>container-fluid<?php } elseif(get_theme_mod('lms_education_study_site_width_layout','Full Width') == 'Container Width') {?>container<?php }?>">
        <a class="skip-link screen-reader-text" href="#skip-content"><?php esc_html_e('Skip to content', 'personal-coach-lite'); ?></a>
        <header id="masthead" class="site-header navbar-dark mt-3">
            <div class="socialmedia">
                <?php get_template_part('template-parts/topheader/topheader' ); ?>
                <?php get_template_part('template-parts/topheader/mainheader'); ?>
            </div>
        </header>