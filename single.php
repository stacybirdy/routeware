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
	if($postType == 'story'): $formIntro = get_field('formIntroStory', 'options');
	elseif($postType == 'post'): $formIntro = get_field('formIntroBlog', 'options');
	elseif($postType == 'newsmedia'): $formIntro = get_field('formIntroNews', 'options');
	elseif($postType == 'webinarsvids'): $formIntro = get_field('formIntroWebVid', 'options');
	elseif($postType == 'guide'):
		$formIntro = get_field('formIntroGuide', 'options');
		$hubspotGuide = get_field('hubspot');
		$flipbook = get_field('flipbook');
	endif;
	
?>


<section class="hero alt type-txt type-resource <?php if($img): echo 'hasFtImg'; endif; ?>">
	<div class="txt bg-green"><div class="overlay"></div><div class="inner animate__animated animate__fadeInDown animate__duration-10">
		<h5><?php echo $postTypeName; ?></h5>
		<h1><?php the_title(); ?></h1>
		<?php if($postType == 'post'): ?><h5 class="noLine">by <?php echo $authorName . '&nbsp;&nbsp;•&nbsp;&nbsp;' . get_the_date('F j, Y'); ?></h5><?php endif; ?>
	</div></div><!--end inner/text-->
</section>

<div class="resourceSingle marB-xl marBmob-l <?php echo $postType; if($img): echo ' hasFtImg'; endif; ?>"><div class="resourceWrap">
	<div class="primary">
		<?php if($postType == 'webinarsvids'): ?>
			<div class="embedContainer animate__animated animate__zoomIn animate__delay-1">
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
		<?php elseif($postType == 'guide'): echo $flipbook; ?>


		<?php else: 
			if($img): echo wp_get_attachment_image( $img, $size, "", ['alt' => $alt, 'class' => 'ftImg animate__animated animate__zoomIn'] ); endif;
		endif; ?>
		<?php if($postType != 'post'): ?>
			<div class="cta top animate__animated animate__fadeInUp">
				<div class="share"><span>Share this:</span><?php echo do_shortcode( '[addtoany]' ); ?></div>
				<div class="link">
					<?php if($postType == 'guide'): ?>
						<button id="trigger-1" class="btn popTrigger"><span class="icon-send"></span>Send to My Inbox</button>
					<?php else: ?>
						<button id="trigger-1" class="btn popTrigger">Join our Mailing List</button>
					<?php endif; ?>
				</div>
			</div><!--end cta-->
		<?php endif; ?>
		<section class="contentEditor animate__animated animate__fadeInUp"><div class="wrap"><?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?></div></section>
		<?php if( have_rows('resourceModules') ): while ( have_rows('resourceModules') ) : the_row(); include('inc/modules.php'); endwhile; else: endif; ?>
		<?php if($postType == 'story' || $postType == 'newsmedia'): ?>
			<div class="cta bot animate__animated animate__fadeInDown">
				<div class="share"><span>Share this:</span><?php echo do_shortcode( '[addtoany]' ); ?></div>
				<div class="link"><button id="trigger-1" class="btn popTrigger">Join our Mailing List</button>
				</div>
			</div><!--end cta-->
		<?php elseif($postType == 'post'): $hasByline = get_field('hasbyline'); $authorID = get_the_author_meta('ID'); $authorName = get_the_author_meta('display_name'); $authorBio = get_field('bio', 'user_' . $authorID); $authorHeadshot = get_field('headshot', 'user_' . $authorID); $alt = get_post_meta( $authorHeadshot, '_wp_attachment_image_alt', true); ?>

			<?php if($hasByline): ?>
				<div class="authorBox marT-l marTmob-m animate__animated animate__fadeInLeft">
					<h5>About the Author</h5>
					<div class="wrap">
						<div class="img"><?php if($authorHeadshot): echo wp_get_attachment_image($authorHeadshot, '300-300', "", ['alt' => $alt]); else: echo '<img src="' . get_template_directory_uri() . '/images/defaultAuthor.png" alt="' . $authorName . '">'; endif; ?></div>
						<div class="txt"><h4><?php echo $authorName; ?></h4><?php echo $authorBio; ?></div>
					</div>
				</div>
			<?php endif; ?>

			<div class="foot"><a href="<?php echo get_permalink(967); ?>" class="btn">See all posts</a></div>
		<?php endif; ?>
	</div><!--end primary-->
	<?php if($postType == 'post'): ?>
		<aside>
			<div class="cta">
				<div class="share"><span>Share this:</span><?php echo do_shortcode( '[addtoany]' ); ?></div>
				<div class="link">
					<?php if($postType == 'guide'): ?><button id="trigger-1" class="btn popTrigger"><span class="icon-send"></span>Send to My Inbox</button>
					<?php else: ?><button id="trigger-1" class="btn popTrigger">Join our Mailing List</button>
					<?php endif; ?>
				</div>
			</div><!--end cta-->
			<?php $solution = wp_get_post_terms(get_the_ID(), 'sol'); if (!empty($solution)) { ?>
				<div class="related">
					<h3>Related Posts</h3>
					<div class="relatedRoll">
						<?php $args = array(
								'post_type' => 'post',
								'tax_query' => array(array('taxonomy' => 'sol', 'field' => 'slug', 'terms' => $solution[0]->slug)),
								'post__not_in' => array(get_the_ID()),
								'posts_per_page' => 4
							);
							$loop = new WP_Query($args); while ($loop->have_posts()) : $loop->the_post(); $img = get_post_thumbnail_id(); $size = '800-500'; $alt = get_post_meta($img, '_wp_attachment_image_alt', true); ?>
							<article>
								<?php echo wp_get_attachment_image($img, $size, "", ['alt' => $alt]); ?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</div><!--end relatedRoll-->
				</div><!--end related-->
			<?php } ?>
		</aside>
	<?php endif; ?>
</div></div><!--end wrap/resourceSingle-->


<?php if(($postType == 'guide' && $hubspotGuide) || ($postType != 'guide' && $hubspot)): ?>
	<div id="modal-1" class="popModal alt">
		<div class="overlay"></div>
		<div class="popup"><div class="bgOverlay"></div><span class="closeModal" aria-label="Close"><span class="icon-close"></span></span><div class="content"><?php echo $formIntro; if($postType == 'guide'): echo $hubspotGuide; else: echo $hubspot; endif; ?></div></div><!--end content/popup-->
	</div><!--end hubForm-->
<?php endif; ?>

<?php get_footer(); ?>
