<?php if( get_row_layout() == 'hero' ):
	get_template_part('components/hero');
?>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'boxedCallouts' ):
	$type = get_sub_field('type');
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$cols = get_sub_field('columns');
	$logoTitle = get_sub_field('logo'); $size = 'full'; $alt = get_post_meta( $logoTitle, '_wp_attachment_image_alt', true);
	$contentTip = get_sub_field('contentTip');
	$content = get_sub_field('content');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob');
?>
<section class="boxedCallouts <?php echo $type; if(is_singular() && !is_page()): echo 'type-tip '; endif;  if($type === 'type-software' || $type === 'type-flips'): echo ' alt'; endif; echo ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="overlay"></div>
<?php if(($type == 'type-tip') || is_singular() && !is_page()): ?>
	<div class="tipBox alt animate__animated animate__zoomIn"><span class="icon-tip"></span><div class="txt"><?php echo $contentTip; ?></div></div>







<?php else: ?>
	<?php if($hasIntro && $intro): echo '<div class="introBg"><div class="intro animate__animated animate__zoomIn">' . $intro . '</div></div>'; endif; ?>
	<?php if($type == 'type-flips'): ?>
		<div class="colsFull alt"><div class="wrap <?php echo $cols; ?>">
			<?php if( have_rows('flipBoxes') ): ?>
				<div class="boxes flipSlider">
					<?php $i = 0; while( have_rows('flipBoxes') ): the_row();
						$eyebrow = get_sub_field('eyebrow');
						$hl = get_sub_field('headline');
						$front = get_sub_field('frontContent');
						$btnText = get_sub_field('btnText');
					?>
					<div class="flipCard"> 
						<div class="card " onclick="this.classList.toggle('flipped');"> 
							<div class="side front"><div class="inner cardFront">
								<h5 class="noLine"><?php echo $eyebrow; ?></h5>
								<div class="mid">
									<h3><?php echo $hl; ?></h3>
									<p><?php echo $front; ?></p>
								</div>
								<span class="btn"><?php echo $btnText; ?></span>
							</div></div><!--end inner/front-->
						    <div class="side back"><div class="inner cardSizer">
								<h5 class="noLine"><?php echo $eyebrow; ?></h5>
								<h3><?php echo $hl; ?></h3>
								<?php if( have_rows('schedule') ): ?>
									<ul class="schedule clean"><?php while( have_rows('schedule') ): the_row(); $time = get_sub_field('time'); $details = get_sub_field('details'); ?>
										<li>
											<div class="time"><?php echo $time; ?></div>
											<div class="details"><?php echo $details; ?></div>
										</li>
									<?php endwhile; ?></ul>
								<?php endif; ?>
								
							</div><span class="icon-clear"></span></div><!--end inner/back-->
						</div> 
					</div> 
					<?php $i++; endwhile; ?>

				</div><!--end boxes-->
				<nav class="sliderNav"><button class="slick-prev prev"></button><button class="slick-next next"></button></nav>
			<?php endif; ?>
		</div></div><!--end wrap/colsFull-->

	<?php else: ?>
		<div class="colsFull alt"><div class="wrap <?php echo $cols; ?>">
		<?php if( have_rows('boxes') ): ?>
			<div class="boxes">
				<?php $i = 0; while( have_rows('boxes') ): the_row();
					$content = get_sub_field('contentTxt');
					$rollHL = get_sub_field('contentHL');
					$rollHover = get_sub_field('contentHover');
					$img = get_sub_field('img'); $alt = get_post_meta( $img, '_wp_attachment_image_alt', true); 
					$logo = get_sub_field('logo'); $altLogo = get_post_meta( $logo, '_wp_attachment_image_alt', true);
					$link = get_sub_field('button');
					$hasPop = get_sub_field('hasPop'); $btnLabel = get_sub_field('btnLabel');
					$poster = get_sub_field('poster'); $altPoster = get_post_meta( $poster, '_wp_attachment_image_alt', true); 
				?>
					<div class="box animate__animated animate__fadeInUp animate__delay-<?php echo $i; ?>" <?php if($type == 'type-imgroll'): ?>style="background-image:url('<?php echo wp_get_attachment_url( $img ); ?>');"<?php endif; ?>>
						<?php if($type == 'type-txt'): ?>
							<?php echo $content; ?>
							<?php if($hasPop): ?><button id="trigger-<?php echo $l . '-' . $i; ?>" class="btn popTrigger"><?php echo $btnLabel; ?></button><?php endif; ?>
							<?php if($link): ?><a class="btn" role="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a><?php endif; ?>
						<?php elseif($type == 'type-imgroll'): ?>
							<h2><?php echo $rollHL; ?></h2>
							<div class="rollover"><?php echo $rollHover; ?></div>
						<?php elseif($type == 'type-software'): ?>
							<?php echo wp_get_attachment_image( $logo, 'full', "", ['alt' => $altLogo, 'class' => 'logo'] ); ?>
							<?php echo wp_get_attachment_image( $img, '940-500', "", ['alt' => $alt, 'class' => 'bg'] ); ?>
							<?php if($link): ?><a class="btn" role="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a><?php endif; ?>

						<?php elseif($type == 'type-video'): ?>
							<div id="trigger-<?php echo $l . '-' . $i; ?>" class="img popTrigger"><span class="icon-play"></span><?php echo wp_get_attachment_image( $poster, '1200-700', "", ['alt' => $altPoster] ); ?></div>
							<div class="inner"><?php echo $content; ?></div>
						<?php endif; ?>
					</div><!--end box-->
				<?php $i++; endwhile; ?>
			</div><!--end boxes-->
		<?php endif; ?>
		</div></div><!--end wrap/colsFull-->

