<?php
/**
 * LMS Education Study - Theme Info Admin Menu
 * @package TheMagnifico52
 * @subpackage Admin
 */
if ( ! class_exists( 'LMS_Education_Study_Theme_Info' ) ) {
    class LMS_Education_Study_Theme_Info{

        private $config;
        private $theme_name;
        private $theme_slug;
        private $theme_version;
        private $page_title;
        private $menu_title;
        private $tabs;

        /**
         * Constructor.
         */
        public function __construct( $config ) {
            $this->config = $config;
            $this->lms_education_study_lms_education_study_prepare_class();

            /*admin menu*/
            add_action( 'admin_menu', array( $this, 'lms_education_study_tm_admin_menu' ) );

            /* enqueue script and style for about page */
            add_action( 'admin_enqueue_scripts', array( $this, 'lms_education_study_style_and_scripts' ) );

            /* ajax callback for dismissable required actions */
            add_action( 'wp_ajax_tm_theme_info_update_recommend_action', array( $this, 'lms_education_study_update_recommended_action_callback' ) );
        }

        /**
         * Prepare and setup class properties.
         */
        public function lms_education_study_lms_education_study_prepare_class() {
            $theme = wp_get_theme();
            $this->theme_name    = esc_html( $theme->get( 'Name' ) );
            $this->theme_slug    = $theme->get_template();
            $this->theme_version = $theme->get( 'Version' );
            $this->page_title    = $this->theme_name . esc_html__( ' Info', 'lms-education-study' );
            $this->menu_title    = $this->theme_name . esc_html__( ' Theme', 'lms-education-study' );
            $this->tabs          = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();
        }

        /**
         * Return the valid array of recommended actions.
         * @return array The valid array of recommended actions.
         */
        /**
         * Dismiss required actions
         */
        public function lms_education_study_update_recommended_action_callback() {

            /*getting for provided array*/
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();

            /*from js action*/
            $action_id = esc_attr( ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0 );
            $todo = esc_attr( ( isset( $_GET['todo'] ) ) ? $_GET['todo'] : '' );

            /*getting saved actions*/
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );

            echo esc_html( wp_unslash( $action_id ) ); /* this is needed and it's the id of the dismissable required action */

            if ( ! empty( $action_id ) ) {

                if( 'reset' == $todo ){
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            $saved_actions[ $recommended_action['id'] ] = true;
                        }
                        update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                    }
                }
                /* if the option exists, update the record for the specified id */
                elseif ( !empty( $saved_actions) and is_array( $saved_actions ) ) {

                    switch ( esc_html( $todo ) ) {
                        case 'add';
                            $saved_actions[ $action_id ] = true;
                            break;
                        case 'dismiss';
                            $saved_actions[ $action_id ] = false;
                            break;
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions );

                    /* create the new option,with false for the specified id */
                }
                else {
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            echo esc_html($recommended_action['id']);
                            echo " ". esc_html($todo);
                            if ( $recommended_action['id'] == $action_id ) {
                                switch ( esc_html( $todo ) ) {
                                    case 'add';
                                        $saved_actions_new[ $action_id ] = true;
                                        break;
                                    case 'dismiss';
                                        $saved_actions_new[ $action_id ] = false;
                                        break;
                                }
                            }
                        }
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                }
            }
            exit;
        }

        private function lms_education_study_get_recommended_actions() {
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );
            if ( ! is_array( $saved_actions ) ) {
                $saved_actions = array();
            }
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $valid       = array();
            if( isset( $recommended_actions ) && is_array( $recommended_actions ) ){
                foreach ( $recommended_actions as $recommended_action ) {
                    if (
                        (
                            ! isset( $recommended_action['check'] ) ||
                            ( isset( $recommended_action['check'] ) && ( $recommended_action['check'] == false ) )
                        )
                        &&
                        ( ! isset( $saved_actions[ $recommended_action['id'] ] ) ||
                            ( isset( $saved_actions[ $recommended_action['id']] ) && ($saved_actions[ $recommended_action['id']] == true ) )
                        )
                    ) {
                        $valid[] = $recommended_action;
                    }
                }
            }
            return $valid;
        }

        private function lms_education_study_count_recommended_actions() {
            $count = 0;
            $actions_count = $this->lms_education_study_get_recommended_actions();
            if ( ! empty( $actions_count ) ) {
                $count = count( $actions_count );
            }
            return $count;
        }
        
        /**
         * Adding Theme Info Menu under Appearance.
         */
        function lms_education_study_tm_admin_menu() {

            if ( ! empty( $this->page_title ) && ! empty( $this->menu_title ) ) {
                $count = $this->lms_education_study_count_recommended_actions();
                $menu_title = $count > 0 ? $this->menu_title . '<span class="badge-action-count">' . esc_html( $count ) . '</span>' : $this->menu_title;
                /* Example
                 * add_theme_page('My Plugin Theme', 'My Plugin', 'edit_theme_options', 'my-unique-identifier', 'my_plugin_function');
                 * */
                add_theme_page( $this->page_title, $menu_title, 'edit_theme_options', $this->theme_slug . '-info', array(
                    $this,
                    'lms_education_study_tm_theme_info_screen_main',
                ) );
            }
        }

        /**
         * Render the info content screen.
         */
        public function lms_education_study_tm_theme_info_screen_main() {
            $theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
            if ( ! empty( $this->config['info_title'] ) ) {
                $welcome_title = $this->config['info_title'];
            }
            if ( ! empty( $this->config['info_content'] ) ) {
                $welcome_content = $this->config['info_content'];
            }
            if ( ! empty( $this->config['quick_links'] ) ) {
                $quick_links = $this->config['quick_links'];
            }

            if (
                ! empty( $welcome_title ) ||
                ! empty( $welcome_content ) ||
                ! empty( $quick_links ) ||
                ! empty( $this->tabs )
            ) {
                echo '<div class="wrap about-wrap info-wrap epsilon-wrap">';
                echo '<div class="header-wrap display-grid col-grid-2 align-center">';
                echo '<div class="theme-detail col">';
                if ( ! empty( $welcome_title ) ) {
                    echo '<h1>';
                    echo esc_html( $welcome_title );
                    if ( ! empty( $this->theme_version ) ) {
                        echo esc_html( $this->theme_version ) . ' </sup>';
                    }
                    echo '</h1>';
                }
                if ( ! empty( $welcome_content ) ) {
                    echo '<div class="about-text">' . wp_kses_post( $welcome_content ) . '</div>';
                }

                /*quick links*/
                if( !empty( $quick_links ) && is_array( $quick_links ) ){
                    echo '<p class="quick-links">';
                    foreach ( $quick_links as $quick_key => $quick_link ) {
                        $button = 'button-secondary';
                        if( 'pro_url' == $quick_key ){
                            $button = 'button button-primary button-hero';
                        }
                        echo '<a href="'.esc_url( $quick_link['url'] ).'" class="button button-hero '.esc_attr( $button ).'" target="_blank">'.esc_html( $quick_link['text'] ).'</a>';
                    }
                    echo "</p>";
                }
                echo '</div>';
                echo '<div class="theme-img col">';
                echo '<img src="' . get_theme_file_uri() . '/screenshot.png" alt="screenshot" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</div>';
                echo '</div><!--/header-wrap-->';
                /* Display tabs */
                if ( ! empty( $this->tabs ) ) {
                    $current_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'lms_education_study_demo_impoter';

                    echo '<h2 class="nav-tab-wrapper wp-clearfix">';
                    $count = $this->lms_education_study_count_recommended_actions();
                    foreach ( $this->tabs as $tab_key => $tab_name ) {
                        echo '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-info' ) ) . '&tab=' . esc_attr( $tab_key ) . '" class="nav-tab ' . ( $current_tab == $tab_key ? 'nav-tab-active' : '' ) . '" role="tab" data-toggle="tab">';
                        echo esc_html( $tab_name );
                        if ( $tab_key == 'recommended_actions' ) {
                            if ( $count > 0 ) {
                                echo '<span class="badge-action-count">' . esc_html( $count ) . '</span>';
                            }
                        }
                        echo '</a>';
                    }

                    echo '</h2>';

                    /* Display content for current tab, dynamic method according to key provided*/
                    if ( method_exists( $this, $current_tab ) ) {

                        echo "<div class='changelog point-releases'>";
                        $this->$current_tab();
                        echo "</div>";
                    }
                }
                echo '</div><!--/.wrap.about-wrap-->';
            }
        }

        /**
         * Getting started tab
         */
        public function lms_education_study_demo_impoter() {
            echo '<div class="feature-section display-grid col-grid-1">';
            if ( ! empty( $this->config['lms_education_study_demo_impoter_steps'] ) ) {
                $lms_education_study_demo_impoter_steps = $this->config['lms_education_study_demo_impoter_steps'];
                if ( ! empty( $lms_education_study_demo_impoter_steps ) ) {

                    /*defaults values for lms_education_study_demo_impoter_steps array */
                    $defaults = array(
                        'title'     => '',
                        'desc'       => '',
                        'button_label'   => '',
                        'button_link'   => '',
                        'is_button' => true,
                        'is_new_tab' => false,
                        'is_gs' => false,
                    );
                    foreach ( $lms_education_study_demo_impoter_steps as $gs_step ) {
                        $instance = wp_parse_args( (array) $gs_step, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $button_label = $instance[ 'button_label'];
                        $button_link = $instance[ 'button_link'];
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        $is_gs = $instance[ 'is_gs' ];
                        
                        echo '<div class="col-items impoter-box">';
                            if ( ! empty( $title ) ) {
                                echo '<h3>';
                                echo esc_html($title);
                                echo '</h3>';
                            }

                            if ( ! empty( $desc ) ) {
                                echo '<p>' . esc_html($desc) . '</p>';
                            }

                            if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                                echo '<p>';
                                $button_class = '';
                                if ( $is_button ) {
                                    $button_class = 'button button-primary button-hero';
                                }

                                $button_new_tab = '_self';
                                if ( isset( $is_new_tab ) ) {
                                    if ( $is_new_tab ) {
                                        $button_new_tab = '_blank';
                                    }
                                }
                                echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $button_link ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_label ) . '</a>';
                                echo '</p>';
                            }
                            echo '</div>';
                    }
                }
            }
            echo '</div><!-- .feature-section col-wrap -->';
        }


        /**
         * Getting started tab
         */
        public function lms_education_study_getting_started() {
            echo '<div class="feature-section display-grid col-grid-3">';
            if ( ! empty( $this->config['lms_education_study_gs_steps'] ) ) {
                $lms_education_study_gs_steps = $this->config['lms_education_study_gs_steps'];
                if ( ! empty( $lms_education_study_gs_steps ) ) {

                    /*defaults values for lms_education_study_gs_steps array */
                    $defaults = array(
                        'title'     => '',
                        'desc'       => '',
                        'button_label'   => '',
                        'button_link'   => '',
                        'is_button' => true,
                        'is_new_tab' => false,
                        'is_gs' => false,
                    );
                    foreach ( $lms_education_study_gs_steps as $gs_step ) {
                        $instance = wp_parse_args( (array) $gs_step, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $button_label = $instance[ 'button_label'];
                        $button_link = $instance[ 'button_link'];
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        $is_gs = $instance[ 'is_gs' ];
                        
                        echo '<div class="col-items">';
                        
                        
                        if ( ! empty( $title ) ) {
                            echo '<h3>';
                            echo esc_html($title);
                            echo '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . esc_html($desc) . '</p>';
                        }

                        if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary button-hero';
                            }

                            $button_new_tab = '_self';
                            if ( isset( $is_new_tab ) ) {
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }
                            }
                            echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $button_link ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_label ) . '</a>';
                            echo '</p>';
                        }
                        echo '</div>';
                    }
                }
            }
            echo '</div><!-- .feature-section col-wrap -->';
        }

        /**
         * Recommended Actions tab
         */
        public function lms_education_study_check_plugin_status( $slug ) {

            $path = WPMU_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
            if ( ! file_exists( $path ) ) {
                $path = WP_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
                if ( ! file_exists( $path ) ) {
                    $path = false;
                }
            }

            if ( file_exists( $path ) ) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

                $needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

                return array( 'status' => is_plugin_active( $slug . '/' . $slug . '.php' ), 'needs' => $needs );
            }

            return array( 'status' => false, 'needs' => 'install' );
        }

        public function lms_education_study_create_action_link( $state, $slug ) {

            switch ( $state ) {
                case 'install':
                    return wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'install-plugin',
                                'plugin' => $slug
                            ),
                            network_admin_url( 'update.php' )
                        ),
                        'install-plugin_' . $slug
                    );
                    break;

                case 'deactivate':
                    return add_query_arg(
                            array(
                                'action'        => 'deactivate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' )
                                ),
                            network_admin_url( 'plugins.php' )
                    );
                    break;

                case 'activate':
                    return add_query_arg(
                            array(
                                'action'        => 'activate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' )
                            ),
                            network_admin_url( 'plugins.php' )
                    );
                    break;
            }
        }

        public function recommended_actions() {

            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $hooray = true;
            if ( ! empty( $recommended_actions ) ) {

                echo '<div class="feature-section action-recommended demo-import-boxed" id="plugin-filter">';

                if ( ! empty( $recommended_actions ) && is_array( $recommended_actions ) ) {

                    /*get saved recommend actions*/
                    $saved_recommended_actions = get_option( $this->theme_slug . '_recommended_actions' );

                    /*defaults values for lms_education_study_getting_started array */
                    $defaults = array(
                        'title'         => '',
                        'desc'          => '',
                        'check'         => false,
                        'plugin_slug'   => '',
                        'id'            => ''
                    );
                    foreach ( $recommended_actions as $action_key => $action_value ) {
                        $instance = wp_parse_args( (array) $action_value, $defaults );

                        /*allowed 5 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc' ];
                        $check = $instance[ 'check' ];
                        $plugin_slug = $instance[ 'plugin_slug' ];
                        $id = $instance[ 'id' ];

                        $hidden = false;

                        /*magic check for recommended actions*/
                        if (
                            isset( $saved_recommended_actions[ $id ] ) &&
                            $saved_recommended_actions[ $id ] == false ) {
                            $hidden = true;
                        }
                        if ( $hidden ) {
                            echo '';
                        }
                        $done = '';
                        if ( $check ) {
                           $done = 'done';
                        }

                        echo "<div class='tm-theme-installation-action-recommend-box {$done}'>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                        if ( ! $hidden ) {
                            echo '<span data-action="dismiss" class="dashicons dashicons-visibility tm-theme-installation-recommend-action-button" id="' . esc_attr( $action_value['id'] ) . '"></span>';
                        } else {
                            echo '<span data-action="add" class="dashicons dashicons-hidden tm-theme-installation-recommend-action-button" id="' . esc_attr( $action_value['id'] ) .'"></span>';
                        }

                        if ( ! empty( $title) ) {
                            echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . wp_kses_post( $desc ) . '</p>';
                        }

                        if ( ! empty( $plugin_slug ) ) {

                            $active = $this->lms_education_study_check_plugin_status( $action_value['plugin_slug'] );
                            $url    = $this->lms_education_study_create_action_link( $active['needs'], $action_value['plugin_slug'] );
                            $label  = '';
                            $class  = '';
                            switch ( $active['needs'] ) {

                                case 'install':
                                    $class = 'install-now button';
                                    $label = esc_html__( 'Install', 'lms-education-study' );
                                    break;

                                case 'activate':
                                    $class = 'activate-now button button-primary';
                                    $label = esc_html__( 'Activate', 'lms-education-study' );

                                    break;

                                case 'deactivate':
                                    $class = 'deactivate-now button';
                                    $label = esc_html__( 'Deactivate', 'lms-education-study' );

                                    break;
                            }

                            ?>
                            <p class="plugin-card-<?php echo esc_attr( $action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
                                <a data-slug="<?php echo esc_attr( $action_value['plugin_slug'] ) ?>"
                                   class="<?php echo esc_attr( $class ); ?>"
                                   href="<?php echo esc_url( $url ) ?>"> <?php echo esc_html( $label ) ?> </a>
                            </p>

                            <?php

                        }
                        echo '</div>';
                        $hooray = false;
                    }
                }
                if ( $hooray ){
                    echo '<span class="hooray">' . esc_html__( 'Hooray! There are no recommended actions for you right now.', 'lms-education-study' ) . '</span>';
                    echo '<a data-action="reset" id="reset" class="reset-all" href="#">'.esc_html__('Show All Recommended Actions', 'lms-education-study').'</a>';
                }
                echo '</div>';
            }
        }

        /**
         * Free vs Pro tab
         */
        public function lms_education_study_free_pro() {
            $theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
            $lms_education_study_free_pro = isset( $this->config['lms_education_study_free_pro'] ) ? $this->config['lms_education_study_free_pro'] : array();
            if ( ! empty( $lms_education_study_free_pro ) ) {
                /*defaults values for child theme array */
                $defaults = array(
                    'title'=> '',
                    'desc' => '',
                    'free' => '',
                    'pro'  => '',
                );

                if ( ! empty( $lms_education_study_free_pro ) && is_array( $lms_education_study_free_pro ) ) {
                    echo '<div class="feature-section">';
                    echo '<div id="lms_education_study_free_pro" class="lms-education-study-theme-installation-tab-pane lms-education-study-theme-installation-fre-pro">';
                    echo '<table class="free-pro-table table-light-wrapper lms-education-study-theme-installation-text-center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>' . esc_html__( 'Theme Feature','lms-education-study' ) . '</th>';
                    echo '<th>' . esc_html__( 'Basic Version','lms-education-study' ) . '</th>';
                    echo '<th>' . esc_html__( 'Premium Version','lms-education-study' ) . '</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ( $lms_education_study_free_pro as $feature ) {

                        $instance = wp_parse_args( (array) $feature, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $free = $instance[ 'free'];
                        $pro = $instance[ 'pro'];

                        echo '<tr>';
                        if ( ! empty( $title ) || ! empty( $desc ) ) {
                            echo '<td>';
                            if ( ! empty( $title ) ) {
                                echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                            }
                            if ( ! empty( $desc ) ) {
                                echo '<p>' . wp_kses_post( $desc ) . '</p>';
                            }
                            echo '</td>';
                        }

                        if ( ! empty( $free )) {
                            if( 'yes' === $free ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $free ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($free ).'</td>';
                            }

                        }
                        if ( ! empty( $pro )) {
                            if( 'yes' === $pro ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $pro ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($pro ).'</td>';
                            }
                        }
                        echo '</tr>';
                    }

                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td><a href="' . esc_url( LMS_EDUCATION_STUDY_GET_PREMIUM_PRO ).'" target="_blank" class="button button-primary button-hero">Buy Pro</a></td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';

                }
            }
        }

        /**
         * Recommended plugins tab
         */
        /*
         * Call plugin api
         */
        public function call_plugin_api( $slug ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

            if ( false === ( $call_api = get_transient( 'tm_theme_info_plugin_information_' . $slug ) ) ) {
                $call_api = plugins_api( 'plugin_information', array(
                    'slug'   => $slug,
                    'fields' => array(
                        'downloaded'        => false,
                        'rating'            => false,
                        'description'       => false,
                        'short_description' => true,
                        'donate_link'       => false,
                        'tags'              => false,
                        'sections'          => true,
                        'homepage'          => true,
                        'added'             => false,
                        'last_updated'      => false,
                        'compatibility'     => false,
                        'tested'            => false,
                        'requires'          => false,
                        'downloadlink'      => false,
                        'icons'             => true
                    )
                ) );
                set_transient( 'tm_theme_info_plugin_information_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
            }

            return $call_api;
        }
        public function get_plugin_icon( $arr ) {

            if ( ! empty( $arr['svg'] ) ) {
                $plugin_icon_url = $arr['svg'];
            } elseif ( ! empty( $arr['2x'] ) ) {
                $plugin_icon_url = $arr['2x'];
            } elseif ( ! empty( $arr['1x'] ) ) {
                $plugin_icon_url = $arr['1x'];
            } else {
                $plugin_icon_url = get_template_directory_uri() . '/assets/img/placeholder_plugin.png';
            }

            return $plugin_icon_url;
        }
        public function lms_education_study_recommended_plugins() {
            $lms_education_study_recommended_plugins = $this->config['lms_education_study_recommended_plugins'];

            if ( ! empty( $lms_education_study_recommended_plugins ) ) {
                if ( ! empty( $lms_education_study_recommended_plugins ) && is_array( $lms_education_study_recommended_plugins ) ) {

                    echo '<div class="feature-section recommended-plugins col-wrap demo-import-boxed" id="plugin-filter">';

                    foreach ( $lms_education_study_recommended_plugins as $lms_education_study_recommended_plugins_item ) {

                        if ( ! empty( $lms_education_study_recommended_plugins_item['slug'] ) ) {
                            $info   = $this->call_plugin_api( $lms_education_study_recommended_plugins_item['slug'] );
                            if ( ! empty( $info->icons ) ) {
                                $icon = $this->get_plugin_icon( $info->icons );
                            }

                            $active = $this->lms_education_study_check_plugin_status( $lms_education_study_recommended_plugins_item['slug'] );

                            if ( ! empty( $active['needs'] ) ) {
                                $url = $this->lms_education_study_create_action_link( $active['needs'], $lms_education_study_recommended_plugins_item['slug'] );
                            }

                            echo '<div class="col"><div class="col-items plugin_box">';
                            if ( ! empty( $icon ) ) {
                                echo '<img src="'.esc_url( $icon ).'" alt="plugin box image">';
                            }
                            if ( ! empty(  $info->version ) ) {
                                echo '<span class="version">'. ( ! empty( $this->config['lms_education_study_recommended_plugins']['version_label'] ) ? esc_html( $this->config['lms_education_study_recommended_plugins']['version_label'] ) : '' ) . esc_html( $info->version ).'</span>';
                            }
                            if ( ! empty( $info->author ) ) {
                                echo '<span class="separator"> | </span>' . wp_kses_post( $info->author );
                            }

                            if ( ! empty( $info->name ) && ! empty( $active ) ) {
                                echo '<div class="action_bar ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<span class="plugin_name">' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'Active: ' : '' ) . esc_html( $info->name ) . '</span>';
                                echo '</div>';

                                $label = '';

                                switch ( $active['needs'] ) {

                                    case 'install':
                                        $class = 'install-now button';
                                        $label = esc_html__( 'Install', 'lms-education-study' );
                                        break;

                                    case 'activate':
                                        $class = 'activate-now button button-primary';
                                        $label = esc_html__( 'Activate', 'lms-education-study' );

                                        break;

                                    case 'deactivate':
                                        $class = 'deactivate-now button';
                                        $label = esc_html__( 'Deactivate', 'lms-education-study' );

                                        break;
                                }

                                echo '<span class="plugin-card-' . esc_attr( $lms_education_study_recommended_plugins_item['slug'] ) . ' action_button ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<a data-slug="' . esc_attr( $lms_education_study_recommended_plugins_item['slug'] ) . '" class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
                                echo '</span>';
                            }
                            echo '</div></div><!-- .col.plugin_box -->';
                        }
                    }
                    echo '</div><!-- .recommended-plugins -->';
                }
            }
        }

        /**
         * Support tab
         */
        public function lms_education_study_support() {
            echo '<div class="feature-section col-wrap">';

            if ( ! empty( $this->config['lms_education_study_support_content'] ) ) {

                $supports = $this->config['lms_education_study_support_content'];

                if ( ! empty( $supports ) ) {

                    /*defaults values for child theme array */
                    $defaults = array(
                        'title' => '',
                        'icon' => '',
                        'desc' => '',
                        'button_label' => '',
                        'button_link' => '',
                        'is_button' => true,
                        'is_new_tab' => true
                    );

                    foreach ( $supports as $support ) {
                        $instance = wp_parse_args( (array) $support, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $icon = $instance[ 'icon'];
                        $desc = $instance[ 'desc'];
                        $button_label = $instance[ 'button_label'];
                        $button_link = $instance[ 'button_link'];
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        
                        echo '<div class="col"><div class="col-items">';

                        if ( ! empty( $title ) ) {
                            echo '<h3>';
                            if ( ! empty( $icon ) ) {
                                echo '<i class="' . esc_attr( $icon ) . '"></i>';
                            }
                            echo esc_html($title);
                            echo '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . esc_html( $desc ) . '</p>';
                        }

                        if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary button-hero';
                            }

                            $button_new_tab = '_self';
                            if ( isset( $is_new_tab ) ) {
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }
                            }
                            echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $button_link ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_label ) . '</a>';
                            echo '</p>';
                        }
                        echo '</div></div>';
                    }
                }
            }
            echo '</div>';
        }

        /**
         * Changelog tab
         */
        private function lms_education_study_parse_changelog() {
            WP_Filesystem();
            global $wp_filesystem;

            $readme_content = $wp_filesystem->get_contents( get_template_directory() . '/readme.txt' );

            if ( is_wp_error( $readme_content ) || empty( $readme_content ) ) {
                return '';
            }

            // Extract only the "Changelog" section
            $changelog = '';
            if ( preg_match( '/==\s*Changelog\s*==(.+?)(==\s*[A-Z][^=]+==|$)/is', $readme_content, $matches ) ) {
                $changelog = trim( $matches[1] );
            }

            return $changelog;
        }

        public function lms_education_study_changelog() {
            $lms_education_study_changelog = $this->lms_education_study_parse_changelog();
            if ( ! empty( $lms_education_study_changelog ) ) {
                echo '<div class="featured-section changelog">';
                echo "<pre class='changelog'>";
                echo esc_html($lms_education_study_changelog);
                echo "</pre>";
                echo '</div><!-- .featured-section.changelog -->';
            }
        }

        /**
         * Load css and scripts for the about page
         */
        public function lms_education_study_style_and_scripts( $hook_suffix ) {

            // this is needed on all admin pages, not just the about page, for the badge action count in the WordPress main sidebar
            wp_enqueue_style( 'lms-education-study-theme-installation-css', get_template_directory_uri() . '/inc/theme-installation/assets/css/theme-installation.css' );

            if ( 'appearance_page_' . $this->theme_slug . '-info' == $hook_suffix ) {

                wp_enqueue_script( 'lms-education-study-theme-installation-js', get_template_directory_uri() . '/inc/theme-installation/assets/js/theme-installation.js', array( 'jquery' ) );

                wp_enqueue_style( 'plugin-install' );
                wp_enqueue_script( 'plugin-install' );
                wp_enqueue_script( 'updates' );

                $count = $this->lms_education_study_count_recommended_actions();
                wp_localize_script( 'lms-education-study-theme-installation-js', 'tm_theme_info_box_object', array(
                    'nr_actions_recommended'   => $count,
                    'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
                    'template_directory'       => get_template_directory_uri()
                ) );

            }

        }
    }
}

$theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
$config = array(

    // Main welcome title
    /* translators: %s - Theme Name*/
    'info_title' => sprintf( esc_html__( 'Welcome to %s - ', 'lms-education-study' ), $theme_name_config ),

    // Main welcome content
    /* translators: %s - Theme Name*/
    'info_content' => sprintf( esc_html__( '%s is now installed and ready to use. We hope the following information will help and you enjoy using it!', 'lms-education-study' ), '<b>'.$theme_name_config.'</b>' ),

    /**
     * Quick links
     */
    'quick_links' => array(
        'theme_url'  => array(
            'text' => __( 'Try the Demo', 'lms-education-study' ),
            'url' => esc_url( LMS_EDUCATION_STUDY_LIVE_DEMO )
        ),
        'pro_url'  => array(
            'text' => __( 'Buy Pro', 'lms-education-study' ),
            'url'  => esc_url( LMS_EDUCATION_STUDY_GET_PREMIUM_PRO )
        ),
    ),

    'tabs' => array(
        'lms_education_study_demo_impoter'         => esc_html__( 'Demo Impoter', 'lms-education-study' ),
        'lms_education_study_getting_started'      => esc_html__( 'Getting Started', 'lms-education-study' ),
        'lms_education_study_free_pro'             => esc_html__( 'Compare Free Vs Pro', 'lms-education-study' ),
        'lms_education_study_recommended_plugins'  => esc_html__( 'Recommended Plugins', 'lms-education-study' ),
        'lms_education_study_support'              => esc_html__( 'Support', 'lms-education-study' ),
        'lms_education_study_changelog'            => esc_html__( 'Changelog', 'lms-education-study' ),
    ),

    /*Getting started tab*/
    'lms_education_study_gs_steps' => array(
        'first' => array(
            'title' => esc_html__( 'Checkout Premium', 'lms-education-study' ),
            'desc' => esc_html__( 'Our premium theme comes with extended features like demo content import , responsive layouts etc.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Get Premium', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_GET_PREMIUM_PRO ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'second' => array (
            'title' => esc_html__( 'Contact Support', 'lms-education-study' ),
            'desc' => esc_html__( 'Thank you for trying LMS Education Study , feel free to contact us for any support regarding our theme.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Contact Support', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_CONTACT_SUPPORT ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'third' => array (
            'title' => esc_html__( 'Review', 'lms-education-study' ),
            'desc' => esc_html__( 'If You love LMS Education Study theme then we would appreciate your review about our theme.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Review', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_REVIEW ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'fourth' => array (
            'title' => esc_html__( 'Go to Customizer', 'lms-education-study' ),
            'desc' => esc_html__( 'All Settings, Header & Footer Options and Theme Options are available via Customize screen.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Go to Customizer', 'lms-education-study' ),
            'button_link' => esc_url( admin_url( 'customize.php' ) ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'fifth' => array(
            'title' => esc_html__( 'Free Documentation', 'lms-education-study' ),
            'desc' => esc_html__( 'Our guide is available if you require any help configuring and setting up the theme. Easy and quick way to setup the theme.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Free Documentation', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_FREE_DOC ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'sixth' => array(
            'title' => esc_html__( 'View Theme Demo', 'lms-education-study' ),
            'desc' => esc_html__( 'Explore the demo to see how easily you can set up and customize the theme.', 'lms-education-study' ),
            'button_label' => esc_html__( 'View Demo', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_LIVE_DEMO ),
            'is_button' => true,
            'is_new_tab' => true
        ),
    ),

    /*Getting started tab*/
    'lms_education_study_demo_impoter_steps' => array(
        'first' => array(
            'title' => esc_html__( 'Instant Demo Setup', 'lms-education-study' ),
            'desc' => esc_html__( 'Import your entire demo content in just one click, including pages, posts, and design elements for a quick setup.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Start Demo Import', 'lms-education-study' ),
            'button_link' => esc_url( admin_url( 'admin.php?page=theme-importer' ) ),
            'is_button' => true,
            'is_new_tab' => true
        )
    ),

    // recommended actions array.
    'lms_education_study_recommended_actions' => array(

    ),

    // Free vs pro array.
    'lms_education_study_free_pro' => array(
        array(
            'desc'=> __( 'Header Background Color', 'lms-education-study' ),
            'free' => __( 'yes','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Custom Navigation Logo Or Text', 'lms-education-study' ),
            'free' => __( 'yes','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Hide Logo Text', 'lms-education-study' ),
            'free' => __( 'yes','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Premium Support', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Fully SEO Optimized', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Recent Posts Widget', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Easy Google Fonts', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Pagespeed Plugin', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Only Show Header Image On Front Page', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Show Header Everywhere', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Custom Text On Header Image', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Full Width (Hide Sidebar)', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Only Show Upper Widgets On Front Page', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Replace Copyright Text', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Upper Widgets Colors', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Navigation Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Post/Page Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Blog Feed Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Footer Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Sidebar Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Customize Background Color', 'lms-education-study' ),
            'free' => __( 'no','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
        array(
            'desc'=> __( 'Importable Demo Content', 'lms-education-study' ),
            'free' => __( 'yes','lms-education-study' ),
            'pro'  => __( 'yes','lms-education-study' ),
        ),
    ),

    // Generic Plugins array.
    'lms_education_study_recommended_plugins' => array(
        'Classic Widgets' => array(
            'slug' => 'classic-widgets'
        ),
        'Magnify – Suggestive Search' => array(
            'slug' => 'magnify-suggestive-search'
        ),
    ),

    // Support content tab.
    'lms_education_study_support_content' => array(
        'first' => array(
            'title' => esc_html__( 'Have a question? We’re here to help—ask now!', 'lms-education-study' ),
            'desc' => esc_html__( 'We are dedicated to addressing any issues that may occur, ensuring your experience with Shippable is seamless and uninterrupted.', 'lms-education-study' ),
            'button_label' => esc_html__( 'Contact Support', 'lms-education-study' ),
            'button_link' => esc_url( LMS_EDUCATION_STUDY_CONTACT_SUPPORT ),
            'is_button' => true,
            'is_new_tab' => true
        )
    ),

);
return new LMS_Education_Study_Theme_Info( $config );