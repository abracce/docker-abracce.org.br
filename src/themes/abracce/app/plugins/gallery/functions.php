<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

function kr_gallery_list() {
	global $post;

	$thumb_ids = get_post_meta( $post->ID, 'kr_gallery', true );

	if($thumb_ids):
		$thumb_ids = explode(',', $thumb_ids);
	?>

	<div class="clearfix"></div><!-- /.clearfix -->

	<div id="gallery<?php echo $post->ID ?>" class="gallery-wrapper row">

		<?php foreach ($thumb_ids as $i => $img_id): ?>

			<?php
			$mod   = ($i%4);
			$class = ($mod == 0) ? ' first' : ( ($mod == 3) ? ' last' : '' );

			if(!empty($img_id)) :
				$resizer = Odin_Thumbnail_Resizer::get_instance();
				$url     = wp_get_attachment_url( $img_id, 'full' );
				$image   = $resizer->process( $url, 260, 150, true );
			?>
			<figure class="col-md-3 col-xs-6 gallery-thumb<?php echo $class ?>">
				<a href="<?php echo $url ?>" data-fancybox-group="gallery" class="thumbnail fancybox-gallery">
					<img src="<?php echo $image ?>" alt="gallery image <?php echo $img_id ?>" class="img-responsive" />
				</a>
			</figure>
			<?php endif; ?>

		<?php endforeach; ?>

	</div>

	<div class="clearfix"></div><!-- /.clearfix -->

	<?php endif; // end if is thumb_ids

}

function add_title_attachment_link($link, $id = null) {
	$id         = intval( $id );
	$_post      = get_post( $id );
	$post_title = esc_attr( $_post->post_title );
	return str_replace('<a href', '<a class="fancybox-gallery" data-fancybox-group="gallery" title="'. $post_title .'" href', $link);
}
add_filter('wp_get_attachment_link', 'add_title_attachment_link', 10, 2);


/* Adicionar "lightbox" nos links que contenham imagens */
add_filter('the_content', 'kr_add_lightbox_in_content');
function kr_add_lightbox_in_content($content) {
	global $post;
	$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	@$replacement = '<a$1href=$2$3.$4$5 class="fancybox-gallery" data-fancybox-group="gallery" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
