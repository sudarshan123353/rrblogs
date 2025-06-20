<?php
/**
 * LMS Education Study Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package LMS Education Study
 */

if ( ! defined( 'LMS_EDUCATION_STUDY_URL' ) ) {
    define( 'LMS_EDUCATION_STUDY_URL', esc_url( 'https://www.themagnifico.net/products/education-wordpress-theme-bundle', 'lms-education-study') );
}
if ( ! defined( 'LMS_EDUCATION_STUDY_TEXT' ) ) {
    define( 'LMS_EDUCATION_STUDY_TEXT', __( 'LMS Education Study Pro','lms-education-study' ));
}
if ( ! defined( 'LMS_EDUCATION_STUDY_BUY_TEXT' ) ) {
    define( 'LMS_EDUCATION_STUDY_BUY_TEXT', __( 'Buy LMS Education Study Pro','lms-education-study' ));
}

use WPTRT\Customize\Section\LMS_Education_Study_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( LMS_Education_Study_Button::class );

    $manager->add_section(
        new LMS_Education_Study_Button( $manager, 'lms_education_study_pro', [
            'title'       => esc_html( LMS_EDUCATION_STUDY_TEXT,'lms-education-study' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'lms-education-study' ),
            'button_url'  => esc_url( LMS_EDUCATION_STUDY_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'lms-education-study-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'lms-education-study-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lms_education_study_customize_register($wp_customize){

    // Pro Version
    class LMS_Education_Study_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( LMS_EDUCATION_STUDY_BUY_TEXT,'lms-education-study' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function LMS_Education_Study_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('lms_education_study_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'lms-education-study' ),
        'section'        => 'title_tagline',
        'settings'       => 'lms_education_study_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_logo_title_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'lms_education_study_sanitize_number_absint'
    ));
    $wp_customize->add_control('lms_education_study_logo_title_font_size',array(
        'label' => esc_html__('Title Font Size','lms-education-study'),
        'section' => 'title_tagline',
        'type'    => 'number'
    ));

    $wp_customize->add_setting('lms_education_study_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'lms-education-study' ),
        'section'        => 'title_tagline',
        'settings'       => 'lms_education_study_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_logo_tagline_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'lms_education_study_sanitize_number_absint'
    ));
    $wp_customize->add_control('lms_education_study_logo_tagline_font_size',array(
        'label' => esc_html__('Tagline Font Size','lms-education-study'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    //Logo
    $wp_customize->add_setting('lms_education_study_logo_max_height',array(
        'default'   => '80',
        'sanitize_callback' => 'lms_education_study_sanitize_number_absint'
    ));
    $wp_customize->add_control('lms_education_study_logo_max_height',array(
        'label' => esc_html__('Logo Width','lms-education-study'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    // General Settings
     $wp_customize->add_section('lms_education_study_general_settings',array(
        'title' => esc_html__('General Settings','lms-education-study'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('lms_education_study_site_width_layout',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_site_width_layout',array(
        'label'       => esc_html__( 'Site Width Layout','lms-education-study' ),
        'type' => 'radio',
        'section' => 'lms_education_study_general_settings',
        'choices' => array(
            'Full Width' => __('Full Width','lms-education-study'),
            'Wide Width' => __('Wide Width','lms-education-study'),
            'Container Width' => __('Container Width','lms-education-study')
        ),
    ) );

    $wp_customize->add_setting('lms_education_study_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'lms-education-study' ),
        'section'        => 'lms_education_study_general_settings',
        'settings'       => 'lms_education_study_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_preloader_type',array(
        'default' => 'Preloader 1',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_preloader_type',array(
        'type' => 'radio',
        'label' => esc_html__('Preloader Type','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'choices' => array(
            'Preloader 1' => __('Preloader 1','lms-education-study'),
            'Preloader 2' => __('Preloader 2','lms-education-study'),
        ),
    ) );

    $wp_customize->add_setting( 'lms_education_study_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'lms_education_study_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_preloader_dot_1_color',
        'active_callback' => 'lms_education_study_preloader1'
    )));

    $wp_customize->add_setting( 'lms_education_study_preloader_dot_2_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_preloader_dot_2_color',
        'active_callback' => 'lms_education_study_preloader1'
    )));

    $wp_customize->add_setting( 'lms_education_study_preloader2_dot_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_preloader2_dot_color', array(
        'label' => esc_html__('Preloader Dot Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_preloader2_dot_color',
        'active_callback' => 'lms_education_study_preloader2'
    )));

    $wp_customize->add_setting('lms_education_study_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'lms-education-study' ),
        'section'        => 'lms_education_study_general_settings',
        'settings'       => 'lms_education_study_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_scroll_top_position',array(
        'type' => 'radio',
        'label' => 'Scroll To Top Position',
        'section' => 'lms_education_study_general_settings',
        'choices' => array(
            'Right' => __('Right','lms-education-study'),
            'Left' => __('Left','lms-education-study'),
            'Center' => __('Center','lms-education-study')
        ),
    ) );

    $wp_customize->add_setting( 'lms_education_study_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'lms_education_study_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'settings' => 'lms_education_study_scroll_color'
    )));

    $wp_customize->add_setting('lms_education_study_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','lms-education-study'),
        'description' => __('Put in px','lms-education-study'),
        'section'   => 'lms_education_study_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('lms_education_study_scroll_border_radius',array(
        'default'   => '0',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_scroll_border_radius',array(
        'label' => __('Scroll Top Border Radius','lms-education-study'),
        'description' => __('Put in %','lms-education-study'),
        'section'   => 'lms_education_study_general_settings',
        'type'      => 'number'
    ));

    // Product Columns
    $wp_customize->add_setting( 'lms_education_study_products_per_row' , array(
       'default'           => '3',
       'transport'         => 'refresh',
       'sanitize_callback' => 'lms_education_study_sanitize_select',
    ) );

    $wp_customize->add_control('lms_education_study_products_per_row', array(
       'label' => __( 'Product per row', 'lms-education-study' ),
       'section'  => 'lms_education_study_general_settings',
       'type'     => 'select',
       'choices'  => array(
           '2' => '2',
           '3' => '3',
           '4' => '4',
       ),
    ) );

    $wp_customize->add_setting('lms_education_study_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_product_per_page',array(
        'label' => __('Product per page','lms-education-study'),
        'section'   => 'lms_education_study_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('lms_education_study_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'lms-education-study' ),
        'section'        => 'lms_education_study_general_settings',
        'settings'       => 'lms_education_study_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','lms-education-study'),
            'Right Sidebar' => __('Right Sidebar','lms-education-study'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('lms_education_study_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'lms-education-study' ),
        'section'        => 'lms_education_study_general_settings',
        'settings'       => 'lms_education_study_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','lms-education-study'),
        'section' => 'lms_education_study_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','lms-education-study'),
            'Right Sidebar' => __('Right Sidebar','lms-education-study'),
        ),
    ) );

    // Social Link
    $wp_customize->add_section('lms_education_study_social_link',array(
        'title' => esc_html__('Social Links','lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_facebook_icon',array(
        'label' => esc_html__('Facebook Icon','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('lms_education_study_facebook_url',array(
        'label' => esc_html__('Facebook Link','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_facebook_url',
        'type'  => 'url'
    ));


    $wp_customize->add_setting('lms_education_study_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_twitter_icon',array(
        'label' => esc_html__('Twitter Icon','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('lms_education_study_twitter_url',array(
        'label' => esc_html__('Twitter Link','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('lms_education_study_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_intagram_icon',array(
        'label' => esc_html__('Intagram Icon','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('lms_education_study_intagram_url',array(
        'label' => esc_html__('Intagram Link','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('lms_education_study_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_linkedin_icon',array(
        'label' => esc_html__('Linkedin Icon','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('lms_education_study_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('lms_education_study_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_pintrest_icon',array(
        'label' => esc_html__('Pinterest Icon','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('lms_education_study_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','lms-education-study'),
        'section' => 'lms_education_study_social_link',
        'setting' => 'lms_education_study_pintrest_url',
        'type'  => 'url'
    ));

    //Top Header
    $wp_customize->add_section('lms_education_study_top_header',array(
        'title' => esc_html__('Top Header Option','lms-education-study')
    ));

    $wp_customize->add_setting('lms_education_study_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    $wp_customize->add_control('lms_education_study_email',array(
        'label' => esc_html__('Email Address','lms-education-study'),
        'section' => 'lms_education_study_top_header',
        'setting' => 'lms_education_study_email',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_topbar_timming',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_topbar_timming',array(
        'label' => esc_html__('Timing','lms-education-study'),
        'section' => 'lms_education_study_top_header',
        'setting' => 'lms_education_study_topbar_timming',
        'type'  => 'text'
    ));
    
    $wp_customize->add_setting('lms_education_study_header_search_setting', array(
        'default' => false,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_header_search_setting',array(
        'label'          => __( 'Show Search Icon', 'lms-education-study' ),
        'section'        => 'lms_education_study_top_header',
        'settings'       => 'lms_education_study_header_search_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_header_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_header_button',array(
        'label' => esc_html__('Header Button Text','lms-education-study'),
        'section' => 'lms_education_study_top_header',
        'setting' => 'lms_education_study_header_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_header_button_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_header_button_url',array(
        'label' => esc_html__('Header Button Url','lms-education-study'),
        'section' => 'lms_education_study_top_header',
        'setting' => 'lms_education_study_header_button_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('lms_education_study_top_header_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_top_header_text',array(
        'label' => esc_html__('Top Header Text','lms-education-study'),
        'section' => 'lms_education_study_top_header',
        'setting' => 'lms_education_study_top_header_text',
        'type'  => 'text'
    ));

    //Menu Settings
    $wp_customize->add_section('lms_education_study_menu_settings',array(
        'title' => esc_html__('Menus Settings','lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_menu_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_menu_font_size',array(
        'label' => esc_html__('Menu Font Size','lms-education-study'),
        'section' => 'lms_education_study_menu_settings',
        'type'  => 'number'
    ));

    $wp_customize->add_setting('lms_education_study_nav_menu_text_transform',array(
        'default'=> 'Capitalize',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_nav_menu_text_transform',array(
        'type' => 'radio',
        'label' => esc_html__('Menu Text Transform','lms-education-study'),
        'choices' => array(
            'Uppercase' => __('Uppercase','lms-education-study'),
            'Capitalize' => __('Capitalize','lms-education-study'),
            'Lowercase' => __('Lowercase','lms-education-study'),
        ),
        'section'=> 'lms_education_study_menu_settings',
    ));

    $wp_customize->add_setting('lms_education_study_nav_menu_font_weight',array(
        'default'=> '500',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_nav_menu_font_weight',array(
        'type' => 'number',
        'label' => esc_html__('Menu Font Weight','lms-education-study'),
        'input_attrs' => array(
            'step'             => 100,
            'min'              => 100,
            'max'              => 1000,
        ),
        'section'=> 'lms_education_study_menu_settings',
    ));

    // Theme Color
    $wp_customize->add_section('lms_education_study_color_option',array(
        'title' => esc_html__('Theme Color','lms-education-study'),
        'priority'   => 10
    ));

    $wp_customize->add_setting( 'lms_education_study_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_theme_color', array(
        'label' => esc_html__('First Color Option','lms-education-study'),
        'section' => 'lms_education_study_color_option',
        'settings' => 'lms_education_study_theme_color'
    )));

    $wp_customize->add_setting( 'lms_education_study_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_theme_color_2', array(
        'label' => esc_html__('Second Color Option','lms-education-study'),
        'section' => 'lms_education_study_color_option',
        'settings' => 'lms_education_study_theme_color_2'
    )));
 
    //Slider
    $wp_customize->add_section('lms_education_study_top_slider',array(
        'title' => esc_html__('Slider Settings','lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_slider_section_setting', array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_slider_section_setting',array(
        'label'          => __( 'Show Slider', 'lms-education-study' ),
        'section'        => 'lms_education_study_top_slider',
        'settings'       => 'lms_education_study_slider_section_setting',
        'type'           => 'checkbox',
    )));

    for ( $lms_education_study_count = 1; $lms_education_study_count <= 3; $lms_education_study_count++ ) {

        $wp_customize->add_setting( 'lms_education_study_top_slider_page' . $lms_education_study_count, array(
            'default'           => '',
            'sanitize_callback' => 'lms_education_study_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'lms_education_study_top_slider_page' . $lms_education_study_count, array(
            'label'    => __( 'Select Slide Page', 'lms-education-study' ),
            'description' => __('Slider image size (1400 x 550)','lms-education-study'),
            'section'  => 'lms_education_study_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    $wp_customize->add_setting('lms_education_study_slider_short_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_slider_short_heading',array(
        'label' => esc_html__('Slider Short  Heading','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_slider_short_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_acitve_student_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_acitve_student_number',array(
        'label' => esc_html__('Slider Active Student Number','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_acitve_student_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_active_student_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_active_student_text',array(
        'label' => esc_html__('Slider Active Student Text','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_active_student_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_online_courses_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_online_courses_number',array(
        'label' => esc_html__('Slider Online Courses Number','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_online_courses_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_online_courses_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_online_courses_text',array(
        'label' => esc_html__('Slider Online Courses Text','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_online_courses_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_slider_team_image_1' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_slider_team_image_1' ,array(
            'label' => __('Team image 1','lms-education-study'),
            'section' => 'lms_education_study_top_slider',
            'settings' => 'lms_education_study_slider_team_image_1' 
    )));

    $wp_customize->add_setting('lms_education_study_slider_team_image_2' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_slider_team_image_2' ,array(
            'label' => __('Team image 2','lms-education-study'),
            'section' => 'lms_education_study_top_slider',
            'settings' => 'lms_education_study_slider_team_image_2' 
    )));

    $wp_customize->add_setting('lms_education_study_slider_team_image_3' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_slider_team_image_3' ,array(
            'label' => __('Team image 3','lms-education-study'),
            'section' => 'lms_education_study_top_slider',
            'settings' => 'lms_education_study_slider_team_image_3' 
    )));

    $wp_customize->add_setting('lms_education_study_slider_team_image_4' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_slider_team_image_4' ,array(
            'label' => __('Team image 4','lms-education-study'),
            'section' => 'lms_education_study_top_slider',
            'settings' => 'lms_education_study_slider_team_image_4' 
    )));

    $wp_customize->add_setting('lms_education_study_right_image_box_3_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_right_image_box_3_text',array(
        'label' => esc_html__('Team Text','lms-education-study'),
        'section' => 'lms_education_study_top_slider',
        'setting' => 'lms_education_study_right_image_box_3_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_slider_content_layout',array(
        'default'=> 'Left',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_slider_content_layout',array(
        'type' => 'radio',
        'label' => esc_html__('Slider Content Layout','lms-education-study'),
        'choices' => array(
            'Left' => __('Left','lms-education-study'),
            'Center' => __('Center','lms-education-study'),
            'Right' => __('Right','lms-education-study'),
        ),
        'section'=> 'lms_education_study_top_slider',
    ));

    $wp_customize->add_setting('lms_education_study_slider_excerpt_length',array(
        'sanitize_callback' => 'lms_education_study_sanitize_number_range',
        'default'  => 15,
    ));
    $wp_customize->add_control('lms_education_study_slider_excerpt_length',array(
        'label'       => esc_html__('Slider Excerpt Length', 'lms-education-study'),
        'section'     => 'lms_education_study_top_slider',
        'type'        => 'range',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 50,
        ),
    ));

   // About Us
    $wp_customize->add_section('lms_education_study_services_section',array(
        'title' => esc_html__('About Us Option','lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_activities_section_setting', array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'lms_education_study_activities_section_setting',array(
        'label'          => __( 'Show About Us', 'lms-education-study' ),
        'section'        => 'lms_education_study_services_section',
        'settings'       => 'lms_education_study_activities_section_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('lms_education_study_about_us_image' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_about_us_image' ,array(
            'label' => __('About Us Image','lms-education-study'),
            'section' => 'lms_education_study_services_section',
            'settings' => 'lms_education_study_about_us_image' 
    )));

    $wp_customize->add_setting('lms_education_study_about_us_small_image' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_about_us_small_image' ,array(
            'label' => __('About Us Circle Image','lms-education-study'),
            'section' => 'lms_education_study_services_section',
            'settings' => 'lms_education_study_about_us_small_image' 
    )));

    $wp_customize->add_setting('lms_education_study_about_us_box_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_box_number',array(
        'label' => esc_html__('About Us Box Number','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_box_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_box_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_box_title',array(
        'label' => esc_html__('About Us Box Heading','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_box_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_title',array(
        'label' => esc_html__('Short Heading','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_heading',array(
        'label' => esc_html__('Heading','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_content_1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_content_1',array(
        'label' => esc_html__('Content','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_content_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us__service_image_1' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_about_us__service_image_1' ,array(
            'label' => __('Service Image 1','lms-education-study'),
            'section' => 'lms_education_study_services_section',
            'settings' => 'lms_education_study_about_us__service_image_1' 
    )));

    $wp_customize->add_setting('lms_education_study_about_us_service_heading_1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_service_heading_1',array(
        'label' => esc_html__('Service Heading 1','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_service_heading_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_service_content_1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_service_content_1',array(
        'label' => esc_html__('Service Content 1','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_service_content_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us__service_image_2' ,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize,'lms_education_study_about_us__service_image_2' ,array(
            'label' => __('Service Image 2','lms-education-study'),
            'section' => 'lms_education_study_services_section',
            'settings' => 'lms_education_study_about_us__service_image_2' 
    )));

    $wp_customize->add_setting('lms_education_study_about_us_service_heading_2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_service_heading_2',array(
        'label' => esc_html__('Service Heading 2','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_service_heading_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_service_content_2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_service_content_2',array(
        'label' => esc_html__('Service Content 2','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_service_content_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_content_2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_content_2',array(
        'label' => esc_html__('Content 2','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_content_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_button_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_button_text',array(
        'label' => esc_html__('Button Text','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_button_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('lms_education_study_about_us_button_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('lms_education_study_about_us_button_url',array(
        'label' => esc_html__('Button Url','lms-education-study'),
        'section' => 'lms_education_study_services_section',
        'setting' => 'lms_education_study_about_us_button_url',
        'type'  => 'text'
    ));

    // Post Settings
     $wp_customize->add_section('lms_education_study_post_settings',array(
        'title' => esc_html__('Post Settings','lms-education-study'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('lms_education_study_post_page_title',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_post_page_meta',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_post_page_thumb',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'lms-education-study'),
    ));

     $wp_customize->add_setting('lms_education_study_post_page_content',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_post_page_excerpt_length',array(
        'sanitize_callback' => 'lms_education_study_sanitize_number_range',
        'default'           => 30,
    ));
    $wp_customize->add_control('lms_education_study_post_page_excerpt_length',array(
        'label'       => esc_html__('Post Page Excerpt Length', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ));

    $wp_customize->add_setting('lms_education_study_post_page_excerpt_suffix',array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '[...]',
    ));
    $wp_customize->add_control('lms_education_study_post_page_excerpt_suffix',array(
        'type'        => 'text',
        'label'       => esc_html__('Post Page Excerpt Suffix', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('For Ex. [...], etc', 'lms-education-study'),
    ));

    $wp_customize->add_setting( 'lms_education_study_blog_post_columns', array(
        'default'  => 'Two',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control( 'lms_education_study_blog_post_columns', array(
        'section' => 'lms_education_study_post_settings',
        'type' => 'select',
        'label' => __( 'No. of Posts per row', 'lms-education-study' ),
        'choices' => array(
            'One'  => __( 'One', 'lms-education-study' ),
            'Two' => __( 'Two', 'lms-education-study' ),
            'Three' => __( 'Three', 'lms-education-study' ),
        )
    ));

    $wp_customize->add_setting('lms_education_study_post_page_pagination',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_post_page_pagination',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Pagination', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable pagination on post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting( 'lms_education_study_blog_pagination_type', array(
        'default'           => 'blog-nav-numbers',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control( 'lms_education_study_blog_pagination_type', array(
        'section' => 'lms_education_study_post_settings',
        'type' => 'select',
        'label' => __( 'Post Pagination Type', 'lms-education-study' ),
        'choices' => array(
            'blog-nav-numbers'  => __( 'Numeric', 'lms-education-study' ),
            'next-prev' => __( 'Older/Newer Posts', 'lms-education-study' ),
        )
    ));

    $wp_customize->add_setting( 'lms_education_study_blog_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control( 'lms_education_study_blog_sidebar_position', array(
        'section' => 'lms_education_study_post_settings',
        'type' => 'select',
        'label' => __( 'Post Page Sidebar Position', 'lms-education-study' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'lms-education-study' ),
            'Left Side' => __( 'Left Side', 'lms-education-study' ),
        )
    ));

    $wp_customize->add_setting('lms_education_study_single_post_page_content',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'lms-education-study'),
        'section'     => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_single_post_page_tag',array(
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('lms_education_study_single_post_page_tag',array(
        'type'  => 'checkbox',
        'label' => esc_html__('Enable Single Post Page Tag', 'lms-education-study'),
        'section' => 'lms_education_study_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'lms-education-study'),
    ));

    $wp_customize->add_setting( 'lms_education_study_single_post_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control( 'lms_education_study_single_post_sidebar_position', array(
        'section' => 'lms_education_study_post_settings',
        'type' => 'select',
        'label' => __( 'Single Post Sidebar Position', 'lms-education-study' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'lms-education-study' ),
            'Left Side' => __( 'Left Side', 'lms-education-study' ),
        )
    ));

    // Page Settings
    $wp_customize->add_section('lms_education_study_page_settings',array(
        'title' => esc_html__('Page Settings','lms-education-study'),
        'priority' => 40,
    ));

    $wp_customize->add_setting( 'lms_education_study_single_page_sidebar_layout', array(
        'default'           => 'No Sidebar',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control( 'lms_education_study_single_page_sidebar_layout', array(
        'section' => 'lms_education_study_page_settings',
        'type' => 'select',
        'label' => __( 'Single Page Sidebar Position', 'lms-education-study' ),
        'choices' => array(
            'No Sidebar' => __( 'No Sidebar', 'lms-education-study' ),
            'Right Side' => __( 'Right Side', 'lms-education-study' ),
            'Left Side' => __( 'Left Side', 'lms-education-study' ),
        )
    ));

    // Footer
    $wp_customize->add_section('lms_education_study_site_footer_section', array(
        'title' => esc_html__('Footer', 'lms-education-study'),
    ));

    $wp_customize->add_setting('lms_education_study_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'choices' => array(
            'Left' => __('Left','lms-education-study'),
            'Center' => __('Center','lms-education-study'),
            'Right' => __('Right','lms-education-study')
        ),
    ) );

    $wp_customize->add_setting( 'lms_education_study_footer_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_footer_bg_color', array(
        'label' => __('Footer Background Color', 'lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'settings' => 'lms_education_study_footer_bg_color',
    )));

    $wp_customize->add_setting( 'lms_education_study_footer_content_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_footer_content_color', array(
        'label' => __('Footer Content Color', 'lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'settings' => 'lms_education_study_footer_content_color',
    )));

    $wp_customize->add_setting('lms_education_study_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'lms_education_study_sanitize_checkbox'
    ));
    $wp_customize->add_control('lms_education_study_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
    ));

    $wp_customize->add_setting('lms_education_study_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('lms_education_study_footer_text_setting', array(
        'label' => __('Replace the footer text', 'lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('lms_education_study_copyright_content_alignment',array(
        'default' => 'Center',
        'transport' => 'refresh',
        'sanitize_callback' => 'lms_education_study_sanitize_choices'
    ));
    $wp_customize->add_control('lms_education_study_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'choices' => array(
            'Left' => __('Left','lms-education-study'),
            'Center' => __('Center','lms-education-study'),
            'Right' => __('Right','lms-education-study')
        ),
    ) );

    $wp_customize->add_setting( 'lms_education_study_copyright_text_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lms_education_study_copyright_text_color', array(
        'label' => __('Copyright Text Color', 'lms-education-study'),
        'section' => 'lms_education_study_site_footer_section',
        'settings' => 'lms_education_study_copyright_text_color',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'LMS_Education_Study_sanitize_custom_control'
    ));
    $wp_customize->add_control( new LMS_Education_Study_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'lms_education_study_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'lms-education-study' ),
        'description' => esc_url( LMS_EDUCATION_STUDY_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'lms_education_study_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lms_education_study_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lms_education_study_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lms_education_study_customize_preview_js(){
    wp_enqueue_script('lms-education-study-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'lms_education_study_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function lms_education_study_panels_js() {
    wp_enqueue_style( 'lms-education-study-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'lms-education-study-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'lms_education_study_panels_js' );