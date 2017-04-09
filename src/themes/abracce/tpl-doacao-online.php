<?php
/**
 * Template name: Doação Online
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

			    		<div class="col-md-12">

			    			<div class="the-content">

			    				<?php the_content(); ?>

			    				<div class="clearfix"></div>

			    				<div class="row abracce-videos">

			    					<div class="col-md-6 col-md-offset-3">
			    						<?php abracce_form_doacao(); ?>
			    					</div>

			    				</div>

			    				<div class="clearfix"></div>
			    			</div>

			    		</div>

					</div>

		    	</div>

    		<?php endwhile; ?>
    	<?php endif; ?>

    </section>
    <!-- /#main-content -->

<?php
get_footer();
