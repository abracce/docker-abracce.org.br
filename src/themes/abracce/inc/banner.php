<?php
$post_args = array(
	'post_status'    => 'publish',
	'post_type'      => array('banners'),
	'posts_per_page' => 5,
);

query_posts($post_args);

if(have_posts()):
global $wp_query;
$total = $wp_query->post_count;
?>
<!-- #banner -->
<section id="banner">

	<div class="bg-full">

		<div class="main-container">

			<div class="row">

				<div class="col-md-12">

					<h1 class="description"><?php bloginfo( 'description' ); ?></h1>

					<div id="carousel-banner" class="carousel slide" data-ride="carousel">

						<?php if($total > 1) : $i = 0; ?>
						<ol class="carousel-indicators">
			            	<?php while(have_posts()): the_post(); ?>
			            		<?php $cls = ($i==0) ? ' active' : ''; ?>
								<li data-target="#carousel-banner" data-slide-to="<?php echo $i ?>" data-container="body" title="<?php the_title() ?>" class="<?php echo $cls ?> tips"></li>
			        		<?php $i++; endwhile; ?>
						</ol>
						<?php endif; ?>

						<div class="carousel-inner">

							<?php
							$i = 0;
							while(have_posts()): the_post();
								$cls = ($i==0) ? ' active' : '';

								$thumb_id = get_post_thumbnail_id();
								$image    = wp_get_attachment_url( $thumb_id, 'full' );

								$texto   = get_post_meta( get_the_ID(), 'banner_texto', true );
							?>
							<div class="item<?php echo $cls ?>" style="background-image: url('<?php echo $image ?>')">
								<div class="caption">
									<h2><?php the_title() ?></h2>

									<?php if(!empty($texto)): ?>
										<p><?php echo $texto ?></p>
									<?php endif; ?>
								</div>
							</div>
							<?php $i++; endwhile; ?>

						</div>


						<?php if($total > 1) : ?>
						<a class="left arrows" href="#carousel-banner" role="button" data-slide="prev">
							<span class="icon icon-chevron-left"></span>
						</a>
						<a class="right arrows" href="#carousel-banner" role="button" data-slide="next">
							<span class="icon icon-chevron-right"></span>
						</a>
						<?php endif; ?>

					</div>
				</div>

			</div>

		</div>

	</div>

</section>
<!-- /#banner -->

<div class="clearfix"></div>

<?php
endif;
wp_reset_query();

