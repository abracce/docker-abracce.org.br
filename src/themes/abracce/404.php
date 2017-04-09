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

    	<div class="page-title">

			<div class="main-container">
				<h1>Erro 404</h1>
    		</div>

    	</div>

    	<div class="clearfix"></div>

		<div class="main-container">

	    	<div class="row">

	    		<div class="col-md-12">

	    			<div class="the-content text-center">

	    				<div class="jumbotron">
		    				<h1>Oops, erro 404...</h1>
		    				<p>A página que você tentou acessar não foi localizada ou não existe.</p>

							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<hr>
									<a href="<?php echo home_url() ?>" class="btn btn-success btn-block">
										<i class="icon icon-home"></i>
										Voltar para página inicial
									</a>
								</div>
							</div>
						</div>

	    			</div>

	    		</div>

			</div>

    	</div>

    </section>
    <!-- /#main-content -->

<?php
get_footer();
