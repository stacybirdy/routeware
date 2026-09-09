<?php
/**
 * routeware functions and definitions
 *
 * @package routeware
 */

/*==============================================================*/
// setting accordion to Rank Math's schema
/*==============================================================*/
add_filter('rank_math/json_ld', function($data, $jsonld) { global $post; if(!is_a($post, 'WP_Post')) return $data; $faqItems = []; if(have_rows('resourceModules', $post->ID)): while(have_rows('resourceModules', $post->ID)): the_row(); if(get_row_layout() == 'accordionModule'): if(have_rows('accordions')): while(have_rows('accordions')): the_row(); $label = get_sub_field('label'); $content = get_sub_field('details'); if($label && $content): $faqItems[] = ['@type' => 'Question', 'name' => wp_strip_all_tags($label), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($content)]]; endif; endwhile; endif; endif; endwhile; endif; if(!empty($faqItems)): $data['FAQPage'] = ['@type' => 'FAQPage', 'mainEntity' => $faqItems]; endif; return $data; }, 10, 2);



/*==============================================================*/
// Add a Canonical Tag Pointing /en_gb/ Pages to the English Versions
/*==============================================================*/
add_filter( 'rank_math/frontend/canonical', function( $canonical ) {
    if ( function_exists( 'trp_get_languages' ) ) {
        $trp = TRP_Translate_Press::get_trp_instance();
        $url_converter = $trp->get_component( 'url_converter' );
        $settings = $trp->get_component( 'settings' );
        $trp_settings = $settings->get_settings();
        $default_lang = $trp_settings['default-language'];
        $current_lang = isset($trp_settings['current-language']) ? $trp_settings['current-language'] : '';
        if ( $current_lang !== $default_lang ) {
            $canonical = $url_converter->get_url_for_language( $default_lang, null, $canonical );
        }
    }
    return $canonical;
} );

/*==============================================================*/
// password protect content
/*==============================================================*/
add_filter('the_password_form', function() {
    return '
    <section class="contentEditor centered animate__animated animate__fadeInDown marT-s marTmob-xs marB-xl marBmob-l"><div class="wrap">
        <h2>This content is password protected.</h2>
        <h4>To view, enter the password below:</h4>
        <form class="passProtect" action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
            <input class="pw" name="post_password" id="pwbox-' . esc_attr( get_the_ID() ) . '" type="password" size="22" />
            <input class="submit" type="submit" name="Submit" value="' . esc_attr__('Submit') . '" />
        </form>
    </div></section>';
});


/*==============================================================*/
// auto popuplate select field with forms
/*==============================================================*/
function acf_populate_gf_forms_ids($field) {
    if (class_exists('GFFormsModel')) {
        $choices = ['' => 'Select a form'];
        foreach (GFFormsModel::get_forms() as $form) {
            $choices[$form->id] = $form->title;
        }
        $field['choices'] = $choices;
    }
    return $field;
}
add_filter('acf/load_field/name=gatedform', 'acf_populate_gf_forms_ids');


/*==============================================================*/
// set cookie per form ID
/*==============================================================*/
add_action('gform_after_submission', function($entry, $form) {
    $form_id = $form['id'];
    setcookie('gf_submitted_' . $form_id, 'true', [
        'expires'  => time() + 86400,
        'path'     => '/',
        'secure'   => is_ssl(),
        'httponly' => false,
    ]);
    $_COOKIE['gf_submitted_' . $form_id] = 'true';
}, 10, 2);



/*==============================================================*/
// only apply template to testing and webinar taxonomies
/*==============================================================*/
add_filter('template_include', function ($template) {
    if (is_singular('webinarsvids')) {
        $terms = wp_get_post_terms(get_queried_object_id(), 'resourcetype', [
            'fields' => 'slugs'
        ]);
        if (!is_wp_error($terms) && array_intersect(['webinar'], $terms)) {
            return get_theme_file_path('single-webinarsvids-webinar.php');
        }
    }
    return $template;
});

/*==============================================================*/
// Set the content width based on the theme's design and stylesheet
/*==============================================================*/
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'routeware_setup' ) ) :


/*==============================================================*/
// Sets up theme defaults and registers support for various WordPress features.
// Note that this function is hooked into the after_setup_theme hook, which
// runs before the init hook. The init hook is too late for some features, such
// as indicating support for post thumbnails.
/*==============================================================*/
function routeware_setup() {


/*==============================================================*/
// Make theme available for translation.
// Translations can be filed in the /languages/ directory.
// If you're building a theme based on routeware, use a find and replace
// to change 'routeware' to the name of your theme in all the template files
/*==============================================================*/
load_theme_textdomain( 'routeware', get_template_directory() . '/languages' );


/*==============================================================*/
// Add default posts and comments RSS feed links to head.
/*==============================================================*/
add_theme_support( 'automatic-feed-links' );


/*==============================================================*/
// Let WordPress manage the document title.
// By adding theme support, we declare that this theme does not use a
// hard-coded <title> tag in the document head, and expect WordPress to
// provide it for us.
/*==============================================================*/
add_theme_support( 'title-tag' );


/*==============================================================*/
// Enable support for Post Thumbnails on posts and pages.
// @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
/*==============================================================*/
add_theme_support( 'post-thumbnails' );
	add_image_size( '940-500', 940, 500, true ); 
	add_image_size( '800-500', 800, 500, true );
    add_image_size( '820-290', 820, 290, true );
    add_image_size( '470-640', 470, 640, true );
    add_image_size( '820-350', 820, 350, array( 'left', 'top' ));
    add_image_size( '1200-700', 1200, 700, true );
    add_image_size( '500-648', 500, 648, true );
    add_image_size( '500-283', 500, 283, true );
    add_image_size( '1800-1019', 1800, 1019, true );
    add_image_size( '936-530', 936, 530, true ); 
    add_image_size( '400-500', 400, 500, true ); 
    add_image_size( '800-453', 800, 453, true ); 
	add_image_size( '300-300', 300, 300, true );

//add_filter('jpeg_quality', function($arg){return 100;});


/*==============================================================*/
// Register Nav
/*==============================================================*/
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'routeware' ),
	'eyebrow' => __( 'Eyebrow Menu', 'routeware' ),
    'footer' => __( 'Footer Menu', 'routeware' ),
) );

