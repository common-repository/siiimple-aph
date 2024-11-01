<?php
require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/front-end.php' );
require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/shortcodes.php' );
require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/templater.php' );

if ( is_admin() ) :
	require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/dashboard.php' );
	require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/import.php' );
	require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/functions/options.php' );
endif;