<?php
/**
 * Template name: Parceiros
 *
 * @package WPKraken
 * @since 3.2.0
 */

get_header(); ?>

	<!-- #main-content -->
    <section id="main-content">

    	<?php if(have_posts()): ?>
	    	<?php while(have_posts()): the_post(); ?>

		    	<div class="page-title">

					<div class="main-container">
						<h1><?php the_title() ?></h1>
		    		</div>

		    	</div>

		    	<div class="clearfix"></div>

		    	<div id="video-wrapper"></div>

				<div class="main-container">

			    	<div class="row">

			    		<div class="col-md-8">

			    			<div class="the-content">

			    				<?php the_content(); ?>

			    				<div class="clearfix"></div>

								<?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$args = array(
									'post_type'      => array('partners'),
									'posts_per_page' => 18,
									'paged'          => $paged,
								);
								query_posts( $args );
								if(have_posts()):
								?>

				    				<div class="row abracce-parceiros">

				    					<?php get_template_part( 'inc/loop', 'parceiros' ); ?>

					    				<div class="clearfix"></div>

					    				<?php echo odin_paging_nav(); ?>

				    				</div>

				    			<?php else: ?>

				    				<?php get_template_part( 'inc/no-content' ); ?>

				    			<?php endif; ?>
				    			<?php wp_reset_query(); ?>

			    				<div class="clearfix"></div>
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
