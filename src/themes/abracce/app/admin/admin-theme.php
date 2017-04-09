<?php

class KR_Admin_Theme {

	public function __construct() {

		add_action( 'admin_head', array( $this, 'kr_disable_admin_color_scheme' ) );
		add_action( 'personal_options', array( $this,'kr_remove_personal_options') );
		add_action( 'admin_enqueue_scripts', array( $this, 'kr_admin_enqueue_assets' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'kr_login_enqueue_assets' ) );
		add_action( 'admin_bar_menu', array( $this, 'visite_site_admin_bar_menu'), 1000 );
		add_filter( 'get_user_option_screen_layout_dashboard', array( $this, 'kr_so_screen_layout_dashboard' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'kr_custom_dashboard_widgets') );
		add_action( 'wp_before_admin_bar_render', array($this, 'kr_admin_adminbar_remove_logo') );

		add_filter( 'admin_footer_text', array($this, 'kr_admin_custom_footer' ) );

		add_filter( 'login_headerurl', array($this, 'kr_admin_logo_url' ) );
		add_filter( 'login_headertitle', array($this, 'kr_admin_logo_title' ) );
		remove_action( 'welcome_panel', 'wp_welcome_panel');

	}

	public function kr_disable_admin_color_scheme() {
		global $_wp_admin_css_colors;
		$_wp_admin_css_colors = 0;
	}

	public function kr_remove_personal_options() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#your-profile .form-table:first, #your-profile h3:first").remove();
		});
	</script>
	<?php
	}

	/**
	 * Custom admin style
	 */
	public function kr_admin_enqueue_assets() {
		wp_enqueue_style( 'vr-admin', ADMIN_THEME_URL . '/assets/css/admin.css', array(), null, 'all' );
	}

	/**
	 * Custom login style
	 */
	public function kr_login_enqueue_assets() {
		wp_enqueue_style( 'vr-login', ADMIN_THEME_URL . '/assets/css/login.css' );
	}

	public function visite_site_admin_bar_menu() {
	    global $wp_admin_bar;

	    if ( !is_super_admin() || !is_admin_bar_showing() )
	        return;

	    $wp_admin_bar->add_menu(
	    	array(
				'id'    => 'site-name',
				'title' => 'Visitar site',
				'href'  => get_home_url(),
				'meta'  => array( 'title' => 'Visitar site',  'target' => '_blank' )
			)
		);
	}

	// Trend dashboard widgets
	public function kr_custom_dashboard_widgets() {
		global $wp_meta_boxes;
		// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

		// Yoast's SEO Plugin Widget
		remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );

		// add custom dashboard widget
		add_meta_box('trend_dashboard_widget', 'Bem vindo!', array($this, 'kr_custom_dashboard_help'), 'dashboard', 'normal', 'high' );
	}

	// custom html to dashboard help
	public function kr_custom_dashboard_help() {
		global $current_user, $support;
		$user_data = $current_user->data;

		$html  = '<div class="vr-custom-widget">';
			$html .= '<h4>';
			$html .= 'Olá, seja bem vindo(a) <strong>'.$user_data->display_name.'</strong>, esse é o famoso painel admistrativo do Wordpress. ';
			$html .= 'Agora ele é todo seu, divirta-se! <span class="dashicons dashicons-smiley"></span>';
			$html .= '</h4>';
			$html .= '<p>';
				$html .= 'Precisa de ajuda? Entre em contato pelo e-mail: <a href="mailto:'.$support['email'].'">'.$support['email'].'</a> </strong> </a> <br>';
				$html .= 'Se preferir você pode usar o formulário de contato em nosso site clicando <a href="'.$support['link'].'" target="_blank"> <strong> &raquo; aqui &laquo; </strong> </a>';
			$html .= '</p>';
		$html .= '</div>';
		echo $html;
	}


	public function kr_admin_adminbar_remove_logo() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'wp-logo' );
	}


	/**
	 * Custom logo URL.
	 */
	public function kr_admin_logo_url() {
		return home_url();
	}

	/**
	 * Custom logo title.
	 */
	public function kr_admin_logo_title() {
		return get_bloginfo( 'name' );
	}


	/**
	 * WPKraken Custom Footer.
	 */
	public function kr_admin_custom_footer() {
		global $dev_copy;
		echo '<span id="footer-thankyou">&copy;'. date( 'Y' ) . ' - Made with WPKraken theme for <a href="https://br.wordpress.org/">WordPress</a> <span class="dashicons dashicons-heart"></span>' . $dev_copy['admin_footer'];
	}

}

new KR_Admin_Theme;
