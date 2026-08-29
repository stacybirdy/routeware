<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'events' ): $hubspot = get_sub_field('hubspot');
    $GLOBALS['hubspot'] = $hubspot; $formIntro = get_sub_field('formIntro'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="events <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">

<div class="wrap">
	<?php $today = current_time('Ymd');
		query_posts(array(
			'post_type' => 'event',
			'posts_per_page' => 9,
			'orderby' => 'meta_value_num',
			'meta_key' => 'startDate',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'startDate',
					'value' => $today,
					'compare' => '>=',
					'type' => 'datetime'
				),
			)
		));
	if (have_posts()): ?>
		<div class="eventRoll animate__animated animate__fadeInUp ">
			<?php while (have_posts()) : the_post(); include('eventArticle.php'); endwhile; ?>
		</div><!--end eventRoll-->
	<?php else: ?>
		<h3>Sorry, no upcoming events scheduled at this time.</h3>
	<?php endif; wp_reset_query(); ?>
	<div class="foot"><button class="btn" id="loadMore">Load More Events</button></div>
</div></section>
<?php if ($hubspot): ?>
  <div id="modal-event" class="popModal">
    <div class="overlay"></div>
    <div class="popup"><span class="closeModal" aria-label="Close popup"><span class="icon-close"></span></span><?php echo $formIntro, $hubspot; ?></div><!--end popup-->
  </div><!--end hubForm-->
<?php endif; ?>