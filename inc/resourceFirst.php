<?php
	global $toFilter;  
	$blurb = get_field('blurb'); 
	$img = get_post_thumbnail_id(); $size = '1800-1019'; $fallbackSize = '1200-700'; $imgMeta = wp_get_attachment_metadata($img); if (!$imgMeta || !isset($imgMeta['sizes'][$size])) $size = $fallbackSize;
	$term = get_the_terms(get_the_ID(), 'resourcetype'); if ($term && !is_wp_error($term)) {$label = $term[0]->name;} else {$postType = get_post_type_object(get_post_type());$label = $postType->labels->singular_name;}
?>
<div class="firstPost">
	<article>
		<a class="articleLink" href="<?php the_permalink() ?>" rel="bookmark" aria-label="<?php the_title_attribute(); ?>">
			<?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt, 'class' => 'animate__animated animate__fadeInDown'] ); ?>
			<div class="box alt animate__animated animate__zoomIn animate__delay-1">
				<div class="details">
					<h2><?php the_title(); ?></h2>
					<?php echo $blurb; ?>
				</div>
				<div class="labels">
					<?php if($toFilter == 'type-webvid'): ?><span class="tag cpt"><?php echo $label; ?></span><?php endif; ?>
					<span class="tag link"><span class="icon-gt"></span></span>
				</div>
			</div><!--end box-->
		</a>
	</article>
</div><!--end firstPost-->