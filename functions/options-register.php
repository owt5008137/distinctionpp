<?php
/* Register Theme Settings
*******************************************************************************************/

// Register theme_wp_distinctionpp_options array to hold all theme options
register_setting( 'theme_wp_distinctionpp_options', 'theme_wp_distinctionpp_options', 'wp_distinctionpp_options_validate' );


/* Register Settings Per Tab Content
*******************************************************************************************/

global $pagenow;
if ( 'themes.php' == $pagenow && isset( $_GET['page'] ) && 'wp_distinctionpp-settings' == $_GET['page'] ) :
    if ( isset ( $_GET['tab'] ) ) :
        $tab = $_GET['tab'];
    else:
        $tab = 'general';
    endif;
    switch ( $tab ) :
        case 'general' :
            require( get_template_directory() . '/functions/options-register-general.php' );
            break;
        case 'layout' :
            require( get_template_directory() . '/functions/options-register-layout.php' );
            break;
		case 'style' :
            require( get_template_directory() . '/functions/options-register-style.php' );
            break;
    endswitch;
endif;


/* Validate/Whitelist User-Input Data Before Updating Theme Options
*******************************************************************************************/

// Codex Reference: http://codex.wordpress.org/Data_Validation
function wp_distinctionpp_options_validate( $input ) {

	$wp_distinctionpp_options = get_option( 'theme_wp_distinctionpp_options' );
	$valid_input = $wp_distinctionpp_options;

	// Determine which form action was submitted
	$submit_general = ( ! empty( $input['submit-general']) ? true : false );
	$reset_general = ( ! empty($input['reset-general']) ? true : false );
	$submit_layout = ( ! empty($input['submit-layout']) ? true : false );
	$reset_layout = ( ! empty($input['reset-layout']) ? true : false );
	$submit_style = ( ! empty($input['submit-style']) ? true : false );
	$reset_style = ( ! empty($input['reset-style']) ? true : false );

	if ( $submit_general ) { // if General Settings Submit

		// General Options
		$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );
		$valid_input['analytics_code'] = $input['analytics_code'];

	} elseif ( $reset_general ) { // if General Settings Reset Defaults

		$wp_distinctionpp_default_options = wp_distinctionpp_get_default_options();
		// General Options
		$valid_input['display_footer_credit'] = $wp_distinctionpp_default_options['display_footer_credit'];
		$valid_input['analytics_code'] = $wp_distinctionpp_default_options['analytics_code'];

	} elseif ( $submit_layout ) { // if Layout Settings Submit

		// Layout Options
		$valid_input['header_menu_position'] = ( 'below' == $input['header_menu_position'] ? 'below' : 'above' );
		$valid_input['header_menu_depth'] = ( ( 1 || 2 || 3 ) == $input['header_menu_depth'] ? $input['header_menu_depth'] : $valid_input['header_menu_depth'] );
		$valid_input['display_site_description'] = ( 'true' == $input['display_site_description'] ? true : false );
		$valid_input['display_menu_search_form'] = ( 'true' == $input['display_menu_search_form'] ? true : false );
		$valid_input['sidebar_position'] = ( 'right' == $input['sidebar_position'] ? 'right' : 'left' );

	} elseif ( $reset_layout ) { // if Layout Settings Reset Defaults

		$wp_distinctionpp_default_options = wp_distinctionpp_get_default_options();
		// Layout Options
		$valid_input['header_menu_position'] = $wp_distinctionpp_default_options['header_menu_position'];
		$valid_input['header_menu_depth'] = $wp_distinctionpp_default_options['header_menu_depth'];
		$valid_input['display_site_description'] = ( 'true' == $input['display_site_description'] ? false : true );
		$valid_input['display_menu_search_form'] = ( 'true' == $input['display_menu_search_form'] ? false : true );
		$valid_input['sidebar_position'] = ( 'right' == $input['sidebar_position'] ? 'left' : 'right' );

	} elseif ( $submit_style ) { // if Style Settings Submit

		// Style Options
		$valid_input['display_header_flames'] = ( 'true' == $input['display_header_flames'] ? true : false );

	} elseif ( $reset_style ) { // if Style Settings Reset Defaults

		$wp_distinctionpp_default_options = wp_distinctionpp_get_default_options();
		// Style Options
		$valid_input['display_header_flames'] = ( 'true' == $input['display_header_flames'] ? false : true );

	}
	return $valid_input;

}
?>