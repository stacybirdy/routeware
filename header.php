<?php
/**
* @package prism
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- ============================================================
 Google Consent Mode v2 + HubSpot Banner Bridge
 MUST load synchronously, BEFORE the Google Tag Manager snippet.
 ============================================================ -->
    <script>
        (function () {
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            // 1) EEA + UK + Switzerland: default everything DENIED.
            //    Regional defaults override the global default for these countries.
            gtag('consent', 'default', {
                'ad_storage': 'denied',
                'ad_user_data': 'denied',
                'ad_personalization': 'denied',
                'analytics_storage': 'denied',
                'region': [
                    'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR',
                    'HU', 'IS', 'IE', 'IT', 'LV', 'LI', 'LT', 'LU', 'MT', 'NL', 'NO', 'PL',
                    'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'GB', 'CH'
                ]
            });

            // 2) Rest of the world (incl. US): default everything GRANTED.
            //    The bridge below downgrades to denied if the visitor clicks Decline.
            gtag('consent', 'default', {
                'ad_storage': 'granted',
                'ad_user_data': 'granted',
                'ad_personalization': 'granted',
                'analytics_storage': 'granted'
            });

            // 3) Bridge HubSpot cookie banner decisions -> Google Consent Mode.
            //    Fires on each page load with the visitor's stored decision (if any),
            //    and again when they click Accept or Decline.
            window._hsp = window._hsp || [];
            window._hsp.push(['addPrivacyConsentListener', function (consent) {
                var granted = !!(consent && (
                    consent.allowed === true ||
                    (consent.categories && (
                        consent.categories.analytics === true ||
                        consent.categories.advertisement === true
                    ))
                ));

                gtag('consent', 'update', {
                    'ad_storage': granted ? 'granted' : 'denied',
                    'ad_user_data': granted ? 'granted' : 'denied',
                    'ad_personalization': granted ? 'granted' : 'denied',
                    'analytics_storage': granted ? 'granted' : 'denied'
                });
            }]);
        })();
    </script>
    <!-- ===== Google Tag Manager (existing snippet) goes BELOW this line ===== -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NBNFZ33');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/uswds/dist/js/uswds-init.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/uswds/dist/css/uswds.min.css" />

<script>
  window.uetq = window.uetq || [];
  window.uetq.push('consent', 'update', {
    'ad_storage': 'granted'
  });
</script>

<script>
  window.uetq = window.uetq || [];
  window.uetq.push('consent', 'update', {
    'ad_storage': 'denied'
  });
</script>

<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0118/0793.js" async="async" ></script>

<?php $regie = get_field('regie', 'options'); $regiePageID = get_field('regiePages', 'options'); 
if(is_page($regiePageID)): echo $regie; endif;
?>

<!-- Meta Pixel Code -->
<script type='text/javascript'>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js?v=next');
</script>
<!-- End Meta Pixel Code -->

<!-- Meta Pixel Code -->
<noscript>
<img height="1" width="1" style="display:none" alt="fbpx"
src="https://www.facebook.com/tr?id=219510607908714&ev=PageView&noscript=1" />
</noscript>
<!-- End Meta Pixel Code -->

<!-- Meta Pixel Event Code -->
<script type='text/javascript'>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
    if( "fb_pxl_code" in event.detail.apiResponse){
      eval(event.detail.apiResponse.fb_pxl_code);
    }
  }, false );
</script>
<!-- End Meta Pixel Event Code -->

<!-- Twitter conversion tracking base code -->
<script>
!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
twq('config','pbkxr');
</script>
<!-- End Twitter conversion tracking base code -->

<!-- TikTok Pixel Code Start -->
<script>
!function (w, d, t) {
  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};


  ttq.load('CVC8ESBC77U73VR7374G');
  ttq.page();
}(window, document, 'ttq');
</script>
<!-- TikTok Pixel Code End -->

<?php if(is_page('1852')): //thank you page ?>
<!-- TikTok Pixel Code Start -->
<script>
!function (w, d, t) {
  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
  ttq.load('CVC8G3RC77UC3LGT7LRG');
  ttq.page();
}(window, document, 'ttq');
</script>
<!-- TikTok Pixel Code End -->
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '168936277079927');
fbq('track', 'Lead');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=168936277079927&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code --> 
<?php endif; ?>


<!--RB2B Tracking-->
<script>!function () {var reb2b = window.reb2b = window.reb2b || [];if (reb2b.invoked) return;reb2b.invoked = true;reb2b.methods = ["identify", "collect"];reb2b.factory = function (method) {return function () {var args = Array.prototype.slice.call(arguments);args.unshift(method);reb2b.push(args);return reb2b;};};for (var i = 0; i < reb2b.methods.length; i++) {var key = reb2b.methods[i];reb2b[key] = reb2b.factory(key);}reb2b.load = function (key) {var script = document.createElement("script");script.type = "text/javascript";script.async = true;script.src = https://ddwl4m2hdecbv.cloudfront.net/b/ + key + "/EN4M0H108ZOM.js.gz";var first = document.getElementsByTagName("script")[0];first.parentNode.insertBefore(script, first);};reb2b.SNIPPET_VERSION = "1.0.1";reb2b.load("EN4M0H108ZOM");}();</script>

<?php wp_head(); ?>

<!-- begin Convert Experiences code-->
<script type="text/javascript" src="//cdn-4.convertexperiments.com/v1/js/1004562-100416996.js?environment=production"></script>
<!-- end Convert Experiences code -->

 <script>
(function(w,q){w['QualifiedObject']=q;w[q]=w[q]||function(){
(w[q].q=w[q].q||[]).push(arguments)};})(window,'qualified')

</script>
<script async src="https://js.qualified.com/qualified.js?token=MgqwpWMEsWkHUV9E"></script>
<!-- End Qualified-->

<?php
global $TRP_LANGUAGE;
if ( is_page( array( 12391, 12377 ) ) && $TRP_LANGUAGE === 'en_GB' ) :
?>
<script>
 window.addEventListener('message', function(event) {
  if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onBeforeFormInit') {
    event.data.data.form.fields.forEach(function(field) {
      if (field.name === 'form_page_source') {
        field.defaultValue = 'permiserv';
      }
    });
  }
});
</script>
<?php endif; ?>

 <!-- Session analytics -->
<script>
(function(id){
  window.pulse=window.pulse||function(){(pulse.q=pulse.q||[]).push(arguments)};
  var s=document.createElement('script');s.async=1;
  s.src='https://cdn.menoinfra.com/p/'+id+'.js';
  document.head.appendChild(s);
})('47085817-7e79-446a-92f7-2d3d225ea25b');
// Optional — if you don't run a CMP (Cookiebot/OneTrust/Transcend/GTM),
// uncomment one of these to control firing:
// pulse('consent','grant');   // grant analytics consent
// pulse('consent','revoke');  // deny analytics consent
</script>

 <!-- Reddit Pixel -->
<script>
!function(w,d){if(!w.rdt){var p=w.rdt=function(){p.sendEvent?p.sendEvent.apply(p,arguments):p.callQueue.push(arguments)};p.callQueue=[];var t=d.createElement("script");t.src="https://www.redditstatic.com/ads/pixel.js?pixel_id=a2_jdkcotriaih4",t.async=!0;var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(t,s)}}(window,document);rdt('init','a2_jdkcotriaih4');rdt('track', 'PageVisit');
</script>
<!-- DO NOT MODIFY UNLESS TO REPLACE A USER IDENTIFIER -->
<!-- End Reddit Pixel -->

</head>

<body <?php body_class(''); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBNFZ33"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<a class="skip-link screen-reader-text" href="#main">Skip to content</a>

<?php
	$hasAlert = get_field('hasAlert', 'options');
	$alert = get_field('alert', 'options');
    $hasIcon = get_field('hasicon', 'options'); $alertIcon = get_field('alerticon', 'options'); $altIcon = get_post_meta( $alertIcon, '_wp_attachment_image_alt', true);
	$logo = get_field('logo', 'options'); $logoWhite = get_field('logoWhite', 'options');
?>
<header id="masthead" role="banner" aria-label="header"><div class="wrap">

	<?php
	$current_locale = get_locale();
	$is_gb = ( $current_locale === 'en_GB' );
	$is_us = ( $current_locale === 'en_US' );
	$show_alert = $alert && (
		$hasAlert === 'alert-on' ||
		( $hasAlert === 'alert-gb' && $is_gb ) ||
		( $hasAlert === 'alert-us' && $is_us )
	);
	if ( $show_alert ): ?>
		<section id="alert" class="hide">
			<div class="wrap">


                    <?php if($hasIcon && $alertIcon): echo wp_get_attachment_image( $alertIcon, 'full', "", ['alt' => $altIcon, 'loading' => 'eager'] ); endif; // alert bar, above the fold ?>
                <div class="txt"><?php echo $alert; ?></div>
                    
            </div>
			<button id="alertClose" class="icon-closeCircle" aria-label="Close"></button>
		</section>
	<?php endif; ?>

	<nav id="eyebrowNav" role="navigation" aria-label="Eyebrow"><div class="wrap">
		<a class="logo" href="/"><img src="<?php echo $logo; ?>" alt="Routeware logo" /></a>
		<?php wp_nav_menu( array( 'theme_location' => 'eyebrow' ) ); ?> 
	</div></nav>
	<nav id="primaryNav" class="megamenu" role="navigation" aria-label="Primary"><div class="wrap">
		<a class="logo" href="/"><img src="<?php echo $logoWhite; ?>" alt="Routeware logo" /></a>
		<span class="spacer"></span>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?> 
	</div></nav>
</div></header>

<main id="main" role="main" aria-label="site content">