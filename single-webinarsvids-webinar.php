<?php
/**
 * @package routeware
 */
get_header();
	$postType = get_post_type(); $postTypeObj = get_post_type_object($postType); $postTypeName = $postTypeObj->labels->singular_name;
	$img = get_post_thumbnail_id(); $alt = get_post_meta( $img, '_wp_attachment_image_alt', true); $size = '1800-1019'; $fallbackSize = '936-530'; $imgMeta = wp_get_attachment_metadata($img); if ($imgMeta && isset($imgMeta['sizes'][$size]) && ($imgMeta['sizes'][$size]['width'] < 1800 || $imgMeta['sizes'][$size]['height'] < 1019)) {$size = $fallbackSize;}
	$vid = get_field('video');
	$hubspot = get_field('resourcesHubspot', 'options');
	$authorId = $post->post_author; $authorName = get_the_author_meta( 'display_name', $authorID );
	$formIntro = get_field('formIntroWebVid', 'options');
	$formHeadline = get_field('formgatedheadline', 'options');
	$hubspotCode = get_field('hubspotcode');
	$hubspotFormID = get_field('hsformid');
	$cookieKeyHS = 'hs_webinar_' . get_the_ID();

?>

<section class="hero asd alt type-txt type-resource hasFtImg <?php echo ($hubspotFormID && !isset($_COOKIE[$cookieKeyHS])) ? 'hasGatedForm' : ''; ?>">
	<div class="txt bg-green"><div class="overlay"></div><div class="inner animate__animated animate__fadeInDown animate__duration-10">
		<h5><?php echo $postTypeName; ?></h5>
		<h1><?php the_title(); ?></h1>
	</div></div><!--end inner/text-->
</section>

<div class="resourceSingle marB-xl marBmob-l hasFtImg <?php echo ($hubspotFormID && !isset($_COOKIE[$cookieKeyHS])) ? 'hasGatedForm' : ''; ?>"><div class="resourceWrap"><div class="primary">

	<?php if($hubspotFormID): if($formHeadline): ?><div class="gatedForm formHL animate__animated animate__zoomIn" style="<?php echo isset($_COOKIE[$cookieKeyHS]) ? 'display:none;' : ''; ?>"><h4><?php echo $formHeadline; ?></h4></div><?php endif; endif; ?>

	<div class="embedContainer animate__animated animate__zoomIn animate__delay-1 gatedVideo"
	     style="<?php echo ($hubspotFormID && !isset($_COOKIE[$cookieKeyHS])) ? 'display:none;' : ''; ?>">

	    <?php preg_match('/src="(.+?)"/', $vid, $matches); $src = $matches[1];
	        $params = array(
	            'autoplay' => 0,
	            'loop' => 1,
	            'title'  => 0,
	            'byline'  => 0,
	            'portrait'  => 0,
	            'controls'  => 1,
	            'mute'  => 0,
	            'muted'  => 0,
	        );
	        $new_src = add_query_arg($params, $src);
	        $vid = str_replace($src, $new_src, $vid);
	        $attributes = 'frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen';
	        $vid = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $vid);
	        echo $vid;
	    ?>
	</div>

	<?php if($hubspotFormID): ?>
		<div class="formContainer animate__animated animate__zoomIn animate__delay-1 gatedForm"
		     style="<?php echo isset($_COOKIE[$cookieKeyHS]) ? 'display:none;' : ''; ?>">
			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
			<script>
			hbspt.forms.create({
				portalId: "5063216",
				formId: "<?php echo esc_js($hubspotFormID); ?>",
				region: "na1",
				onFormSubmitted: function() {
					document.cookie = "<?php echo esc_js($cookieKeyHS); ?>=true; path=/; max-age=86400";
					var video    = document.querySelector('.gatedVideo');
					var form     = document.querySelector('.formContainer.gatedForm');
					var headline = document.querySelector('.gatedForm.formHL');
					var hero     = document.querySelector('.hero');
					var resource = document.querySelector('.resourceSingle');
					if (video)    video.style.display    = '';
					if (form)     form.style.display     = 'none';
					if (headline) headline.style.display = 'none';
					if (hero)     hero.classList.remove('hasGatedForm');
					if (resource) resource.classList.remove('hasGatedForm');
				}
			});
			</script>
		</div>
	<?php endif; ?>


	<div class="cta top animate__animated animate__fadeInUp">
		<div class="share"><span>Share this:</span><?php echo do_shortcode( '[addtoany]' ); ?></div>
		<div class="link">
			<button id="trigger-1" class="btn popTrigger">Join our Mailing List</button>
		</div>
	</div><!--end cta-->

	<section class="contentEditor animate__animated animate__fadeInUp"><div class="wrap"><?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?></div></section>
	<?php if( have_rows('resourceModules') ): while ( have_rows('resourceModules') ) : the_row(); include('inc/modules.php'); endwhile; else: endif; ?>

</div></div></div><!--end primary/wrap/resourceSingle-->


<?php if($hubspot): ?>
	<div id="modal-1" class="popModal alt">
		<div class="overlay"></div>
		<div class="popup"><div class="bgOverlay"></div><span class="closeModal" aria-label="Close"><span class="icon-close"></span></span><div class="content"><?php echo $formIntro; if($postType == 'guide'): echo $hubspotGuide; else: echo $hubspot; endif; ?></div></div><!--end content/popup-->
	</div><!--end hubForm-->
<?php endif; ?>



<?php get_footer(); ?>
