<?php
/**
 * LMS Education Study functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LMS Education Study
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/LMS_Education_Study_Loader.php' );

$LMS_Education_Study_Loader = new \WPTRT\Autoload\LMS_Education_Study_Loader();

$LMS_Education_Study_Loader->lms_education_study_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$LMS_Education_Study_Loader->lms_education_study_register();

if ( ! function_exists( 'lms_education_study_setup' ) ) :

	function lms_education_study_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		load_theme_textdomain( 'lms-education-study', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('lms-education-study-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','lms-education-study' ),
	        'footer'=> esc_html__( 'Footer Menu','lms-education-study' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'lms_education_study_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_lms_education_study_dismissable_notice', 'lms_education_study_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'lms_education_study_setup' );


function lms_education_study_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lms_education_study_content_width', 1170 );
}
add_action( 'after_setup_theme', 'lms_education_study_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lms_education_study_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lms-education-study' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'lms-education-study' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'lms-education-study' ),
		'id'            => 'lms-education-study-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'lms-education-study' ),
		'id'            => 'lms-education-study-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'lms-education-study' ),
		'id'            => 'lms-education-study-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'lms-education-study' ),
		'id'            => 'lms-education-study-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'lms_education_study_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lms_education_study_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'inter',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'just-another-hand',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Just+Another+Hand&display=swap" rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'lms-education-study-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'lms-education-study-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'lms-education-study-style',$lms_education_study_theme_css );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('lms-education-study-theme-custom-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lms_education_study_scripts' );

/**
 * Enqueue Preloader.
 */
function lms_education_study_preloader() {

  $lms_education_study_theme_color_css = '';
  $lms_education_study_preloader_bg_color = get_theme_mod('lms_education_study_preloader_bg_color');
  $lms_education_study_preloader_dot_1_color = get_theme_mod('lms_education_study_preloader_dot_1_color');
  $lms_education_study_preloader_dot_2_color = get_theme_mod('lms_education_study_preloader_dot_2_color');
  $lms_education_study_preloader2_dot_color = get_theme_mod('lms_education_study_preloader2_dot_color');
  $lms_education_study_logo_max_height = get_theme_mod('lms_education_study_logo_max_height');
  $lms_education_study_theme_color = get_theme_mod('lms_education_study_theme_color');
  $lms_education_study_theme_color_2 = get_theme_mod('lms_education_study_theme_color_2');
  $lms_education_study_scroll_bg_color = get_theme_mod('lms_education_study_scroll_bg_color');
  $lms_education_study_scroll_color = get_theme_mod('lms_education_study_scroll_color');
  $lms_education_study_scroll_font_size = get_theme_mod('lms_education_study_scroll_font_size');
  $lms_education_study_scroll_border_radius = get_theme_mod('lms_education_study_scroll_border_radius');

  	if(get_theme_mod('lms_education_study_logo_max_height') == '') {
		$lms_education_study_logo_max_height = '80';
	}

	if(get_theme_mod('lms_education_study_preloader_dot_1_color') == '') {
		$lms_education_study_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('lms_education_study_preloader_dot_2_color') == '') {
		$lms_education_study_preloader_dot_2_color = '#000000';
	}

	$lms_education_study_theme_color_css = '

		.service-image,.contact-box,.bottom-header-box,.site-navigation .primary-menu ul{
			background: '.esc_attr($lms_education_study_theme_color).';
		}
		{
			background: linear-gradient(60deg, '.esc_attr($lms_education_study_theme_color).' 68%, '.esc_attr($lms_education_study_theme_color_2).' 54%);
		}
		@media screen and (max-width:1000px){
	        {
	        background: '.esc_attr($lms_education_study_theme_color).';
	 		}
		}
		.image-box-2-icon i,h5.main-title,.navbar-brand a,h5.slider-short,#top-slider span.last_slide_head,.image-box-2 h6.contact-text{
			color: '.esc_attr($lms_education_study_theme_color).';
		}
		{
			color: '.esc_attr($lms_education_study_theme_color).' !important;
		}
		{
			border-color: '.esc_attr($lms_education_study_theme_color).';
		}
		button.button-offcanvas-close,span.navbar-control-trigger i,.featured .about-btn a,.image-box-3,.image-box-1,.image-box-2,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.pro-button a, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.wp-block-button__link,.sidebar .tagcloud a:hover,.sidebar h5,.comment-respond input#submit,a.btn-text,.search-form-main input.search-submit,.sidebar input[type="submit"], .sidebar button[type="submit"],#colophon,span.head-btn a,#top-slider .slide-btn a,.box-icon,.site-navigation ul.primary-menu.theme-menu li a:hover, .main-navigation .menu > li > a:focus{
			background: '.esc_attr($lms_education_study_theme_color_2).';
		}
		.woocommerce-message::before, .woocommerce-info::before,p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.sidebar ul li a:hover,a,.article-box a,h5.box-title{
			color: '.esc_attr($lms_education_study_theme_color_2).';
		}
		.wp-block-button.is-style-outline .wp-block-button__link{
			color: '.esc_attr($lms_education_study_theme_color_2).' !important;
		}
		.woocommerce-message, .woocommerce-info,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.wp-block-button.is-style-outline .wp-block-button__link{
			border-color: '.esc_attr($lms_education_study_theme_color_2).';
		}


		.custom-logo-link img{
			max-height: '.esc_attr($lms_education_study_logo_max_height).'px;
	 	}
		.loading, .loading2{
			background-color: '.esc_attr($lms_education_study_preloader_bg_color).';
		}
		@keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($lms_education_study_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($lms_education_study_preloader_dot_2_color).';
		  }
		}
		.load hr {
			background-color: '.esc_attr($lms_education_study_preloader2_dot_color).';
		}
		a#button{
			background-color: '.esc_attr($lms_education_study_scroll_bg_color).';
			color: '.esc_attr($lms_education_study_scroll_color).' !important;
			font-size: '.esc_attr($lms_education_study_scroll_font_size).'px;
			border-radius: '.esc_attr($lms_education_study_scroll_border_radius).'%;
		}
	';
    wp_add_inline_style( 'lms-education-study-style',$lms_education_study_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'lms_education_study_preloader' );

