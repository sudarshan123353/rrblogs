<?php
/**
 * Personal Coach Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Personal Coach Lite
 */

function personal_coach_lite_files_setup() {

    if ( ! defined( 'LMS_EDUCATION_STUDY_CONTACT_SUPPORT' ) ) {
        define('LMS_EDUCATION_STUDY_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/personal-coach-lite/','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_REVIEW' ) ) {
        define('LMS_EDUCATION_STUDY_REVIEW',__('https://wordpress.org/support/theme/personal-coach-lite/reviews/','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_LIVE_DEMO' ) ) {
        define('LMS_EDUCATION_STUDY_LIVE_DEMO',__('https://demo.themagnifico.net/personal-coach-lite/','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_GET_PREMIUM_PRO' ) ) {
        define('LMS_EDUCATION_STUDY_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/education-wordpress-theme-bundle','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_PRO_DOC' ) ) {
        define('LMS_EDUCATION_STUDY_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/personal-coach-lite-pro-doc/','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_FREE_DOC' ) ) {
        define('LMS_EDUCATION_STUDY_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/personal-coach-lite-free-doc/','personal-coach-lite'));
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_URL' ) ) {
        define( 'LMS_EDUCATION_STUDY_URL', esc_url( 'https://www.themagnifico.net/products/education-wordpress-theme-bundle', 'personal-coach-lite') );
    }
    if ( ! defined( 'LMS_EDUCATION_STUDY_TEXT' ) ) {
        define( 'LMS_EDUCATION_STUDY_TEXT', __( 'Personal Coach Pro','personal-coach-lite' ));
    }
}

add_action( 'after_setup_theme', 'personal_coach_lite_files_setup' );

function personal_coach_lite_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
    $personal_coach_lite_parentcss = 'lms-education-study-style';
    $personal_coach_lite_theme = wp_get_theme(); wp_enqueue_style( $personal_coach_lite_parentcss, get_template_directory_uri() . '/style.css', array(), $personal_coach_lite_theme->parent()->get('Version'));
    wp_enqueue_style( 'personal-coach-lite-style', get_stylesheet_uri(), array( $personal_coach_lite_parentcss ), $personal_coach_lite_theme->get('Version'));

    require get_theme_file_path( '/custom-option.php' );
    wp_add_inline_style( 'personal-coach-lite-style',$lms_education_study_theme_css );
    require get_parent_theme_file_path( '/custom-option.php' );
    wp_add_inline_style( 'lms-education-study-style',$lms_education_study_theme_css );

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true ); 

    wp_enqueue_script('personal-coach-lite-theme-custom-js', get_stylesheet_directory_uri() . '/assets/js/theme-custom-script.js', array('jquery'), '', true ); 
}

add_action( 'wp_enqueue_scripts', 'personal_coach_lite_enqueue_styles' );