<?php endif; //end inner type ?>

	<?php endif; //end type main ?>
</section>


<?php if( have_rows('boxes') ): $i = 0; while( have_rows('boxes') ): the_row(); 
	$vid = get_sub_field('video');
	$hasPop = get_sub_field('hasPop'); $contentPop = get_sub_field('contentPop'); $hubspot = get_sub_field('hubspot');
?>
	<?php if(($type == 'type-video' && $vid) || ($type == 'type-txt' && $hasPop) ): ?>
    	<div id="modal-<?php echo $l . '-' . $i; ?>" class="popModal alt <?php echo $type; ?>"><div class="overlay"></div>
      		<div class="popup"><span class="closeModal" aria-label="Close popup"><span class="icon-close"></span></span>
      			<?php if($type == 'type-video'): echo '<div class="embedContainer">' . $vid . '</div>'; elseif($type == 'type-txt'): echo $contentPop, $hubspot; endif; ?>
      		</div><!--end popup-->
    	</div><!--end popModal-->
  	<?php endif; ?>
<?php $i++; endwhile; endif; ?>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'iconText' ): 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$hasAnchor = get_sub_field('hasAnchor'); $anchor = get_sub_field('anchor');
	$type = get_sub_field('type');
	$bg = get_sub_field('bg');
	$colLR = get_sub_field('colLR'); $colStack = get_sub_field('colStack');
	$link = get_sub_field('link');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?> class="iconText <?php echo $bg . ' ' . $type . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="wrap">
	<?php if($hasIntro && $intro): echo '<div class="intro  animate__animated animate__zoomIn' . ($type == 'type-stack' ? ' introFull introLeft reduceMar1' : '') . '">' . $intro . '</div>'; endif; ?>
	<?php if( have_rows('icons') ): ?>
		<div class="icons  animate__animated animate__fadeInDown <?php if($type == 'type-bullets'): echo $colLR; elseif($type == 'type-cols' && !is_page()): echo 'col3'; elseif($type == 'type-cols' && is_page()): echo $colStack; endif; ?>">
			<?php while( have_rows('icons') ): the_row(); 
				$icon = get_sub_field('icon'); $size = 'full'; $alt = get_post_meta( $icon, '_wp_attachment_image_alt', true);
				$content = get_sub_field('content');
			?>
				<div class="iconBlock">
					<div class="icon"><?php echo wp_get_attachment_image( $icon, $size, "", ['alt' => $alt] ); ?></div>
					<div class="txt"><?php echo $content; ?></div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
	<?php if($link): ?><div class="foot animate__animated animate__fadeInUp"><a class="btn" role="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a></div><?php endif; ?>
</div></section>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'contentEditor' ): $hasAnchor = get_sub_field('hasanchor'); $anchor = get_sub_field('anchor'); $content = get_sub_field('content'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?> class="contentEditor animate__animated animate__fadeInUp <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="wrap"><?php echo $content; ?></div></section>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'statSlider' ): $hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $bg = get_sub_field('bg'); $cols = get_sub_field('cols'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="statSliderModule <?php echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
 	<div class="statWrap animate__animated animate__fadeIn <?php if(is_singular() && !is_page()): echo 'col3'; else: echo $cols; endif; ?>"><?php $totalRows = count(get_sub_field('stats')); if( have_rows('stats') ): ?>
		<ul class="statSlider clean <?php if($totalRows > 4): echo 'slides-more'; else: echo 'slides-four'; endif; ?>">
			<?php while( have_rows('stats') ): the_row(); 
				$icon = get_sub_field('icon'); $size = 'full'; $alt = get_post_meta( $icon, '_wp_attachment_image_alt', true); $imgSize = get_sub_field('imgSize');
				$pre = get_sub_field('prepend');
				$value = get_sub_field('value');
				$app = get_sub_field('append');
				$label = get_sub_field('label');
				$details = get_sub_field('details');
			?>
				<li class="stat">
					<div class="img <?php echo $imgSize; ?>"><?php echo wp_get_attachment_image( $icon, $size, "", ['alt' => $alt] ); ?></div>
					<div class="txt">
						<h3 class="stats"><?php if($pre): ?><span class="pre"><?php echo $pre; ?></span><?php endif; ?><span class="counter"><?php echo $value; ?></span><?php if($app): ?><span class="app"><?php echo $app; ?></span><?php endif; ?></h3>
						<h4><?php echo $label; ?></h4>
						<?php if($details): echo '<p>' . $details . '</p>'; endif; ?>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?></div><!--end statWrap-->
</section>



<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'arrowCallout' ): 
	$type = get_sub_field('type');
	$hasAnchor = get_sub_field('hasAnchor'); $anchor = get_sub_field('anchor');
	$arrowBg = get_sub_field('arrowbg');
	$cols = get_sub_field('columns');
	$content = get_sub_field('arrowContent');
	$countdown = get_sub_field('countdown');
	$img = get_sub_field('image'); $size = 'full'; $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>

