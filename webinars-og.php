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
	$formID = get_field('gatedform'); 
	$cookieKey = 'gf_submitted_' . $formID;
	$formHeadline = get_field('formgatedheadline', 'options'); 
	$hubspotCode = get_field('hubspotcode'); 

?>
<?php if($formID): ?><script>var formId = <?php echo intval($formID); ?>;</script><?php endif; ?>

<section class="hero asd alt type-txt type-resource hasFtImg <?php echo isset($_COOKIE[$cookieKey]) ? '' : 'hasGatedForm'; ?>">
	<div class="txt bg-green"><div class="overlay"></div><div class="inner animate__animated animate__fadeInDown animate__duration-10">
		<h5><?php echo $postTypeName; ?></h5>
		<h1><?php the_title(); ?></h1>
	</div></div><!--end inner/text-->
</section>

<div class="resourceSingle marB-xl marBmob-l hasFtImg <?php if($formID): echo isset($_COOKIE[$cookieKey]) ? '' : 'hasGatedForm'; endif; ?>"><div class="resourceWrap"><div class="primary">

	<?php if($formID): if($formHeadline): ?><div class="gatedForm formHL animate__animated animate__zoomIn" style="<?php echo isset($_COOKIE[$cookieKey]) ? 'display:none;' : ''; ?>"><h4><?php echo $formHeadline; ?></h4></div><?php endif; endif; ?>

	<?php if($hubspotCode): echo $hubspotCode; endif; ?>

	<div class="embedContainer animate__animated animate__zoomIn animate__delay-1 gatedVideo" 
	     style="<?php if($formID): echo isset($_COOKIE[$cookieKey]) ? '' : 'display:none;'; endif; ?>">



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

	<?php if($formID): ?>
		<div class="formContainer animate__animated animate__zoomIn animate__delay-1 gatedForm"
	     style="<?php echo isset($_COOKIE[$cookieKey]) ? 'display:none;' : ''; ?>">
	    	<?php gravity_form($formID, false, false, false, null, true); ?>
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