/*==============================================================*/
// output specific branch of menu
/*==============================================================*/
function navBranch($menu_name, $parent_id) {
    $menu_items = wp_get_nav_menu_items($menu_name);
    if (!$menu_items) return '';
    $top_item = null;
    foreach ($menu_items as $item) {
        if ($item->ID == $parent_id) {
            $top_item = $item;
            break;
        }
    }
    if (!$top_item) return '';
    $top_item->children = build_menu_tree($menu_items, $parent_id);
    return render_menu_branch([$top_item], true);
}
function build_menu_tree($items, $parent_id) {
    $tree = [];
    foreach ($items as $item) {
        if ($item->menu_item_parent == $parent_id) {
            $item->children = build_menu_tree($items, $item->ID);
            $tree[] = $item;
        }
    }
    return $tree;
}
function render_menu_branch($items, $is_top_level = false) {
    if (empty($items)) return '';
    $output = '<ul class="menu' . ($is_top_level ? ' navBranch' : '') . '">'; // Add "foo" class to top-level
    foreach ($items as $item) {
        $classes = implode(' ', $item->classes); // Get the existing classes
        $output .= '<li class="' . esc_attr($classes) . '"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        if (!empty($item->children)) {
            $output .= render_menu_branch($item->children);
        }
        $output .= '</li>';
    }
    $output .= '</ul>';
    return $output;
}





/*==============================================================*/
// Switch default core markup for search form, comment form, and comments to output valid HTML5.
/*==============================================================*/
add_theme_support( 'html5', array(
	'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
) );


/*==============================================================*/
// Enable support for Post Formats || See http://codex.wordpress.org/Post_Formats
/*==============================================================*/
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link',
) );


/*==============================================================*/
// Closing Theme Setup
/*==============================================================*/
}
endif; // routeware_setup		
add_action( 'after_setup_theme', 'routeware_setup' );


/*==============================================================*/
// Widgets
/*==============================================================*/
function routeware_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'routeware' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 role="heading" class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'routeware_widgets_init' );


/*==============================================================*/
// CUSTOM POST TYPES
/*==============================================================*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'event', array(
        'labels' => array(
            'name' => __( 'Events' ),
            'singular_name' => __( 'Event' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'event', 'with_front' => false),
        'supports' => array( 'title', 'revisions'),
        )
    );
    register_post_type( 'partner', array(
        'labels' => array(
            'name' => __( 'Partners' ),
            'singular_name' => __( 'Partners' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'partner', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions'),
        )
    );
    register_post_type( 'team', array(
        'labels' => array(
            'name' => __( 'Team' ),
            'singular_name' => __( 'Team' )
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'thumbnail', 'revisions'),
        )
    );
    register_post_type( 'newsmedia', array(
        'labels' => array(
            'name' => __( 'News &amp; Media' ),
            'singular_name' => __( 'News &amp; Media' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'resources/news', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions'),
        )
    );
    register_post_type( 'guide', array(
        'labels' => array(
            'name' => __( 'Guides' ),
            'singular_name' => __( 'Guide' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'resources/guide', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'sticky'),
        )
    );
    register_post_type( 'story', array(
        'labels' => array(
            'name' => __( 'Customer Stories' ),
            'singular_name' => __( 'Customer Story' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'resources/customer-story', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'sticky'),
        )
    );
    register_post_type( 'factsheet', array(
        'labels' => array(
            'name' => __( 'Factsheets' ),
            'singular_name' => __( 'Factsheet' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'resources/factsheet', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions'),
        )
    );
    register_post_type( 'webinarsvids', array(
        'labels' => array(
            'name' => __( 'Webinars &amp; Videos' ),
            'singular_name' => __( 'Webinars &amp; Videos' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'resources/webinar-video', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'sticky'),
        )
    );
    register_post_type( 'testimonials', array(
        'labels' => array(
            'name' => __( 'Testimonials' ),
            'singular_name' => __( 'Testimonial' )
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array( 'title', 'revisions'),
        )
    );
    register_post_type( 'glossary-terms', array(
        'labels' => array(
            'name' => __( 'Glossary Terms' ),
            'singular_name' => __( 'Glossary Term' )
        ),
        'public' => true,
        'has_archive' => 'glossary',
        'rewrite' => array('slug' => 'glossary', 'with_front' => false),
        'supports' => array( 'title', 'editor', 'revisions'),
        )
    );
}

/* -------------------------------------------------------------------------- */
/*                  Blog Permalink Rewrite: /blog/%postname%                  */
/* -------------------------------------------------------------------------- */
// 1. Make blog posts output as /blog/post-slug/
add_filter('post_link', function ($permalink, $post) {
    if ($post->post_type === 'post') {
        return home_url('/blog/' . $post->post_name . '/');
    }

    return $permalink;
}, 10, 2);

// 2. Make WordPress understand /blog/post-slug/
add_action('init', function () {
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?name=$matches[1]&post_type=post',
        'top'
    );
});


