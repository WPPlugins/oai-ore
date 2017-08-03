<?php

/*
OAI-ORE Resource Map
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
*/

require_once ('../../../wp-config.php');

header('Content-Type: application/atom+xml; charset=' . get_option('blog_charset'), true);

$remUrl = get_bloginfo('wpurl') . '/wp-content/plugins/oai-ore/rem.php';

echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . ">\n"; 
?>
<feed xmlns="http://www.w3.org/2005/Atom"
      xmlns:grddl="http://www.w3.org/2003/g/data-view#"
      grddl:transformation="http://www.openarchives.org/ore/atom-grddl.xsl"
      xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
      xmlns:dc="http://purl.org/dc/elements/1.1/"
      xmlns:dcterms="http://purl.org/dc/terms/">

	<id><?php bloginfo('url'); ?></id>
	<link rel="self" type="application/atom+xml" href="<?php echo $remUrl; ?>" />
	<category scheme="http://www.openarchives.org/ore/terms/" term="http://www.openarchives.org/ore/terms/ResourceMap" label="Resource Map" />
	<link rel="describes" href="<?php echo $remUrl; ?>#aggregation" />
	<title type="text">Resource Map <?php echo $remUrl; ?></title>
	<author>
		<name><?php echo get_bloginfo('name'); ?></name>
		<uri><?php echo get_bloginfo('url'); ?></uri>
		<email><?php echo get_bloginfo('admin_email'); ?></email>
	</author>
	<updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT')); ?></updated>
	<dc:title><?php echo get_bloginfo('name'); ?></dc:title>	
	<dcterms:alternative><?php echo get_bloginfo('description'); ?></dcterms:alternative>

<?php foreach(array_merge(get_pages(), get_posts('numberposts=0')) as $post) : setup_postdata($post); ?>

	<entry>
		<id><?php the_permalink() ?></id>
		<link rel="alternate" type="text/html" href="<?php the_permalink_rss() ?>" />
		<title>Aggregated Resource <?php the_permalink_rss() ?></title>
		<updated><?php echo get_post_modified_time('Y-m-d\TH:i:s\Z', true); ?></updated>
		<author>
			<name><?php the_author() ?></name>
<?php $author_url = get_the_author_url(); if ( !empty($author_url) ) : ?>
			<uri><?php the_author_url()?></uri>
<?php endif; ?>
		</author>
		<summary type="html"><?php echo substr(strip_tags($post->post_content), 0, 500); ?>... [first 500 chars]</summary>
		<dc:identifier><?php the_permalink() ?></dc:identifier>
		<dc:title><?php the_title() ?></dc:title>
		<dc:creator><?php the_author() ?></dc:creator>
		<dc:publisher><?php echo get_bloginfo('name') ?></dc:publisher>
		<dc:date><?php echo get_post_modified_time('Y-m-d\TH:i:s\Z', true); ?></dc:date>
		<dc:language><?php echo get_option('rss_language') ?></dc:language>
<?php foreach ( (array) get_the_category() as $cat ) { ?>
		<dc:subject><?php echo $cat->cat_name; ?></dc:subject>
<?php } ?>
	</entry>

<?php endforeach ; ?>

</feed>



