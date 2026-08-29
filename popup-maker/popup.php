<?php
/**
 * Popup Templates
 * @package   PUM
 * @copyright Copyright (c) 2023, Code Atlantic LLC
 */
$popID = pum_get_popup_id();
$bg = get_field('popupImg', $popID); 
$logoWhite = get_field('logoWhite', 'options');
?>
<div id="pum-<?php pum_popup_ID(); ?>" class="<?php pum_popup_classes(); ?>" <?php pum_popup_data_attr(); ?> role="dialog" aria-modal="false" <?php if ( pum_get_popup_title() !== '' ) : ?> aria-labelledby="pum_popup_title_<?php pum_popup_ID(); ?>"<?php endif; ?>>
	<div id="popmake-<?php pum_popup_ID(); ?>" class="<?php pum_popup_classes( null, 'container' ); ?> <?php if($bg): echo 'hasImg'; else: echo 'noImg'; endif; ?>">
		<div class="popWrap ">
			<?php if($bg): ?><div class="img" style="background-image:url('<?php echo $bg; ?>');"></div><?php endif; ?>
			<div class="txt">

				<?php do_action( 'pum_popup_before_title' ); ?>
				<?php do_action( 'popmake_popup_before_inner' ); // Backward compatibility. ?>
				<?php if ( pum_get_popup_title() !== '' ) : ?><div id="pum_popup_title_<?php pum_popup_ID(); ?>" class="<?php pum_popup_classes( null, 'title' ); ?>">
						<?php pum_popup_title(); ?></div><?php endif; ?>
				<?php do_action( 'pum_popup_before_content' ); ?>
				<div class="<?php pum_popup_classes( null, 'content' ); ?>" <?php pum_popup_content_tabindex_attr(); ?>>
					<div class="inner"><?php pum_popup_content(); ?></div>
					<div class="foot"><div class="overlay"></div><a class="logo" href="/"><img src="<?php echo $logoWhite; ?>" alt="Routeware logo" /></a></div>
				</div>
				<?php do_action( 'pum_popup_after_content' ); ?>
				<?php do_action( 'popmake_popup_after_inner' ); // Backward compatibility. ?>
			</div><!--end txt-->
		</div><!--end popWrap-->

		<?php if ( pum_show_close_button() ) : ?>
			<button type="button" class="<?php pum_popup_classes( null, 'close' ); ?>" aria-label="<?php _e( 'Close', 'popup-maker' ); ?>"><span class="icon-close"></span></button>
		<?php endif; ?>


	</div><!--end popmake-->
</div><!--end pum-->
