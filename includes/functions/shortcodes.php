<?php
if ( ! shortcode_exists( 'fnaph_feeds' ) ) :
	function iiiaph_fnaph_feeds() {
		include_once( ABSPATH . WPINC . '/feed.php' );
		$fnaph_feeds = array();
		if ( get_option( 'iiiaph_fnaph_news' ) ) : $fnaph_feeds[] = 'https://www.fnaph.fr/actualites?format=feed&type=rss'; endif;
		if ( get_option( 'iiiaph_ffnaph_tours' ) ) : $fnaph_feeds[] = 'https://www.fnaph.fr/voyages-vacances/voyages-inter-amicales?format=feed&type=rss'; endif;
		if ( get_option( 'iiiaph_fnaph_ticketing' ) ) : $fnaph_feeds[] = 'https://www.fnaph.fr/billeterie?format=feed&type=rss'; endif;
		$nb_feeds = count( $fnaph_feeds );
		if ( $nb_feeds == 0 ) : return; endif;
		$span = 12 / $nb_feeds;
		if ( $nb_feeds == 1 ) : $height = 333; else : $height = 666 / $nb_feeds; endif;
		$max_items = 0;
		$cols = '';
		ob_start();
		foreach ( $fnaph_feeds as $fnaph_feed ) :
			$rss = fetch_feed( $fnaph_feed );
			if ( ! is_wp_error( $rss ) ) : 
				$max_items = $rss->get_item_quantity( 1 );
				$rss_items = $rss->get_items( 0, $max_items );
				$rss_title = $rss->get_title();
				if ( strpos( $rss_title, 'Actualités' ) !== false ) :
					$anchor = 'Lire l&rsquo;article';
					$bg = esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/img/actualite-fnaph.jpg';
					$bg_overlay = 0.27;
					$css = 'news';
					$lead = 'Relayez l&rsquo;actualité de la FNAPH';
				elseif ( strpos( $rss_title, 'Voyages Inter-Amicales' ) !== false ) :
					$anchor = 'Voir le voyage';
					$bg = esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/img/voyage-inter-amicales.jpg';
					$bg_overlay = 0.09;
					$css = 'tours';
					$lead = 'Encouragez les voyages entre amicales';
				elseif ( strpos( $rss_title, 'Billetterie' ) !== false ) :
					$anchor = 'Voir l&rsquo;offre';
					$bg = esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/img/billeterie-fnaph.jpg';
					$bg_overlay = 0.09;
					$css = 'ticketing';
					$lead = 'Faîtes bénéficier des tarifs FNAPH';
				endif;
			endif;
			if ( $max_items != 0 ) :
				foreach ( $rss_items as $rss_item ) :
					$text_box = '[text_box width="79" position_y="85" animate="fadeInLeft" text_align="left"]<h3><strong>' . $rss_item->get_title() . '</strong></h3><p class="lead">' . $lead . '</p><a href="' . esc_url( $rss_item->get_permalink() ) . '" rel="nofollow noopener" target="_blank" class="button fnaph-' . $css . ' is-fnaph is-large" style="border-radius:99px;"><span>' . $anchor . '</span></a>[/text_box]';
					$banner = '[ux_banner height="' . $height . 'px" bg="' . $bg . '" bg_size="medium" bg_overlay="rgba(0, 0, 0, ' . $bg_overlay . ')" hover="zoom"]' . $text_box . '[/ux_banner]';
				endforeach;
			endif;
			$cols .= '[col_grid span="' . $span . '" span__sm="15"]' . $banner . '[/col_grid]';
		endforeach;
		$banner_grid = do_shortcode( '[ux_banner_grid height="' . $height . '" depth="1"]' . $cols . '[/ux_banner_grid]' );
		ob_end_clean();
		return $banner_grid;
	}
	add_shortcode( 'fnaph_feeds', 'iiiaph_fnaph_feeds' );
endif;

if ( ! shortcode_exists( 'cta_button' ) ) :
	function iiiaph_cta_button() {
		$aph_brochure = get_post_meta( get_queried_object_id(), '_aph_brochure', true );
		$aph_purchase_order = get_post_meta( get_queried_object_id(), '_aph_purchase_order', true );
		$purchase_order_link = '#aph-form-link';
		$target='_self';
		if ( strpos( $aph_brochure, 'http' ) !== false ) :
			$brochure_link = $aph_brochure; $target = '_blank';
		elseif ( ! empty( $aph_brochure ) ) :
			global $wpdb;
    		$brochure_attachment = $wpdb->get_col( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_name='%s';", $aph_brochure ) );
            $brochure_link = $brochure_attachment[0]; $target = '_blank';
		endif;
		if ( ! empty( $brochure_link ) ) : echo '<a href="' . esc_url( $brochure_link ) . '" target="' . $target . '" class="button" style="border-radius:99px;"><span>Brochure</span></a>'; endif;
		if ( strpos( $aph_purchase_order, 'http' ) !== false ) :
			$purchase_order_link = $aph_purchase_order; $target = '_blank';
		elseif ( ! empty( $aph_purchase_order ) ) :
			global $wpdb;
    		$purchase_order_attachment = $wpdb->get_col( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_name='%s';", $aph_purchase_order ) );
            $purchase_order_link = $purchase_order_attachment[0]; $target = '_blank';
		endif;
		echo '<a href="' . esc_url( $purchase_order_link ) . '" target="' . $target . '" class="button alert is-alert" style="border-radius:99px;"><span>Bon de commande</span></a>';
	}
	add_shortcode( 'cta_button', 'iiiaph_cta_button' );
endif;