function lms_education_study_files_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/custom-header.php';

	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */
	require get_template_directory() . '/inc/template-functions.php';

	/**
	 * Menu
	 */

	require get_template_directory() . '/inc/class-navigation-menu.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	/* TGM. */
	require get_parent_theme_file_path( '/inc/tgm.php' );

	if ( ! defined( 'LMS_EDUCATION_STUDY_CONTACT_SUPPORT' ) ) {
		define('LMS_EDUCATION_STUDY_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/lms-education-study/','lms-education-study'));
	}
	if ( ! defined( 'LMS_EDUCATION_STUDY_REVIEW' ) ) {
		define('LMS_EDUCATION_STUDY_REVIEW',__('https://wordpress.org/support/theme/lms-education-study/reviews/','lms-education-study'));
	}
	if ( ! defined( 'LMS_EDUCATION_STUDY_LIVE_DEMO' ) ) {
		define('LMS_EDUCATION_STUDY_LIVE_DEMO',__('https://demo.themagnifico.net/lms-education-study/','lms-education-study'));
	}
	if ( ! defined( 'LMS_EDUCATION_STUDY_GET_PREMIUM_PRO' ) ) {
		define('LMS_EDUCATION_STUDY_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/education-wordpress-theme-bundle','lms-education-study'));
	}
	if ( ! defined( 'LMS_EDUCATION_STUDY_PRO_DOC' ) ) {
		define('LMS_EDUCATION_STUDY_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/lms-education-study-pro-doc/','lms-education-study'));
	}
	if ( ! defined( 'LMS_EDUCATION_STUDY_FREE_DOC' ) ) {
		define('LMS_EDUCATION_STUDY_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/lms-education-study-free-doc/','lms-education-study'));
	}

}

add_action( 'after_setup_theme', 'lms_education_study_files_setup' );



function lms_education_study_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function lms_education_study_preloader1(){
	if(get_theme_mod('lms_education_study_preloader_type', 'Preloader 1') == 'Preloader 1' ) {
		return true;
	}
	return false;
}

function lms_education_study_preloader2(){
	if(get_theme_mod('lms_education_study_preloader_type', 'Preloader 1') == 'Preloader 2' ) {
		return true;
	}
	return false;
}

function lms_education_study_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/*dropdown page sanitization*/
function lms_education_study_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function lms_education_study_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*radio button sanitization*/
function lms_education_study_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function lms_education_study_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function lms_education_study_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'lms_education_study_loop_columns');
if (!function_exists('lms_education_study_loop_columns')) {
	function lms_education_study_loop_columns() {
		$columns = get_theme_mod( 'lms_education_study_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

/** * Posts pagination. */
if ( ! function_exists( 'lms_education_study_blog_posts_pagination' ) ) {
	function lms_education_study_blog_posts_pagination() {
		$pagination_type = get_theme_mod( 'lms_education_study_blog_pagination_type', 'blog-nav-numbers' );
		if ( $pagination_type == 'blog-nav-numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation();
		}
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'lms_education_study_shop_per_page', 9 );
function lms_education_study_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'lms_education_study_product_per_page', 9 );
	return $cols;
}

function lms_education_study_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'pro_version_footer_setting' );
    $wp_customize->remove_control( 'pro_version_footer_setting' );

}
add_action( 'customize_register', 'lms_education_study_remove_customize_register', 11 );


