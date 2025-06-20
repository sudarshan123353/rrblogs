<?php

    $lms_education_study_theme_css= "";

    /*--------------------------- Scroll to top positions -------------------*/

    $lms_education_study_scroll_position = get_theme_mod( 'lms_education_study_scroll_top_position','Right');
    if($lms_education_study_scroll_position == 'Right'){
        $lms_education_study_theme_css .='#button{';
            $lms_education_study_theme_css .='right: 20px;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_scroll_position == 'Left'){
        $lms_education_study_theme_css .='#button{';
            $lms_education_study_theme_css .='left: 20px;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_scroll_position == 'Center'){
        $lms_education_study_theme_css .='#button{';
            $lms_education_study_theme_css .='right: 50%;left: 50%;';
        $lms_education_study_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $lms_education_study_footer_widget_content_alignment = get_theme_mod( 'lms_education_study_footer_widget_content_alignment','Left');
    if($lms_education_study_footer_widget_content_alignment == 'Left'){
        $lms_education_study_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $lms_education_study_theme_css .='text-align: left;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_footer_widget_content_alignment == 'Center'){
        $lms_education_study_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $lms_education_study_theme_css .='text-align: center;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_footer_widget_content_alignment == 'Right'){
        $lms_education_study_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $lms_education_study_theme_css .='text-align: right;';
        $lms_education_study_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $lms_education_study_copyright_content_alignment = get_theme_mod( 'lms_education_study_copyright_content_alignment','Center');
    if($lms_education_study_copyright_content_alignment == 'Left'){
        $lms_education_study_theme_css .='.footer-menu-left{';
        $lms_education_study_theme_css .='text-align: left !important;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_copyright_content_alignment == 'Center'){
        $lms_education_study_theme_css .='.footer-menu-left{';
            $lms_education_study_theme_css .='text-align: center !important;';
        $lms_education_study_theme_css .='}';
    }else if($lms_education_study_copyright_content_alignment == 'Right'){
        $lms_education_study_theme_css .='.footer-menu-left{';
            $lms_education_study_theme_css .='text-align: right !important;';
        $lms_education_study_theme_css .='}';
    } 

    /*---------------- Logo CSS ----------------------*/
    $lms_education_study_logo_title_font_size = get_theme_mod( 'lms_education_study_logo_title_font_size');
    $lms_education_study_logo_tagline_font_size = get_theme_mod( 'lms_education_study_logo_tagline_font_size');
    if( $lms_education_study_logo_title_font_size != '') {
        $lms_education_study_theme_css .='#masthead .navbar-brand a{';
            $lms_education_study_theme_css .='font-size: '. $lms_education_study_logo_title_font_size. 'px;';
        $lms_education_study_theme_css .='}';
    }
    if( $lms_education_study_logo_tagline_font_size != '') {
        $lms_education_study_theme_css .='#masthead .navbar-brand p{';
            $lms_education_study_theme_css .='font-size: '. $lms_education_study_logo_tagline_font_size. 'px;';
        $lms_education_study_theme_css .='}';
    }

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
    if($lms_education_study_menu_font_size != ''){
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
    }
    if($lms_education_study_slider_content_layout == 'Center'){
        $lms_education_study_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $lms_education_study_theme_css .='text-align : center;';
        $lms_education_study_theme_css .='}';
    }
    if($lms_education_study_slider_content_layout == 'Right'){
        $lms_education_study_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $lms_education_study_theme_css .='text-align : right;';
        $lms_education_study_theme_css .='}';
    }

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