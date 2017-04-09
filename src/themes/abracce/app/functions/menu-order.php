<?php

$menu_custom_posts = array();

$menu_order_pre = array(
	'index.php',
	'separator1',
	'edit.php',
	'edit-comments.php',
	'edit.php?post_type=page',
);

foreach ($kr_modules as $item) {
	$menu_custom_posts[] = 'edit.php?post_type=' . $item;
}

// $menu_custom_posts[] = 'edit.php?post_type=product';
// $menu_custom_posts[] = 'pedidos';
$menu_custom_posts[] = 'poll';

$menu_order_pos = array(
	'separator2',
	'upload.php',
	'plugins.php',
	'users.php',
	'separator-last',
	'themes.php',
	'options-general.php',
);

// $menu_order_pos[] = 'option';
// $menu_order_pos[] = 'edit.php?post_type=shop_order';

$kr_menu_order = array_merge($menu_order_pre, $menu_custom_posts, $menu_order_pos);

/* custom admin menu order */
function kr_custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	global $kr_menu_order;
	return $kr_menu_order;
}

add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'kr_custom_menu_order');
