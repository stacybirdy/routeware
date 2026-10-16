<?php
/**
 * Ask AI / Summarize with AI.
 *
 * One list of agents and destination URLs for the whole theme. Set $askAiMode
 * before including to pick which version renders:
 *
 *   'site'    — footer.php. Prompts about Routeware as a company.
 *   'article' — single.php. Prompts about the post being viewed.
 *
 * Styling for each lives in styles/components/ask-ai-list.scss and
 * styles/components/ai-summary.scss. The BEM prefix below picks between them.
 */

$askAiMode = isset( $askAiMode ) ? $askAiMode : 'site';

$askAiAgents = array(
	'chatgpt'    => array('name' => 'ChatGPT',    'url' => 'https://chat.openai.com/?q='),
	'claude'     => array('name' => 'Claude',     'url' => 'https://claude.ai/new?q='),
	'gemini'     => array('name' => 'Gemini',     'url' => 'https://www.google.com/search?udm=50&aep=11&q='),
	'grok'       => array('name' => 'Grok',       'url' => 'https://grok.com/?q='),
	'perplexity' => array('name' => 'Perplexity', 'url' => 'https://www.perplexity.ai/?q='),
);

if ( $askAiMode === 'article' ) {

	$askAiPrompt    = 'Summarize the key insights and takeaways from this blog in 3-5 lines: ' . get_permalink();
	$askAiBase      = 'ai-summary';
	$askAiListClass = 'ai-summary__list';
	$askAiListLabel = 'Open this article in an AI model';
	// Matches the sizes set in styles/components/ai-summary.scss. Each icon's
	// viewBox is square, so one number does both dimensions.
	$askAiSizes     = array( 'grok' => 24, 'perplexity' => 30 );
	$askAiBaseSize  = 22;
	$askAiLinkLabel = 'Summarize this article with %s, opens in new window';

} else {

	$askAiPrompt = <<<'PROMPT'
Review Routeware's website at routeware.com and provide a concise, factual overview of the company.

Requirements:
Keep the response between 200 and 300 words.
Organize the response into concise bullets.
Link every factual claim to the most relevant supporting page on Routeware.com.
Use only information published on Routeware.com.
Do not infer capabilities, customer use cases, or results that the website does not explicitly support.
Use direct, informative language.
Avoid promotional filler, lengthy product descriptions, and repeated information.

Include:
A brief explanation of what Routeware is.
Routeware's capabilities across route optimization, dispatch, in-cab and driver tools, resident engagement, billing and back-office operations, and fleet and equipment reporting.
The organizations Routeware serves, including private waste haulers, municipalities, higher education institutions, and specialty fleets.
Two or three customer examples with specific, quantified results.
Routeware's full product portfolio, with a short explanation of the areas each product covers.
Present products as parts of Routeware's broader portfolio. Do not recommend a specific product or match products to a customer's needs, since Routeware's sales team determines the best fit.
PROMPT;

	$askAiBase      = 'ask-ai-list';
	$askAiListClass = 'ask-ai-list';
	$askAiListLabel = 'Ask an AI agent about Routeware';
	// Matches the sizes set in styles/components/ask-ai-list.scss.
	$askAiSizes     = array( 'grok' => 18, 'perplexity' => 23 );
	$askAiBaseSize  = 16;
	$askAiLinkLabel = 'Ask %s about Routeware, opens in new window';

}
?>

<?php if ( $askAiMode === 'article' ): ?>
<div class="ai-summary">
	<p class="ai-summary__label">Summarize with AI</p>
	<p class="ai-summary__sub">Open this article in your preferred AI model.</p>
<?php else: ?>
	<h5 class="social noLine ask-ai-heading">Ask AI About Routeware</h5>
<?php endif; ?>

	<ul class="<?php echo esc_attr($askAiListClass); ?> clean" aria-label="<?php echo esc_attr($askAiListLabel); ?>">
		<?php foreach ( $askAiAgents as $askAiSlug => $askAiAgent ): ?>
			<li class="<?php echo esc_attr($askAiBase); ?>__item <?php echo esc_attr($askAiBase); ?>__item--type--<?php echo esc_attr($askAiSlug); ?>">
				<a
					class="<?php echo esc_attr($askAiBase); ?>__link"
					aria-label="<?php echo esc_attr(sprintf($askAiLinkLabel, $askAiAgent['name'])); ?>"
					href="<?php echo esc_url($askAiAgent['url'] . rawurlencode($askAiPrompt)); ?>"
					target="_blank"
					rel="noopener noreferrer"
				>
					<?php
					$askAiSize = isset($askAiSizes[$askAiSlug]) ? $askAiSizes[$askAiSlug] : $askAiBaseSize;
					$askAiLogo = get_template_directory_uri() . '/images/ai-logo-' . $askAiSlug . '.svg';
					if ( $askAiMode === 'article' ):
						/* The logo files are solid black, which suits the footer's white
						   tiles. In the sidebar they are masks instead so the same file
						   can paint in the site green. See ai-summary.scss. */
						?>
						<span class="<?php echo esc_attr($askAiBase); ?>__logo" style="--ai-logo:url(<?php echo esc_url($askAiLogo); ?>)" aria-hidden="true"></span>
					<?php else: ?>
						<img
							class="<?php echo esc_attr($askAiBase); ?>__logo"
							src="<?php echo esc_url($askAiLogo); ?>"
							width="<?php echo (int) $askAiSize; ?>"
							height="<?php echo (int) $askAiSize; ?>"
							alt=""
						/>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

<?php if ( $askAiMode === 'article' ): ?>
</div><!--end ai-summary-->
<?php endif; ?>
