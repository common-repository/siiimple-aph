<?php
// Action: admin_enqueue_scripts
function iiiaph_admin_enqueue_scripts() {
	wp_register_style( 'iiiaph_admin_dashboard', esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/css/admin.css' );
	wp_enqueue_style( 'iiiaph_admin_dashboard' );
	if ( $GLOBALS['title'] != 'Tableau de bord' ) : return; endif;
	$GLOBALS['title'] =  __( 'Espace pro' );
}
add_action( 'admin_enqueue_scripts', 'iiiaph_admin_enqueue_scripts' );

// Action: admin_head
function iiiaph_admin_head() {
	$current_user = wp_get_current_user();
	$current_user_name = $current_user->user_login;
    if ( ( $current_user_name != 'francoisdubois' ) && ( $current_user_name != 'marcdubois' ) ) :
		add_filter( 'pre_option_update_core', '__return_null' );
		add_filter( 'pre_site_transient_update_core', '__return_null' );
		add_filter( 'pre_site_transient_update_plugins', '__return_null' );
		remove_action( 'load-update-core.php', 'wp_update_plugins' );
        remove_action( 'admin_notices', 'update_nag',3);
		remove_submenu_page( 'index.php', 'update-core.php' );
		if ( ! current_user_can( 'manage_options' ) ) : remove_menu_page( 'edit-comments.php' ); endif;
		remove_menu_page( 'edit.php?post_type=blocks' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'vc-welcome' );
		if ( ! current_user_can( 'manage_options' ) ) : remove_menu_page( 'wpcf7' ); endif;
	endif;
}
add_action( 'admin_head', 'iiiaph_admin_head', 1 );

// ACtion: admin_footer_text
function iiiaph_admin_footer_text() {
	echo __( 'Merci de faire confiance à Siiimple pour développer votre activité.' );
}
add_filter( 'admin_footer_text', 'iiiaph_admin_footer_text' );

// Action: user_register
function iiiaph_user_register( $user_id ) {
    $args = array( 'ID' => $user_id, 'admin_color' => 'midnight' );
    wp_update_user( $args );
}
add_action( 'user_register', 'iiiaph_user_register' );

// Action: wp_before_admin_bar_render
function iiiaph_wp_before_admin_bar_render() {  
    global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' ); 
    $wp_admin_bar->remove_menu( 'new-content' );
	$wp_admin_bar->remove_menu( 'wp-logo' );
	if ( in_array( 'wordpress-seo/wp-seo.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : $wp_admin_bar->remove_menu( 'wpseo-menu' ); endif;
}  
add_action( 'wp_before_admin_bar_render', 'iiiaph_wp_before_admin_bar_render' );

// Action: wp_dashboard_setup
function iiiaph_wp_dashboard_setup() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );
	wp_add_dashboard_widget( 'iiiaph_wp_dashboard_widget', 'Ressources en ligne', 'iiiaph_dashboard_customer_support');
}
add_action( 'wp_dashboard_setup', 'iiiaph_wp_dashboard_setup', 999 );
remove_action( 'welcome_panel', 'wp_welcome_panel' );

// Dashboard customer support
function iiiaph_dashboard_customer_support() {
	echo '<p>Pour toute question ou précision, n&rsquo;hésitez pas à <a href="https://www.siiimple.fr/wp-login.php" target="_blank">contacter Siiimple</a>.</p>';
	$title = 'Tutoriels WordPress et procédures pas à pas'; 
	echo '<div class="rss-widget">';
		echo '<b>' . $title . '</b>';
		echo '<hr style="border: 0; background-color: #eee; height: 1px;">';
		echo '<ul>';
			echo '<li>';
				echo '<a href="https://www.siiimple.fr/tutoriel/google-sheets/comment-completer-un-fichier-import-google-sheets/" target="_blank" title="Compléter le fichier d’import de vos produits">Compléter le fichier d’import de vos produits ></a>';
				echo '<br />';
				echo 'Pour importer ou mettre à jour de nombreux produits simultanément dans le catalogue de votre APH, il est nécessaire d’utiliser un fichier CSV.';
			echo '</li>';
	echo '<li>';
				echo '<a href="https://www.siiimple.fr/tutoriel/wordpress/woocommerce/ajouter-des-produits-par-lot-a-un-catalogue-woocommerce/" target="_blank" title="Ajouter des produits par lot à votre catalogue">Ajouter des produits par lot à votre catalogue ></a>';
				echo '<br />';
				echo 'Il est possible d’ajouter très facilement des centaines de produits au catalogue de votre APH en quelques clics.';
			echo '</li>';
		echo '</ul>';
	echo '</div>';
}