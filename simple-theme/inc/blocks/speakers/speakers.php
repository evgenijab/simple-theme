<?php
/**
 * Speakers Block Template.
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

$section_title        = get_field( 'section_title' );
$section_description     = get_field( 'section_description' );
$button = get_field('button');
if ( $button ) :
	$button_url    = $button['url'];
	$button_title  = $button['title'];
	$button_target = $button['target'] ? $button['target'] : '_self';
endif;
if ( $section_title ) { ?>
	<section class="section section-cards section-speakers">
		<div class="container">
			
			<div class="cards-inner_heading">
				
				<?php if ($section_title) : ?>
			<h2>
			<?php echo $section_title; ?>
			</h2>
			<?php endif; ?>
			
				<?php if ( $button ) : ?>
					<a href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>" class="btn-link">
					<span><?php echo esc_html( $button_title ); ?></span><?php inline_svg( 'arrow-down-right' );?></a>
				<?php endif; ?>
			
			</div>
			<div class="row cards-inner_content">
				<div class="col-md-3">
			<?php if ($section_description) : ?>
				<p> 
					<?php echo $section_description; ?>
			</p> 
				<?php endif; ?>
			</div>
			<?php if(have_rows('speakers')) : ?>
				<div class="col-md-9">
				<div class="row">
					<?php while (have_rows('speakers')) : 
						the_row();
						$image = get_sub_field('image');
						$name = get_sub_field('name');
						$position = get_sub_field('position');
						$location = get_sub_field('location');
						?>
						
						<div class="col-md-6">
							<div class="card">
							<?php if ( $image ) : ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />
						<?php endif; ?>
								
								<div class="card_content">
								<?php if ($name) : ?>
									<h4><?php echo $name; ?> </h4>
								<?php endif; ?>
								<div class="card_details">
								
								<?php if ($position) : ?>
									<p><?php echo $position; ?> </p>
								<?php endif; ?>
								<?php if ($location) : ?>
									<p><?php echo $location; ?> </p>
								<?php endif; ?>
								</div>
								</div>
					</div>
					</div>
					
					<?php endwhile; ?>
					</div>
			</div>
				<?php endif;?>
			</div>
		</div>
	</section>

	<?php
} else if ( $is_preview ) {
	echo '<section class="section"><div class="container"><div class="empty">' . __( 'Empty block. Please fill out some fields in the right sidebar.', 'simple-theme' ) . '</div></div></section>';
}
?>
