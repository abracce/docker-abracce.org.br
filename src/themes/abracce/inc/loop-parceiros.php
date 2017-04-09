<?php while(have_posts()): the_post(); ?>

	<!-- #parceiro-<?php the_ID() ?> -->
	<article id="parceiro-<?php the_ID() ?>" <?php post_class('col-md-6 col-xs-12'); ?>>
		<?php $link = get_post_meta( get_the_ID(), 'parceiro_link', true ); ?>

		<figure class="parceiro-thumb">

			<?php if($link): ?>
			<a href="<?php echo $link ?>" target="_blank" title="<?php the_title() ?>">
			<?php endif; ?>

				<?php
				$thumb_id = get_post_thumbnail_id();
				$image    = wp_get_attachment_url( $thumb_id, 'full' );
				?>
				<img src="<?php echo $image ?>" title="<?php the_title() ?>" class="img-responsive" alt="logo parceiro <?php the_title() ?>">

			<?php if($link): ?>
			</a>
			<?php endif; ?>

		</figure>

	</article>
	<!-- /#parceiro-<?php the_ID() ?> -->

<?php
endwhile;
