<?php
function iiiaph_add_column_to_importer( $options ) {
	$options['_aph_brochure'] = 'Brochure';
	$options['_aph_purchase_order'] = 'Purchase order';
	$options['_product_video'] = 'Product video';
	return $options;
}
add_filter( 'woocommerce_csv_product_import_mapping_options', 'iiiaph_add_column_to_importer' );

function iiiaph_add_column_to_mapping_screen( $columns ) {
	$columns['Brochure'] = '_aph_brochure';
	$columns['Purchase order'] = '_aph_purchase_order';
	$columns['Product video'] = '_product_video';
	return $columns;
}
add_filter( 'woocommerce_csv_product_import_mapping_default_columns', 'iiiaph_add_column_to_mapping_screen' );

function iiiaph_pre_process_import( $object, $data ) {
	$object->update_meta_data( '_aph_brochure', $data['_aph_brochure'] );
	$object->update_meta_data( '_aph_purchase_order', $data['_aph_purchase_order'] );
	return $object;
}
add_filter( 'woocommerce_product_import_pre_insert_product_object', 'iiiaph_pre_process_import', 10, 2 );

function iiiaph_post_process_import( $object, $data ) {
	$wc_productdata_options = get_post_meta( get_queried_object_id(), 'wc_productdata_options', true );
	$previous_video = $wc_productdata_options[0]['_product_video'];
	$wc_productdata_options[0]['_product_video'] = $data['_product_video'];
	update_post_meta( $object->get_id(), 'wc_productdata_options', $wc_productdata_options, $previous_video );
}
add_action( 'woocommerce_product_import_inserted_product_object', 'iiiaph_post_process_import', 99, 2 );