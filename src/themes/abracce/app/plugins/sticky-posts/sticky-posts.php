<?php

class KR_Sticky_Posts {

	public function __construct() {
		add_action( 'admin_head', array($this, 'kr_sticky_head_script' ) );
		add_action( 'admin_init', array($this, 'kr_sticky_add_meta_box') );
		add_action( 'admin_init', array($this, 'kr_sticky_admin_init' ), 20);
		add_action( 'pre_get_posts', array($this, 'kr_sticky_posts_filter' ) );
	}

	public function kr_sticky_head_script() {
		global $parent_file;

		if ( isset( $_GET['action'] ) && $_GET['action'] == 'edit' && isset( $_GET['post'] ) && $parent_file == 'edit.php') { ?>

			<script>
			jQuery(document).ready(function() {
				var kr_sticky = jQuery('#sticky'),
					sticky = jQuery('#sticky');

				kr_sticky.on('click', function(){
					if(sticky.attr('checked')) {
						sticky.attr('checked', false);
					}
					else {
						sticky.attr('checked', 'checked');
					}
				});
			});
			</script>

		<?php
		}
	}

	public function kr_sticky_description() {
		echo '<p>' . __( 'Enable support for sticky custom post types.', THEME_FX ) . '</p>';
	}

	public function kr_sticky_set_custom_post_types() {
		$post_types = get_post_types( array( '_builtin' => false, 'public' => true ), 'names' );
		if ( ! empty( $post_types ) ) {
			$checked_post_types = $this->kr_sticky_post_types();
			foreach ( $post_types as $post_type ) { ?>
				<div><input type="checkbox" id="<?php echo esc_attr( 'post_type_' . $post_type ); ?>" name="sticky_custom_post_types[]" value="<?php echo esc_attr( $post_type ); ?>" <?php checked( in_array( $post_type, $checked_post_types ) ); ?> /> <label for="<?php echo esc_attr( 'post_type_' . $post_type ); ?>"><?php echo esc_html( $post_type ); ?></label></div><?php
			}
		}
		else {
			echo '<p>' . __( 'No public custom post types found.', THEME_FX ) . '</p>';
		}
	}

	public function kr_sticky_set_post_and_pages() {
		$post_types = get_post_types( array( '_builtin' => true, 'public' => true ), 'names' );
		if ( ! empty( $post_types ) ) {
			$checked_post_types = $this->kr_sticky_post_types();
			foreach ( $post_types as $post_type ) { ?>
				<div><input type="checkbox" id="<?php echo esc_attr( 'post_type_' . $post_type ); ?>" name="sticky_custom_post_types[]" value="<?php echo esc_attr( $post_type ); ?>" <?php checked( in_array( $post_type, $checked_post_types ) ); ?> /> <label for="<?php echo esc_attr( 'post_type_' . $post_type ); ?>"><?php echo esc_html( $post_type ); ?></label></div><?php
			}
		}
		else {
			return;
		}
	}

	public function kr_sticky_filter( $query_type ) {
		$filters = (array) get_option( 'sticky_custom_post_types_filters', array() );

		return in_array( $query_type, $filters );
	}

	public function kr_sticky_admin_init() {
		register_setting( 'reading', 'sticky_custom_post_types' );
		register_setting( 'reading', 'sticky_custom_post_types_filters' );

		add_settings_section( 'kr_sticky_options', __( 'Sticky Custom Post Types', THEME_FX ), array( $this, 'kr_sticky_description' ), 'reading' );

		add_settings_field( 'sticky_custom_post_types', __( 'Show "Stick this..." checkbox on', THEME_FX ), array( $this, 'kr_sticky_set_custom_post_types' ), 'reading', 'kr_sticky_options' );
		add_settings_field( 'sticky_post_and_pages', __( 'Posts and pages', THEME_FX ), array( $this, 'kr_sticky_set_post_and_pages' ), 'reading', 'kr_sticky_options' );
	}

	public function kr_sticky_post_types() {
		$sticky_option = (array) get_option( 'sticky_custom_post_types', array() );
		return $sticky_option;
	}

	public function kr_sticky_meta() { ?>
		<input id="sticky" name="sticky" type="checkbox" value="sticky" <?php checked( is_sticky() ); ?> /> <label for="sticky" class="selectit"><?php _e( 'Stick this to the front page', THEME_FX ) ?></label><?php
	}

	public function kr_sticky_add_meta_box() {
		if( ! current_user_can( 'edit_others_posts' ) )
			return;

		foreach( $this->kr_sticky_post_types() as $post_type )
			add_meta_box( 'kr_sticky_meta', __( 'Sticky', THEME_FX ), array( $this, 'kr_sticky_meta' ), $post_type, 'side', 'high' );
	}

	public function kr_sticky_posts_filter( $query ) {
		if ( $query->is_main_query() && $query->is_home() && ! $query->get( 'suppress_filters' ) && $this->kr_sticky_filter( 'home' ) ) {

			$kr_sticky_post_types = $this->kr_sticky_post_types();

			if ( ! empty( $kr_sticky_post_types ) ) {
				$post_types = array();

				$query_post_type = $query->get( 'post_type' );

				if ( empty( $query_post_type ) ) {
					$post_types[] = 'post';
				}
				elseif ( is_string( $query_post_type ) ) {
					$post_types[] = $query_post_type;
				}
				elseif ( is_array( $query_post_type ) ) {
					$post_types = $query_post_type;
				}
				else {
					return; // Unexpected value
				}

				$post_types = array_merge( $post_types, $kr_sticky_post_types );

				$query->set( 'post_type', $post_types );
			}
		}
	}

}

$sticky_posts = new KR_Sticky_Posts();
