<?php
/**
 * Sample Results Template
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags.
 *
 * http://codex.wordpress.org/Template_Tags
 *
 * @package Search_Filter_Pro
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! isset( $query ) ) {
    return;
}

$allowed_pagination_html = array(
    'a' => array(
        'href'  => array(),
        'class' => array(),
        'id'    => array(),
        'rel'   => array(),
        'title' => array(),
    ),
);

if ( $query->have_posts() ) {

    $current_page = isset( $query->query['paged'] ) ? $query->query['paged'] : 1;
    ?>



    <!-- Keep the `.search-filter-query-posts` class to support the load more button -->
    <div class="search-filter-query-posts"><div class="wrap"><div class="partners">
        <?php while ( $query->have_posts() ) {
            $query->the_post();$name = get_sub_field('name');
        $details = get_sub_field('details');
        $url = get_sub_field('url');

            ?>
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
            <?php
        }
        /**
         * Reset post data.
         *
         * @phpstan-ignore-next-line deadCode.unreachable
         */
        wp_reset_postdata();
        ?>
    </div></div></div>

    

    <?php
} else {
    echo '<div class="wrap centered"><h3>No Results Found</h3></div>';
}
?>
