<?php
/**
 * The page template file.
 *
 * @package WPKraken
 * @since 3.2.0
 */

get_header(); ?>

	<!-- #main-content -->
    <section id="main-content">

    	<?php if(have_posts()): ?>
	    	<?php while(have_posts()): the_post(); ?>

		    	<div class="page-title single-title">

					<div class="main-container">
						<h1><?php the_title() ?></h1>
		    		</div>

		    	</div>

		    	<div class="clearfix"></div>

				<div class="main-container">

			    	<div class="row">

			    		<div class="col-md-8">
			    			<div class="the-content">
								<?php
									$thumb_id = get_post_thumbnail_id( $post->ID );
									$resizer  = Odin_Thumbnail_Resizer::get_instance();
									$url      = wp_get_attachment_url( $thumb_id, 'full' );
									$image    = $resizer->process( $url, 320, 200, true );

									if($image) {
										echo '<a href="'. $url .'" title="'.$post->post_title.'" data-fancybox-group="gallery" class="fancybox-gallery thumbnail alignleft">';
											echo '<img src="'.$image.'" alt="Imagem de '.$post->post_title.'" class="img-responsive">';
										echo '</a>';
									}
								?>

			    				<?php the_content(); ?>

			    				<?php kr_gallery_list(); ?>

			    				<div class="clearfix"></div>

			    				<h3 class="sub-title pull-left">Compartilhe: </h3>
			    				<div class="sharethis-box pull-left">
			    					<?php
									$share = array(
										// 'email'      => 'E-mail',
										'facebook'   => 'Facebook',
										'twitter'    => 'Tweet',
										'linkedin'   => 'LinkedIn',
										'googleplus' => 'Google +',
										// 'pinterest'  => 'Pinterest',
									);
									kr_sharethis( $share );
									?>
			    				</div>

			    				<div class="clearfix"></div>

			    				<hr>

			    				<h3 class="sub-title">Comente</h3>
								<div class="fb-comments" data-href="<?php echo get_the_permalink() ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
			    			</div>
			    		</div>

			    		<?php get_sidebar(); ?>

					</div>

		    	</div>

    		<?php endwhile; ?>
    	<?php endif; ?>

    </section>
    <!-- /#main-content -->

<?php
get_footer();
