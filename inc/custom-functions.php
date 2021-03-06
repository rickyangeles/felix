<?php


// Getting Logo
if ( ! function_exists('header_logo') ) {
    function header_logo() {
        $logoArray = get_field('logo', 'options');
        if ( $logoArray ) {
            //$logoURL = $logoArray['url'];
            $size = 'logo';
            $logoURL = $logoArray['sizes'][ $size ];
        } else {
            $logoURL = 'https://via.placeholder.com/350x100';
        }
        return $logoURL;
    }
}

// Adding Header CTA to menu
add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
    global $post;
    $ctaLocation 			= get_field('header_cta_location', 'options') ? 'd-blog d-md-block' : '';
    $headerCTA              = get_field('header_cta_override') ? get_field('header_cta_override') : get_field('header_cta', 'options');
    $disableHeaderCTA       = get_field('disable_header_cta');

    if ( !get_field('disable_header_cta', $post->ID) ) {
        if ( $headerCTA && $args->theme_location == 'main-menu') {
            $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page header-cta-wrap ' . $ctaLocation . '"><a class="nav-link header-cta rounded" href="' . $headerCTA['url'] . '">' . $headerCTA['title'] . '</a></li>';
        }
    }
    return $items;
}

// Get header CTA
if ( ! function_exists('get_header_cta') ) {
    function get_header_cta() {
        global $post;
        $headerCTA = get_field('header_cta_override') ? get_field('header_cta_override') : get_field('header_cta', 'options');
        if ( $headerCTA ) {
            $cta = '<li class="menu-item menu-item-type-post_type menu-item-object-page header-cta-wrap"><a class="nav-link header-cta rounded" href="' . $headerCTA['url'] . '">' . $headerCTA['title'] . '</a></li>';
        }
        if ( !get_field('disable_header_cta', $post->ID) ) {
            return $cta;
        }
    }
}

// Get Search in Header
add_filter( 'wp_nav_menu_items', 'header_search', 10, 2 );
function header_search($items, $args) {
    $search = get_field('search_icon', 'options');
    if ( $search && $args->theme_location == 'main-menu' ) {
        $items .= '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
        <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" class="search-input" />
        <i class="far fa-search"></i>
        </div>
        </form>';
    }
    return $items;
}


//Adding social media icons
if ( ! function_exists('header_social') ) {

    function header_social() {
        $socialList = array('facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'youtube', 'tripadvisor', 'yelp');
        echo '<ul class="list-inline">';
        foreach ( $socialList as $social ) {
            $s_name = $social . '_url';
            $s_field = get_field($s_name, 'options');
            if ( !empty($s_field) && $social == 'facebook') {
                echo '<li class="list-inline-item"><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-f"></i></a></li>';
            } elseif ( !empty($s_field) && $social == 'linkedin') {
                echo '<li class="list-inline-item"><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-in"></i></a></li>';
            } elseif ( !empty($s_field) && $social == 'pinterest') {
                echo '<li class="list-inline-item"><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-p"></i></a></li>';
            } else {
                echo '<li class="list-inline-item"><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '"></i></a></li>';
            }
        }
        echo '</ul>';
    }
}

// Adding social media icons to the mobile menu
if ( ! function_exists('mmenu_social') ) {

    function mmenu_social() {
        $socialList = array('facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'youtube', 'tripadvisor', 'yelp');
        foreach ( $socialList as $social ) {
            $s_name = $social . '_url';
            $s_field = get_field($s_name, 'options');
            $social_list = '';
            if ( !empty($s_field) && $social == 'facebook') {
                $social_list += '"<a class=\"fab fa-' . $social . '-f" href="' . $s_field . '"></a>"';
                //echo '\"<a class=\"fab fa-' . $social . '-f" href="' . $s_field . '"></a>\"';
            } elseif ( !empty($s_field) && $social == 'linkedin') {
                $social_list += '"<a class="fab fa-' . $social . '-in" href="' . $s_field . '"></a>"';
            } elseif ( !empty($s_field) && $social == 'pinterest') {
                $social_list += '"<a class="fab fa-' . $social . '-p" href="' . $s_field . '"></a>"';
            } else {
                $social_list += '"<a class="fab fa-' . $social . '" href="' . $s_field . '"></a>"';
            }
        }

        echo $social_list;
    }
}

//Adding Clickup form on admin bar
add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'clickup-support',
        'title' => 'Submit Issue',
        'href'  => '#',
        'meta'  => array(
            'class' => 'submit-issue-btn',
        ),
    ));
}

