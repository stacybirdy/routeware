<?php
/**
 * Glossary Term Item
 * 
 * @package routeware
 */

$args = wp_parse_args(
  $args,
  array(
    'word' => get_the_title(),
    'icon' => isset(get_field('icon')['url']) ? get_field('icon')['url'] : '',
    'definition' => get_field('hero_description') ? get_field('hero_description') : '',
    'url' => get_permalink(),
  )
);

// $args['icon'] = $args['icon'] ? $args['icon'] : get_template_directory_uri() . '/images/definition-icon-green.svg';

extract($args);

?>


<div class="glossary-term-item animate__animated animate__fadeInLeft inView" data-letter="<?php echo esc_attr( strtoupper( substr( $word, 0, 1 ) ) ); ?>">
  <div class="glossary-term-item__header <?php echo $icon ? 'glossary-term-item__header--has-icon' : ''; ?>">
    <?php if($icon) : ?>
    <div class="glossary-term-item__icon">
      <?php rw_maybe_get_svg_from_media_id($icon); ?>
    </div>
    <?php endif; ?>
    <h2 class="glossary-term-item__heading"><?php echo $word; ?></h2>
  </div>
  <div class="glossary-term-item__definition">
    <?php echo $definition; ?>
  </div>

  <a class="glossary-term-item__link" href="<?php echo esc_url($url); ?>">Learn More ></a>
</div>