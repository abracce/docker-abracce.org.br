<?php
/**
 * The Header for our theme.
 *
 * @package WPKrarken
 * @since 3.2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="5_b3uRkZcKS5F9uJoFc3kEuRtcj6jLWJeNCqLStxhkU" />
    <?php wp_head(); ?>
  </head>
  <body <?php theme_body_id(); ?> <?php body_class(); ?>>

  	<!-- #main -->
  	<div id="main">

  		<!-- .header -->
      	<header class="header">

      		<!-- .main-container -->
      		<div class="main-container">

      			<div class="row">

  	    			<!-- .navbar -->
  	    			<nav class="col-md-12 navbar" role="navigation">

  						<div class="navbar-header">
  							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  							</button>
  							<a class="navbar-brand logo" href="<?php echo home_url() ?>">
  								<img src="<?php echo THEME_URL ?>/assets/images/logo.png" class="img-responsive" alt="logo" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
  							</a>
  							<a class="navbar-brand" href="<?php echo home_url() ?>">
  								<?php echo get_bloginfo( 'name' ); ?>
  							</a>
  						</div>

  	    				<div class="collapse navbar-collapse">
  							<?php
  								wp_nav_menu(
  									array(
  										'theme_location' => 'main-menu',
  										'depth'          => 2,
  										'container'      => false,
  										'menu_class'     => 'nav navbar-nav navbar-right',
  										'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
  										'walker'         => new Odin_Bootstrap_Nav_Walker()
  									)
  								);
  							?>
  						</div>

  	    			</nav>
  	    			<!-- /.navbar -->

  	    		</div>

          	</div>
      		<!-- /.main-container -->

          </header>
  		<!-- /.header -->

  		<div class="clearfix"></div>
