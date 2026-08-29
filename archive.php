<?php
/**
 * @package routeware
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article role="article">
			<h2 role="heading"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p><?php $content = get_the_excerpt(); echo wp_trim_words( $content , '50', ' <a class="more" href="'. get_permalink() .'">More &raquo;</a>' ); ?></p>
		</article>
	<?php endwhile; ?>
	<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav role="navigation" class="nav-links" aria-label="Navigate between posts">
		  	<div class="nav-previous"><?php next_posts_link( '&laquo; Older Posts', $the_query->max_num_pages ); ?></div>
		  	<div class="nav-next"><?php previous_posts_link( 'Newer Posts &raquo;' ); ?></div>
		</nav>
	<?php endif; ?>
<?php else : ?>
	<article>
    	<h2 role="heading">Sorry...</h2>
    	<p>No posts were found.</p>
  </article>
<?php endif; ?>

<?php get_footer(); ?>
