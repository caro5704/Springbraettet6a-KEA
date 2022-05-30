<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">

	<?php
		// Start bufferization to compute all dynamic CSS styles to show it before <body>
		// OhioBuffer::start_content_bufferization();

		wp_head();
	?>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'parts/elements/preloader' ); ?>
	<?php get_template_part( 'parts/headers/elements-bar' ); ?>
	<?php if ( OhioOptions::get_global('page_custom_cursor') == true ): ?>
		<div class="circle-cursor circle-cursor-outer"></div>
		<div class="circle-cursor circle-cursor-inner">
			<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.06055 0H20.0605V18H17.0605V5.12155L2.12132 20.0608L0 17.9395L14.9395 3H2.06055V0Z"/></svg>
		</div>
	<?php endif; ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'ohio' ); ?></a>
		<?php if ( OhioOptions::get( 'page_use_boxed_wrapper', false ) ) : ?>
		<div class="boxed-container">
		<?php endif; ?>

		<?php if ( !OhioHelper::is_optimized_flow( 'header' ) ): ?>

		<?php get_template_part( 'parts/headers/subheader' ); ?>

		<?php
			$header_menu_style = OhioOptions::get( 'page_header_menu_style', 'style1' );
			$show_header = OhioOptions::get( 'page_header_visibility', true ) && !OhioSettings::page_is( 'for_builder' ) && !OhioSettings::is_coming_soon_page();
			$append_header_cap = OhioOptions::get( 'page_header_add_cap', true );
			$append_subheader = OhioSettings::subheader_is_displayed();
			$show_search = OhioOptions::get( 'page_header_search_visibility', true ) && !OhioSettings::is_coming_soon_page();
			$mobile_menu = OhioOptions::get_global( 'page_mobile_menu_initial_resolution' ); 
			$header_cap_class = '';


			if ( $header_menu_style == 'style3' ) {
				$header_cap_class .= ' header-2';
			}
			if ( $append_subheader ) {
				$header_cap_class .= ' subheader_included';
			}

			if ( $show_header ) {
				switch ( $header_menu_style ) {
					case 'style1' :
						get_template_part( 'parts/headers/header', 'style-1' );
						break;
					case 'style2' :
						get_template_part( 'parts/headers/header', 'style-2' );
						break;
					case 'style3' :
						get_template_part( 'parts/headers/header', 'style-3' );
						break;
					case 'style4' :
						get_template_part( 'parts/headers/header', 'style-4' );
						break;
					case 'style5' :
						get_template_part( 'parts/headers/header', 'style-5' );
						break;
					case 'style6' :
						get_template_part( 'parts/headers/header', 'style-6' );
						break;
					case 'style7' :
						get_template_part( 'parts/headers/header', 'style-7' );
						break;
					default :
						get_template_part( 'parts/headers/header', 'style-1' );
						break;
				}
			}
		?>

		<?php if ( $show_search ) : ?>
		<div class="clb-popup search-popup">
			<div class="close-bar">
				<button class="icon-button -light" aria-label="close">
				    <i class="icon">
				    	<svg class="default" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z"></path></svg>
				    	<svg class="minimal" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 0.244806C16.0816 0.571215 16.0816 1.10043 15.7552 1.42684L1.42684 15.7552C1.10043 16.0816 0.571215 16.0816 0.244806 15.7552C-0.0816021 15.4288 -0.0816021 14.8996 0.244806 14.5732L14.5732 0.244806C14.8996 -0.0816019 15.4288 -0.0816019 15.7552 0.244806Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 15.7552C15.4288 16.0816 14.8996 16.0816 14.5732 15.7552L0.244807 1.42684C-0.0816013 1.10043 -0.0816013 0.571215 0.244807 0.244806C0.571215 -0.0816021 1.10043 -0.0816021 1.42684 0.244806L15.7552 14.5732C16.0816 14.8996 16.0816 15.4288 15.7552 15.7552Z"></path></svg>
				    </i>
				</button>
			</div>
			<div class="holder">
				<?php
				$search_type = OhioSettings::get('page_header_search_type', 'global');
				if ($search_type == 'woo') {
					if (function_exists('get_product_search_form')) {
						get_product_search_form( true );
					} else {
						get_search_form();
					}
				} else {
					get_search_form();
				}
				?>
			</div>
		</div>
		<?php endif; ?>

		<?php endif; ?>

		<?php if ( isset( $header_menu_style ) && $header_menu_style == 'style6' ) : ?>
		<div class="content-right">
		<?php endif; ?>

		<div id="content" class="site-content" data-mobile-menu-resolution="<?php echo esc_attr(isset($mobile_menu) ? $mobile_menu : ''); ?>">

			<?php if ( isset( $show_header ) && $append_header_cap && $show_header ) : ?>
			<div class="header-cap<?php echo esc_attr( $header_cap_class ); ?>"></div>
			<?php endif; ?>