<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?> class="arrowCallout <?php echo $type . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<div class="txt alt <?php echo $arrowBg; ?>"><div class="inner animate__animated animate__fadeInLeft"><?php echo $content; ?></div></div>
	<div class="media"><div class="inner animate__animated animate__fadeInRight" <?php if($type == 'type-img'): ?>style="background-image:url('<?php echo $img; ?>')"<?php endif; ?>>
		<?php if($type == 'type-countdown'): ?><div class="overlay"></div><?php endif; ?>
		<div class="wrap">
			<?php if($type == 'type-logos'): ?>
				<?php if( have_rows('logosTop') ): ?>
					<div class="logoSlides logoSlider-<?php echo $cols; ?>">
						<?php while( have_rows('logosTop') ): the_row(); $logo = get_sub_field('logo'); $size = 'full'; $alt = get_post_meta( $logo, '_wp_attachment_image_alt', true); $link = get_sub_field('link'); ?>
							<div class="slide"><?php if($link): echo '<a href="' . $link . '" target="_blank">'; endif; echo '<span>' . wp_get_attachment_image( $logo, $size, "", ['alt' => $alt] ) . '</span>'; if($link): echo '</a>'; endif; ?></div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
				<?php if( have_rows('logosBot') ): ?>
					<div class="logoSlides logoSlider-<?php echo $cols; ?>">
						<?php while( have_rows('logosBot') ): the_row(); $logo = get_sub_field('logo'); $size = 'full'; $alt = get_post_meta( $logo, '_wp_attachment_image_alt', true); $link = get_sub_field('link'); ?>
							<div class="slide"><?php if($link): echo '<a href="' . $link . '" target="_blank">'; endif; echo wp_get_attachment_image( $logo, $size, "", ['alt' => $alt] );if($link): echo '</a>'; endif; ?></div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			<?php elseif($type == 'type-countdown'): echo $countdown; ?>
			<?php else: endif; //end type ?>
		</div></div></div><!--end wrap/inner/media-->
</section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'accordionModule' ): 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="accordions <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro reduceMar1 animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
	<div class="wrap animate__animated animate__fadeInDown">
		<?php if( have_rows('accordions') ): $i = 0; ?>
	      <div class="usa-accordion usa-accordion--bordered">
	        <?php while( have_rows('accordions') ): the_row(); $i++; $label = get_sub_field('label'); $labelStrip = substr(preg_replace('/[^a-z0-9]/', '', strtolower($label)), 0, 10); $content = get_sub_field('details'); ?>
	              <h3 class="usa-accordion__heading"><button type="button" class="usa-accordion__button" aria-expanded="false" aria-controls="<?php echo $labelStrip, $i; ?>"><?php echo $label; ?></button></h3>
	          <div id="<?php echo $labelStrip, $i; ?>" class="usa-accordion__content"><?php echo $content; ?></div>
	        <?php endwhile;  ?>
	      </div>
	    <?php endif; wp_reset_query(); ?>
	</div>
</section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'testimonialModule--OLD' ): 
	if(is_singular() && !is_page()): $type = 'type-txt'; else: $type = get_sub_field('type'); endif;
	$typeSingle = get_sub_field('typeSingle');
	$quoteSingle = get_sub_field('quoteSingle');
	$imgSingle = get_sub_field('imgSingle'); $altSingle = get_post_meta( $imgSingle, '_wp_attachment_image_alt', true);
	$nameSingle = get_sub_field('nameSingle'); $posSingle = get_sub_field('posSingle'); 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="testimonials <?php echo $type . ' ' . $typeSingle . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if(is_singular() && !is_page()): //single resources ?>

		<?php if($typeSingle == 'type-txt'): ?>
			<div class="testi-txt animate__animated animate__fadeInRight">
				<div class="quote alt"><?php echo $quoteSingle; ?></div>
				<div class="meta">
					<p class="byline"><strong><?php echo $nameSingle; if($posSingle): echo ',&nbsp;&nbsp;'; endif; ?></strong><?php if($posSingle): echo '<em>' . $posSingle . '</em>'; endif; ?></p>
				</div>
			</div>	
		<?php elseif($typeSingle == 'type-img'): ?>	


			<div class="testi-txtimg alt animate__animated animate__fadeInUp">
				<div class="img" style="background-image:url('<?php echo $imgSingle; ?>');"><div class="mob" style="background-image:url('<?php echo $imgSingle; ?>');"></div></div><!--end img-->
				<div class="txt">
					<div class="quote">
						<?php echo $quoteSingle;  ?>
						<p class="byline"><strong><?php echo $nameSingle; if($posSingle): echo ',&nbsp;&nbsp;'; endif; ?></strong><?php if($posSingle): echo '<em>' . $posSingle . '</em>'; endif; ?></p>
					</div><!--end quote-->
				</div><!--end txt-->
			</div><!--end testi-txtimg-->
		<?php endif; ?>


	<?php else: ?>
		<?php if($hasIntro && $intro): echo '<div class="intro animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
		<div class="bg"><div class="wrap">
			<?php if( have_rows('testimonials') ): ?>
		      <div class="testiSlider alt animate__animated animate__fadeInUp">
		        <?php while( have_rows('testimonials') ): the_row(); $quote = get_sub_field('quote'); $name = get_sub_field('name'); $pos = get_sub_field('position'); $byline = get_sub_field('byline'); $value = get_sub_field('value'); $label = get_sub_field('label'); $img = get_sub_field('image'); $logo = get_sub_field('logo');  $alt = get_post_meta( $logo, '_wp_attachment_image_alt', true); ?>
		            <div class="slide" <?php if($type == 'type-story'): ?>style="background-image:url('<?php echo $img; ?>');"<?php endif; ?>>
						<?php if($type == 'type-txt'): ?>
							<div class="quote"><?php echo $quote; ?></div>
							<div class="meta">
								<p class="byline"><strong><?php echo $name; if($pos): echo ',&nbsp;&nbsp;'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo '<br />' . $byline; endif; ?></em></p>
							</div><!--end byline-->
						<?php else: ?>
							<div class="img" <?php if($type == 'type-img'): ?>style="background-image:url('<?php echo $img; ?>');"<?php endif; ?>>
								<?php if($type == 'type-img'): ?><div class="mob" style="background-image:url('<?php echo $img; ?>');"></div><?php endif; ?>
								<?php if($type == 'type-story'): echo '<div class="overlay"></div>' . wp_get_attachment_image( $logo, $size, "", ['alt' => $alt] ); endif; ?>
							</div><!--end img-->
							<div class="txt">
								<div class="quote">
									<?php echo $quote; //limit to 30 on stories ?>
									<?php if($type == 'type-img'): ?>
										<p class="byline"><strong><?php echo $name; if($pos): echo ',<br />'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo '<br />' . $byline; endif; ?></em></p>
									<?php endif; ?>
								</div><!--end quote-->
								<?php if($type == 'type-story'): ?>
									<div class="statBox">
										<p class="byline"><strong><?php echo $name; if($pos): echo ',&nbsp;&nbsp;'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo ', ' . $byline; endif; ?></em></p>

										<div class="stat"><span class="value"><?php echo $value; ?></span><span class="label"><?php echo $label; ?></span></div>
											
									</div><!--end stat-->
								<?php endif; ?>
							</div><!--end txt-->
						<?php endif; //end type ?>
		            </div><!--end slide-->
		        <?php endwhile;  ?>
		      </div><!--end testiSlider-->
		      <?php if($type == 'type-story'): ?><div class="foot animate__animated animate__fadeInDown"><a href="/resources/customer-stories/" class="btn bot">View Customer Stories</a></div><?php endif; ?>
		    <?php endif; wp_reset_query(); ?>
		</div></div><!--end wrap/bg-->
	<?php endif; //end post type ?>