add_action( 'init', 'build_taxonomies', 0 );
function build_taxonomies() {
    $labels = array(
        'name'              => _x( 'Type', 'Type' ),
        'singular_name'     => _x( 'Type', 'Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'resourcetype', array( 'post','newsmedia','guide','story','factsheet','webinarsvids' ), $args );


    $labels = array(
        'name'              => _x( 'Audience', 'Audience' ),
        'singular_name'     => _x( 'Audience', 'Audience' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'aud', array( 'post','story','factsheet' ), $args );


    $labels = array(
        'name'              => _x( 'Location', 'Location' ),
        'singular_name'     => _x( 'Location', 'Location' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'loc', array( 'post','story','factsheet' ), $args );

    $labels = array(
        'name'              => _x( 'Solution', 'Solution' ),
        'singular_name'     => _x( 'Solution', 'Solution' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'sol', array( 'post','factsheet','story' ), $args );

    $labels = array(
        'name'              => _x( 'Type', 'Type' ),
        'singular_name'     => _x( 'Type', 'Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'team-type', 'team', $args );

    $labels = array(
        'name'              => _x( 'Event Type', 'Event Type' ),
        'singular_name'     => _x( 'Event Type', 'Event Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'event-type', 'event', $args );

    $labels = array(
        'name'              => _x( 'Event Location', 'Event Location' ),
        'singular_name'     => _x( 'Event Location', 'Event Location' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'event-loc', 'event', $args );

    $labels = array(
        'name'              => _x( 'Specialtys', 'Specialtys' ),
        'singular_name'     => _x( 'Specialty', 'Specialty' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'specialty-tag', 'partner', $args );

    $labels = array(
        'name'              => _x( 'Types', 'Types' ),
        'singular_name'     => _x( 'Type', 'Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'type', 'testimonials', $args );

    $labels = array(
        'name'              => _x( 'Themes', 'Themes' ),
        'singular_name'     => _x( 'Theme', 'Theme' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'themes', 'post', $args );

    $labels = array(
        'name'              => _x( 'Products', 'Products' ),
        'singular_name'     => _x( 'Product', 'Product' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );
    register_taxonomy( 'tax-products', 'story', $args );


    
}

//change name of Posts
add_filter( 'post_type_labels_post', 'change_post_labels' );
function change_post_labels( $args ) {
    foreach( $args as $key => $label ){
        if( null === $label ) {continue;}
        $args->{$key} = str_replace( [ 'Posts', 'Post' ], [ 'Blogs', 'Blog' ], $label );
    }
    return $args;
}

//rewrite post structure
// add_action('init', function() {
//   global $wp_rewrite;
//   $wp_rewrite->set_permalink_structure('/blog/%postname%/');
// });


/*==============================================================*/
// sticky stuff
/*==============================================================*/
function show_sticky_option__post_edit($post) {
    if ( current_user_can( 'edit_others_posts' ) && post_type_supports( $post->post_type, 'sticky' ) ) {
        $sticky_checkbox_checked = is_sticky( $post->post_id ) ? 'checked="checked"' : '';
        $sticky_span = '<span id="sticky-span" style="display:block;margin-left:0;padding: 15px 10px;background:#aadab0;"><input id="sticky" name="sticky" type="checkbox" value="sticky" ' . $sticky_checkbox_checked . ' /> <label for="sticky" class="selectit"><b>' . __( 'Stick this post to the top' ) . '</b></label></span>';
        echo $sticky_span;
    }
}
add_action( 'post_submitbox_start', 'show_sticky_option__post_edit' );


//add sticky filter to admin menu
add_action('restrict_manage_posts', function() {
    $screen = get_current_screen();
    $allowedPostTypes = ['post', 'webinarsvids', 'story', 'guide']; // Add CPT slugs here

    if (in_array($screen->post_type, $allowedPostTypes)) {
        $selected = isset($_GET['sticky_filter']) ? $_GET['sticky_filter'] : '';
        echo '<select name="sticky_filter">';
        echo '<option value="">Sticky Filter</option>';
        echo '<option value="only_sticky" ' . selected($selected, 'only_sticky', false) . '>Show Sticky Features Only</option>';
        echo '</select>';
    }
});
add_action('pre_get_posts', function($query) {
    if (
        is_admin() &&
        $query->is_main_query() &&
        isset($_GET['sticky_filter']) &&
        $_GET['sticky_filter'] === 'only_sticky' &&
        isset($_GET['post_type'])
    ) {
        $allowedPostTypes = ['post', 'webinarsvids', 'story', 'guide']; // Same list as above
        if (in_array($_GET['post_type'], $allowedPostTypes)) {
            $sticky = get_option('sticky_posts');
            $query->set('post__in', $sticky);
            $query->set('ignore_sticky_posts', 1);
        }
    }
});





/*==============================================================*/
// autoselect term for post, guide, story, factsheet
// hide unrelated terms for webinarsvids, newsmedia
/*==============================================================*/
add_action('admin_footer', function () {
    global $post;
    if (!$post) return;
    $auto_select_map = [
        'post' => '19',
        'guide' => '20',
        'story' => '21',
        'factsheet' => '22',
    ];
    $hide_terms_map = [
        'webinarsvids' => ['15', '16', '19', '20', '21', '22'],
        'newsmedia'    => ['17', '18', '19', '20', '21', '22'],
    ];
    $term_to_select = isset($auto_select_map[$post->post_type]) ? esc_js($auto_select_map[$post->post_type]) : null;
    $terms_to_hide = isset($hide_terms_map[$post->post_type]) ? $hide_terms_map[$post->post_type] : [];

    if (!$term_to_select && empty($terms_to_hide)) return;
    ?>
    <script>
    jQuery(document).ready(function($) {
        <?php if ($term_to_select): ?>
        var termID = '<?php echo $term_to_select; ?>';
        var $checkbox = $('input[name="tax_input[resourcetype][]"][value="' + termID + '"]');
        if ($checkbox.length) $checkbox.prop('checked', true);
        <?php endif; ?>
        <?php if (!empty($terms_to_hide)): ?>
        var hiddenTerms = <?php echo json_encode($terms_to_hide); ?>;
        hiddenTerms.forEach(function(id) {
            $('li:has(input[value="' + id + '"])').hide();
        });
        <?php endif; ?>
    });
    </script>
    <?php
});





/*==============================================================*/
// REMOVE CATEGORY/TAGS FROM POSTS
/*==============================================================*/
add_action('init', 'myprefix_remove_tax');
function myprefix_remove_tax() {
    register_taxonomy('category', array());
    register_taxonomy('post_tag', array());
}



/*==============================================================*/
// SCRIPTS AND STYLES
/*==============================================================*/
function routeware_scripts() {
	wp_enqueue_style( 'icomoon', '//cdn.icomoon.io/45376/Routeware/style.css?2dfxlu');
	wp_enqueue_style( 'adobeFonts', '//use.typekit.net/ovh1wav.css');
	wp_enqueue_style( 'accordionSlider-style', get_stylesheet_directory_uri() . '/styles/accSlider.css', array(), filemtime( get_stylesheet_directory() . '/styles/accSlider.css' ) );

    wp_enqueue_style( 'routeware-style', get_stylesheet_directory_uri() . '/styles/base.css', array(), filemtime( get_stylesheet_directory() . '/styles/base.css' ) );
	wp_enqueue_style( 'additions', get_stylesheet_directory_uri() . '/styles/additions.css', array(), filemtime( get_stylesheet_directory() . '/styles/additions.css' ) );

	wp_enqueue_script( 'routeware-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1', true );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-1.11.0.min.js', array(), '1', true );
	wp_enqueue_script( 'waypointsCounter', '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array(), '1', true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/counterup.js', array(), '1', true );

    wp_enqueue_script( 'slick-script', '//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js', array(), '1', true );
wp_enqueue_style( 'slick-styles', '//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/accessible-slick-theme.min.css');


	wp_enqueue_script( 'inView', get_template_directory_uri() . '/js/inView.js', array(), '1', true );
	wp_enqueue_script( 'alert', get_template_directory_uri() . '/js/alert.js', array(), filemtime(get_template_directory() . '/js/alert.js') );

    wp_enqueue_script( 'accordionSlider-scripts', get_template_directory_uri() . '/js/accSlider.js', array(), filemtime(get_template_directory() . '/js/accSlider.js') );

    wp_enqueue_script( 'bgVids-script', get_template_directory_uri() . '/js/bgVids.js', array(), '1', true );

	wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), filemtime( get_stylesheet_directory() . '/js/scripts.js' ) );

    // load glossary script only on glossary terms archive page
    if (is_post_type_archive('glossary-terms')) {
        wp_enqueue_script('glossary-script', get_stylesheet_directory_uri() . '/js/glossary.js', array(), filemtime(get_stylesheet_directory() . '/js/glossary.js'));
    }


/*==============================================================*/
// Comments
/*==============================================================*/
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
}
add_action( 'wp_enqueue_scripts', 'routeware_scripts' );


/*==============================================================*/
// Template Tags
/*==============================================================*/
require get_template_directory() . '/inc/template-tags.php';


/*==============================================================*/
// Custom functions that act independently of the theme templates
/*==============================================================*/
require get_template_directory() . '/inc/extras.php';


/*==============================================================*/
// Customizer additions
/*==============================================================*/
require get_template_directory() . '/inc/customizer.php';


/*==============================================================*/
// Load Jetpack compatibility file.
/*==============================================================*/
require get_template_directory() . '/inc/jetpack.php';


/*==============================================================*/
// Favicon
/*==============================================================*/
function add_favicon() {
  $favicon_url = get_stylesheet_directory_uri() . '/images/favicon.ico';
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon_url . '" />';
}
// show favicon everywhere
add_action('wp_head', 'add_favicon');
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');



/*==============================================================*/
// ACF OPTIONS PAGES
/*==============================================================*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Global Information Snippets For Use Throughout The Site',
		'menu_title'	=> 'Global Snippets',
		'menu_slug' 	=> 'global-snippets',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


/*==============================================================*/
// allow svg uploads (plugin required as well)
/*==============================================================*/
function disable_real_mime_check( $data, $file, $filename, $mimes ) {
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext = $wp_filetype['ext'];
    $type = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];
    return compact( 'ext', 'type', 'proper_filename' );
}
add_filter( 'wp_check_filetype_and_ext', 'disable_real_mime_check', 10, 4 );


/*==============================================================*/
// stop editor from stripping empty spans
/*==============================================================*/
function myextensionTinyMCE($init) {
    $ext = 'span[id|name|class|style]';
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }
    return $init;
}
add_filter('tiny_mce_before_init', 'myextensionTinyMCE' );


/*==============================================================*/
// gravity forms anchoring
/*==============================================================*/
add_filter( 'gform_confirmation_anchor', '__return_true' );


/*==============================================================*/
// WYSIWYG UPDATES
/*==============================================================*/
/*--------------------------------------------------------------*/
/* remove p tags from around images
/*--------------------------------------------------------------*/
function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('acf_the_content', 'filter_ptags_on_images', 9999);
add_filter('the_content', 'filter_ptags_on_images', 9999);


/*--------------------------------------------------------------*/
/* customize the formatselect with headings to choose from
/*--------------------------------------------------------------*/
add_filter( 'tiny_mce_before_init', 'formatselect_settings' );
function formatselect_settings( $settings ){
	$settings['block_formats'] = 'h2=h2;h3=h3;h4=h4;h5=h5;Paragraph=p;Hero=h1';
	return $settings;
}


/*--------------------------------------------------------------*/
/* customize wysiwyg fields in ACF
/* https://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/ || https://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols
/*--------------------------------------------------------------*/
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	$toolbars['Simple' ] = array();
	$toolbars['Simple' ][1] = array('formatselect', 'styleselect', 'bold', 'italic', 'link', 'bullist', 'numlist', 'hr', 'blockquote', 'alignleft', 'aligncenter', 'alignright'  );
	return $toolbars;
}


/*--------------------------------------------------------------*/
/* add Format button with options
/* https://wponcall.com/add-styles-menu-visual-editor-wordpress-4-0/ || http://www.wpbeginner.com/wp-tutorials/how-to-add-custom-styles-to-wordpress-visual-editor/
/*--------------------------------------------------------------*/
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
function my_mce_before_init_insert_formats( $init_array ) {  
    $style_formats = array(
    array(
        'title' => 'Buttons/Links',
        'items' => array(
            array( 'title' => 'Invisible SEO link', 'selector' => 'a', 'classes' => 'seo' ),
            array( 'title' => 'Button: Gold', 'selector' => 'a', 'classes' => 'btn' ),
            array( 'title' => 'Button: Outline (gold border)', 'selector' => 'a', 'classes' => 'btnOutline' ),
            array( 'title' => 'Button: Outline (white border)', 'selector' => 'a', 'classes' => 'btnOutline-white' ),
            array( 'title' => 'Button: Outline (dark border)', 'selector' => 'a', 'classes' => 'btnOutline-dark' ),
        )
    ),
    array(
        'title' => 'Typography',
        'items' => array(
            array( 'title' => 'Reduce Font Size x1', 'selector' => 'p,h1', 'classes' => 'reduceFS1' ),
            array( 'title' => 'Increase Font Size x1', 'selector' => 'p,ul', 'classes' => 'increaseFS1' ),
            array( 'title' => 'h5: No underline', 'selector' => 'h5', 'classes' => 'noLine' ),
            
        )
    ),
    array(
        'title' => 'Spacing',
        'items' => array(
            array( 'title' => 'Reduce Margin x1', 'selector' => 'p, h3, h4', 'classes' => 'reduceMar1' ),
            array( 'title' => 'Reduce Margin x2', 'selector' => 'p', 'classes' => 'reduceMar2' ),
            array( 'title' => 'Increase Margin x1', 'selector' => 'p,ul,ol,img,h4', 'classes' => 'increaseMar1' ),
            array( 'title' => 'Increase Margin x2', 'selector' => 'p,ul,ol,img', 'classes' => 'increaseMar2' ),
        )
    ),
);
    $init_array['style_formats'] = json_encode( $style_formats );  
    return $init_array;  
} 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );



/*--------------------------------------------------------------*/
/* add editor styles to match options above
/*--------------------------------------------------------------*/
function add_editor_styles() {
    $editorStyle = 'styles/editor-styles.css';
    $version = filemtime( get_stylesheet_directory() . '/' . $editorStyle );
    add_editor_style( get_stylesheet_directory_uri() . '/' . $editorStyle . '?ver=' . $version );
}
add_action( 'admin_init', 'add_editor_styles' );


/*==============================================================*/
// adjust wisywyg size 
/*==============================================================*/
function custom_acf_admin_css() {
    echo '<style>
        .shorty .acf-editor-wrap iframe { height: 150px !important; }
    </style>';
}
add_action('admin_head', 'custom_acf_admin_css');



/*==============================================================*/
// numbered pagination
/*==============================================================*/
function numbered_pager( $query ) {
    $big = 999999999;
    $current = max( 1, isset( $query->query['paged'] ) ? $query->query['paged'] : 1 );

    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '',
        'current' => $current,
        'total' => $query->max_num_pages
    ) );
}


/*==============================================================*/
// custom gf spinner
/*==============================================================*/
// add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
// function spinner_url( $image_src, $form ) {
//     return  '/wp-content/themes/routeware/images/gfLoader.svg';
// }

/*==============================================================*/
// SVG image upload support
/*==============================================================*/
function cc_mime_types($mimes) {    
     $mimes['svg'] = 'image/svg+xml';    
     return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



/*==============================================================*/
// load more events
/*==============================================================*/
// function loadMoreEvents() {
//   $today = current_time('Ymd');
//   $paged = $_POST['paged'];
//   $hubspot = null;if (have_rows('modules', 35)) {while (have_rows('modules', 35)) {the_row();if (get_row_layout() === 'events') {$hubspot = get_sub_field('hubspot');break;}}reset_rows();}$GLOBALS['hubspot'] = $hubspot;
//   $ajaxposts = new WP_Query([
//     'paged' => $paged,
//     'post_type' => 'event',
//     'posts_per_page' => 9,
//     'orderby' => 'meta_value_num',
//     'meta_key' => 'startDate',
//     'order' => 'ASC',
//     'meta_query' => array(
//         'relation' => 'OR',
//         array(
//             'key' => 'startDate',
//             'value' => $today,
//             'compare' => '>=',
//             'type' => 'datetime'
//         ),
//     )
//   ]);
//   $response = '';
//   $has_more = false;

//   // Check if there are posts and append HTML
//   if ($ajaxposts->have_posts()) {
//     while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
//         $response .= get_template_part('inc/eventArticle');
//     endwhile;
//     // If there are more pages to load
//     if ($ajaxposts->max_num_pages > $paged) {
//         $has_more = true;
//     }
//   } 
//   // Return the response HTML and the hasMore flag
//   echo $response;
//   echo '<script>var hasMore = ' . ($has_more ? 'true' : 'false') . ';</script>';
//   wp_die();
// }

// add_action('wp_ajax_loadMoreEvents', 'loadMoreEvents');
// add_action('wp_ajax_nopriv_loadMoreEvents', 'loadMoreEvents');





/*==============================================================*/
// sizing info for featured images
/*==============================================================*/
function filter_featured_image_admin_text( $content, $post_id, $thumbnail_id ){
    $post_type = get_post_type( $post_id );
    $messages = array(
        'post'  => 'Images should be at least 936 pixels wide by 530 pixels tall',
        'team'  => 'Images should be at least 400 pixels wide by 500 pixels tall',
    );
    if( isset($messages[$post_type]) ){
        $help_text = '<p>' . esc_html( $messages[$post_type] ) . '</p>';
        return $help_text . $content;
    }
    return $content;
}
add_filter( 'admin_post_thumbnail_html', 'filter_featured_image_admin_text', 10, 3 );








add_action( 'search-filter/query/query_args', 'search_filter_filter_by_todays_date', 10, 2 );

function search_filter_filter_by_todays_date( $query_args, $search_filter_query ) {
    // Get the query ID.
    $query_id = $search_filter_query->get_id();

    // If the query ID is 123, update the order.
    if ( $query_id === 8 ) {
        // If the meta query is not set, initialize it.
        if ( ! isset( $query_args['meta_query'] ) ) {
            $query_args['meta_query'] = array();
        }

        // Add the condition to the existing meta query.
        $query_args['meta_query'][] = array(
            'key'     => 'startDate',
            'value'   => date( 'Ymd', strtotime( 'today' ) ),
            'compare' => '>=',
            'type'    => 'DATE',
        );
    }

    // Always return the $query_args.
    return $query_args;
}



/*==============================================================*/
// automatically append UK to titles
/*==============================================================*/
add_filter( 'rank_math/frontend/title', function( $title ) {
    $url = $_SERVER['REQUEST_URI'] ?? '';
    
    if ( strpos( $url, '/en_gb/' ) !== false || strpos( $url, '/en-gb/' ) !== false ) {
        $title .= ' (UK)';
    }

    return $title;
}, 99 );


/*==============================================================*/
// force categories to keep heirarchy 
/*==============================================================*/
// add_filter('wp_terms_checklist_args', function($args, $idPost) {
//     $args['checked_ontop'] = false;
//     return $args;
// }, 10, 2);


/*==============================================================*/
// is_tree functionality
/*==============================================================*/
// function is_tree($pid) {
// 	global $post;

// 	$ancestors = get_post_ancestors($post->$pid);
// 	$root = count($ancestors) - 1;
// 	$parent = $ancestors[$root];

// 	if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors)))
// 	{
// 		return true;
// 	}
// 	else
// 	{
// 		return false;
// 	}
// };


/*==============================================================*/
// reset ACF field positioning (can comment back out once reset)
/*==============================================================*/
// function prefix_reset_metabox_positions(){
//   delete_user_meta( 1, 'meta-box-order_post' );
//   delete_user_meta( 1, 'meta-box-order_page' );
//   delete_user_meta( 1, 'meta-box-order_custom_post_type' );
// }
// add_action( 'admin_init', 'prefix_reset_metabox_positions' );


/*==============================================================*/
// change image upload defaults
/*==============================================================*/
// update_option('image_default_align', 'left' );
// update_option('image_default_link_type', 'none' );
// update_option('image_default_size', 'full' );
// add_action('after_setup_theme', 'routeware_setup');


/*==============================================================*/
// allow CPT single templates
/*==============================================================*/
// function add_posttype_slug_template( $single_template )
// {
// 	$object = get_queried_object();
// 	$single_postType_postName_template = locate_template("single-{$object->post_type}-{$object->post_name}.php");
// 	if( file_exists( $single_postType_postName_template ) )
// 	{
// 		return $single_postType_postName_template;
// 	} else {
// 		return $single_template;
// 	}
// }
// add_filter( 'single_template', 'add_posttype_slug_template', 10, 1 );


/*==============================================================*/
// change label of Posts || here it would be called 'Updates'
/*==============================================================*/
// function customize_post_admin_menu_labels() {
// 	global $menu;
// 	global $submenu;
// 	$menu[5][0] = 'Updates';
// 	$submenu['edit.php'][5][0] = 'Updates';
// 	$submenu['edit.php'][10][0] = 'Add Updates';
// 	echo '';
// }
// add_action( 'admin_menu', 'customize_post_admin_menu_labels' );

// function customize_admin_labels() {
// 	global $wp_post_types;
// 	$labels = &$wp_post_types['post']->labels;
// 	$labels->name = 'Updates';
// 	$labels->singular_name = 'Update';
// 	$labels->add_new = 'Add Update';
// 	$labels->add_new_item = 'Add Update';
// 	$labels->edit_item = 'Edit Updates';
// 	$labels->new_item = 'Update';
// 	$labels->view_item = 'View Updates';
// 	$labels->search_items = 'Search Updates';
// 	$labels->not_found = 'No Updates found';
// 	$labels->not_found_in_trash = 'No Updates found in Trash';
// }
// add_action( 'init', 'customize_admin_labels' );


/*==============================================================*/
// reorder dashboard menu
/*==============================================================*/
// function custom_menu_order($menu_ord) {
//   if (!$menu_ord) return true;
//   return array(
//       'index.php', // Dashboard
//       'separator1', // First separator
//       'edit.php', // Posts
//       'edit.php?post_type=customposttypename', // Custom Post Type
//       'edit.php?post_type=page', // Pages
//       'separator2', // Second separator
//       'upload.php', // Media
//       'link-manager.php', // Links
//       'edit-comments.php', // Comments
//       'separator3', // Third separator
//       'themes.php', // Appearance
//       'plugins.php', // Plugins
//       'users.php', // Users
//       'tools.php', // Tools
//       'options-general.php', // Settings
//       'separator-last', // Last separator
//   );
// }
// add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
// add_filter('menu_order', 'custom_menu_order');

/* -------------------------------------------------------------------------- */
/*                                 Breadcrumbs                                */
/* -------------------------------------------------------------------------- */
function rw_get_breadcrumbs() {
    $items = [];

    $home_id = (int) get_option('page_on_front');
    $home_label = $home_id ? get_the_title($home_id) : __('Home', 'routeware');
    if (empty($home_label)) {
        $home_label = __('Home', 'routeware');
    }

    $items[] = [
        'label' => $home_label,
        'url' => home_url('/'),
        'current' => is_front_page(),
    ];

    if (is_front_page()) {
        return $items;
    }

    if (is_page()) {
        $page_id = get_queried_object_id();
        if (!$page_id) {
            return $items;
        }

        $ancestors = array_reverse(get_post_ancestors($page_id));
        foreach ($ancestors as $ancestor_id) {
            $items[] = [
                'label' => get_the_title($ancestor_id),
                'url' => get_permalink($ancestor_id),
                'current' => false,
            ];
        }

        $items[] = [
            'label' => get_the_title($page_id),
            'url' => '',
            'current' => true,
        ];

        return $items;
    }

    if (is_singular()) {
        $post_id = get_queried_object_id();
        $post_type = get_post_type($post_id);

        if ($post_type && $post_type !== 'page') {
            if ($post_type === 'post') {
                $posts_page_id = (int) get_option('page_for_posts');
                if ($posts_page_id) {
                    $items[] = [
                        'label' => get_the_title($posts_page_id),
                        'url' => get_permalink($posts_page_id),
                        'current' => false,
                    ];
                }
            } else {
                $archive_link = get_post_type_archive_link($post_type);
                $post_type_obj = get_post_type_object($post_type);
                if ($archive_link && $post_type_obj) {
                    $items[] = [
                        'label' => $post_type_obj->labels->name,
                        'url' => $archive_link,
                        'current' => false,
                    ];
                }
            }

            $items[] = [
                'label' => get_the_title($post_id),
                'url' => '',
                'current' => true,
            ];
        }

        return $items;
    }

    if (is_post_type_archive()) {
        $post_type = get_query_var('post_type');
        if (is_array($post_type)) {
            $post_type = reset($post_type);
        }

        if ($post_type) {
            $post_type_obj = get_post_type_object($post_type);
            if ($post_type_obj) {
                $items[] = [
                    'label' => $post_type_obj->labels->name,
                    'url' => '',
                    'current' => true,
                ];
            }
        }
    }

    return $items;
}

function rw_breadcrumbs() {
    $breadcrumbs = rw_get_breadcrumbs();
    if (empty($breadcrumbs)) {
        return;
    }

    echo '<div class="rw-bc">';
    echo '<nav aria-label="Breadcrumb">';

    foreach ($breadcrumbs as $index => $item) {
        $is_last = ($index === count($breadcrumbs) - 1);
        $label = isset($item['label']) ? $item['label'] : '';
        $url = isset($item['url']) ? $item['url'] : '';

        if (!empty($url) && !$is_last && empty($item['current'])) {
            echo '<a class="rw-bc__link rw-bc__text" href="' . esc_url($url) . '">' . esc_html($label) . '</a>';
        } else {
            echo '<span class="rw-bc__text rw-bc__current" aria-current="page">' . esc_html($label) . '</span>';
        }

        if (!$is_last) {
            echo ' <span class="rw-bc__sep">|</span> ';
        }
    }

    echo '</nav>';
    echo '</div>';
}

function rw_maybe_get_svg_from_media_id($media) {
    if (empty($media)) {
        return '';
    }

    $attachment_id = 0;
    $source_url = '';
    $file_path = '';
    $fallback = '';

    if (is_numeric($media)) {
        $attachment_id = (int) $media;
        if (!$attachment_id) {
            return '';
        }

        $fallback = wp_get_attachment_image($attachment_id, 'full');
        $file_path = get_attached_file($attachment_id);
        $source_url = wp_get_attachment_url($attachment_id);
    } else {
        $source_url = trim((string) $media);
        if ($source_url === '') {
            return '';
        }

        $attachment_id = attachment_url_to_postid($source_url);
        if ($attachment_id) {
            $fallback = wp_get_attachment_image($attachment_id, 'full');
            $file_path = get_attached_file($attachment_id);
        } else {
            $fallback = '<img src="' . esc_url($source_url) . '" alt="" />';
        }

        if (!$file_path) {
            $uploads = wp_get_upload_dir();
            if (!empty($uploads['baseurl']) && !empty($uploads['basedir']) && strpos($source_url, $uploads['baseurl']) === 0) {
                $relative_path = ltrim(substr($source_url, strlen($uploads['baseurl'])), '/');
                $file_path = trailingslashit($uploads['basedir']) . $relative_path;
            }
        }
    }

    $url_path = $source_url ? parse_url($source_url, PHP_URL_PATH) : '';
    $url_extension = $url_path ? strtolower(pathinfo($url_path, PATHINFO_EXTENSION)) : '';
    $file_extension = $file_path ? strtolower(pathinfo($file_path, PATHINFO_EXTENSION)) : '';
    $is_svg = ($url_extension === 'svg' || $file_extension === 'svg');

    if (!$is_svg) {
        echo $fallback;
        return $fallback;
    }

    $svg = '';

    if ($file_path && file_exists($file_path) && is_readable($file_path)) {
        $svg = file_get_contents($file_path);
    } elseif ($source_url) {
        $response = wp_remote_get($source_url, ['timeout' => 5]);
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $svg = wp_remote_retrieve_body($response);
        }
    }

    if (!$svg) {
        echo $fallback;
        return $fallback;
    }

    $svg = trim($svg);
    echo $svg;

    return $svg;
}

/**
 * Filter WP_Query results by post title prefix when requested.
 */
function rw_filter_posts_by_title_prefix( $where, $query ) {
    if ( is_admin() ) {
        return $where;
    }

    $title_starts_with = $query->get( 'title_starts_with' );

    if ( empty( $title_starts_with ) ) {
        return $where;
    }

    global $wpdb;

    $where .= $wpdb->prepare(
        " AND {$wpdb->posts}.post_title LIKE %s",
        $wpdb->esc_like( $title_starts_with ) . '%'
    );

    return $where;
}
add_filter( 'posts_where', 'rw_filter_posts_by_title_prefix', 10, 2 );

/**
 * Exclude elements from WP Rocket's Automatic Lazy Rendering.
 *
 * WP Rocket adds data-wpr-lazyrender="1" plus [data-wpr-lazyrender]{content-visibility:auto}
 * to containers below the fold. The layout containment that comes with content-visibility
 * collapses .colsFull to 0px, so boxedCallouts sizes itself from the intro only and the
 * cards render below the section background instead of inside it.
 *
 * This filter matches raw HTML, not CSS selectors.
 */
function rw_rocket_lazyrender_exclusions( $exclusions ) {
    $exclusions[] = 'colsFull';

    return $exclusions;
}
add_filter( 'rocket_lrc_exclusions', 'rw_rocket_lazyrender_exclusions' );

/**
 * Default every wp_get_attachment_image() to loading="lazy".
 *
 * WordPress decides this itself, but on this site almost nothing was getting a
 * loading attribute at all — 43 of 47 images on the homepage had none. Rather
 * than rely on core's heuristic, set it here so it is deterministic.
 *
 * Above-the-fold images opt out by passing their own loading or fetchpriority:
 * the hero image (components/hero.php), the hero title logo (inc/heroTitle.php)
 * and the alert bar icon (header.php) all do.
 */
function rw_default_image_loading( $attr ) {
    if ( empty( $attr['loading'] ) && empty( $attr['fetchpriority'] ) ) {
        $attr['loading'] = 'lazy';
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'rw_default_image_loading' );


/*==============================================================*/
// LOAD PLUGIN ASSETS ONLY ON PAGES THAT USE THEM
/*==============================================================*/

/**
 * Everything this page could possibly render, as one searchable string.
 *
 * Post content alone is not enough: this theme builds pages from ACF flexible
 * content, so module layout names and any shortcodes typed into module fields
 * live in post meta rather than post_content. Both are collected here.
 *
 * Built once per request.
 */
function rw_page_content_blob() {
    static $blob = null;

    if ( $blob !== null ) {
        return $blob;
    }

    $blob    = '';
    $post_id = get_queried_object_id();

    if ( ! $post_id ) {
        return $blob;
    }

    $post = get_post( $post_id );

    if ( $post ) {
        $blob .= ' ' . $post->post_content;
    }

    foreach ( get_post_meta( $post_id ) as $key => $values ) {
        // Skip ACF's underscore-prefixed field key references, which hold no content.
        if ( isset( $key[0] ) && '_' === $key[0] ) {
            continue;
        }

        foreach ( (array) $values as $value ) {
            if ( is_string( $value ) ) {
                $blob .= ' ' . $value;
            }
        }
    }

    return $blob;
}

/**
 * Does this page use a given plugin's front-end feature?
 *
 * Anything not listed here returns true, so an unrecognised feature is never
 * unloaded by accident.
 */
function rw_page_uses( $feature ) {
    $blob = rw_page_content_blob();

    switch ( $feature ) {

        // The resourceFiltering module (inc/modules.php) prints [searchandfilter]
        // shortcodes. The layout name appears in the flexible content meta.
        case 'search-filter':
            return false !== strpos( $blob, 'resourceFiltering' )
                || false !== strpos( $blob, '[searchandfilter' );

        // TablePress renders from a [table id=..] shortcode.
        case 'tablepress':
            return (bool) preg_match( '/\[table[\s\]]/i', $blob );

        // arrowCallout type-countdown holds the countdown shortcode in a wysiwyg field.
        case 'countdown':
            return false !== strpos( $blob, 'type-countdown' );

        // Widget Options adds classes to widgets. If none are present in the
        // rendered sidebars there is nothing for its stylesheet to style.
        case 'widget-options':
            return false !== strpos( $blob, 'widgetopts' )
                || false !== strpos( $blob, 'hide-widget' );
    }

    return true;
}

/**
 * Handles to unload, grouped by the feature that needs them.
 *
 * Taken from the id="<handle>-css" / id="<handle>-js" attributes WordPress
 * printed on the staging homepage, so these are the real registered handles.
 */
function rw_conditional_asset_map() {
    return array(
        'search-filter' => array(
            'styles'  => array(
                'search-filter-frontend',
                'search-filter-frontend-ugc',
                'search-filter-frontend-component-combobox',
                'search-filter-frontend-component-date-picker',
                'search-filter-frontend-component-range',
            ),
            'scripts' => array(
                'search-filter-frontend',
                'search-filter-frontend-component-combobox',
                'search-filter-frontend-component-checkbox',
                'search-filter-frontend-component-date-picker',
                'search-filter-frontend-component-range',
                'search-filter-data',
                'search-filter-api-url',
            ),
        ),
        'tablepress' => array(
            'styles'  => array(
                'tablepress-default',
                'tablepress-datatables-buttons',
                'tablepress-datatables-columnfilterwidgets',
                'tablepress-datatables-fixedheader',
                'tablepress-datatables-fixedcolumns',
                'tablepress-datatables-scroll-buttons',
                'tablepress-responsive-tables',
            ),
            'scripts' => array(),
        ),
        // 'animated' is Widget Countdown's own handle for its legacy effects.css,
        // despite the generic name.
        'countdown' => array(
            'styles'  => array( 'countdown_css', 'animated' ),
            'scripts' => array( 'countdown-front-end' ),
        ),
        // Widget Options is an admin plugin. Its front-end stylesheet is only
        // needed if a widget is using one of its visibility or styling classes.
        'widget-options' => array(
            'styles'  => array( 'widgetopts-styles' ),
            'scripts' => array(),
        ),
    );
}

/**
 * Dequeue the assets for features this page does not use.
 *
 * Only runs on singular pages and posts. Archives, search results and 404s have
 * no single queried post to inspect, so they are left alone rather than risk
 * unloading something they do need.
 *
 * Priority 100 so plugins have finished enqueueing first.
 */
function rw_dequeue_unused_plugin_assets() {
    if ( is_admin() || ! is_singular() ) {
        return;
    }

    foreach ( rw_conditional_asset_map() as $feature => $assets ) {
        if ( rw_page_uses( $feature ) ) {
            continue;
        }

        foreach ( $assets['styles'] as $handle ) {
            wp_dequeue_style( $handle );
            wp_deregister_style( $handle );
        }

        foreach ( $assets['scripts'] as $handle ) {
            wp_dequeue_script( $handle );
            wp_deregister_script( $handle );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'rw_dequeue_unused_plugin_assets', 100 );

/**
 * Add To Any enqueues its stylesheet, its script and a request to
 * static.addtoany.com on every single page, with no check for whether share
 * buttons are actually rendered. It does expose a filter to switch that off:
 *
 *     $script_disabled = apply_filters( 'addtoany_script_disabled', false );
 *     if (is_admin() || $script_disabled) return;
 *
 * Returning true prevents the enqueue rather than undoing it, so nothing is
 * registered in the first place.
 *
 * The share buttons appear on single resources only — blog posts plus the
 * story, newsmedia, guide, factsheet and webinarsvids post types.
 */
function rw_addtoany_only_on_resources( $disabled ) {
    $with_share_buttons = array(
        'post',
        'story',
        'newsmedia',
        'guide',
        'factsheet',
        'webinarsvids',
    );

    if ( is_singular( $with_share_buttons ) ) {
        return $disabled;
    }

    return true;
}
add_filter( 'addtoany_script_disabled', 'rw_addtoany_only_on_resources' );