function personal_coach_lite_customize_register($wp_customize){

    //Latest Recipes
    $wp_customize->add_section('personal_coach_lite_popular_articles',array(
        'title' => esc_html__('Courses Option','personal-coach-lite')
    ));

    $wp_customize->add_setting('personal_coach_lite_services_content',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('personal_coach_lite_services_content',array(
        'label' => esc_html__('Section Short Title','personal-coach-lite'),
        'section' => 'personal_coach_lite_popular_articles',
        'setting' => 'personal_coach_lite_services_content',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('personal_coach_lite_services_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('personal_coach_lite_services_heading',array(
        'label' => esc_html__('Section Heading','personal-coach-lite'),
        'section' => 'personal_coach_lite_popular_articles',
        'setting' => 'personal_coach_lite_services_heading',
        'type'  => 'text'
    ));

    $categories = get_categories();
    $cats = array();
    $i = 0;
    $cat_post[]= 'select';
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('personal_coach_lite_services_sec_category',array(
        'default' => 'select',
        'sanitize_callback' => 'lms_education_study_sanitize_choices',
    ));
    $wp_customize->add_control('personal_coach_lite_services_sec_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Latest Recipes','personal-coach-lite'),
        'section' => 'personal_coach_lite_popular_articles',
    ));

    for ($i=1; $i <=6 ; $i++) {
        $wp_customize->add_setting('personal_coach_lite_courses_rating_number'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('personal_coach_lite_courses_rating_number'.$i,array(
            'label' => esc_html__('Courses Rating Number ','personal-coach-lite').$i,
            'section' => 'personal_coach_lite_popular_articles',
            'setting' => 'personal_coach_lite_courses_rating_number'.$i,
            'type'  => 'text'
        ));

        $wp_customize->add_setting('personal_coach_lite_course_price'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('personal_coach_lite_course_price'.$i,array(
            'label' => esc_html__('Courses Price ','personal-coach-lite').$i,
            'section' => 'personal_coach_lite_popular_articles',
            'setting' => 'personal_coach_lite_course_price'.$i,
            'type'  => 'text'
        ));

        $wp_customize->add_setting('personal_coach_lite_course_time'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('personal_coach_lite_course_time'.$i,array(
            'label' => esc_html__('Courses Time','personal-coach-lite').$i,
            'section' => 'personal_coach_lite_popular_articles',
            'setting' => 'personal_coach_lite_course_time'.$i,
            'type'  => 'text'
        ));

        $wp_customize->add_setting('personal_coach_lite_course_no_of_student'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('personal_coach_lite_course_no_of_student'.$i,array(
            'label' => esc_html__('Courses Date ','personal-coach-lite').$i,
            'section' => 'personal_coach_lite_popular_articles',
            'setting' => 'personal_coach_lite_course_no_of_student'.$i,
            'type'  => 'text'
        ));
        
    }

}
add_action('customize_register', 'personal_coach_lite_customize_register');

if ( ! function_exists( 'personal_coach_lite_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function personal_coach_lite_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('personal-coach-lite-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'lms_education_study_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
        add_action('wp_ajax_personal_coach_lite_dismissable_notice', 'personal_coach_lite_dismissable_notice');
    }
endif;
add_action( 'after_setup_theme', 'personal_coach_lite_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function personal_coach_lite_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'personal-coach-lite' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'personal-coach-lite' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'personal_coach_lite_widgets_init' );

function personal_coach_lite_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_section( 'lms_education_study_color_option' );

    $wp_customize->remove_setting('lms_education_study_slider_short_heading');
    $wp_customize->remove_control('lms_education_study_slider_short_heading');
    
}

add_action( 'customize_register', 'personal_coach_lite_remove_customize_register', 11 );

// add_action( 'lms_education_study_navigation_action','lms_education_study_single_post_navigation',30 );
if( !function_exists('personal_coach_lite_content_offcanvas') ):

    // Offcanvas Contents
    function personal_coach_lite_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <i class="fas fa-times"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'personal-coach-lite'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('primary')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'primary',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new LMS_Education_Study_Menu_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'personal_coach_lite_before_footer_content_action','personal_coach_lite_content_offcanvas',30 );


function personal_coach_lite_remove_my_action() {
    remove_action( 'remove_menu_page','lms-education-study-info' );
    remove_action( 'admin_menu','demo_importer_admin_page' );
    remove_action( 'admin_notices','lms_education_study_deprecated_hook_admin_notice' );
}
add_action( 'init', 'personal_coach_lite_remove_my_action');

add_action('admin_menu', 'remove_my_theme_page', 999);
function remove_my_theme_page() {
    remove_submenu_page('themes.php','lms-education-study-info');
}

/**
 * Get CSS
 */

function personal_coach_lite_getpage_css($hook) {
    wp_register_script( 'admin-notice-script', get_stylesheet_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','personal_coach_lite',
        array('admin_ajax'  =>  admin_url('admin-ajax.php'),'wpnonce'  =>   wp_create_nonce('personal_coach_lite_dismissed_notice_nonce')
        )
    );
    wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'personal_coach_lite_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    if ( 'appearance_page_personal-coach-lite-info' != $hook ) {
        return;
    }
}
add_action( 'admin_enqueue_scripts', 'personal_coach_lite_getpage_css' );

//Admin Notice For Getstart
function personal_coach_lite_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function personal_coach_lite_deprecated_hook_admin_notice() {

     // Check if the notice has been dismissed by the user
    $dismissed = get_user_meta(get_current_user_id(), 'personal_coach_lite_dismissable_notice', true);

    // Exclude the notice from being shown on the "Theme Importer" page
    $current_screen = get_current_screen();
    if ($current_screen && $current_screen->id === 'appearance_page_theme-importer') {
        return; // Don't show the notice on this page
    }

    if (!$dismissed) {  
        ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
            <div class="tm-admin-image">
                <img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="tm-admin-content" style="padding-left: 30px; align-self: center">
                <h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'personal-coach-lite'); ?><?php echo wp_get_theme(); ?><h2>
                <p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'personal-coach-lite'); ?><p>
                <a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=theme-importer' )); ?>"><?php esc_html_e( 'Start Demo Import', 'personal-coach-lite' ) ?></a>
                <a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=personal-coach-lite-info.php' )); ?>"><?php esc_html_e( 'Get started', 'personal-coach-lite' ) ?></a>
                <a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( LMS_EDUCATION_STUDY_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'personal-coach-lite' ) ?></a>
                <span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
                <span class="dashicons dashicons-admin-links"></span>
                <a class="admin-notice-btn"  target="_blank" href="<?php echo esc_url( LMS_EDUCATION_STUDY_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'personal-coach-lite' ) ?></a>
                </span>
            </div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'personal_coach_lite_deprecated_hook_admin_notice' );

function personal_coach_lite_switch_theme() {
    delete_user_meta(get_current_user_id(), 'personal_coach_lite_dismissable_notice');
}
add_action('after_switch_theme', 'personal_coach_lite_switch_theme');
function personal_coach_lite_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'personal_coach_lite_dismissable_notice', true);
    die();
}

