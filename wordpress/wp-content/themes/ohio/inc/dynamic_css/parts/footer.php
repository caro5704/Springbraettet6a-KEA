<?php
/*
	Footer custom styles
	
	Table of contents: (use search)
	# 1. Variables
	# 9. View
*/

# 1. Variables
$footer_sitename_typo = false;
$copyright_background = false;

$background_color_css = '';
$background_image_css = '';
$background_text_color_css = '';
$border_color_css = '';
$copyright_background_color_css = '';
$copyright_background_image_css = '';

$background_type = OhioOptions::get( 'page_footer_background_type' );
$background_select_type = OhioOptions::get_last_select_type();

if ( !$background_type ) $background_type = 'color';

$background_color = OhioOptions::get_by_type( 'page_footer_background_color', $background_select_type );

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}

if ( $background_type == 'image' ) {
	$background_image_css = OhioHelper::get_background_image_css_by_type( 'page_footer', $background_select_type );
}

$footer_logo_type = OhioOptions::get( 'page_footer_logo_widget_type', 'light_variant' );
$footer_logo_select_type = OhioOptions::get_last_select_type();

if ( $footer_logo_type == 'sitename' ) {
	$footer_sitename_typo = OhioOptions::get_by_type( 'page_footer_sitename_typo', $footer_logo_select_type );
}

$copyright_background_type = OhioOptions::get( 'page_footer_copyright_section_background_type' );
$copyright_background_select_type = OhioOptions::get_last_select_type();
if ( !$copyright_background_type ) $copyright_background_type = 'color';

$copyright_background_color = OhioOptions::get_by_type( 'page_footer_copyright_section_background_color', $copyright_background_select_type );
if ( $copyright_background_color ) {
	$copyright_background_color_css = 'background-color:' . $copyright_background_color . ';';
}

if ( $copyright_background_type == 'image' ) {
	$copyright_background_image_css = OhioHelper::get_background_image_css_by_type( 'page_footer_copyright_section', $copyright_background_select_type );
}

if ( $background_color_css || $background_image_css ) {
	$_selector = '.site-footer';
	$_css = $background_color_css . $background_image_css;
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $_css );
}

## Footer headlines
$page_footer_widget_title_typo = OhioOptions::get_global( 'page_footer_widget_title_typo' );
$page_footer_widget_title_typo_css = OhioHelper::parse_acf_typo_to_css( $page_footer_widget_title_typo );
if ( $page_footer_widget_title_typo_css ) {
	$_selector = [
		'.site-footer .widget-title'
	];
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $page_footer_widget_title_typo_css );
}

## Footer text
$page_footer_text_typo = OhioOptions::get_global( 'page_footer_text_typo' );
$page_footer_text_typo_css = OhioHelper::parse_acf_typo_to_css( $page_footer_text_typo );
if ( $page_footer_text_typo_css ) {
	$_selector = [
		'.site-footer',
		'.site-footer h6',
		'.site-footer .widgets',
		'.site-footer .button'
	];
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $page_footer_text_typo_css );
}

## Footer links
$page_footer_links_typo = OhioOptions::get_global( 'page_footer_links_typo' );
$page_footer_links_typo_css = OhioHelper::parse_acf_typo_to_css( $page_footer_links_typo );
if ( $page_footer_links_typo_css ) {
	$_selector = [
		'.site-footer a:not(.-unlink):not(.-undash):not(.button)'
	];
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $page_footer_links_typo_css );
}

## Copyright text
$page_footer_copyright_section_text_typo = OhioOptions::get_global( 'page_footer_copyright_section_text_typo' );
$page_footer_copyright_section_text_typo_css = OhioHelper::parse_acf_typo_to_css( $page_footer_copyright_section_text_typo );
if ( $page_footer_copyright_section_text_typo_css ) {
	$_selector = [
		'.site-footer-copyright'
	];
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $page_footer_copyright_section_text_typo_css );
}

## Copyright links
$page_footer_copyright_section_links_color = OhioOptions::get_global( 'page_footer_copyright_section_links_color' );
$page_footer_copyright_section_links_color_css = OhioHelper::parse_acf_typo_to_css( $page_footer_copyright_section_links_color );
if ( $page_footer_copyright_section_links_color_css ) {
	$_selector = [
		'.site-footer-copyright a:not(.-unlink):not(.-undash):not(.button)'
	];
	OhioBuffer::pack_dynamic_css_to_buffer( $_selector, $page_footer_copyright_section_links_color_css );
}