<?php

/*
Plugin Name: OAI-ORE Resource Map
Plugin URI: http://lackoftalent.org/michael/blog/ore-wordpress-plug-in/
Description: Implements OAI-ORE 0.1 specification, providing a resource map of an aggregation of all posts within a WP instance.  Resource map is valid Atom, and may be mapped to RDF via GRDDL.
Version: 0.2
Author: Michael J. Giarlo
Author URI: http://purl.org/net/leftwing/blog

OAI-ORE Server for Wordpress
Copyright (C) 2007  Michael J. Giarlo (leftwing@alumni.rutgers.edu)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

HISTORY:
Version: 0.1, 2007-12-14 [Michael J. Giarlo]
Version: 0.2, 2007-12-15 [Michael J. Giarlo]
*/

add_action('wp_head',    'ore_link');
//add_action('admin_menu', 'ore_admin_menu');

//add_option('ore_someFoo', 'ore-somefoo:', 'A configurable ORE field');
//add_option('ore_someBar', 'ore-somebar:', 'Another configurable ORE field');


function ore_link() {
	echo "	<!-- OAI-ORE -->\n";
	echo '	<link rel="resourcemap" type="application/atom+xml" href="' .
		get_bloginfo('wpurl') .
		'/wp-content/plugins/oai-ore/rem.php"/>' .
		"\n";
}

/* function ore_admin_menu() {
	if ( function_exists('add_options_page') ) {
		add_options_page('OAI-ORE Configuration', 'OAI-ORE', 9, __FILE__, 'ore_manage');
	}
} */

/* function ore_manage() {
	if ( isset($_POST['ore_someFoo']) || isset($_POST['ore_someBar']) ) {
		update_option('ore_someFoo', $_POST['ore_someFoo']);
		update_option('ore_someBar', $_POST['ore_someBar']);
		echo '<div class="updated"><p><strong>Options saved.</strong></p></div>';
	}
	$someFoo = get_option('someFoo');
	$someBar = get_option('someBar');
	echo '<div class="wrap"> ' .
		'<h2>OAI-ORE Options</h2>' .
		'<form name="form1" method="post" action="' . $_SERVER['REQUEST_URI'] . '">' .
		'<fieldset class="options"><legend>Enter in some foo</legend><br/>' .
		'<input type="text" size="75" name="ore_someFoo" ' . 'value="' . $someFoo . '"/>' .
		'<br/>' . 
		'<input type="text" size="75" name="ore_someBar" ' . 'value="' . $someBar . '"/>' .
		'</fieldset>' .
		'<p class="submit">' .
		'<input type="submit" name="Submit" value="Update Options &raquo;" />' .
		'</p>' .
		'</form>' .
		'</div>';
} */
?>