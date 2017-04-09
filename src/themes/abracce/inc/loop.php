<?php while(have_posts()): the_post(); ?>

	<!-- #post-<?php the_ID() ?> -->
	<article id="post-<?php the_ID() ?>" <?php post_class('row'); ?>>

		<figure class="post-thumb col-md-4">
			<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
				<?php kr_thumb( 320, 260, 'img-responsive' ); ?>
			</a>
		</figure>

		<div class="post-content col-md-8">
			<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
			<span class="date"><em><?php the_time( get_option( 'date_format' ) ); ?></em></span>
			<p><?php echo wp_trim_words( get_the_content(), 56 ); ?> <a href="<?php the_permalink() ?>">[Leia mais]</a></p>
		</div>

	</article>
	<!-- /#post-<?php the_ID() ?> -->

<?php
endwhile;
