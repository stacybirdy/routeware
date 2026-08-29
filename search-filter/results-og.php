<!--
<div class="wrap"><div class="partners">
	<?php $args = array('post_type' => 'partner', 'orderby' => 'name', 'order' => 'ASC', 'posts_per_page'=>'-1'); $loop = new WP_Query( $args ); while ( $loop->have_posts() ) : $loop->the_post();
		$name = get_sub_field('name');
		$details = get_sub_field('details');
		$url = get_sub_field('url');?>
		<article><?php if($url): ?><a href="<?php echo $url; ?>" target="_blank"><?php endif; ?>
			<div class="img"><?php echo the_post_thumbnail('full'); ?></div>
			<div class="txt">
				<?php if($name): ?><h4><?php echo $name; ?></h4><?php endif; ?>
				<?php the_content(); ?>
				<?php $terms = get_the_terms( $post->ID, 'specialty-tag' ); if ( $terms && ! is_wp_error( $terms ) ) : echo '<ul class="tags clean">';
					foreach ( $terms as $term ) {
						echo '<li class="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</li>';
					}
				echo '</ul>'; endif; ?>
			</div>
		<?php if($url): ?></a><?php endif; ?></article>
	<?php endwhile; wp_reset_query(); ?>
</div></div>-->

<!-- / / / / / / ------------------------------------------------------>
<?php	global $toFilter; $toFilter = get_sub_field('toFilter'); 
	global $featuredResource;
		if($toFilter == 'type-blog'): $featuredResource = get_sub_field('stickBlog');
		elseif($toFilter == 'type-stories'): $featuredResource = get_sub_field('stickStory');
		elseif($toFilter == 'type-webvid'): $featuredResource = get_sub_field('stickWebvid');
		elseif($toFilter == 'type-guides'): $featuredResource = get_sub_field('stickGuide');
		endif;
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="searchfilter <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
<!-- / / / / / / ------------------------------------------------------>

<?php
/**
 * Featured first post results template (blog, stories, web/vid, guides)
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags.
 *
 * http://codex.wordpress.org/Template_Tags
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {exit;}
if ( ! isset( $query ) ) {return;}
if ( $query->have_posts() ) { $paged = isset( $query->query['paged'] ) ? $query->query['paged'] : 1; ?>
	<div class="search-filter-query-posts">
		<?php global $featuredResource; $featuredID = $featuredResource ? $featuredResource->ID : null;

		if ($paged === 1 && $featuredResource && empty($_GET)) {

			global $post; $post = $featuredResource; setup_postdata($post); get_template_part('inc/resourceFirst'); wp_reset_postdata();
		}
		if ($query->have_posts()) {
			echo '<div class="search-filter-query-posts">'; $wrapOpen = false;
			while($query->have_posts()){$query->the_post();
				if ($paged === 1 && empty($_GET) && get_the_ID() == $featuredID) continue;

				if (!$wrapOpen) {
					echo '<div class="wrap"><div class="resourceRoll featuredFirst">'; $wrapOpen = true;
				}
  					get_template_part('inc/resourceArticle');}
				if ($wrapOpen) echo '</div></div></div><!--end resourceRoll/wrap/sfqp-->';
			wp_reset_postdata();
		} ?>

	<nav class="numberedPager"><?php numbered_pager( $query ); ?></nav>
<?php } else { ?>
	<div class="noResults marT-s marTmob-xs"><h3>Sorry, no results were found.</h3></div>
<?php } ?>
