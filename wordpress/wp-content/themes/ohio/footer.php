		</div>

		<?php if ( !OhioHelper::is_optimized_flow( 'footer' ) && !OhioSettings::is_coming_soon_page() ): ?>
			<?php get_template_part( 'parts/elements/footer' ); ?>
		<?php endif; ?>
	</div>

	<?php get_template_part('parts/elements/notification'); ?>

	<?php if ( OhioOptions::get( 'page_header_menu_style', 'style1' ) == 'style6' ) : ?>
	</div>
	<?php endif; ?>

	<?php if ( OhioOptions::get( 'page_use_boxed_wrapper', false ) ) : ?>
	</div>
	<?php endif; ?>

	<div class="clb-popup container-loading custom-popup">
		<div class="close-bar">
			<button class="icon-button -light" aria-label="close">
			    <i class="icon">
			    	<svg class="default" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z"></path></svg>
			    	<svg class="minimal" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 0.244806C16.0816 0.571215 16.0816 1.10043 15.7552 1.42684L1.42684 15.7552C1.10043 16.0816 0.571215 16.0816 0.244806 15.7552C-0.0816021 15.4288 -0.0816021 14.8996 0.244806 14.5732L14.5732 0.244806C14.8996 -0.0816019 15.4288 -0.0816019 15.7552 0.244806Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 15.7552C15.4288 16.0816 14.8996 16.0816 14.5732 15.7552L0.244807 1.42684C-0.0816013 1.10043 -0.0816013 0.571215 0.244807 0.244806C0.571215 -0.0816021 1.10043 -0.0816021 1.42684 0.244806L15.7552 14.5732C16.0816 14.8996 16.0816 15.4288 15.7552 15.7552Z"></path></svg>
			    </i>
			</button>
		</div>
		<div class="clb-popup-holder"></div>
	</div>

	<?php
		$search_position = OhioOptions::get( 'page_header_search_position', 'standard' );
	?>

	<?php if ( $search_position == "fixed" ) : ?>
		<?php get_template_part( 'parts/elements/search' );?>
	<?php endif; ?>

	<?php
		// Some dynamic code place: popups, client JS, snippets...
		OhioLayout::get_footer_buffer_content( true );

		//OhioBuffer::stop_content_bufferization();

		OhioHelper::calculate_custom_fonts_inline();
		OhioLayout::show_shortcodes_inline_css(); // Include collected dynamic CSS to head
		//OhioBuffer::get_content_buffer(); // Return the rest of page code
		wp_footer();

		do_action( 'ohio_additional_page_layout', 10, 0 );
	?>
	</body>
</html>