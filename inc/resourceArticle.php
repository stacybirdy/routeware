<?php
	global $toFilter;  
	$blurb = get_field('blurb'); $blurb = wp_trim_words($blurb, 25);
	$pdf = get_field('pdf');
	$img = get_post_thumbnail_id(); $size = '800-453'; $fallbackSize = '500-283'; $imgMeta = wp_get_attachment_metadata($img); if(!$imgMeta || !isset($imgMeta['sizes'][$size]) || $imgMeta['sizes'][$size]['width'] < 800 || $imgMeta['sizes'][$size]['height'] < 453){$size = $fallbackSize;} 
	$sizeFactsheet = '500-648'; $alt = get_post_meta($img, '_wp_attachment_image_alt', true);
	$term = get_the_terms(get_the_ID(), 'resourcetype'); if ($term && !is_wp_error($term)) {$label = $term[0]->name;} else {$postType = get_post_type_object(get_post_type());$label = $postType->labels->singular_name;}
?>
 
<?php if($toFilter == 'type-factsheets'): ?>
	<article>
		<a href="<?php echo $pdf; ?>" target="_blank">
			<?php the_post_thumbnail($sizeFactsheet); ?>
			<h4><?php the_title(); ?></h4>
			<?php echo $blurb; ?>
		</a>
	</article>
<?php else: ?>
	<?php if('factsheet' === get_post_type()): ?>
		<article>
			<a class="articleLink" href="<?php echo $pdf; ?>" target="_blank" aria-label="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail($size);  ?>
				<div class="details">
					<h4><?php the_title(); ?></h4>
					<?php if($toFilter == 'type-stories' || $toFilter == 'type-blog' ): echo $blurb; endif; ?>
				</div>
				<div class="labels">
					<?php if(($toFilter != 'type-stories' && $toFilter != 'type-guides' && $toFilter != 'type-blog')): ?>
						<span class="tag cpt"><?php echo $label; ?></span>
					<?php endif; ?>
					<span class="tag dl">Download <span class="icon-dl"></span></span>
				</div>
			</a>
		</article>
	<?php else: ?>
		<article>
			<a class="articleLink" href="<?php the_permalink() ?>" rel="bookmark" aria-label="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail($size);  ?>
				<div class="details">
					<h4><?php the_title(); ?></h4>
					<?php if('post' === get_post_type()): ?><p class="date"><?php the_time('F j, Y'); ?></p><?php endif; ?>

					<?php if($toFilter == 'type-stories' || $toFilter == 'type-blog' ): echo $blurb; endif; ?>
				</div>

					<?php if(($toFilter == 'type-stories' || $toFilter == 'type-blog')): ?>


						<?php $terms = get_the_terms( $post->ID, 'sol' ); if ( $terms && ! is_wp_error( $terms ) ) : echo '<ul class="tags clean">';
	                    foreach ( $terms as $term ) {
	                        echo '<li class="term-' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '</li>';
	                    }
	                echo '</ul>'; endif; ?>


                	<?php endif; ?>




				<div class="labels<?php if($toFilter == 'type-stories' || $toFilter == 'type-blog'): echo ' cornerArrow'; endif; ?>">
					<?php if(($toFilter != 'type-stories' && $toFilter != 'type-guides' && $toFilter != 'type-blog')): ?>
						<span class="tag cpt"><?php echo $label; ?></span>
					<?php endif; ?>
					<span class="tag link"><span class="icon-gt"></span></span>
				</div>
			</a>
		</article>
	<?php endif; ?>
<?php endif; //end layouts ?>
