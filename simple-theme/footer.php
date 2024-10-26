<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simple-theme
 */

 $footer_logo = get_field( 'logo', 'option' );
$title = get_field('title', 'option');
?>

	<footer id="colophon" class="site-footer simple-footer">
		<div class="container">
			<div class="row footer-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="footer-logo-img">
						<?php if ( $footer_logo) : ?>
						<img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>" title="<?php echo $footer_logo['title']; ?>" />
							<?php
						endif;
						?>
					</a>
			</div>
			<div class="row">
				<div class="col-md-2">
				<h5> <?php echo $title; ?></h5>
					<?php
					if(have_rows('footer_links', 'option')): ?>
						<div class="footer-links">
						<?php
					while (have_rows('footer_links', 'option')):
						the_row();
						$link = get_sub_field('link'); ?>
						
						<a class="footer-link text-big" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
						<?php
						
					endwhile;
					?>
					</div>
					<?php
				endif;
				?>
					</div>
					</div>
			
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