// Demo Content Code

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu page to trigger theme import
add_action('admin_menu', 'personal_coach_lite_demo_importer_admin_page');

function personal_coach_lite_demo_importer_admin_page() {
    add_theme_page(
        'Demo Theme Importer',     // Page title
        'Theme Importer',          // Menu title
        'manage_options',          // Capability
        'theme-importer',          // Menu slug
        'personal_coach_lite_demo_importer_page',      // Callback function
    );
}

// Display the page content with the button
function personal_coach_lite_demo_importer_page() {
    ?>
    <div class="wrap-main-box">
        <div class="main-box">
            <h2><?php echo esc_html('Welcome to Personal Coach Lite','personal-coach-lite'); ?></h2>
            <h3><?php echo esc_html('Create your website in just one click','personal-coach-lite'); ?></h3>
            <hr>
            <p><?php echo esc_html('The "Begin Installation" helps you quickly set up your website by importing sample content that mirrors the demo version of the theme. This tool provides you with a ready-made layout and structure, so you can easily see how your site will look and start customizing it right away. It\'s a straightforward way to get your site up and running with minimal effort.','personal-coach-lite'); ?></p>
            <p><?php echo esc_html('Click the button below to install the demo content.','personal-coach-lite'); ?></p>
            <hr>
            <button id="import-theme-mods" class="button button-primary"><?php echo esc_html('Begin Installation','personal-coach-lite'); ?></button>
            <div id="import-response"></div>
        </div>
    </div>
    <?php
}

// Add the AJAX action to trigger theme mods import
add_action('wp_ajax_import_theme_mods', 'personal_coach_lite_demo_importer_ajax_handler');

// Handle the AJAX request
function personal_coach_lite_demo_importer_ajax_handler() {
    // Sample data to import
    $theme_mods_data = array(
        'header_textcolor' => '000000',  // Example: change header text color
        'background_color' => 'ffffff',  // Example: change background color
        'custom_logo'      => 123,       // Example: set a custom logo by attachment ID
        'footer_text'      => 'Custom Footer Text', // Example: custom footer text
    );

    // Call the function to import theme mods
    if (demo_theme_importer($theme_mods_data)) {
        // After importing theme mods, create the menu
        personal_coach_lite_create_demo_menu();
        wp_send_json_success(array(
            'msg' => 'Theme mods imported successfully.',
            'redirect' => home_url()
        ));
    } else {
        wp_send_json_error('Failed to import theme mods.');
    }

    wp_die();
}

// Function to set theme mods
function personal_coach_lite_demo_theme_importer($import_data) {
    if (is_array($import_data)) {
        foreach ($import_data as $mod_name => $mod_value) {
            set_theme_mod($mod_name, $mod_value);
        }
        return true;
    } else {
        return false;
    }
}