</section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'testimonialModule' ): 
	if(is_singular() && !is_page()): $type = 'type-txt'; else: $type = get_sub_field('type'); endif;
	$typeCPT = get_sub_field('typecpt'); $typeCPT = $typeCPT->slug;
	$testiCPT = get_sub_field('testicpt');
	$typeSingle = get_sub_field('typeSingle');
	$quoteSingle = get_sub_field('quoteSingle');
	$imgSingle = get_sub_field('imgSingle'); $altSingle = get_post_meta( $imgSingle, '_wp_attachment_image_alt', true);
	$nameSingle = get_sub_field('nameSingle'); $posSingle = get_sub_field('posSingle'); 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>


<section class="testimonials im-new <?php echo $typeCPT . ' ' . $typeSingle . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if(is_singular() && !is_page()): //single resources ?>

		<?php if($typeSingle == 'type-txt'): ?>
			<div class="testi-txt animate__animated animate__fadeInRight">
				<div class="quote alt"><?php echo $quoteSingle; ?></div>
				<div class="meta">
					<p class="byline"><strong><?php echo $nameSingle; if($posSingle): echo ',&nbsp;&nbsp;'; endif; ?></strong><?php if($posSingle): echo '<em>' . $posSingle . '</em>'; endif; ?></p>
				</div>
			</div>	
		<?php elseif($typeSingle == 'type-img'): ?>	


			<div class="testi-txtimg alt animate__animated animate__fadeInUp">
				<div class="img" style="background-image:url('<?php echo $imgSingle; ?>');"><div class="mob" style="background-image:url('<?php echo $imgSingle; ?>');"></div></div><!--end img-->
				<div class="txt">
					<div class="quote">
						<?php echo $quoteSingle;  ?>
						<p class="byline"><strong><?php echo $nameSingle; if($posSingle): echo ',&nbsp;&nbsp;'; endif; ?></strong><?php if($posSingle): echo '<em>' . $posSingle . '</em>'; endif; ?></p>
					</div><!--end quote-->
				</div><!--end txt-->
			</div><!--end testi-txtimg-->
		<?php endif; ?>


	<?php else: ?>
		<?php if($hasIntro && $intro): echo '<div class="intro animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
		<div class="bg"><div class="wrap">
			<?php
				$testiFieldMap = ['type-story' => 'testi-story', 'type-img' => 'testi-img', 'type-txt' => 'testi-txt'];
				$selectedTestis = get_sub_field($testiFieldMap[$typeCPT] ?? '');
				$testiIDs = $selectedTestis ? wp_list_pluck( (array) $selectedTestis, 'ID' ) : [];
				$testiQuery = !empty($testiIDs) ? new WP_Query([
					'post_type'      => 'testimonials',
					'posts_per_page' => -1,
					'post__in'       => $testiIDs,
					'orderby'        => 'post__in',
				]) : null;
				if( $testiQuery && $testiQuery->have_posts() ): ?>
		      <div class="testiSlider alt animate__animated animate__fadeInUp">
		        <?php while( $testiQuery->have_posts() ): $testiQuery->the_post();
		        	$quote = get_field('quote'); $name = get_field('name'); $pos = get_field('position'); $byline = get_field('byline'); $value = get_field('value'); $label = get_field('label'); $img = get_field('image'); $logo = get_field('logo'); $alt = get_post_meta( $logo, '_wp_attachment_image_alt', true); ?>
		            <div class="slide"><?php
					/* type-story used an inline background-image, so it shipped the
					   full-size original to every phone with no lazy loading.
					   Now a real img filling .slide via object-fit — see the
					   img.slideBg rules under &.type-story in _modules.sass:1295,
					   which also reproduce the mobile 'auto 50% / center top'
					   behaviour. .slide is 92% of the wrap, capped at 1400px.
					   $img must be an attachment ID; a URL string still renders. */
					if($typeCPT == 'type-story'):
						if( is_numeric($img) ):
							echo wp_get_attachment_image( $img, 'full', false, array(
								'class'   => 'slideBg',
								'alt'     => '',
								'sizes'   => '(min-width: 1522px) 1400px, 92vw',
								'loading' => 'lazy',
							) );
						elseif( $img ):
							echo '<img class="slideBg" src="' . esc_url($img) . '" alt="" loading="lazy" />';
						endif;
					endif;
					?>
						<?php if($typeCPT == 'type-txt'): ?>
							<div class="quote"><?php echo $quote; ?></div>
							<div class="meta">
								<p class="byline"><strong><?php echo $name; if($pos): echo ',&nbsp;&nbsp;'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo '<br />' . $byline; endif; ?></em></p>
							</div><!--end byline-->
						<?php else: ?>
							<div class="img" <?php if($typeCPT == 'type-img'): ?>style="background-image:url('<?php echo $img; ?>');"<?php endif; ?>>
								<?php if($typeCPT == 'type-img'): ?><div class="mob" style="background-image:url('<?php echo $img; ?>');"></div><?php endif; ?>
								<?php if($typeCPT == 'type-story'): echo '<div class="overlay"></div>' . wp_get_attachment_image( $logo, $size, "", ['alt' => $alt] ); endif; ?>
							</div><!--end img-->
							<div class="txt">
								<div class="quote">
									<?php echo $quote; ?>
									<?php if($typeCPT == 'type-img'): ?>
										<p class="byline"><strong><?php echo $name; if($pos): echo ',<br />'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo '<br />' . $byline; endif; ?></em></p>
									<?php endif; ?>
								</div><!--end quote-->
								<?php if($typeCPT == 'type-story'): ?>
									<div class="statBox">
										<p class="byline"><strong><?php echo $name; if($pos): echo ',&nbsp;&nbsp;'; endif; ?></strong><em><?php if($pos): echo $pos; endif; if($byline): echo ', ' . $byline; endif; ?></em></p>
										<div class="stat"><span class="value"><?php echo $value; ?></span><span class="label"><?php echo $label; ?></span></div>
									</div><!--end stat-->
								<?php endif; ?>
							</div><!--end txt-->
						<?php endif; //end type ?>
		            </div><!--end slide-->
		        <?php endwhile; wp_reset_postdata(); ?>
		      </div><!--end testiSlider-->
		      <?php if($typeCPT == 'type-story'): ?><div class="foot animate__animated animate__fadeInDown"><a href="/resources/customer-stories/" class="btn bot">View Customer Stories</a></div><?php endif; ?>
		    <?php endif; ?>
		</div></div><!--end wrap/bg-->
	<?php endif; //end post type ?>
