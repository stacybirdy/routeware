<?php
/**
 * Glossary Filters
 * 
 * @package routeware
 */

$available_letters = $args['letters'] ?? [];

$row1 = range('A', 'Z');
?>

<div class="glossary-filters animate__animated animate__fadeInLeft inView">
  <div class="glossary-filters__list alphabet-list">
    <div class="alphabet-list__row alphabet-list__row--1">
    <?php 
      foreach ($row1 as $letter) :
        $is_disabled = !in_array($letter, $available_letters);
    ?>
      <button class="alphabet-list__item <?php echo $is_disabled ? 'alphabet-list__item--disabled' : ''; ?>" <?php echo $is_disabled ? 'disabled' : ''; ?>" type="button" data-letter="<?php echo $letter; ?>" <?php echo $is_disabled ? 'disabled' : ''; ?>><?php echo $letter; ?></button>
    <?php endforeach; ?>
    </div>
  </div>

  <button class="glossary-filters__btn btn">Reset Filters</button>
</div>