<?php
/**
 * KR Ajax Poll Widget
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

class KR_Ajax_Poll_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'KR_Ajax_Poll_Widget',
			__('Poll', THEME_FX),
			array('description' => 'Insere enquetes na sidebar')
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

		$title      = apply_filters('KR_Ajax_Poll_Widget_title', $instance['title']);
		$kr_poll_id = apply_filters('KR_Ajax_Poll_Widget_kr_poll_id', $instance['kr_poll_id']);

		echo $before_widget;
		if(!empty($title)) {
			echo $before_title.$title.$after_title;
		}

		include 'views/front-poll-votes.php';

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
		global $wpdb;

		$title      = (isset($instance['title'])) ? $instance['title'] : '';
		$kr_poll_id = (isset($instance['kr_poll_id'])) ? $instance['kr_poll_id'] : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_name('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_name('kr_poll_id'); ?>">Enquete:</label>
			<select name="<?php echo $this->get_field_name('kr_poll_id'); ?>" id="<?php echo $this->get_field_id('kr_poll_id'); ?>">
				<option value=""> -- Selecione -- </option>
				<?php
				$query   = "SELECT * FROM {$wpdb->prefix}kr_poll_questions WHERE question_status = '2' ORDER BY id DESC";
				$results = $wpdb->get_results( $query );
				if($results) {
					foreach ($results as $poll) {
						$selected = (esc_attr($kr_poll_id) == $poll->id) ? 'selected' : '';
						echo '<option value="'.$poll->id.'" '.$selected.'>'.$poll->question_title.'</option>';
					}
				}
				?>
			</select>
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

		$instance['title']   = (!empty($new_instance['title']) ? strip_tags( $new_instance['title']):'');
		$instance['kr_poll_id'] = (!empty($new_instance['kr_poll_id']) ? strip_tags( $new_instance['kr_poll_id']):'');

		return $instance;
	}

}

/**
 * Action: widgets_init
 */
function kr_ajax_poll_widgets_init() {
	register_widget('KR_Ajax_Poll_Widget');
}
add_action( 'widgets_init', 'kr_ajax_poll_widgets_init' );
