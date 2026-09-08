<?php
/**
 * Hero
 * 
 * @package routeware
 */

$args = wp_parse_args(
	$args,
	array(
		'type' => get_sub_field('type'),
		'bgColor' => get_sub_field('bg'),
		'bgImg' => get_sub_field('image'),
		'pageTitle' => get_sub_field('pageTitle'),
		'logoTitle' => get_sub_field('logo'),
		'size' => 'full',
		'logoSize' => get_sub_field('logoSize'),
		'customTitle' => get_sub_field('customTitle'),
		'content' => get_sub_field('content'),
		'hubspot' => get_sub_field('hubspot'),
		'poster' => get_sub_field('poster'),
		'mp4' => get_sub_field('mp4'),
		'ogv' => get_sub_field('ogv'),
		'hasQL' => get_sub_field('hasQuicklinks'),
		'QL' => get_sub_field('quicklinks'),
		'spaceB' => get_sub_field('spaceB'),
		'spaceBmob' => get_sub_field('spaceBmob'),
	)
);

$alt = get_post_meta( $args['logoTitle'], '_wp_attachment_image_alt', true);

extract($args);

// glossary should use same class as type-img for styling purposes
$typeClass = $type == 'type-glossary' ? 'type-img' : $type;
?>

<section class="hero alt <?php echo $typeClass . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>" >

	<?php if($type == 'type-form'): ?>
		<div class="txt <?php echo $bgColor . ' ' . $pageTitle; ?>">
			<div class="overlay"></div>
			<div class="wrap">
				<div class="left">
					<div class="inner">
						<?php include(__DIR__ . '/../inc/heroTitle.php'); ?>
						<?php echo $content; ?>
					</div>
				</div>
				<div class="right"><?php echo $hubspot; ?></div>
			</div>
		</div><!--end txt-->

	<?php else: ?>
		<div class="txt <?php echo $bgColor . ' ' . $pageTitle; ?>">
			<div class="overlay"></div>
			<div class="inner animate__animated <?php if($type == 'type-txt'): echo 'animate__fadeInDown'; else: echo 'animate__fadeInLeft'; endif; ?>">
				<?php if($hasQL && $QL): echo '<div class="qlWrap">'; endif; ?>
				<?php include(__DIR__ . '/../inc/heroTitle.php'); ?>
				<?php if($hasQL && $QL): echo '<div class="quicklinks alt">' . $QL . '</div></div>'; endif; ?>
				<?php echo $content; ?>

				<?php if($type == 'type-glossary'): ?>
				<form class="search-form" role="search" method="get">
					<input class="search-form__input" type="text" name="s" placeholder="Search" />
					<button class="search-form__button" type="submit">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.516 11.4454C13.4943 10.2353 14.0793 8.70252 14.0793 7.03866C14.0793 3.1563 10.9225 0 7.03964 0C3.15675 0 0 3.1563 0 7.03866C0 10.921 3.15675 14.0773 7.03964 14.0773C8.71383 14.0773 10.2468 13.4924 11.447 12.5143L16.7116 17.7781C16.8629 17.9294 17.0545 18 17.2461 18C17.4377 18 17.6294 17.9294 17.7806 17.7781C18.0731 17.4857 18.0731 17.0017 17.7806 16.7092L12.516 11.4454ZM1.50273 7.03866C1.50273 3.99328 3.98375 1.5126 7.02956 1.5126C10.0754 1.5126 12.5564 3.99328 12.5564 7.03866C12.5564 8.52101 11.9714 9.86218 11.0133 10.8605C10.9831 10.8807 10.9427 10.9008 10.9125 10.9311C10.8822 10.9613 10.8721 11.0017 10.8419 11.0319C9.8434 11.9798 8.50203 12.5748 7.01947 12.5748C3.97367 12.5748 1.49265 10.0941 1.49265 7.04874L1.50273 7.03866Z" fill="currentColor"/>
						</svg>
					</button>
				</form>
				<?php endif; ?>
			</div>
	</div><!--end inner/text-->

		<?php if($type == 'type-img' || $type == 'type-glossary'): ?>
			<div class="imgInline">
				<?php
				/* Responsive hero image. .imgInline is full width below $break-mid (900px)
				   and 60% of the viewport at mid and up, per _modules.sass:221.
				   $bgImg must be an attachment ID; a URL string still renders, unsized. */
				if( is_numeric($bgImg) ):
					echo wp_get_attachment_image( $bgImg, '1800-1019', false, array(
						'alt'           => get_post_meta( $bgImg, '_wp_attachment_image_alt', true),
						'sizes'         => '(min-width: 900px) 60vw, 100vw',
						'fetchpriority' => 'high',
						'decoding'      => 'sync',
					) );
				elseif( $bgImg ):
					echo '<img src="' . esc_url($bgImg) . '" alt="" fetchpriority="high" />';
				endif;
				?>
			</div>

		<?php elseif($type == 'type-vid'): ?>
			<div class="img">
				<div class="video-hero jquery-background-video-wrapper demo-video-wrapper">
				  <video class="jquery-background-video" autoplay muted loop poster="<?php echo $poster; ?>">
				    <source src="<?php echo $mp4; ?>" type="video/mp4">
				    <source src="<?php echo $ogv; ?>" type="video/ogg">
				  </video>
				</div>
			</div><!--end img-->
		<?php endif; ?>
	<?php endif; //end type ?>
</section>