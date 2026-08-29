<?php
/**
 * Partner filtering results template
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

if ( $query->have_posts() ) {$paged = isset( $query->query['paged'] ) ? $query->query['paged'] : 1; ?>
	<div class="search-filter-query-posts"><div class="wrap"><div class="eventRoll animate__animated animate__fadeInUp ">
		<?php while ( $query->have_posts() ) { $query->the_post(); the_title(); } wp_reset_postdata(); ?>
	</div></div></div><!--end eventRoll/wrap/sfqp-->
	<nav class="numberedPager"><?php numbered_pager( $query ); ?></nav>
<?php } else { ?>
	<div class="noResults marT-s marTmob-xs"><!--<h3>Sorry, no results were found :(</h3><br />--></div>
<?php } ?>