</section>

<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'photoColumns' ): $bg = get_sub_field('bg'); $hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $hasLink = get_sub_field('hasButton'); $link = get_sub_field('link'); $cols = get_sub_field('columns'); $size = get_sub_field('imgSize'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="photoColumns <?php if($bg == 'bg-dblue'): echo 'alt '; endif; echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="overlay"></div>
	<?php if($hasIntro && $intro): echo '<div class="intro reduceMar1 animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
 	<?php if( have_rows('blocks') ): $i=0; ?>
		<div class="wrap"><div class="blocks <?php echo $cols; ?>">
			<?php while( have_rows('blocks') ): the_row(); $i++;
				$img = get_sub_field('image');  $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
				$content = get_sub_field('content');
			?>
				<div class="col animate__animated animate__fadeInUp animate__delay-<?php echo $i; ?>">
					<?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt] ); ?>
					<div class="content"><?php echo $content; ?></div>
				</div><!--end col-->
			<?php endwhile; ?>
		</div></div><!--end blocks/wrap-->
	<?php endif; ?>
	<?php if($link): ?><div class="foot reduceMar1 animate__animated animate__fadeInUp"><a class="btn" role="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a></div><?php endif; ?>
</section>



<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'imgTxt' ): $hasAnchor = get_sub_field('hasAnchor'); $anchor = get_sub_field('anchor'); $layout = get_sub_field('layout'); $content = get_sub_field('content'); $img = get_sub_field('image'); $size = 'full'; $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);  $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section  <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?> class="imgTxt <?php echo $layout . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="wrap">
	<div class="img animate__animated <?php if($layout == 'layout-IT'): echo 'animate__fadeInLeft'; else: echo 'animate__fadeInRight'; endif; ?>"><?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt] ); ?></div>
	<div class="txt animate__animated <?php if($layout == 'layout-IT'): echo 'animate__fadeInRight'; else: echo 'animate__fadeInLeft'; endif; ?>"><?php echo $content; ?></div>
</div></section>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'factsheetsModule' ):
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $bg = get_sub_field('bg'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob');

	$factsheetsNA = get_sub_field('factsheets'); $factsheetsUK = get_sub_field('factsheetsUK'); $currentLang = get_locale();
	if($currentLang == 'en_US'): $factsheets = $factsheetsNA; elseif($currentLang == 'en_GB'): $factsheets = $factsheetsUK; endif; ?>
<section class="factsheets <?php echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
  <div class="wrap animate__animated animate__fadeInUp"><div class="factsheetSlider">
    <?php foreach( $factsheets as $post ): setup_postdata($post); $summary = get_field('summary'); $pdf = get_field('pdf'); $img = get_post_thumbnail_id(); $size = '500-648'; $alt = get_post_meta($img, '_wp_attachment_image_alt', true); ?>
        <div class="slide"> 
            <a href="<?php echo $pdf; ?>" target="_blank">
            	<?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt] ); ?>
            	<h4><?php the_title(); ?></h4>
            	<?php echo $summary; ?>
            </a>
        </div>
    <?php endforeach; wp_reset_postdata(); ?>
	</div></div>
</section>



