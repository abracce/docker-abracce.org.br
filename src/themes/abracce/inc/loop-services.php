<?php while(have_posts()): the_post(); ?>

	<!-- #service-<?php the_ID() ?> -->
	<article id="service-<?php the_ID() ?>" <?php post_class('service-item col-md-3'); ?>>

		<div class="service-inner">

			<figure class="service-thumb">
				<a href="<?php the_permalink() ?>"><?php kr_thumb( 450, 230 ); ?></a>
			</figure>

			<div class="service-content text-center">
				<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
				<p><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_content(), 13 ); ?></a></p>
				<a href="<?php the_permalink() ?>" class="btn btn-primary btn-sm">Leia mais</a>
			</div>

		</div>

	</article>
	<!-- /#service-<?php the_ID() ?> -->

<?php
endwhile;