// add_action( 'lms_education_study_navigation_action','lms_education_study_single_post_navigation',30 );
if( !function_exists('lms_education_study_content_offcanvas') ):

    // Offcanvas Contents
    function lms_education_study_content_offcanvas(){ ?>

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
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'lms-education-study'); ?>" role="navigation">
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

add_action( 'lms_education_study_before_footer_content_action','lms_education_study_content_offcanvas',30 );


if ( ! function_exists( 'lms_education_study_sub_menu_toggle_button' ) ) :

    function lms_education_study_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'primary' && isset( $args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle with Font Awesome icon
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . esc_attr( $toggle_target_string ) . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'lms-education-study' ) . '</span><i class="fas fa-chevron-down"></i></span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';

        } elseif ( $args->theme_location == 'primary' ) {

            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = '<i class="fas fa-chevron-down"></i></div>';

            } else {

                $args->before = '';
                $args->after  = '';

            }

        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'lms_education_study_sub_menu_toggle_button', 10, 3 );

/**
 * Get CSS
 */

function lms_education_study_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','lms_education_study',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('lms_education_study_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'lms_education_study_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_lms-education-study-info' != $hook ) {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'lms_education_study_getpage_css' );

//Admin Notice For Getstart
function lms_education_study_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function lms_education_study_deprecated_hook_admin_notice() {

     // Check if the notice has been dismissed by the user
    $dismissed = get_user_meta(get_current_user_id(), 'lms_education_study_dismissable_notice', true);

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
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'lms-education-study'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'lms-education-study'); ?><p>
	    		<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=theme-importer' )); ?>"><?php esc_html_e( 'Start Demo Import', 'lms-education-study' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=lms-education-study-info.php' )); ?>"><?php esc_html_e( 'Get started', 'lms-education-study' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( LMS_EDUCATION_STUDY_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'lms-education-study' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( LMS_EDUCATION_STUDY_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'lms-education-study' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'lms_education_study_deprecated_hook_admin_notice' );

function lms_education_study_switch_theme() {
    delete_user_meta(get_current_user_id(), 'lms_education_study_dismissable_notice');
}
add_action('after_switch_theme', 'lms_education_study_switch_theme');
function lms_education_study_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'lms_education_study_dismissable_notice', true);
    die();
}

// Demo Content Code

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu page to trigger theme import
add_action('admin_menu', 'demo_importer_admin_page');

function demo_importer_admin_page() {
    add_theme_page(
        'Demo Theme Importer',     // Page title
        'Theme Importer',          // Menu title
        'manage_options',          // Capability
        'theme-importer',          // Menu slug
        'demo_importer_page',      // Callback function
    );
}

// Display the page content with the button
function demo_importer_page() {
    ?>
    <div class="wrap-main-box">
        <div class="main-box">
            <h2><?php echo esc_html('Welcome to LMS Education Study','lms-education-study'); ?></h2>
            <h3><?php echo esc_html('Create your website in just one click','lms-education-study'); ?></h3>
            <hr>
            <p><?php echo esc_html('The "Begin Installation" helps you quickly set up your website by importing sample content that mirrors the demo version of the theme. This tool provides you with a ready-made layout and structure, so you can easily see how your site will look and start customizing it right away. It\'s a straightforward way to get your site up and running with minimal effort.','lms-education-study'); ?></p>
            <p><?php echo esc_html('Click the button below to install the demo content.','lms-education-study'); ?></p>
            <hr>
            <button id="import-theme-mods" class="button button-primary"><?php echo esc_html('Begin Installation','lms-education-study'); ?></button>
            <div id="import-response"></div>
        </div>
    </div>
    <?php
}

// Add the AJAX action to trigger theme mods import
add_action('wp_ajax_import_theme_mods', 'demo_importer_ajax_handler');

