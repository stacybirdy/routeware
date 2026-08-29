<?php $hubspot = isset($GLOBALS['hubspot']) ? $GLOBALS['hubspot'] : null;
$startDate = get_field('startDate');
$endDate = get_field('endDate');
if($startDate):
  $startTime = strtotime($startDate);
  $startMonth = date("F", $startTime);
  $startDay = date("j", $startTime);
  $startYear = date("Y", $startTime);
  if($endDate):
    $endTime = strtotime($endDate);
    $endMonth = date("F", $endTime);
    $endDay = date("j", $endTime);
    $endYear = date("Y", $endTime);
    if($startMonth === $endMonth && $startYear === $endYear):
      $start = "$startMonth $startDay";
      $end = "$endDay, $endYear";
    else:
      $start = ($startYear !== $endYear) ? "$startMonth $startDay, $startYear" : "$startMonth $startDay";
      $end = "$endMonth $endDay, $endYear";
    endif;
  else:
    $start = "$startMonth $startDay, $startYear";
  endif;
endif;
$dateTxt = get_field('dateTxt');
$virtual = has_term('virtual','event-type',get_the_ID());
$venue = get_field('venue');
$loc = get_field('loc');
$booth = get_field('booth');
$details = get_field('details');
$cta = get_field('cta');
$img = get_field('image'); $size = '820-350'; $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
?>
<article>
	<?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt] ); ?>
	<div class="details">
		<h4><span class="icon-date"></span><?php if($dateTxt): echo $dateTxt; else: echo $start; if($endDate): echo ' - ' . $end; endif; endif; ?></h4>
		<h3><?php the_title(); ?></h3>
		<?php if($venue || $loc): ?>
			<p class="meta"><span class="icon-pin"></span><span class="txt"><?php if($venue): echo '<strong>' . $venue . '</strong>'; endif; if($venue && $loc): echo ' in ' ; endif; if($loc): echo $loc; endif; ?></span></p>
		<?php endif; ?>
		<?php if($virtual): ?>
			<p class="meta"><span class="icon-computer"></span><span class="txt"><strong>Virtual</strong></span></p>
		<?php endif; ?>
		<?php if($booth): ?>
			<p class="meta"><span class="icon-person"></span><span class="txt"><strong><?php echo $booth; ?></strong></span></p>
		<?php endif; ?>
		<?php if($details): echo $details; endif; ?>
		<?php if($cta): ?><a class="inline" role="link" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><?php echo $cta['title']; ?></a>
		<?php else: if ($hubspot): ?><button id="trigger-event" class="popTrigger inline">Connect with Us</button><?php endif; endif; ?>
	</div><!--end details-->
</article>