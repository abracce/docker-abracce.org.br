<?php
/**
 * Starter all modules
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

global $kr_modules;
if(count($kr_modules) > 0) {
	foreach ($kr_modules as $_module) {
		if(!empty($_module)) {
			include_once( MODULES_PATH . '/' . $_module . '/init.php' );
		}
	}
}