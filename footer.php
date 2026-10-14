<?php
/**
 * @package routeware
 */
?>

<?php
	$footerImg = get_field('footerImg', 'options');
	$footerContent = get_field('footerContent', 'options');
	$footerPartnerContent = get_field('footercontentpartners', 'options');
	$footerHS = get_field('footerHubspot', 'options');
	$footerHSPartners = get_field('footerhubspotpartners', 'options');
	$noFooterForm = get_field('noFooterForm', 'options');
	$logoWhite = get_field('logoWhite', 'options');
	$footerBlurb = get_field('footerBlurb', 'options');
	$email = get_field('email', 'options');
	$phone = get_field('phone', 'options');
	$ig = get_field('instagram_url', 'options');
	$li = get_field('linkedin_url', 'options');
	$fb = get_field('facebook_url', 'options');
	$x = get_field('x_url', 'options');
	$yt = get_field('youtube_url', 'options');
	$copyright = get_field('copyright', 'options');
?>


<footer id="colophon" class="site-footer alt" role="contentinfo">
    <?php $matchFound = false; foreach( $noFooterForm as $page ){ if( $page->ID == get_the_ID() ){ $matchFound = true; break; } } if( !$matchFound && !is_404() ): ?>

		<div class="topFoot">
			<div class="img">
				<?php
				/* Was an inline background-image, which can't carry srcset or lazy
				   loading. Now a real img filling .img via object-fit (see
				   _head-foot.sass:563). Displays at 100vw below $break-desk and 60vw
				   above (_head-foot.sass:572).
				   $footerImg must be an attachment ID; a URL string still renders. */
				if( is_numeric($footerImg) ):
					echo wp_get_attachment_image( $footerImg, 'full', false, array(
						'alt'     => get_post_meta( $footerImg, '_wp_attachment_image_alt', true),
						'sizes'   => '(min-width: 1024px) 60vw, 100vw',
						'loading' => 'lazy',
					) );
				elseif( $footerImg ):
					echo '<img src="' . esc_url($footerImg) . '" alt="" loading="lazy" />';
				endif;
				?>
			</div>
			<div id="form" class="txt <?php if( have_rows('modules') ): $i = 0; while ( have_rows('modules') ) : the_row(); $i++; if( $i > 1 ): break; endif; $bg = get_sub_field('bg'); echo $bg; endwhile; endif; ?>"><div class="overlay"></div><div class="inner"><?php if(is_page(11509) && $footerPartnerContent): echo $footerPartnerContent; else: echo $footerContent; endif; if(is_page(11509) && $footerHSPartners): echo $footerHSPartners; else: echo $footerHS; endif; ?>
			</div></div>
		</div><!--end topFoot-->
	<?php endif; //end form match?>


	<div class="botFoot">
		<div class="wrap">
			<div class="col colNav colDesk"><?php echo navBranch('primary', 74); ?></div>
			<div class="col colNav colDesk"><?php echo navBranch('primary', 64); echo navBranch('primary', 61); ?></div>
			
			<div class="col colNav colDesk"><?php echo navBranch('primary', 12000); echo navBranch('primary', 12213); ?></div>
			<div class="col colNav colDesk"><?php echo navBranch('primary', 56); echo navBranch('primary', 68); ?></div>
		</div>
		<div class="wrap botRow">
			<div class="col colNav colLogo"> 
				<a class="logo" href="/"><img src="<?php echo $logoWhite; ?>" alt="Routeware logo" width="614" height="123" /></a>
				<?php if($footerBlurb): echo $footerBlurb; endif; ?>
			</div>
			<div class="col colNav colInfo colSocial"> 
				<h5 class="social noLine">Follow Us</h5>	
				<ul class="social clean" aria-label="social media profile links">
					<?php if($li): ?><li><a aria-label="LinkedIn page, opens in new window" href="<?php echo $li; ?>" target="_blank" class="icon-li"></a></li><?php endif; ?>
					<?php if($yt): ?><li><a aria-label="YouTube channel, opens in new window" href="<?php echo $yt; ?>" target="_blank" class="icon-yt"></a></li><?php endif; ?>
					<?php if($fb): ?><li><a aria-label="Facebook page, opens in new window" href="<?php echo $fb; ?>" target="_blank" class="icon-fb"></a></li><?php endif; ?>
					<?php if($ig): ?><li><a aria-label="Instagram account, opens in new window" href="<?php echo $ig; ?>" target="_blank" class="icon-ig"></a></li><?php endif; ?>
					<?php if($x): ?><li><a aria-label="X feed, opens in new window" href="<?php echo $x; ?>" target="_blank" class="icon-x"></a></li><?php endif; ?>
				</ul>

				<?php $askAiMode = 'site'; include('inc/ask-ai.php'); ?>

				<div class="colMob"><?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?> 
				<?php if($copyright): echo '<div class="copyright">' . $copyright . '</div>'; endif; ?></div>
			</div>
			<div class="col colNav colInfo colCopy"> 
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?> 
				<?php if($copyright): echo '<div class="copyright">' . $copyright . '</div>'; endif; ?>
			</div>
		</div>
	</div>





</footer>



</main><!--end main-->

<!-- Start of HubSpot code snippet -->
<button type="button" id="hs_show_banner_button"
style="background-color: #52A959; border: 1px solid #52A959;
       border-radius: 3px; padding: 10px 16px; text-decoration: none; color: #fff;
       font-family: inherit; font-size: inherit; font-weight: normal; line-height: inherit;
       text-align: left; text-shadow: none;"
onClick="(function(){
  var _hsp = window._hsp = window._hsp || [];
  _hsp.push(['showBanner']);
})()"
>
Cookie Settings
</button>

<!-- End of HubSpot code snippet -->

<?php wp_footer(); ?>
</body>
</html>
