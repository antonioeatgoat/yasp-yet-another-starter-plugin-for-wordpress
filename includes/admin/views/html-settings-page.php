<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Get the settings page to display
$settings_page = SP_Admin_Settings::get_settings_page();

// Get tabs for the settings page
$tabs = apply_filters( 'sp_settings_tabs', array() );

// Get the current tab
$current_tab = $settings_page->get_id();

?>

<div class="wrap">
	<?php if ( count( $tabs ) > 1 ): ?>
		<nav class="nav-tab-wrapper">
			<?php

			$c = 0;
			foreach ( $tabs as $slug => $label ) {
				$tab_active_class = ( $current_tab === $slug || $current_tab === null && $c ++ == 0 ? 'nav-tab-active' : '' );

				echo '<a href="' . esc_html( admin_url( 'admin.php?page=' . esc_attr( SP_Admin_Settings::SETTINGS_PAGE_SLUG ) . '&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . $tab_active_class . '">' . esc_html( $label ) . '</a>';
			}

			?>
		</nav>
	<?php endif; ?>

	<form method="post" id="st-settings-form" action="options.php" enctype="multipart/form-data">

		<?php

		$settings_page->render_fields();

		submit_button();

		?>

	</form>
</div>