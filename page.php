<?php
/**
 * @package routeware
 */
get_header(); ?>

<?php if( have_rows('modules') ): $l = 0;
    while ( have_rows('modules') ) : the_row(); $l++;
        if ($l === 1 && get_row_layout() === 'hero') {
            include('inc/modules.php');
            continue;
        }
        if (post_password_required()) {
            echo get_the_password_form();
            break;
        }
        include('inc/modules.php');
    endwhile;
endif; ?>


<?php get_footer(); ?>
