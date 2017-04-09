<?php
/**
 * The main template file.
 *
 * @package WPKraken
 * @since 3.2.0
 */

get_header(); ?>

	<?php
	if(is_home()):
		get_template_part( 'inc/banner' );
	endif;
	?>

	<!-- #main-content -->
    <section id="main-content">

		<?php
		$args = array(
			'post_type'      => array('services'),
			'posts_per_page' => 4,
		);
		query_posts( $args );
		if(have_posts()):
		?>

		<div class="services-wrapper">

			<div class="main-container">

				<div class="row">

					<h2 class="col-md-12 services-title">Nossos Serviços</h2>

	    			<?php get_template_part( 'inc/loop', 'services' ); ?>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

		<?php endif; ?>
		<?php wp_reset_query(); ?>

		<div class="main-container">

    		<hr>

	    	<div class="row">

				<div class="boxes col-md-5">
			    	<?php
			    		$page    = get_page_by_path( 'sobre/a-abracce' );
						$content = wp_trim_words( $page->post_content, 36 );
					?>
					<h3 class="box-title"><?php echo $page->post_title ?></h3>

					<div class="box-content">

						<?php
							$thumb_id = get_post_thumbnail_id( $page->ID );
							$resizer  = Odin_Thumbnail_Resizer::get_instance();
							$url      = wp_get_attachment_url( $thumb_id, 'full' );
							$image    = $resizer->process( $url, 480, 320, true );
						?>

						<?php if($image) { ?>
						<figure class="box-thumb">
							<a href="<?php echo get_the_permalink($page->ID) ?>">
								<img src="<?php echo $image ?>" class="img-responsive" alt="imagem de <?php echo $page->post_title ?>">
							</a>
						</figure>
						<?php } ?>

						<?php if(!empty($content)) { ?>
						<div class="box-text">
							<p><?php echo $content ?> <a href="<?php echo get_the_permalink($page->ID) ?>">Leia mais</a></p>
						</div>
						<?php } ?>

					</div>
				</div>

				<div class="boxes col-md-4">
					<h3 class="box-title">Quanto vale um abraço?</h3>
					<div class="box-content">
						<div class="box-video">
							<div class="video-container">
								<iframe width="100%" height="235" src="//www.youtube.com/embed/3wLud3xo4CQ" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>

						<div class="clearfix"></div>

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
				</div>

				<?php
				/*
					$args = array(
						'post_type'      => array('post'),
						'posts_per_page' => 3
					);
					query_posts( $args );
					if(have_posts()): ?>
					<div class="boxes col-md-3">
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
					</div>
					<?php endif; ?>
					<?php wp_reset_query();
				*/
				?>

				<div class="boxes col-md-3">
					<h3 class="box-title">Faça sua doação</h3>
					<?php abracce_form_doacao(); ?>
				</div>

			</div>
		</div>

		<div class="clearfix"></div>

		<br>
		<div class="bg-full">

			<div class="main-container">

				<div class="row">
					<div class="boxes col-md-3">
						<h3 class="box-title">Seja um herói</h3>
						<div class="box-content">
							<div class="box-hero">
								<h2>Faça uma doação</h2>
								<span class="icon-hero">
									<i class="icon icon-heart"></i>
								</span>
								<p>CAIXA ECONÔMICA <br>FEDERAL <br>
									Agência: 3640 <br>
									Conta: 2358-2 <br>
									Operação: 013</p>
							</div>
						</div>
					</div>

					<div class="boxes col-md-4">
						<h3 class="box-title">Fan page</h3>
						<div class="box-content">
							<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FAbracce&amp;width&amp;height=320&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=587056308082131" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:320px; width:100%;" allowTransparency="true"></iframe>
						</div>
					</div>

					<div class="boxes col-md-5">
						<h3 class="box-title">@Abracce</h3>
						<div class="box-content">
							<a class="twitter-timeline" href="https://twitter.com/Abracce" data-widget-id="508273950829187072">Tweets de @Abracce</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
					</div>
				</div>
			</div>

    	</div>

    </section>
    <!-- /#main-content -->

<?php
get_footer();
