<?php
/**
 * @package routeware
 */
get_header(); 
$content = get_field('content404', 'options');
$img = get_field('img404', 'options'); $size = 'full'; $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
?>

<section class="notFound"><div class="overlay"></div><div class="wrap alt">
	<div class="animate__animated animate__zoomIn  animate__delay-2"><?php echo $content; ?></div>
	<?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt, 'class' => 'robot  animate__animated animate__fadeInLeft'] ); ?>
</div></section>

<?php get_footer(); ?>