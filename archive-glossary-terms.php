<?php

/**
 * Archive template for Glossary Terms.
 *
 * @package routeware
 */

get_header();

$paged = max(
	1,
	get_query_var( 'paged' ),
	get_query_var( 'page' )
);

$glossary_query = new WP_Query(
	array(
		'post_type'              => 'glossary-terms',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'orderby'                => 'title',
		'order'                  => 'ASC',
	)
);

// Build available letters from all published glossary terms.
$glossary_letter_ids = get_posts(
	array(
		'post_type'      => 'glossary-terms',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
	)
);

$available_letters = array();

foreach ( $glossary_letter_ids as $post_id ) {
	$title = get_the_title( $post_id );
	$title = trim( wp_strip_all_tags( $title ) );

	if ( '' === $title ) {
		continue;
	}

	$first_letter = function_exists( 'mb_substr' )
		? mb_substr( $title, 0, 1, 'UTF-8' )
		: substr( $title, 0, 1 );

	$first_letter = strtoupper( (string) $first_letter );

	if ( preg_match( '/^[A-Z]$/', $first_letter ) ) {
		$available_letters[] = $first_letter;
	}
}

$available_letters = array_values( array_unique( $available_letters ) );
sort( $available_letters );



?>

<?php
get_template_part(
	'components/hero',
	null,
	array(
		'type'        => 'type-glossary',
		'bgColor'     => 'bg-green',
		'pageTitle'   => 'title-custom',
		'customTitle' => 'Glossary',
		'bgImg'       => 11710, // hero-RCC.jpg — attachment ID, so the hero can emit srcset
		'content'     => 'A quick-reference guide to the terms, acronyms, and jargon you\'ll encounter in waste management and recycling. Browse by letter or search for a specific term to get started.',
	)
);
?>

<?php get_template_part(
	'components/glossary-filters',
	null,
	array(
		'letters'           => $available_letters,
		'available_letters' => $available_letters,
	)
); ?>

<div id="glossary-results">

	<?php if ( $glossary_query->have_posts() ) : ?>

		<div class="glossary-items-grid">

			<?php
			while ( $glossary_query->have_posts() ) :
				$glossary_query->the_post();

				get_template_part( 'components/glossary-term-item' );
			endwhile;
			?>

		</div>

		<?php
		$pagination = paginate_links(
			array(
				'total'     => $glossary_query->max_num_pages,
				'current'   => $paged,
				'type'      => 'list',
				'prev_text' => __( 'Previous', 'routeware' ),
				'next_text' => __( 'Next', 'routeware' ),
			)
		);

		if ( $pagination ) :
			?>
			<nav class="glossary-pagination" aria-label="Glossary pagination">
				<?php echo wp_kses_post( $pagination ); ?>
			</nav>
		<?php endif; ?>

	<?php else : ?>

		<div class="glossary-no-results">
			<p>No glossary terms matched your search.</p>
		</div>

	<?php endif; ?>

</div>

<?php
wp_reset_postdata();

get_footer();