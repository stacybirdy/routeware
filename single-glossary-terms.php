<?php
/**
 * @package routeware
 */
get_header();

$hero_description = get_field('hero_description');
$icon = get_field('icon');
	
?>


<section class="hero alt type-txt type-resource">
	<div class="txt bg-green">
    <div class="overlay"></div>
      <div class="inner animate__animated animate__fadeInDown animate__duration-10">
        <h5>Glossary</h5>
        <h1 class="hero__heading">
          <?php if($icon):  ?>
            <div class="hero__icon"><?php rw_maybe_get_svg_from_media_id($icon['ID']); ?></div>
          <?php endif; ?>
          <?php the_title(); ?>
        </h1>
        <?php if( $hero_description ): ?>
        <div class="hero__description">
          <?php echo $hero_description; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
</section>

<div class="resourceSingle">
  <div class="resourceWrap">
        <div class="cta top animate__animated animate__fadeInUp">
          <?php rw_breadcrumbs(); ?>
          <div class="link">
              <a href="<?php echo get_post_type_archive_link('glossary-terms'); ?>" id="trigger-1" class="btn popTrigger">Back to Glossary</a>
          </div>
        </div><!--end cta-->
  </div>

  <section class="contentEditor animate__animated animate__fadeInUp">
    <div class="wrap">
      <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
    </div>
  </section>

  <a class="single-glossary-terms__end-btn animate__animated animate__fadeInUp animate__duration-10 btn" href="<?php echo get_post_type_archive_link('glossary-terms'); ?>">Back to Glossary</a>
</div>

<?php get_footer(); ?>
