<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simple-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'simple-theme' ); ?></a>

	<div class="simple-header-wrapper">
		<div class="container">
			<header id="masthead" class="site-header simple-header">
				<div class="simple-header-inner">
					<div class="simple-header-branding site-branding">
						<?php
						$site_logo = get_field( 'site_logo', 'option' );
						if ( $site_logo ) : 
							?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home"><img src="<?php echo $site_logo['url']; ?>" class="custom-logo" decoding="async"></a>
							<?php
					else :
							the_custom_logo();
					endif;
					?>
					</div>
					<div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<?php inline_svg('burger-menu'); ?>
						<!-- <span class="sr-only">Toggle Menu</span> -->
					</div>
					<!-- <div class="simple-header-navigation"> -->
						<nav id="site-navigation" class="simple-navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container_class' => 'simple-navigation-menu',
								)
							);

							$menu_buttons = get_field( 'menu_buttons', 'option' );
										ob_start();
							if ( have_rows( 'menu_buttons', 'option' ) ) :
								while ( have_rows( 'menu_buttons', 'option' ) ) :
									the_row();
									$button = get_sub_field( 'button' );
									if ( $button ) :
										$button_link = $button['url'];
										$button_target = $button['target'] ? $button['target'] : '_self';
										$button_title = $button['title'];
										$button_class = get_row_index() === 1 ? 'btn-link' : 'btn-primary';
									endif;
									if ( $button ) :
										?>
											<a class="
											<?php
												echo $button_class; 
											?>
												" href="
												<?php
												echo esc_url( $button_link ); 
												?>
												" target="
												<?php
												echo esc_attr( $button_target ); 
												?>
												"><span>
												<?php
												echo esc_html( $button_title );
												?>
											</span></a>
										<?php
									endif;
								endwhile;
							endif;
							$ob_aside = ob_get_contents();
							ob_end_clean();
							if ( $ob_aside ) {
								echo '<div class="simple-nav-aside">' .
									'<div class="nav-buttons">' .
										$ob_aside .
									'</div>' .
								'</div>';
							}
							?>
						</nav><!-- #site-navigation -->
					<!-- </div> -->
				</div>
			</header><!-- #masthead -->
		</div>
	</div>
	