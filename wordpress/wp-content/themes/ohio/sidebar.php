<?php
	if ( ! is_active_sidebar( 'sidebar-1' ) ) return;
?>

<div class="vc_col-md-3 page-sidebar">
	<aside id="secondary" class="widgets">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
</div>