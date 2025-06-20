<?php

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function lms_education_study_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Magnify – Suggestive Search', 'lms-education-study' ),
			'slug'             => 'magnify-suggestive-search',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'lms_education_study_register_recommended_plugins' );