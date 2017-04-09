<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_full_page_classes' ) ) {

	/**
	 * Full page classes.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_full_page_classes() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_page_sidebar_classes' ) ) {

	/**
	 * Page with sidebar classes.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_page_sidebar_classes() {
		return 'col-md-8';
	}
}

if ( ! function_exists( 'odin_sidebar_classes' ) ) {

	/**
	 * Sidebar classes.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_sidebar_classes() {
		return 'widget-area col-md-4 hidden-xs';
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 *
	 * @return void
	 */
	function odin_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'odin' ) . ' </span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date"><i class="icon icon-calendar"></i> <time class="entry-date" datetime="%s">%s</time></span></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ));
	}
}

if ( ! function_exists( 'odin_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 *
	 * @return void
	 */
	function odin_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo odin_pagination( $mid, $end, false );
	}
}
