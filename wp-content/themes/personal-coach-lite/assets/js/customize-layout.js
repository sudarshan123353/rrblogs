(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-lms_education_study_options-';
		
		// Label
		function lms_education_study_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'lms_education_study_scroll_hide' || id === 'lms_education_study_preloader_hide' || id === 'lms_education_study_sticky_header' || id === 'lms_education_study_products_per_row')  {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'lms_education_study_facebook_icon' || id === 'lms_education_study_twitter_icon' || id === 'lms_education_study_intagram_icon'|| id === 'lms_education_study_linkedin_icon'|| id === 'lms_education_study_pintrest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'lms_education_study_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header

			if ( id === 'lms_education_study_email' || id === 'lms_education_study_topbar_timming' || id === 'lms_education_study_top_header_text' || id === 'lms_education_study_header_search_setting' || id === 'lms_education_study_header_button' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}


			// Slider

			if ( id === 'lms_education_study_slider_section_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Courses

			if ( id === 'personal_coach_lite_services_content' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'lms_education_study_footer_widget_content_alignment' || id === 'lms_education_study_show_hide_copyright') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Settings

			if ( id === 'lms_education_study_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Settings

			if ( id === 'lms_education_study_single_post_page_content' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-lms_education_study_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

	    // Site Identity
		lms_education_study_customizer_label( 'custom_logo', 'Logo Setup' );
		lms_education_study_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		lms_education_study_customizer_label( 'lms_education_study_preloader_hide', 'Preloader' );
		lms_education_study_customizer_label( 'lms_education_study_scroll_hide', 'Scroll To Top' );
		lms_education_study_customizer_label( 'lms_education_study_products_per_row', 'woocommerce Setting' );

		// Colors
		lms_education_study_customizer_label( 'lms_education_study_theme_color', 'Theme Color' );
		lms_education_study_customizer_label( 'background_color', 'Colors' );
		lms_education_study_customizer_label( 'background_image', 'Image' );

		// Social Icon
		lms_education_study_customizer_label( 'lms_education_study_facebook_icon', 'Facebook' );
		lms_education_study_customizer_label( 'lms_education_study_twitter_icon', 'Twitter' );
		lms_education_study_customizer_label( 'lms_education_study_intagram_icon', 'Intagram' );
		lms_education_study_customizer_label( 'lms_education_study_linkedin_icon', 'Linkedin' );
		lms_education_study_customizer_label( 'lms_education_study_pintrest_icon', 'Pintrest' );

		//Header Image
		lms_education_study_customizer_label( 'header_image', 'Header Image' );

		// Header
		lms_education_study_customizer_label( 'lms_education_study_topbar_timming', 'Timing' );
		lms_education_study_customizer_label( 'lms_education_study_top_header_text', 'Topbar Text' );
		lms_education_study_customizer_label( 'lms_education_study_email', 'Email' );
		lms_education_study_customizer_label( 'lms_education_study_header_search_setting', 'Search Header' );
		lms_education_study_customizer_label( 'lms_education_study_header_button', 'Header Button' );

		//Slider
		lms_education_study_customizer_label( 'lms_education_study_slider_section_setting', 'Slider' );

		//Courses
		lms_education_study_customizer_label( 'personal_coach_lite_services_content', 'Courses' );

		//Footer
		lms_education_study_customizer_label( 'lms_education_study_footer_widget_content_alignment', 'Footer' );
		lms_education_study_customizer_label( 'lms_education_study_show_hide_copyright', 'Copyright' );

		//Post setting
		lms_education_study_customizer_label( 'lms_education_study_post_page_title', 'Post Settings' );

		//Single post setting
		lms_education_study_customizer_label( 'lms_education_study_single_post_page_content', 'Single Post Settings' );
	});

})( jQuery );