<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'events' ): $hubspot = get_sub_field('hubspot');
    $GLOBALS['hubspot'] = $hubspot; $formIntro = get_sub_field('formIntro'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="events <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="24"]'); echo do_shortcode('[searchandfilter field="23"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="8" action="show-results"]'); ?>
</section>
<?php if ($hubspot): ?>
  <div id="modal-event" class="popModal">
    <div class="overlay"></div>
    <div class="popup"><span class="closeModal" aria-label="Close popup"><span class="icon-close"></span></span><?php echo $formIntro, $hubspot; ?></div><!--end popup-->
  </div><!--end hubForm-->
<?php endif; ?>





<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'video' ): $hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $link = get_sub_field('link'); $mp4 = get_sub_field('mp4');  $webm = get_sub_field('webm'); $poster = get_sub_field('poster'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="video <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
	<div class="bg">
		<div class="embedContainer animate__animated animate__fadeInUp">
			 <video poster="<?php echo $poster; ?>" controls>
			    <source src="<?php echo $mp4; ?>" type="video/mp4">
			    <source src="<?php echo $webm; ?>" type="video/webm">
			    Your browser doesn't support HTML5 video tag.
			</video>
		</div>
		<?php if($link): ?><div class="foot"><a class="btn" role="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a></div><?php endif; ?>
	</div>
</section>





<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'locationModule' ): 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$type = get_sub_field('type');
	$bg = get_sub_field('bg');
	$colLR = get_sub_field('colLR'); $colStack = get_sub_field('colStack');
	$link = get_sub_field('link');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="locations <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php $rows = get_sub_field('locations'); $count = count($rows); $col = ($count % 3 === 0 ? 'col-3' : 'col-2'); if($rows): $i=0; ?>
		<div class="box <?php echo $col; ?>">
			<div class="head"><h2>Locations</h2></div>
			<?php foreach($rows as $row){ $i++;
				$img = $row['image']; $size = '1200-700'; $alt = get_post_meta($img, '_wp_attachment_image_alt', true);
				$title = $row['title'];
				$subhead = $row['subhead'];
				$addy = $row['address'];
				$link = $row['custom_link'];
			?>
				<div class="loc animate__animated animate__fadeInDown animate__delay-<?php echo $i; ?>"><a href="<?php if($link): echo $link; else: echo 'https://maps.google.com?q=' . $addy; endif; ?>" target="_blank">
					<div class="txt">
						<h4><?php echo $title; ?></h4>
						<?php if($subhead): ?><p><strong><?php echo $subhead; ?></strong></p><?php endif; ?>
						<h5 class="noLine"><?php echo $addy; ?></h5>
					</div>
					<?php echo wp_get_attachment_image($img, $size, "", ['alt'=>$alt]); ?>
				</a></div>
			<?php } ?>
		</div>
	<?php endif; ?>

</section>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'resourceFiltering' ):
	global $toFilter; $toFilter = get_sub_field('toFilter');
	global $featuredResource;
	$postType = '';
	if($toFilter == 'type-blog'): $postType = 'post'; elseif ($toFilter == 'type-stories'): $postType = 'story'; elseif ($toFilter == 'type-webvid'): $postType = 'webinarsvids'; elseif ($toFilter == 'type-guides'): $postType = 'guide'; endif;
	if($postType) {$sticky = get_option('sticky_posts');if (!empty($sticky)) {$args = array('post_type' => $postType,'post__in' => $sticky,'posts_per_page' => 1,'orderby' => 'date','order' => 'DESC','ignore_sticky_posts' => 1);$sticky_query = new WP_Query($args);if ($sticky_query->have_posts()) {$featuredResource = $sticky_query->posts[0];}wp_reset_postdata();}}
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="searchfilter hi <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($toFilter == 'type-all'):
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Resource Type"]'); echo do_shortcode('[searchandfilter field="Audience"]'); echo do_shortcode('[searchandfilter field="Location"]'); echo do_shortcode('[searchandfilter field="Solution"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="1" action="show-results"]'); ?>
	<?php elseif($toFilter == 'type-news'):
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Type-NewsMedia"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="3" action="show-results"]'); ?>
	
	<?php elseif($toFilter == 'type-blog'): 
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Blog-Audience"]'); echo do_shortcode('[searchandfilter field="Blog-Location"]'); echo do_shortcode('[searchandfilter field="Blog-Solution"]'); echo do_shortcode('[searchandfilter field="Blog-Theme"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="5" action="show-results"]'); ?>
	

	<?php elseif($toFilter == 'type-stories'):
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Story-Audience"]'); echo do_shortcode('[searchandfilter field="Story-Location"]'); echo do_shortcode('[searchandfilter field="Story-Solution"]'); echo do_shortcode('[searchandfilter field="Story-Product"]'); 
		include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="7" action="show-results"]'); ?>

	<?php elseif($toFilter == 'type-webvid'): 
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Type-WebVid"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="2" action="show-results"]'); ?> 
	<?php elseif($toFilter == 'type-guides'): 
		echo do_shortcode('[searchandfilter query="6" action="show-results"]'); ?>
	<?php elseif($toFilter == 'type-factsheets'): 
		include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="Factsheet-Audience"]'); echo do_shortcode('[searchandfilter field="Factsheet-Location"]'); include('filterbarClose.php');
		echo do_shortcode('[searchandfilter query="4" action="show-results"]'); ?>
	<?php endif; ?>
