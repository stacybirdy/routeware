<div id="filters" class="filterbar alt usa-accordion">
	<h4 class="usa-accordion__heading"><button type="button" class="usa-accordion__button" aria-expanded="<?php if(!empty($_GET)): echo 'true'; else: echo 'false'; endif; ?>" aria-controls="filterbar"><div class="inner">
		<div class="filterToggle"><span class="icon-filter"></span><span class="show">Show Filters</span><span class="hide">Hide Filters</span></div>
		<?php if(!empty($_GET)): ?>
			<div class="reset hide"><span id="clearUrl"><span class="icon-reverse"></span>Reset Filters</span></div>
		<?php endif; ?>
	</div></button></h4>
	<div id="filterbar" class="usa-accordion__content"><div class="wrap"><div class="inner">