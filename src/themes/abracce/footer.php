<?php
/**
 * The template for displaying the footer.
 *
 * @package WPKrarken
 * @since 3.2.0
 */
?>

		<div class="clearfix"></div><!-- /clearfix -->

		<div class="gototop">
			<a href="#"><i class="icon icon-chevron-up"></i></a>
		</div>

		<!-- .footer -->
		<footer class="footer">
			<span class="line top"></span>

			<!-- .main-container -->
			<div class="main-container">

				<div class="row">
					<div class="col-md-6">
						<p class="text-muted">&copy;2014 <?php bloginfo( 'name' ); ?>. Desevolvido por <a href="http://nandomoreira.me/" target="_blank">Nando Moreira</a>.</p>
					</div>

					<div class="col-md-6">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'depth'          => 2,
									'container'      => false,
									'menu_class'     => 'nav-footer list-inline pull-right',
									'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
									'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						?>
					</div>
				</div>

			</div>
			<!-- /.main-container -->

			<span class="line bottom"></span>
		</footer>
		<!-- /.footer -->

		<div class="clearfix"></div><!-- /clearfix -->
    </div>
    <!-- /#main -->

<?php wp_footer(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=668905279849616&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html><!-- by @nando_dev -->