</section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'footnote' ): $content = get_sub_field('content'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="footnote animate__animated animate__fadeInLeft <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><?php echo $content; ?></section>




<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'productSlider' ): $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="productSliderModule <?php echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="overlay"></div><div class="wrap alt animate__animated animate__fadeInDown">
 	<?php if( have_rows('slides') ): ?>
 		<nav class="sliderNav"><button class="slick-prev prev"><span class="slick-sr-only">Previous</span></button><button class="slick-next next"><span class="slick-sr-only">Next</span></button></nav>
		<div class="productSlider">
			<?php while( have_rows('slides') ): the_row(); 
				$img = get_sub_field('image'); $size = 'full'; $alt = get_post_meta( $img, '_wp_attachment_image_alt', true);
				$content = get_sub_field('content');
			?>
				<div class="slide">
					<div class="txt"><div class="inner"><?php echo $content; ?></div></div>
					<div class="img"><?php echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt] ); ?></div>
				</div><!--end slide-->
			<?php endwhile; ?>
		</div><!--end productSlides-->
	<?php endif; ?>
</div></section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'codeBlock' ): $hasAnchor = get_sub_field('hasanchor'); $anchor = get_sub_field('anchor'); $bg = get_sub_field('bg'); if(!$bg): $bg = 'bg-gray'; endif; $hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $width = get_sub_field('width'); $code = get_sub_field('code'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?> class="codeBlock <?php echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro reduceMar1 animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
	<div class="wrap animate__animated animate__fadeInUp" <?php if($width): ?>style="max-width:<?php echo $width; ?>px"<?php endif; ?>><?php echo $code; ?></div>
</section>



<?php elseif( get_row_layout() == 'fullWidthCallout' ):
	$bgColor = get_sub_field('bg');
	$bgOverlay = get_sub_field('bgOverlay');
	$content = get_sub_field('content');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob');
?>
<section class="fullWidthCallout alt <?php echo $bgColor . ' ' . $bgOverlay . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<div class="overlay"></div>
	<div class="wrap"><?php echo $content; ?></div>
</section>





<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'accSlider' ): $row = get_row_index(); $content = get_sub_field('content'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="accSliderModule animate__animated animate__fadeInUp <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="wrap">



<?php $count = count(get_sub_field('slider')); if( have_rows('slider') ): ?>
	<div id="accSlider-<?php echo $row; ?>" class="accordion-slider"><div class="as-panels slides-<?php echo $count; ?>">
		<?php while( have_rows('slider') ): the_row(); $bg = get_sub_field('bg'); $content = get_sub_field('content'); ?>
			<div class="as-panel">
				<?php
				/* Panel background.
				   The sizes hint depends on the panel count, because only .slides-5 has
				   viewport-width rules (_modules.sass:2492 — 92vw / 69vw at 600px /
				   61vw at 768px / 46vw at 1024px).
				   Any other count falls through to accSlider.css's height:100%,
				   width:auto, so the panel is the slider's fixed 500px height times the
				   image aspect ratio — a fixed pixel width, not a percentage. Measured
				   on staging at a 1440px viewport: 883px and 857px, which is 500 x 1.766
				   and 500 x 1.714. 900px covers that with headroom.
				   Below 600px, _modules.sass:2534 sets width:100%.
				   $bg must be an attachment ID; a URL string still renders, unsized. */
				$asSizes = ( (int) $count === 5 )
					? '(min-width: 1024px) 46vw, (min-width: 768px) 61vw, (min-width: 600px) 69vw, 92vw'
					: '(min-width: 600px) 900px, 100vw';
				if( is_numeric($bg) ):
					echo wp_get_attachment_image( $bg, '1200-700', false, array(
						'class' => 'as-background',
						'alt'   => get_post_meta( $bg, '_wp_attachment_image_alt', true),
						'sizes' => $asSizes,
					) );
				elseif( $bg ):
					echo '<img class="as-background" src="' . esc_url($bg) . '" alt="" />';
				endif;
				?>
				<div class="overlay"></div>
				<div class="as-layer text alt">
	        		<?php echo $content; ?>
	        	</div>
			</div>
		<?php endwhile; ?>
	</div></div>
<?php endif; ?>


<div class="controls">
  <a href="#" id="prevArrow-<?php echo $row; ?>"><span class="icon-back"></span></a>
  <a href="#" id="nextArrow-<?php echo $row; ?>"><span class="icon-link"></span></a>
</div>

<script>
  (function(){
    const totalPanels = <?php echo $count; ?>;
    const prevBtn = document.getElementById('prevArrow-<?php echo $row; ?>');
    const nextBtn = document.getElementById('nextArrow-<?php echo $row; ?>');
    const sliderId = 'accSlider-<?php echo $row; ?>';

    function getCurrentIndex() {
      const match = location.hash.match(new RegExp(`#${sliderId}/(\\d+)`));
      return match ? parseInt(match[1]) : 0;
    }

    function updateHash(index) {
      location.hash = `#${sliderId}/${index}`;
    }

    function updateArrowStates() {
      const current = getCurrentIndex();
      prevBtn.classList.toggle('disabled', current === 0);
      nextBtn.classList.toggle('disabled', current === totalPanels - 1);
    }

    prevBtn.addEventListener('click', e => {
      e.preventDefault();
      const current = getCurrentIndex();
      if(current > 0) updateHash(current - 1);
    });

    nextBtn.addEventListener('click', e => {
      e.preventDefault();
      const current = getCurrentIndex();
      if(current < totalPanels - 1) updateHash(current + 1);
    });

    window.addEventListener('hashchange', updateArrowStates);
    window.addEventListener('load', updateArrowStates);
  })();
</script>



</div></section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'team' ): $type = get_sub_field('type'); $hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro'); $hasAnchor = get_sub_field('hasAnchor'); $anchor = get_sub_field('anchor'); $bg = get_sub_field('bg'); $cols = get_sub_field('columns'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?>  class="teamModule <?php if($bg == 'bg-dblue'): echo 'alt '; endif; echo $bg . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php if($hasIntro && $intro): echo '<div class="intro reduceMar1 animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>
	<?php $args = array('post_type'=>'team','posts_per_page'=>-1,'orderby'=>'menu_order','order'=>'ASC','tax_query'=>array(array('taxonomy'=>'team-type','field'=>'term_id','terms'=>$type))); $loop = new WP_Query($args); echo '<ul class="clean animate__animated animate__fadeInUp '.$cols.'">'; while($loop->have_posts()): $loop->the_post(); $pos = get_field('pos'); ?>
		<li>
    	<?php
		/* Placeholder path was hardcoded to routeware.com, so staging and local both
		   pulled it from production. content_url() resolves to the current site. */
		if(has_post_thumbnail()):
			the_post_thumbnail( '400-500' );
		else:
			echo '<img src="' . esc_url( content_url( 'uploads/2025/08/teamPlaceholder.jpg' ) ) . '" width="400" height="500" alt="" loading="lazy" />';
		endif;
		?>
    	<h4><?php the_title(); ?></h4>
    	<?php if($pos): ?><h5 class="noLine"><?php echo $pos; ?></h5><?php endif; ?>
		</li>
	<?php endwhile; ?>
