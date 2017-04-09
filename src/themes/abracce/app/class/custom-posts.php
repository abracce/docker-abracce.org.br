<?php

/**
 * KR_Custom_Posts
 */
class KR_Custom_Posts extends Odin_Post_Type {

	private $_labels    = array();
	private $_arguments = array();
	private $_dashicon  = 'dashicons-';
	private $_supports  = array( 'title', 'editor', 'thumbnail' );

	private $_slug;
	private $_singular;
	private $_plural;
	private $_rewrite;
	private $_exclude_search;

	public function __construct( $post_slug = null, $singular = null, $plural = null, $supports = array(), $dashicon = 'admin-post', $rewrite = null, $exclude_search = false ) {
		if(empty($post_slug)) {
			echo '<pre>' . print_r( __('The Parameter <code>$post_slug</code> is required!!'), true ) . '</pre>';
			die();
		}
		$this->_slug           = $post_slug;
		$this->_dashicon       = $this->_dashicon . $dashicon;
		$this->_singular       = (!empty($singular)) ? $singular : $this->_slug;
		$this->_plural         = (!empty($plural)) ? $plural : $this->_slug;
		$this->_supports       = (count($supports) > 0) ? $supports : $this->_supports;
		$this->_rewrite        = (!empty($rewrite)) ? array('slug' => $rewrite) : array('slug' => $this->_slug);
		$this->_exclude_search = $exclude_search;
		$this->kr_init();
	}

	private function kr_init() {
		parent::__construct( $this->_slug, $this->_slug );
		$this->kr_set_labels();
		$this->kr_set_arguments();

		$this->set_labels($this->_labels); # odin method set_labels
		$this->set_arguments($this->_arguments); # odin method set_arguments

		$this->kr_cleaner();
	}

	private function kr_set_labels() {
		$this->_labels = array(
			'name'               => $this->_plural,
			'singular_name'      => $this->_singular,
			'menu_name'          => $this->_plural,
			'all_items'          => $this->_plural,
			'add_new'            => 'Adicionar Novo',
			'add_new_item'       => 'Adicionar Novo',
			'search_items'       => 'Buscar',
			'not_found'          => 'Nada encontrado',
			'not_found_in_trash' => 'Nada encontrado na lixeira',
		);
	}

	private function kr_set_arguments() {
		$this->_arguments = array(
			'supports'            => $this->_supports,
			'menu_icon'           => $this->_dashicon,
			'rewrite'             => $this->_rewrite,
			'exclude_from_search' => $this->_exclude_search,
			// 'menu_position'       => '1.36',
			'capability_type'     => 'page',
		);
	}

	private function kr_cleaner() {
		unset($this->_slug);
		unset($this->_dashicon);
		unset($this->_singular);
		unset($this->_plural);
		unset($this->_supports);
		unset($this->_exclude_search);
		unset($this->_rewrite);
		unset($this->_labels);
		unset($this->_arguments);
	}

} # End Class KR_Custom_Posts
