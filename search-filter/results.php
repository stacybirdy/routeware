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
					echo '<div class="wrap animate__animated animate__fadeInUp"><div class="resourceRoll">'; $wrapOpen = true;
				}
  					get_template_part('inc/resourceArticle');}
				if ($wrapOpen) echo '</div></div></div><!--end resourceRoll/wrap/sfqp-->';
			wp_reset_postdata();
		} ?>

	<nav class="numberedPager"><?php numbered_pager( $query ); ?></nav>
<?php } else { ?>
	<div class="noResults marT-s marTmob-xs"><h3>Sorry, no results were found.</h3></div>
<?php } ?>
