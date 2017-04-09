<div class="sidebar col-md-4">

	<aside class="widgets boxes">
		<?php get_search_form(); ?>
	</aside>

	<aside class="widgets boxes">
		<h3 class="box-title">Siga a ABRACCE</h3>
		<div class="box-content">
			<ul class="social">
				<li class="facebook">
					<a href="http://fb.com/Abracce" target="_blank"><i class="icon icon-facebook"></i></a>
				</li>
				<li class="twitter">
					<a href="http://twitter.com/Abracce" target="_blank"><i class="icon icon-twitter"></i></a>
				</li>
				<li class="youtube">
					<a href="http://youtube.com/Abraccepr" target="_blank"><i class="icon icon-youtube-play"></i></a>
				</li>
			</ul>
		</div>
	</aside>

	<?php if(is_page( 'contato' )): ?>

		<aside class="widgets boxes">
			<h3 class="box-title">Fale conosco</h3>

			<p><i class="icon icon-phone-square"></i>&nbsp; Administrativo: (41)3022-4676</p>
			<p><i class="icon icon-phone-square"></i>&nbsp; Clinica: (41)3022-4618</p>
			<address>
				<i class="icon icon-map-marker"></i>&nbsp; R. Capiberibe, 716 - Santa Quitéria, CEP: 80310-170, Curitiba-PR
			</address>
		</aside>

	<?php else: ?>

		<?php
		$args = array(
			'post_type'      => array('post'),
			'posts_per_page' => 3
		);
		query_posts( $args );
		if(have_posts()): ?>
		<aside class="widgets boxes">
			<h3 class="box-title">Últimas notícias</h3>
			<ul class="last-posts">

				<?php while(have_posts()): the_post(); ?>
				<li <?php post_class(); ?>>
					<p>
						<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
							<strong><?php the_title() ?></strong>
							<?php echo wp_trim_words( get_the_content(), 8 ); ?>
						</a>
					</p>
				</li>
				<?php endwhile; ?>

			</ul>
		</aside>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

	<?php endif; ?>

</div>
