<?php
/**
 * Template name: Contato
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
						<h1>Localização e Contato</h1>
		    		</div>

		    	</div>

		    	<div class="clearfix"></div>

				<section class="gmap">
					<?php
						$get_address = 'R. Capiberibe, 716 - Santa Quitéria, PR, 80310-170';
						$address   = !empty($get_address) ? $get_address : 'Rua Anita Garibaldi, 2480 - Ahu, Curitiba - PR, 82210-000';
						$odin_map  = '[map';
						$odin_map .= ' id="trendmap"';
						$odin_map .= ' width="100%"';
						$odin_map .= ' height="200"';
						$odin_map .= ' address="'.$address.'"';
						$odin_map .= ' zoom="16"';
						$odin_map .= ' marker="true"';
						// $odin_map .= ' markerimage="'.THEME_URL.'/assets/images/address-map.png"';
						$odin_map .= ' traffic="true"';
						$odin_map .= ' bike="true"';
						$odin_map .= ' scrollwheel="false"]';

						echo do_shortcode( $odin_map );
					?>
				</section>

		    	<div class="clearfix"></div>

				<div class="main-container">

			    	<div class="row">

			    		<div class="col-md-8">

			    			<div class="the-content">

			    				<?php the_content(); ?>

			    				<div class="clearfix"></div>

			    				<?php echo kr_contact_form()->render(); ?>

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
