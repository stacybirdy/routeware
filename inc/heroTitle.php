<h1 <?php if(is_front_page()): echo 'class="reduceFS1"'; endif; if($pageTitle == 'title-logo'): echo 'class="' . $logoSize . '" aria-label="' . $alt . '"'; endif; ?>>
	<?php if($pageTitle == 'title-default'): echo the_title();
		elseif($pageTitle == 'title-custom'): echo $customTitle; 
		elseif($pageTitle == 'title-logo'): echo wp_get_attachment_image( $logoTitle, $size, "", ['alt' => $alt] );
	endif; ?>	
</h1>