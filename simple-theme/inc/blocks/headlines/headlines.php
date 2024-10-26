<?php
/**
 * Headlines Block Template.
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
$headline_tag 	 = get_field( 'headline_tag' );
$text_align 	 = get_field( 'text_align' );
if ( $headline || $description ) { ?>
	<section class="section section-headlines">
		<div class="container">
			
			<div class="row headlines-inner" style="text-align: <?php echo $text_align; ?>">
				<div class="col-md-8 offset-md-2">
				<?php if ($headline) : ?>
			<<?php echo $headline_tag;?>>
			<?php echo $headline; ?>
			</<?php echo $headline_tag;?>>
			<?php endif; ?>
			<?php if ($description) : ?>
				<p class="dark"> 
					<?php echo $description; ?>
			</p> 
				<?php endif; ?>
			</div>
			</div>
		</div>
	</section>

	<?php
} else if ( $is_preview ) {
	echo '<section class="section"><div class="container"><div class="empty">' . __( 'Empty block. Please fill out some fields in the right sidebar.', 'simple-theme' ) . '</div></div></section>';
}
?>
