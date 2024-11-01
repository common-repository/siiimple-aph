<?php
function iiiaph_admin_menu() {
	add_action( 'admin_init', 'iiiaph_register_options' );
	add_menu_page( 'Personnalisation de votre APH', 'APH', 'manage_woocommerce', 'fnaph', 'iiiaph_options', 'dashicons-smiley', 99 );
}
add_action( 'admin_menu', 'iiiaph_admin_menu' );

function iiiaph_options() { ?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Personnalisation de votre APH</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'aph-options' ); ?>
			<?php do_settings_sections( 'aph-options' ); ?>
			<?php if ( ! current_user_can( 'administrator' ) ) : $readonly = 'readonly'; else : $readonly = ''; endif; ?>
			<h2 class="wp-heading-inline">Catalogue de produits</h2>
			<table class="form-table">
				<tr valign="top">
					<?php $gs_products_database = get_option( 'iiiaph_gs_products_database' ); ?>
					<th scope="row">Google Sheets</th>
					<td><input type="text" id="iiiaph_gs_products_database" name="iiiaph_gs_products_database" value="<?php echo esc_url( $gs_products_database ); ?>" <?php echo $readonly; ?> /> <a class="button button-secondary" href="<?php echo esc_url( $gs_products_database ); ?>" target="_blank">Ouvrir</a></td>
				</tr>
				<tr valign="top">
					<?php $cf7_order_form = get_option( 'iiiaph_cf7_order_form' ); ?>
					<th scope="row">ID de bon de commande CF7</th>
					<td><input type="text" id="iiiaph_cf7_order_form" name="iiiaph_cf7_order_form" value="<?php echo $cf7_order_form; ?>" <?php echo $readonly; ?> /></td>
				</tr>
			</table>
			<h2 class="wp-heading-inline">Options de diffusion FNAPH</h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Actualités</th>
					<td><input type="checkbox" id="iiiaph_fnaph_news" name="iiiaph_fnaph_news" value="1" <?php checked( 1, get_option( 'iiiaph_fnaph_news' ), true); ?> /></td>
				</tr>
				<tr valign="top">
					<th scope="row">Voyages inter-amicales</th>
					<td><input type="checkbox" id="iiiaph_ffnaph_tours" name="iiiaph_ffnaph_tours" value="1" <?php checked( 1, get_option( 'iiiaph_ffnaph_tours' ), true); ?> /></td>
				</tr>
				<tr valign="top">
					<th scope="row">Billeterie</th>
					<td><input type="checkbox" id="iiiaph_fnaph_ticketing" name="iiiaph_fnaph_ticketing" value="1" <?php checked( 1, get_option( 'iiiaph_fnaph_ticketing' ), true); ?> /></td>
				</tr>
			</table>
			<h2 class="wp-heading-inline">Suivi et analyse d'audience</h2>
			<table class="form-table">
				<tr valign="top">
					<?php $tracking_id = get_option( 'iiiaph_ga_tracking_id' ); ?>
					<th scope="row">ID de suivi GA</th>
					<td><input type="text" id="iiiaph_ga_tracking_id" name="iiiaph_ga_tracking_id" value="<?php echo $tracking_id; ?>" <?php echo $readonly; ?> /> <a class="button button-secondary" href=" https://analytics.google.com/analytics/web/" target="_blank">Ouvrir</a></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }

function iiiaph_options_capability( $capability ) {
    return 'manage_woocommerce';
}
add_filter( 'option_page_capability_aph-options', 'iiiaph_options_capability' );

function iiiaph_register_options() {
	register_setting( 'aph-options', 'iiiaph_gs_products_database' );
	register_setting( 'aph-options', 'iiiaph_cf7_order_form' );
	register_setting( 'aph-options', 'iiiaph_fnaph_news' );
	register_setting( 'aph-options', 'iiiaph_ffnaph_tours' );
	register_setting( 'aph-options', 'iiiaph_fnaph_ticketing' );
	register_setting( 'aph-options', 'iiiaph_ga_tracking_id' );
}