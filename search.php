<?php
/**
 * @package routeware
 */
get_header(); ?>

<section class="hero alt type-txt marB-s marBmob-xs"><div class="txt bg-green title-default"><div class="overlay"></div><div class="inner animate__animated animate__fadeInDown">
	<h3>Search Results:</h3> 
	<h1>"<?php echo get_search_query(); ?>"</h1>
</div></div></section>

<section class="contentEditor marB-xl marBmob-l"><div class="wrap animate__animated animate__fadeInUp">
	<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); $postType = get_post_type(); $postTypeObj = get_post_type_object($postType); $postTypeName = $postTypeObj->labels->singular_name; $excerpt = get_the_excerpt();$pdf = get_field('pdf'); ?>
			<article>
				<h5><?php echo $postTypeName; ?></h5>
				<h3><?php if($postType == 'factsheet'): ?><a href="<?php echo $pdf; ?>" target="_blank"><?php elseif($postType == 'event'): ?><a href="<?php echo get_the_permalink('35'); ?>" title="<?php echo get_the_title('35'); ?>"><?php else: ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php endif; ?><?php the_title(); ?></a></h3>
				<?php if (have_rows('modules')): $i = 0; while (have_rows('modules')) : the_row(); $i++; $moduleContent = get_sub_field('content'); if ($moduleContent) { echo '<p class="excerpt">' . wp_trim_words($moduleContent, '50') . '</p>'; break; } if ($i == 2) break; endwhile;  ?>
				<?php elseif($excerpt): ?><p class="excerpt"><?php echo wp_trim_words( $excerpt , '50' ); ?></p>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
	</div><!--end wrap-->
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="numberedPager width-S"><?php numbered_pager( $wp_query ); ?></nav>
	<?php endif; ?>
	<?php else : ?>
		<div class="wrap animate__animated animate__fadeInUp"><article class="centered"><h3>Sorry, no results found</h3></article></div>
	<?php endif; ?>
</div></section>

<?php get_footer(); ?>
