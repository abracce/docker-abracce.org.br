<?php
/**
 * The option init
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

global $KR_Options, $args, $tabs, $sections;

include(dirname( __FILE__ ) . '/kr-options.php');
include(dirname( __FILE__ ) . '/config.php');
include(dirname( __FILE__ ) . '/sections.php');
include(dirname( __FILE__ ) . '/tabs.php');

function kr_framework_options() {
	global $KR_Options, $args, $tabs, $sections;
	$KR_Options = new KR_Options($sections, $args, $tabs);
}

add_action('init', 'kr_framework_options', 0);
