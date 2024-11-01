<?php

/*
 * Plugin Name: Surmetric Surveys
 * Description: A plugin that allows you to embed your Surmetric survey and collect responses on your WordPress website. After entering your campaign information on the settings. You can then display the survey itself by using the shortcode: [survey] or using our widget.
 * Version: 1.0
 * License: GPLv2
 * Author: Sophware Enterprises
 * Author URI: https://www.surmetric.com/
 */

//security
if(!defined('ABSPATH')) {
	exit;
}

//includes
require_once('survey_widget.php');

//creats admin page
function surmetric_create_settings_page() {
	add_menu_page('Survey Settings', 'Surmetric', 'manage_options', 'surmetric-settings', 'surmetric_get_settings_content', '', 200);
}
add_action('admin_menu', 'surmetric_create_settings_page');

//creates settings page
function surmetric_get_settings_content() {
	include 'settings_page.php';
}

//registers survey taking widget
function surmetric_register_widget() {
	register_widget('Surmetric_Survey_Widget');
}
add_action('widgets_init', 'surmetric_register_widget');

//creates shortcode for surveys
function surmetric_get_survey_shortcode() {
	$json = array();
	$campaign_id = get_option('surmetric_campaign_id', '');
	$json['color'] = get_option('surmetric_font_color', '#000000');
	$json['background'] = get_option('surmetric_background_color', '#ffffff');
	$json['shadow'] = filter_var(get_option('surmetric_box_shadow', 'false'), FILTER_VALIDATE_BOOLEAN);
	$json['mutedColor'] = get_option('surmetric_muted_color', '#000000');
	$json['fontSize'] = get_option('surmetric_font_size', '16') . "px";

	$html = "<div class='sophware-survey' data-uid='";
	$html .= $campaign_id;
	$html .= "' data-style='" . json_encode($json) . "'>";
	$html .= "</div>";
	return $html;
}
add_shortcode('survey', 'surmetric_get_survey_shortcode');

//adds dashboard summary
function surmetric_create_dashboard_summary_widget() {
	wp_add_dashboard_widget('summary-widget', 'Your Survey Summary', 'surmetric_get_dashboard_summary_content');
}
add_action('wp_dashboard_setup', 'surmetric_create_dashboard_summary_widget');

//adds iframe script
function surmetric_add_iframe() {
	wp_enqueue_script('surmetric_main_script', plugins_url('load_iframe.js', __FILE__));
}
add_action('wp_enqueue_scripts', 'surmetric_add_iframe');
