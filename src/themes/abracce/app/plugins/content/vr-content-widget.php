<?php

// Setup actions
add_action('init', array('KRContentWidget', 'init'));
add_action('admin_init', array('KRContentWidget', 'admin_init'));
add_action('plugins_loaded', array('KRContentWidget', 'plugins_loaded'));
add_action('widgets_admin_page', array('KRContentWidget', 'widgets_admin_page'), 100);
add_action('widgets_init', array('KRContentWidget', 'widgets_init'));
// Setup filters
add_filter('KR_Content_Widget_content', 'wptexturize');
add_filter('KR_Content_Widget_content', 'convert_smilies');
add_filter('KR_Content_Widget_content', 'convert_chars');
add_filter('KR_Content_Widget_content', 'wpautop');
add_filter('KR_Content_Widget_content', 'shortcode_unautop');
add_filter('KR_Content_Widget_content', 'prepend_attachment');
add_filter('KR_Content_Widget_content', 'do_shortcode', 11);


/**
 * Content Widget singelton
 */
class KRContentWidget {

	/**
	 * @var string
	 */
	const VERSION = "1.0.0";

	/**
	 * @var string
	 */
	const TEXTDOMAIN = "content";

	/**
	 * Action: init
	 */
	public static function init() {

	}

	/**
	 * Action: admin_init
	 */
	public static function admin_init() {
		wp_register_script(self::TEXTDOMAIN, PLUGINS_URL . '/' . self::TEXTDOMAIN . '/assets/content.js', array('jquery'), self::VERSION);
		wp_enqueue_script(self::TEXTDOMAIN);

		wp_register_style(self::TEXTDOMAIN, PLUGINS_URL . '/' . self::TEXTDOMAIN . '/assets/content.css', array(), self::VERSION);
		wp_enqueue_style(self::TEXTDOMAIN);
	}


	/**
	 * Action: widgets_admin_page
	 */
	public static function widgets_admin_page() {
		?>
		<div id="content-container" style="display: none;">
			<a class="close" href="javascript:KRContentWidget.hideEditor();" title="Fechar"><span class="icon"></span></a>
			<div class="editor">
				<?php
				$settings = array(
					'textarea_rows' => 15
				);
				wp_editor('', 'content', $settings);
				?>
				<p>
					<a href="javascript:KRContentWidget.updateWidgetAndCloseEditor(true);" class="button button-primary">Salvar e fechar</a>
				</p>
			</div>
		</div>
		<div id="content-backdrop" style="display: none;"></div>
		<?php
	}

	/**
	 * Action: widgets_init
	 */
	public static function widgets_init() {
		register_widget('KR_Content_Widget');
	}

}


/**
 * Adds KR_Content_Widget widget.
 */
class KR_Content_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'KR_Content_Widget',
			'Conteúdo',
			array(
				'description' => 'Insere um conteúdo na sidebar'
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		extract( $args );

		$title        = apply_filters('KR_Content_Widget_title', $instance['title']);
		$output_title = apply_filters('KR_Content_Widget_output_title', $instance['output_title']);
		$content      = apply_filters('KR_Content_Widget_content', $instance['content']);

		echo $before_widget;

		if ($output_title == "1" && !empty($title)) {
			echo $before_title.$title.$after_title;
		}

		echo $content;

		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {

		$title   = (isset($instance['title'])) ? $instance['title'] : '';
		$content = (isset($instance['content'])) ? $instance['content'] : '';

		$output_title = (isset($instance['output_title']) && $instance['output_title'] == "1" ? true:false);
		?>
		<input type="hidden" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" value="<?php echo esc_attr($content); ?>">
		<p>
			<label for="<?php echo $this->get_field_name('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('output_title'); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('output_title'); ?>" name="<?php echo $this->get_field_name('output_title'); ?>" value="1" <?php checked($output_title, true) ?>> Exibir título
			</label>
		</p>
		<p>
			<a href="javascript:KRContentWidget.showEditor('<?php echo $this->get_field_id('content'); ?>');">Inserir conteúdo</a>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();

		$instance['title']        = (!empty($new_instance['title']) ? strip_tags( $new_instance['title']):'');
		$instance['content']      = (!empty($new_instance['content']) ? $new_instance['content']:'');
		$instance['output_title'] = (isset($new_instance['output_title']) && $new_instance['output_title'] == "1" ? 1:0);

		return $instance;
	}

}
