<?php
/**
 * Text/Media Block Template.
 *
 * @package simple-theme
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

?>

<?php

// Create id attribute allowing for custom "anchor" value.
if ( ! empty( $block['anchor'] ) ) {
	$id = " id='" . $block['anchor'] . "'";
}

$headline        = get_field( 'headline' );
$description     = get_field( 'copy_text' );
$image 	 = get_field( 'image' );
$date 	 = get_field( 'date' );
$time 	 = get_field( 'time' );


$button  = get_field( 'button' );
if ( $button ) :
	// Workaround to get the permalink of the page, so that you get the link of the the equivalent translated page if needed (WPML Bug: gives you only default language link in each language).
	$link_post_id = url_to_postid( $button['url'] ); // This returns 0 if not found, so you can detect an external link.
	$button_url = ( 0 === $link_post_id || str_contains( $button['url'], '#' ) ) ? $button['url'] : get_the_permalink( $link_post_id );
	$button_title = $button['title'];
	$button_target = $button['target'] ? $button['target'] : '_self';
endif;

if ( $headline || $image ) { ?>
	<section class="section section-text-media">
		<div class="container">
			
			<div class="row media-inner">
				
				<?php if ($image) : ?>
			
					
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />
						
			
				<?php endif; ?>
			</div>
			<div class="row content-inner">
						<div class="col-md-5">
						<?php if ( $headline ) : ?>
							<h3> <?php echo $headline; ?> </h3>
							<?php endif; ?>
					</div>
					<div class="col-md-7">
					<div class="content-inner_date">
							<span><?php echo $date;?></span>
							<span><?php echo $time;?></span>
					</div>
						<div class="content-inner_text">
					<?php if ( $description ) : ?>
						
							<p> <?php echo $description; ?> </p>
							<?php endif; ?>
							<?php if ( $button ) : ?>
						
							<a class="btn-primary" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>">
								<span><?php echo esc_html( $button_title ); ?></span>
							</a>
							</div>	
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
} else if ( $is_preview ) {
	echo '<section class="section"><div class="container"><div class="empty">' . __( 'Empty block. Please fill out some fields in the right sidebar.', 'child' ) . '</div></div></section>';
}
?>
