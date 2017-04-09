<?php
/**
 * Template name: Notícias
 *
 * @package WPKraken
 * @since 3.2.0
 */

get_header(); ?>

	<!-- #main-content -->
    <section id="main-content">

    	<div class="page-title">

			<div class="main-container">
				<h1>Notícias</h1>
    		</div>

    	</div>

    	<div class="clearfix"></div>

    	<div id="video-wrapper"></div>

		<div class="main-container">

	    	<div class="row">

	    		<div class="col-md-8">

	    			<div class="the-content">
						<?php if(have_posts()): ?>

		    				<div class="noticias">
		    					<?php get_template_part( 'inc/loop' ); ?>
		    				</div>

		    				<div class="clearfix"></div>

		    				<?php echo odin_paging_nav(); ?>

		    			<?php else: ?>

		    				<?php get_template_part( 'inc/no-search' ); ?>

		    			<?php endif; ?>

	    			</div>

	    		</div>

	    		<?php get_sidebar() ?>

			</div>

    	</div>

    </section>
    <!-- /#main-content -->

<?php
get_footer();
