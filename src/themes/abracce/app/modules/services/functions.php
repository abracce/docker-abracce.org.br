<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */


function abracce_services_list() {

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
		'post_type'      => array('services'),
		'posts_per_page' => 16,
		'paged'          => $paged,
	);
	query_posts( $args );
	if(have_posts()):

		get_template_part( 'inc/loop', 'services' );

		echo '<div class="clearfix"></div>';
		echo odin_paging_nav();

	endif;
	wp_reset_query();

}