</ul><?php wp_reset_query(); ?>


</section>


<!-- / / / / / / ------------------------------------------------------>
<?php 
	elseif( get_row_layout() == 'logo_bar' ): 
		$subheading = get_sub_field('subheading'); 
		$heading = get_sub_field('heading'); 
		$logos = get_sub_field('logos'); 
		$bg = get_sub_field('background');
		// NOTE: using lowercase for the field names
		$spaceT = get_sub_field('spacet'); $spaceTmob = get_sub_field('spacetmob'); $spaceB = get_sub_field('spaceb'); $spaceBmob = get_sub_field('spacebmob');
?>
	
<section class="logo-bar txtColumns <?php echo ($bg ? 'bg-lgray logo-bar--padded ' : '') . 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<div class="wrap">
		<div class="logo-bar__inner">
			<?php if( $subheading || $heading ): ?>
			<div class="logo-bar__content">
				<?php if( $subheading ): ?><h5><?php echo $subheading; ?></h5><?php endif; ?>
				<?php if( $heading ): ?><h2><?php echo $heading; ?></h2><?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if( $logos ): ?>
			<div class="logo-bar__logos">
				<?php foreach( $logos as $logo ):
					$image_id = $logo['image'];
					$url = $logo['url'];
				?>
					<div class="logo-bar__logo-item">
						<?php if( $url ): ?>
							<a class="logo-bar__logo-link" href="<?php echo $url; ?>">
						<?php endif; ?>
						<?php
						/* $image_id is already an attachment ID here, so this needs no ACF
						   change. base.css:11868 caps .logo-bar__logo-image at 200px wide. */
						echo wp_get_attachment_image( $image_id, 'medium', false, array(
							'class' => 'logo-bar__logo-image',
							'alt'   => get_post_meta( $image_id, '_wp_attachment_image_alt', true),
							'sizes' => '200px',
						) );
						?>
						<?php if( $url ): ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'txtColumns' ): 
	$hasIntro = get_sub_field('hasIntro'); $intro = get_sub_field('intro');
	$hasAnchor = get_sub_field('hasAnchor'); $anchor = get_sub_field('anchor');
	$bg = get_sub_field('bg');
	$cols = get_sub_field('col'); 
	$content1 = get_sub_field('content1'); $content2 = get_sub_field('content2'); $content3 = get_sub_field('content3');
	$spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section <?php if($hasAnchor && $anchor): echo 'id="' . $anchor . '"'; endif; ?>  class="txtColumns <?php echo $bg . ' ' . $type . ' mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>"><div class="wrap">
	<?php if($hasIntro && $intro): echo '<div class="intro  animate__animated animate__zoomIn">' . $intro . '</div>'; endif; ?>

	<div class="cols <?php echo $cols; ?>">
		<div class="col"><?php echo $content1; ?></div>
		<div class="col"><?php echo $content2; ?></div>
		<?php if($cols == 'col3'): ?><div class="col"><?php echo $content3; ?></div><?php endif; ?>
	</div><!--end cols-->


</div></section>


<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'gallery' ): $intro = get_sub_field('intro'); $shortcode = get_sub_field('shortcode'); $link = get_sub_field('link'); $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="gallery animate__animated animate__fadeInDown <?php echo $width; ?> <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<div class="wrap">
		<?php if($intro): echo '<div class="intro introFull">' . $intro . '</div>'; endif; ?>
		<?php echo do_shortcode($shortcode ); ?>
		<?php if($link): ?><div class="foot"><a role="link" class="btn" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a></div><?php endif; ?>
	</div>
</section>






 
<!-- / / / / / / ------------------------------------------------------>
<?php elseif( get_row_layout() == 'partnersNew' ): $spaceT = get_sub_field('spaceT'); $spaceTmob = get_sub_field('spaceTmob'); $spaceB = get_sub_field('spaceB'); $spaceBmob = get_sub_field('spaceBmob'); ?>
<section class="partnerModule <?php echo 'mar' . $spaceT . ' mar' . $spaceTmob . ' mar' . $spaceB . ' mar' . $spaceBmob; ?>">
	<?php include('filterbarOpen.php'); echo do_shortcode('[searchandfilter field="29"]'); include('filterbarClose.php'); echo do_shortcode('[searchandfilter query="11" action="show-results"]'); ?>

</section>

<!-- / / / / / / ------------------------------------------------------>
<?php endif; //end layouts ?>