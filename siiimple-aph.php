<?php
/*
Plugin Name:	Siiimple APH
Plugin URI:		https://www.siiimple.fr/ressources/aph/
Description:	Personnalisation clé-en-main et ressources Siiimple.
Version:		1.0.6
Author:			Siiimple
Author URI:		https://www.siiimple.fr
License:		GPLv3
License URI:	https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:	aph-siiimple
Domain Path:	/languages

Siiimple Plugin
Copyright 2018, Siiimple - contact@siiimple.fr

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! function_exists( 'add_filter' ) ) : header( 'Status: 403 Forbidden' ); header( 'HTTP/1.1 403 Forbidden' ); exit(); endif;

if ( ! defined( 'IIIAPH_PLUGIN_FILE' ) ) : define( 'IIIAPH_PLUGIN_FILE', __FILE__ ); endif;

// Init
require_once( dirname( IIIAPH_PLUGIN_FILE ) . '/includes/init.php' );