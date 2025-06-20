<?php

    $lms_education_study_theme_css= "";

    /*------------------ Nav Menus -------------------*/

    $lms_education_study_nav_menu = get_theme_mod( 'lms_education_study_nav_menu_text_transform','Capitalize');
    if($lms_education_study_nav_menu == 'Capitalize'){
        $lms_education_study_theme_css .='.site-navigation .primary-menu > li > a, .site-navigation .primary-menu .link-icon-wrapper a{';
            $lms_education_study_theme_css .='text-transform:Capitalize;';
        $lms_education_study_theme_css .='}';
    }
    if($lms_education_study_nav_menu == 'Lowercase'){
        $lms_education_study_theme_css .='.site-navigation .primary-menu > li > a, .site-navigation .primary-menu .link-icon-wrapper a{';
            $lms_education_study_theme_css .='text-transform:Lowercase;';
        $lms_education_study_theme_css .='}';
    }
    if($lms_education_study_nav_menu == 'Uppercase'){
        $lms_education_study_theme_css .='.site-navigation .primary-menu > li > a, .site-navigation .primary-menu .link-icon-wrapper a{';
            $lms_education_study_theme_css .='text-transform:Uppercase;';
        $lms_education_study_theme_css .='}';
    }

    $lms_education_study_menu_font_size = get_theme_mod( 'lms_education_study_menu_font_size');
    if($lms_education_study_menu_font_size != ''){
        $lms_education_study_theme_css .='.site-navigation .primary-menu > li > a, .site-navigation .primary-menu .link-icon-wrapper a{';
            $lms_education_study_theme_css .='font-size: '.esc_attr($lms_education_study_menu_font_size).'px;';
        $lms_education_study_theme_css .='}';
    }

    $lms_education_study_nav_menu_font_weight = get_theme_mod( 'lms_education_study_nav_menu_font_weight',500);
    if($lms_education_study_nav_menu_font_weight != ''){
        $lms_education_study_theme_css .='.site-navigation .primary-menu > li > a, .site-navigation .primary-menu .link-icon-wrapper a{';
            $lms_education_study_theme_css .='font-weight: '.esc_attr($lms_education_study_nav_menu_font_weight).';';
        $lms_education_study_theme_css .='}';
    }

    /*------------------ Slider CSS -------------------*/

    $lms_education_study_slider_content_layout = get_theme_mod( 'lms_education_study_slider_content_layout','Left');
    if($lms_education_study_slider_content_layout == 'Left'){
        $lms_education_study_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $lms_education_study_theme_css .='text-align : left;';
        $lms_education_study_theme_css .='}';
        $lms_education_study_theme_css .='.btn-team {';
            $lms_education_study_theme_css .='justify-content : start;';
        $lms_education_study_theme_css .='}';
    }
    if($lms_education_study_slider_content_layout == 'Center'){
        $lms_education_study_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $lms_education_study_theme_css .='text-align : center;';
        $lms_education_study_theme_css .='}';
        $lms_education_study_theme_css .='.btn-team {';
            $lms_education_study_theme_css .='justify-content : center;';
        $lms_education_study_theme_css .='}';
        $lms_education_study_theme_css .='#top-slider .slider-inner-box p {';
            $lms_education_study_theme_css .='margin: 0 auto;';
        $lms_education_study_theme_css .='}';
    }
    if($lms_education_study_slider_content_layout == 'Right'){
        $lms_education_study_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $lms_education_study_theme_css .='text-align : right;';
        $lms_education_study_theme_css .='}';
        $lms_education_study_theme_css .='.btn-team {';
            $lms_education_study_theme_css .='justify-content : end;';
        $lms_education_study_theme_css .='}';
        $lms_education_study_theme_css .='#top-slider .slider-inner-box p {';
            $lms_education_study_theme_css .='margin: 0 0 0 auto;';
        $lms_education_study_theme_css .='}';
    }

    /*---------- Preloader CSS -------*/
    $lms_education_study_preloader2_dot_color = get_theme_mod('lms_education_study_preloader2_dot_color');
    $lms_education_study_theme_css .='.load hr {';
        $lms_education_study_theme_css .='background-color: '.esc_attr($lms_education_study_preloader2_dot_color).';';
    $lms_education_study_theme_css .='}';

    /*------------------ Footer CSS -------------------*/
    $lms_education_study_footer_bg_color = get_theme_mod( 'lms_education_study_footer_bg_color');
    if($lms_education_study_footer_bg_color != '' ){
        $lms_education_study_theme_css .='#colophon {';
            $lms_education_study_theme_css .='background-color: '.esc_attr($lms_education_study_footer_bg_color).'; ';
        $lms_education_study_theme_css .='}';
    }

    $lms_education_study_footer_content_color = get_theme_mod( 'lms_education_study_footer_content_color');
    if($lms_education_study_footer_content_color != ''){
        $lms_education_study_theme_css .='#colophon, #colophon a, #colophon h5, #colophon .widget #wp-calendar caption {';
            $lms_education_study_theme_css .='color: '.esc_attr($lms_education_study_footer_content_color).';';
        $lms_education_study_theme_css .='}';
    }

    /*------------------ Copyright CSS -------------------*/
    $lms_education_study_copyright_text_color = get_theme_mod( 'lms_education_study_copyright_text_color');
    if($lms_education_study_copyright_text_color != ''){
        $lms_education_study_theme_css .='#colophon .site-info a, #colophon .site-info span {';
            $lms_education_study_theme_css .='color: '.esc_attr($lms_education_study_copyright_text_color).';';
        $lms_education_study_theme_css .='}';
    }