// Handle the AJAX request
function demo_importer_ajax_handler() {
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
        create_demo_menu();
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
function demo_theme_importer($import_data) {
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
function create_demo_menu() {

    // Page import process
    $pages_to_create = array(
        array(
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'page-template/home-template.php',
        ),
        array(
            'title'    => 'Courses',
            'slug'     => 'courses',
            'template' => '',
        ),
        array(
            'title'    => 'Blog',
            'slug'     => 'blog',
            'template' => '',
        ),
        array(
            'title'    => 'Page',
            'slug'     => 'page',
            'template' => '',
        ),
        array(
            'title'    => 'LearnPress Add-On',
            'slug'     => 'learnpress-add-on',
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
            'menu-item-title' =>  __('Home','lms-education-study'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Courses','lms-education-study'),
            'menu-item-classes' => 'courses',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Blog','lms-education-study'),
            'menu-item-classes' => 'Blog',
            'menu-item-url' => home_url( '/index.php/blog/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Page','lms-education-study'),
            'menu-item-classes' => 'page',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('LearnPress Add-On','lms-education-study'),
            'menu-item-classes' => 'learnpress-add-on',
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
    set_theme_mod( 'lms_education_study_twitter_url', '#' );
    set_theme_mod( 'lms_education_study_intagram_url', '#' );
    set_theme_mod( 'lms_education_study_linkedin_url', '#' );
    set_theme_mod( 'lms_education_study_pintrest_url', '#' );
    set_theme_mod( 'lms_education_study_top_header_text', 'Senior leaders from the world’s leading research..' );

    //Slider
    set_theme_mod( 'lms_education_study_slider_short_heading', '100% Satisfaction Guaranteed' );

    set_theme_mod( 'lms_education_study_acitve_student_number', '5500+' );
    set_theme_mod( 'lms_education_study_active_student_text', 'Active Student' );

    set_theme_mod( 'lms_education_study_online_courses_number', '3500+' );
    set_theme_mod( 'lms_education_study_online_courses_text', 'Online Course' );

    set_theme_mod( 'lms_education_study_slider_team_image_1', get_template_directory_uri().'/assets/img/team-1.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_2', get_template_directory_uri().'/assets/img/team-2.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_3', get_template_directory_uri().'/assets/img/team-3.png' );
    set_theme_mod( 'lms_education_study_slider_team_image_4', get_template_directory_uri().'/assets/img/team-4.png' );
    set_theme_mod( 'lms_education_study_right_image_box_3_text', '21+ Certified Experts' );

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

	        $image_url = get_template_directory_uri().'/assets/img/slider-small.png';

			$image_id = media_sideload_image($image_url, $post_id, null, 'id');

		        if (!is_wp_error($image_id)) {
		            // Set the downloaded image as the post's featured image
		            set_post_thumbnail($post_id, $image_id);
		        }
      	}
    }

    //About Us
    set_theme_mod( 'lms_education_study_about_us_image', get_template_directory_uri().'/assets/img/about-1.png' );
    set_theme_mod( 'lms_education_study_about_us_small_image', get_template_directory_uri().'/assets/img/about-2.png' );
    set_theme_mod( 'lms_education_study_about_us_title', 'About Our Company' );
    set_theme_mod( 'lms_education_study_about_us_heading', 'The Worlds Best Online Education Infinitude' );
    set_theme_mod( 'lms_education_study_about_us_content_1', 'Choose from over 210,000 online video courses with new additions Published' );
    set_theme_mod( 'lms_education_study_about_us_content_2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );

    set_theme_mod( 'lms_education_study_about_us__service_image_1', get_template_directory_uri().'/assets/img/aboutsmall-1.png' );
    set_theme_mod( 'lms_education_study_about_us_service_heading_1', 'Learn Skills' );
    set_theme_mod( 'lms_education_study_about_us_service_content_1', 'with unlimited courses' );

    set_theme_mod( 'lms_education_study_about_us__service_image_2', get_template_directory_uri().'/assets/img/aboutsmall-2.png' );
    set_theme_mod( 'lms_education_study_about_us_service_heading_2', 'Generation Technology' );
    set_theme_mod( 'lms_education_study_about_us_service_content_2', 'value all over the world' );

    set_theme_mod( 'lms_education_study_about_us_box_number', '+240' );
    set_theme_mod( 'lms_education_study_about_us_box_title', 'Awesome Awards' );


    set_theme_mod( 'lms_education_study_about_us_button_text', 'Find Out More' );
    set_theme_mod( 'lms_education_study_about_us_button_url', '#' );

}
// Enqueue necessary scripts
add_action('admin_enqueue_scripts', 'demo_importer_enqueue_scripts');

function demo_importer_enqueue_scripts() {
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

/**
 * Theme Info.
 */
function lms_education_study_theme_info_load() {
	require get_theme_file_path( '/inc/theme-installation/theme-installation.php' );
}
add_action( 'init', 'lms_education_study_theme_info_load' );