// Adding Widget Areas for footer
function register_widget_areas() {
    register_sidebar( array(
        'name'          => 'Footer Menu',
        'id'            => 'footer_menu',
        'description'   => 'Area above menu',
        'before_widget' => '<section class="footer-menu fm">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
    register_sidebar( array(
        'name'          => 'Copyright Menu',
        'id'            => 'copyright_menu',
        'description'   => 'Menu below footer',
        'before_widget' => '<section class="copyright-menu">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer One',
        'id'            => 'footer_one',
        'description'   => 'Logo/About Area',
        'before_widget' => '<section class="footer-widget f1">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer Two',
        'id'            => 'footer_two',
        'description'   => 'Navigation Area',
        'before_widget' => '<section class="footer-widget f2">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer Three',
        'id'            => 'footer_three',
        'description'   => 'Navigation Area',
        'before_widget' => '<section class="footer-widget f3">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar( array(
        'name'          => 'Footer Four',
        'id'            => 'footer_four',
        'description'   => 'CTA and Contact Info',
        'before_widget' => '<section class="footer-widget f4">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'register_widget_areas' );


// Mobile Menu CTAs
if ( ! function_exists('mobile_menu_cta') ) {

    function mobile_menu_cta() {
        $mobileCTAs = '';
    	if ( have_rows('mobile_menu_cta', 'options') ) {
    		while ( have_rows('mobile_menu_cta', 'options') ) : the_row();
    			$cta = get_sub_field('cta');
    			$ctaLink = $cta['url'];
    			$ctaText = $cta['title'];
    			$buttonColor = get_sub_field('button_color');
                $reverse = get_sub_field('reverse') ? $buttonColor .' reverse' : '';
    			$mobileCTAs .= '"<a class=\'mm-cta ' . $buttonColor . '\' href=\'' . $ctaLink . '\'>' . $ctaText . '</a>",';
    		endwhile;
    	}

        return $mobileCTAs;
    }
}

// tn Limit Excerpt Length by number of Words
if ( ! function_exists('excerpt') ) {

    function excerpt( $limit, $readmore, $pID ) {
        $excerpt = explode(' ', get_the_excerpt($pID), $limit);
        $link = get_the_permalink($pID);
        if ( count($excerpt) >= $limit ) {
            array_pop($excerpt);
            if ( $readmore == true ) {
                $excerpt = implode(" ",$excerpt).'...<a href="' . $link . '"><strong>Read More</strong></a>';
            } else {
                $excerpt = implode(" ",$excerpt).'...';
            }

        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;
    }
}

if ( ! function_exists('content') ) {

    function content($limit) {
        $content = explode(' ', get_the_content(), $limit);
        if (count($content)>=$limit) {
            array_pop($content);
            $content = implode(" ",$content).'...';
        } else {
            $content = implode(" ",$content);
        }
        $content = preg_replace('/[.+]/','', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}

if ( ! function_exists('get_page_header') ) {
/**
 * get_page_header()
 *
 * @param  [string, number] $pID page ID
 * @param  [string] $classes Classes for banner type, example: "justify-content-center align-items-center"
 * @return [html]   Echos markup for page header
 * @link https://getbootstrap.com/docs/4.0/utilities/flex/
 */
    function get_page_header($pID,$classes) {
        $headerType     = get_field('header_type');
        $title          = get_field('override_page_header') ? get_field('override_page_header') : get_the_title();
        $bgColor        = get_field('page_header_color');
        $headerSize     = get_field('page_header_level') ? get_field('page_header_level') : 'h1';
        $subHeaderSize  = get_field('page_subheader_level');

        if ( $bgColor ) {
            $color = array_shift(array_values($bgColor));
        }
        if ( $headerType == 'banner') {
            $subtitle = get_field('page_subheader');
            if ( get_field('page_header_color') ) {
                $size       = 'page-header';
                $image      = get_field('banner_background', $pID);
                $thumb      = $image['sizes'][ $size ];
                $bgImage    = ' style="background-image:url(' . $thumb . ');"';
            }
        }
        if ( $headerType == 'basic') {
            echo '<div class="page-header row ' . $color . ' ' . $headerType . '-header">';
            echo '<' . $headerSize . ' class="container">' . $title . '</' . $headerSize . '>';
            echo '</div>';
        } elseif ( $headerType == 'banner') {
            echo '<div class="page-header row ' . $color . ' ' . $headerType . '-header d-flex '.$classes.'"' . $bgImage . '>';
            echo '<' . $headerSize . '>' . $title . '</' .  $headerSize . '>';
            echo '<' . $subHeaderSize . '>' . $subtitle . '</' . $subHeaderSize . '>';
            echo '</div>';
        } else {
            echo '<div class="page-header row none-header">';
            echo '<' . $headerSize . ' class="container">' . $title . '</' . $headerSize . '>';
            echo '</div>';
        }
    }
}

if ( ! function_exists('get_block_header') ) {

    function get_block_header() {
        $header             = get_field('header');
        $header_size        = get_field('header_size');
        $ov_header_size     = get_field('header_font_size') ? 'style="font-size:'. get_field('header_font_size') . '"': '';
        $subheader          = get_field('subheader');
        $subheader_size     = get_field('subheader_size');
        $ov_subheader_size  = get_field('subheader_font_size') ? 'style="font-size:'. get_field('subheader_font_size') . '"': '';
        $heaader_align      = get_field('header_align');

        if ( $header || $subheader ) { echo '<div class="block-header ' . $heaader_align . '">'; }
        if ( $header ) {
            if ( $ov_header_size ) {
                echo '<' . $header_size . ' ' . $ov_header_size .' class="header">' . $header . '</' . $header_size . '>';
            } else {
                echo '<' . $header_size . ' class="header">' . $header . '</' . $header_size . '>';
            }
        }
        if ( $subheader ) {
            if ( $ov_subheader_size ) {
                echo '<' . $subheader_size . ' ' . $ov_subheader_size .' class="subheader">' . $subheader . '</' . $subheader_size . '>';
            } else {
                echo '<' . $subheader_size . ' class="subheader">' . $subheader . '</' . $subheader_size . '>';
            }

        }
        if ( $header || $subheader ) { echo '</div>'; }
    }
}

// Block buttons
if ( ! function_exists('get_block_button') ) {
    function get_block_button() {
        $buttons = get_field('buttons_buttons');

        if( have_rows('buttons_buttons') ){
            echo '<div class="block-buttons"><ul class="buttons">';
            while( have_rows('buttons_buttons') ) {
                the_row();
                $link       = get_sub_field('link');
                $color      = get_sub_field('color');
                if ( $link ) {
                    $link_title = ' alt="' . $link['title'] . '"';
                }
                if ( get_sub_field('reverse') == 1 ) {
                    $color .= ' reverse';
                }
                //print_r($style);
                if ( $link ) {
                    echo '<li><a href="' . $link['url'] .'" class="' . $color . '"' . $link_title . '>' . $link['title'] . '</a></li>';
                }
            }
            echo '</ul></div>';
        }
    }
}

// Get Block Custom ID
if ( ! function_exists('block_custom_id') ) {
    function block_custom_id() {
        $c_id = get_field('custom_id') ? 'id="' . get_field('custom_id') . '"' : '';
        if ( get_field('custom_id') ) {
            echo '<div class="c_anchor"' . $c_id . '></div>';
        }
    }
}

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


// Core Block edits
function wporg_block_wrapper( $block_content, $block ) {
    if ( $block['blockName'] === 'core/paragraph' ) {
        $content = '<div class="wp-block-wrap-paragraph">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } elseif ( $block['blockName'] === 'core/heading' ) {
        $content = '<div class="wp-block-wrap-heading">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } elseif ( $block['blockName'] === 'core/latest-posts' ) {
        $content = '<div class="wp-block-wrap-latest-posts">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    elseif ( $block['blockName'] === 'core/image' ) {
        $content = '<div class="wp-block-wrap-image">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    return $block_content;
}
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );


add_action( 'admin_menu', 'admin_menu_add_external_link_top_level' );
function admin_menu_add_external_link_top_level() {
    global $menu;

    $menu_slug = "external_slug"; // just a placeholder for when we call add_menu_page
    $menu_pos = 1; // whatever position you want your menu to appear

    // create the top level menu, using $menu_slug as a placeholder for the link
    add_menu_page( 'admin_menu_add_external_link_top_level', 'Documentation', 'read', $menu_slug, '', 'dashicons-format-aside', $menu_pos );

    // replace the slug with your external url
    $menu[$menu_pos][2] = "/doc/index.php";
}
