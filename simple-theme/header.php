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

	<div class="simple-header-wrapper<?php echo $sticky_header; ?>">
		<div class="container">
			<header id="masthead" class="site-header simple-header">
				<div class="simple-header-inner">
					<div class="simple-header-branding site-branding">
						<?php
						$site_logo = get_field( 'site_logo', 'option' );
						if ( $site_logo ) : 
							?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home"><img width="60" height="40" src="<?php echo $site_logo['url']; ?>" class="custom-logo" decoding="async"></a>
							<?php
					else :
							the_custom_logo();
					endif;
					if ( is_front_page() && is_home() ) :
						?>
							<h1 class="simple-header-title site-title"><a href="
						<?php
							echo esc_url( home_url( '/' ) ); 
						?>
								" rel="home">
							<?php
							bloginfo( 'name' );
							?>
								</a></h1>
							<?php
						else :
							?>
							<p class="simple-header-title site-title"><a href="
							<?php
								echo esc_url( home_url( '/' ) ); 
							?>
								" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$simple_description = get_bloginfo( 'description', 'display' );
						if ( $simple_description || is_customize_preview() ) :
							?>
							<p class="site-description">
							<?php
								echo $simple_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
							?>
							</p>
						<?php endif; ?>
					</div>
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span>
					<?php
						esc_html_e( 'Primary Menu', 'simple' );
					?>
					</span></button>
					<div class="simple-header-navigation">
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
									$button = get_sub_field( 'buttons' );
									if ( $button ) :
										// Workaround to get the permalink of the page, so that you get the link of the the equivalent translated page if needed (WPML Bug: gives you only default language link in each language).
										$link_post_id = url_to_postid( $button['url'] ); // This returns 0 if not found, so you can detect an external link.
										$button_link = ( 0 === $link_post_id || str_contains( $button['url'], '#' ) ) ? $button['url'] : get_the_permalink( $link_post_id );
										$button_target = $button['target'] ? $button['target'] : '_self';
										$button_title = $button['title'];
										$button_class = get_row_index() === 1 ? 'simple-btn-secondary' : 'simple-btn-primary';
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
									'<div class="simple-buttons simple-buttons_noGap">' .
										$ob_aside .
									'</div>' .
								'</div>';
							}
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</header><!-- #masthead -->
		</div>
	</div>