// Function to create demo menu
function personal_coach_lite_create_demo_menu() {

    // Page import process
    $pages_to_create = array(
        array(
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'page-template/home-template.php',
        ),
        array(
            'title'    => 'Classes',
            'slug'     => 'classes',
            'template' => '',
        ),
         array(
            'title'    => 'About Us',
            'slug'     => 'about',
            'template' => '',
        ),
        array(
            'title'    => 'Page',
            'slug'     => 'page',
            'template' => '',
        ),
        array(
            'title'    => 'Blog',
            'slug'     => 'blog',
            'template' => '',
        ),
        array(
            'title'    => 'Contact Us',
            'slug'     => 'contact',
            'template' => '',
        ),

    );

    // Loop through each page data to create pages
    foreach ($pages_to_create as $page_data) {
        $page_check = get_page_by_title($page_data['title']);
        
        // Check if the page doesn't exist already
        if (!$page_check) {
            $page = array(
                'post_type'    => 'page',
                'post_title'   => $page_data['title'],
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => $page_data['slug'],
            );
            
            // Insert the page and get the inserted page ID
            $page_id = wp_insert_post($page);
            
            // Set the page template
            if ($page_id) {
                add_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }

    // Set 'Home' as the front page
    $home_page = get_page_by_title('Home');
    if ($home_page) {
        update_option('page_on_front', $home_page->ID);
        update_option('show_on_front', 'page');
    }

    // Set 'Blog' as the posts page
    $blog_page = get_page_by_title('Blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }
    // ------- Create Main Menu --------
    $menuname =  'Primary Menu';
    $bpmenulocation = 'primary';
    $menu_exists = wp_get_nav_menu_object($menuname);
    
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menuname);
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Home','personal-coach-lite'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Classes','personal-coach-lite'),
            'menu-item-classes' => 'classes',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('About Us','personal-coach-lite'),
            'menu-item-classes' => 'about',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Page','personal-coach-lite'),
            'menu-item-classes' => 'page',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Blog','personal-coach-lite'),
            'menu-item-classes' => 'Blog',
            'menu-item-url' => home_url( '/index.php/blog/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Contact Us','personal-coach-lite'),
            'menu-item-classes' => 'contact',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        // Assign the menu to the location
        if (!has_nav_menu($bpmenulocation)) {
            $locations = get_theme_mod('nav_menu_locations');
            $locations[$bpmenulocation] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
    
    //Header
    set_theme_mod( 'lms_education_study_email', 'info@example.com' );
    set_theme_mod( 'lms_education_study_topbar_timming', 'Mon - Sat: 8:00 am - 7:00 pm' );
    set_theme_mod( 'lms_education_study_header_button', 'Free Quote' );
    set_theme_mod( 'lms_education_study_header_button_url', '#' );

    set_theme_mod( 'lms_education_study_facebook_url', '#' );
    set_theme_mod( 'lms_education_study_facebook_icon', 'fab fa-facebook-f' );
    
    set_theme_mod( 'lms_education_study_twitter_url', '#' );
    set_theme_mod( 'lms_education_study_twitter_icon', 'fab fa-twitter' );

    set_theme_mod( 'lms_education_study_intagram_url', '#' );
    set_theme_mod( 'lms_education_study_intagram_icon', 'fab fa-instagram' );

    set_theme_mod( 'lms_education_study_linkedin_url', '#' );
    set_theme_mod( 'lms_education_study_linkedin_icon', 'fab fa-linkedin-in' );

    set_theme_mod( 'lms_education_study_pintrest_url', '#' );
    set_theme_mod( 'lms_education_study_pintrest_icon', 'fab fa-pinterest-p' );

    set_theme_mod( 'lms_education_study_top_header_text', 'We will start new batch from next month' );

    //Slider
    set_theme_mod( 'lms_education_study_slider_short_heading', '100% Satisfaction Guaranteed' );

    set_theme_mod( 'lms_education_study_acitve_student_number', '5500+' );
    set_theme_mod( 'lms_education_study_active_student_text', 'Online Classes' );

    set_theme_mod( 'lms_education_study_online_courses_number', '3500+' );
    set_theme_mod( 'lms_education_study_online_courses_text', 'Active Student' );

    set_theme_mod( 'lms_education_study_slider_team_image_1', get_stylesheet_directory_uri().'/assets/img/team-1.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_2', get_stylesheet_directory_uri().'/assets/img/team-2.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_3', get_stylesheet_directory_uri().'/assets/img/team-3.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_4', get_stylesheet_directory_uri().'/assets/img/team-4.png' );
    set_theme_mod( 'lms_education_study_right_image_box_3_text', '21M+ Happy Clients' );

    for($i=1;$i<=3;$i++){
         $title = 'The Worlds Best Online Education Institute';
         $content = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';
            // Create post object
         $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'page',
         );

         // Insert the post into the database
         $post_id = wp_insert_post( $my_post );

         if ($post_id) {
            // Set the theme mod for the slider page
            set_theme_mod('lms_education_study_top_slider_page' . $i, $post_id);

            $image_url = get_stylesheet_directory_uri().'/assets/img/slider.png';

            $image_id = media_sideload_image($image_url, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
        }
    }

    //About Us
    set_theme_mod( 'lms_education_study_about_us_image', get_stylesheet_directory_uri().'/assets/img/about-1.png' );
    set_theme_mod( 'lms_education_study_about_us_small_image', get_stylesheet_directory_uri().'/assets/img/about-2.png' );
    set_theme_mod( 'lms_education_study_about_us_title', 'About Our Company' );
    set_theme_mod( 'lms_education_study_about_us_heading', 'Take advantage of the world\'s best e-learning system' );
    set_theme_mod( 'lms_education_study_about_us_content_1', 'Choose from over 210,000 online video courses with new additions Published' );
    set_theme_mod( 'lms_education_study_about_us_content_2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );

    set_theme_mod( 'lms_education_study_about_us__service_image_1', get_stylesheet_directory_uri().'/assets/img/aboutsmall-1.png' );
    set_theme_mod( 'lms_education_study_about_us_service_heading_1', 'Track your daily activity.' );
    set_theme_mod( 'lms_education_study_about_us_service_content_1', 'with unlimited courses' );

    set_theme_mod( 'lms_education_study_about_us__service_image_2', get_stylesheet_directory_uri().'/assets/img/aboutsmall-2.png' );
    set_theme_mod( 'lms_education_study_about_us_service_heading_2', 'Virtual support team' );
    set_theme_mod( 'lms_education_study_about_us_service_content_2', 'value all over the world' );

    set_theme_mod( 'lms_education_study_about_us_box_number', '+240' );
    set_theme_mod( 'lms_education_study_about_us_box_title', 'Awesome Awards' );


    set_theme_mod( 'lms_education_study_about_us_button_text', 'Find Out More' );
    set_theme_mod( 'lms_education_study_about_us_button_url', '#' );


    //Event
    set_theme_mod( 'personal_coach_lite_services_content', '100% Free' );
    set_theme_mod( 'personal_coach_lite_services_heading', 'Our Best Events' );



    set_theme_mod( 'personal_coach_lite_services_sec_category', 'event' );
    
    $post_heading = array('Cycling Marathon for Your Healthy Lifestyle.','USBF Baltimore Natural Pro-Am Health Coaching Contest','Vancouver Healthy Culinary Show Pro-Am Health Coaching');
    for($i=1;$i<=3;$i++){


         $title = $post_heading[$i-1];
         $content = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';
            // Create post object
         $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'post',
         );

         // Insert the post into the database
         $post_id = wp_insert_post( $my_post );

         wp_set_object_terms( $post_id, 'Event', 'category' );

         if ($post_id) {

            $image_url_course = get_stylesheet_directory_uri().'/assets/img/course'.$i.'.png';

            $image_id = media_sideload_image($image_url_course, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
        }
    }
    for ($i=1; $i <=6 ; $i++) { 
        set_theme_mod( 'personal_coach_lite_courses_rating_number'.$i, '4.5' );
        set_theme_mod( 'personal_coach_lite_course_price'.$i, '$36' );
        set_theme_mod( 'personal_coach_lite_course_time'.$i, '04 PM' );
        set_theme_mod( 'personal_coach_lite_course_no_of_student'.$i, '30/11/24' );
    }

}
// Enqueue necessary scripts
add_action('admin_enqueue_scripts', 'personal_coach_lite_demo_importer_enqueue_scripts');

function personal_coach_lite_demo_importer_enqueue_scripts() {
    wp_enqueue_script(
        'demo-theme-importer',
        get_template_directory_uri() . '/assets/js/theme-importer.js', // Path to your JS file
        array('jquery'),
        null,
        true
    );

    wp_enqueue_style('demo-importer-style', get_template_directory_uri() . '/assets/css/importer.css', array(), '');

    // Localize script to pass AJAX URL to JS
    wp_localize_script(
        'demo-theme-importer',
        'demoImporter',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('theme_importer_nonce')
        )
    );
}