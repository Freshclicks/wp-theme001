<?php

/**
 * Setup Theme Functions
 *
 */
if (!function_exists('fcstandard2014_theme_setup')):
    function fcstandard2014_theme_setup() {

        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
       /* Not sure why I would want to declare different post formats, but it is nice to know that I can */
	   //add_theme_support('post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat' ));

    }
endif;

add_action('after_setup_theme', 'fcstandard2014_theme_setup');

// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//register menu locations used by the theme
register_nav_menus( array(
	'primary_menu' => 'Primary Menu',
	'footer_menu' => 'Footer Menu'
) );

// add breadcrumb

function get_breadcrumb()
{
    global $wp_query;
    if ( !is_home() ){
        // Start the UL
        echo '<small><ul class="breadcrumb">';
        // Add the Home link
        echo '<li><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_option('home') .'" itemprop="url"><span itemprop="title">Home</span></a></span> </li>';

        if ( is_category() )
        {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
            echo "<li> ". get_category_parents( $cat, TRUE, "") ."</li>";
        }
        elseif ( is_archive() && !is_category() )
        {
            echo "<li>  Archives</li>";
        }
        elseif ( is_search() ) {

            echo "<li>  Search Results</li>";
        }
        elseif ( is_404() )
        {
            echo "<li>  404 Not Found</li>";
        }
        elseif ( is_single() )
        {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );

            echo ' <li>  '. get_category_parents( $category_id, TRUE, '&nbsp;  / &nbsp;');
            echo the_title(' ','', FALSE) ." </li>";
        }
        elseif ( is_page() )
        {
            $post = $wp_query->get_queried_object();

            if ( $post->post_parent == 0 ){

                echo "<li>  ".the_title('','', FALSE)." </li>";

            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);

                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li>  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor) .'" itemprop="url"><span itemprop="title">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</span></a></span> </li>';
                    } else {
                        echo '<li>  '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .' </li>';
                    }
                }
            }
        }

        // End the UL
        echo "</ul></small>";
    }
}



// modify all images to include the responsive images option

function add_image_class($class){
	$class .= ' img-responsive';
	return $class;
}
add_filter('get_image_tag_class','add_image_class');

//register the sidebar modules

if ( function_exists('register_sidebars') )

register_sidebar( array(
		'name' => __( 'Home Sidebar', 'fcstandard2014' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="well widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Recent', 'fcstandard2014' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the blog pages', 'fcstandard2014' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s well">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'fcstandard2014' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'fcstandard2014' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'fcstandard2014' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'fcstandard2014' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'fcstandard2014' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'fcstandard2014' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'fcstandard2014' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your site footer', 'fcstandard2014' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	

// Display template for post meta information on archive

if (!function_exists('fcstandard2014_posted_on')) :
    function fcstandard2014_posted_on()
    {
        printf(__('<pan class="text-muted"><small>Posted on: <time class="entry-date" datetime="%3$s" pubdate>%4$s</time><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span></small></span>','fcstandard2014'),
            esc_url(get_permalink()),
            esc_attr(get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_attr(sprintf(__('View all posts by %s', 'veryplaintext'), get_the_author())),
            esc_html(get_the_author())
        );
    }
endif;

/**
 * Define post thumbnail size.
 * Add two additional image sizes. Does this do anything?
 *
 */
function fcstandard2014_images() {

    set_post_thumbnail_size(260, 180); // 260px wide x 180px high
    add_image_size('bootstrap-small', 300, 200); // 300px wide x 200px high
    add_image_size('bootstrap-medium', 360, 270); // 360px wide by 270px high
}

/**
 * Checks if a post thumbnails is already defined.
 *
 */
function fcstandard2014_is_post_thumbnail_set()
{
    global $post;
    if (get_the_post_thumbnail()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Set post thumbnail as first image from post, if not already defined.
 *
 */
function fcstandard2014_autoset_featured_img()
{
    global $post;

    $post_thumbnail = fcstandard2014_is_post_thumbnail_set();
    if ($post_thumbnail == true) {
        return get_the_post_thumbnail();
    }
    $image_args     = array(
        'post_type'      => 'attachment',
        'numberposts'    => 1,
        'post_mime_type' => 'image',
        'post_parent'    => $post->ID,
        'order'          => 'desc'
    );
    $attached_images = get_children($image_args, ARRAY_A);
    $first_image = reset($attached_images);
    if (!$first_image) {
        return false;
    }

    return get_the_post_thumbnail($post->ID, $first_image['ID']);

}

// Produces an hCard for post authors
function fcstandard2014_author_hCard() {
	global $wpdb, $authordata;
	echo '<span class="entry-author author vcard"><a class="url fn n" href="' . get_author_link(false, $authordata->ID, $authordata->user_nicename) . '" title="View all posts by ' . $authordata->display_name . '">' . get_the_author() . '</a></span>';
}

// Produces semantic classes for the body element; Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_body_class( $print = true ) {
	global $wp_query, $current_user;

	$c = array('wordpress');

	fcstandard2014_date_classes(time(), $c);

	is_home()       ? $c[] = 'home'       : null;
	is_archive()    ? $c[] = 'archive'    : null;
	is_date()       ? $c[] = 'date'       : null;
	is_search()     ? $c[] = 'search'     : null;
	is_paged()      ? $c[] = 'paged'      : null;
	is_attachment() ? $c[] = 'attachment' : null;
	is_404()        ? $c[] = 'four04'     : null;

	if ( is_single() ) {
		the_post();
		$c[] = 'single';
		if ( isset($wp_query->post->post_date) )
			fcstandard2014_date_classes(mysql2date('U', $wp_query->post->post_date), $c, 's-');
		foreach ( (array) get_the_category() as $cat )
			$c[] = 's-category-' . $cat->category_nicename;
			$c[] = 's-author-' . get_the_author_login();
		rewind_posts();
	}

	else if ( is_author() ) {
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;
	}
	
	else if ( is_category() ) {
		$cat = $wp_query->get_queried_object();
		$c[] = 'category';
		$c[] = 'category-' . $cat->category_nicename;
	}

	else if ( is_page() ) {
		the_post();
		$c[] = 'page';
		$c[] = 'page-author-' . get_the_author_login();
		rewind_posts();
	}

	if ( $current_user->ID )
		$c[] = 'loggedin';
		
	$c = join(' ', apply_filters('body_class',  $c));

	return $print ? print($c) : $c;
}

// Produces semantic classes for the each individual post div; Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_post_class( $print = true ) {
	global $post, $fcstandard2014_post_alt;

	$c = array('hentry', "p$fcstandard2014_post_alt", $post->post_type, $post->post_status);

	$c[] = 'author-' . get_the_author_login();

	if ( is_attachment() )
		$c[] = 'attachment';

	foreach ( (array) get_the_category() as $cat )
		$c[] = 'category-' . $cat->category_nicename;

	fcstandard2014_date_classes(mysql2date('U', $post->post_date), $c);

	if ( ++$fcstandard2014_post_alt % 2 )
		$c[] = 'alt';
		
	$c = join(' ', apply_filters('post_class', $c));

	return $print ? print($c) : $c;
}
$fcstandard2014_post_alt = 1;

// Produces semantic classes for the each individual comment li; Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_comment_class( $print = true ) {
	global $comment, $post, $fcstandard2014_comment_alt;

	$c = array($comment->comment_type);

	if ( $comment->user_id > 0 ) {
		$user = get_userdata($comment->user_id);

		$c[] = "byuser commentauthor-$user->user_login";

		if ( $comment->user_id === $post->post_author )
			$c[] = 'bypostauthor';
	}

	fcstandard2014_date_classes(mysql2date('U', $comment->comment_date), $c, 'c-');
	if ( ++$fcstandard2014_comment_alt % 2 )
		$c[] = 'alt';

	$c[] = "c$fcstandard2014_comment_alt";

	if ( is_trackback() ) {
		$c[] = 'trackback';
	}

	$c = join(' ', apply_filters('comment_class', $c));

	return $print ? print($c) : $c;
}

// Produces date-based classes for the three functions above; Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_date_classes($t, &$c, $p = '') {
	$t = $t + (get_option('gmt_offset') * 3600);
	$c[] = $p . 'y' . gmdate('Y', $t);
	$c[] = $p . 'm' . gmdate('m', $t);
	$c[] = $p . 'd' . gmdate('d', $t);
	$c[] = $p . 'h' . gmdate('h', $t);
}

// Returns other categories except the current one (redundant); Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_other_cats($glue) {
	$current_cat = single_cat_title('', false);
	$separator = "\n";
	$cats = explode($separator, get_the_category_list($separator));

	foreach ( $cats as $i => $str ) {
		if ( strstr($str, ">$current_cat<") ) {
			unset($cats[$i]);
			break;
		}
	}

	if ( empty($cats) )
		return false;

	return trim(join($glue, $cats));
}

// Returns other tags except the current one (redundant); Originally from the Sandbox, http://www.plaintxt.org/themes/sandbox/
function fcstandard2014_other_tags($glue) {
	$current_tag = single_tag_title('', '',  false);
	$separator = "\n";
	$tags = explode($separator, get_the_tag_list("", "$separator", ""));

	foreach ( $tags as $i => $str ) {
		if ( strstr($str, ">$current_tag<") ) {
			unset($tags[$i]);
			break;
		}
	}

	if ( empty($tags) )
		return false;

	return trim(join($glue, $tags));
}

// Produces an avatar image with the hCard-compliant photo class
function fcstandard2014_commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$email = get_comment_author_email();
	$avatar_size = get_option('fcstandard2014_avatarsize');
	if ( empty($avatar_size) ) $avatar_size = '40';
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email", "$avatar_size" ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}

// Function to filter the default gallery shortcode
function fcstandard2014_gallery($attr) {
	global $post;
	if ( isset($attr['orderby']) ) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if ( !$attr['orderby'] )
			unset($attr['orderby']);
	}

	extract(shortcode_atts( array(
		'orderby'    => 'menu_order ASC, ID ASC',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
	), $attr ));

	$id           =  intval($id);
	$orderby      =  addslashes($orderby);
	$attachments  =  get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) )
		return null;

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link( $id, $size, true ) . "\n";
		return $output;
	}

	$listtag     =  tag_escape($listtag);
	$itemtag     =  tag_escape($itemtag);
	$captiontag  =  tag_escape($captiontag);
	$columns     =  intval($columns);
	$itemwidth   =  $columns > 0 ? floor(100/$columns) : 100;

	$output = apply_filters( 'gallery_style', "\n" . '<div class="gallery">', 9 ); // Available filter: gallery_style

	foreach ( $attachments as $id => $attachment ) {
		$img_lnk = get_attachment_link($id);
		$img_src = wp_get_attachment_image_src( $id, $size );
		$img_src = $img_src[0];
		$img_alt = $attachment->post_excerpt;
		if ( $img_alt == null )
			$img_alt = $attachment->post_title;
		$img_rel = apply_filters( 'gallery_img_rel', 'attachment' ); // Available filter: gallery_img_rel
		$img_class = apply_filters( 'gallery_img_class', 'gallery-image' ); // Available filter: gallery_img_class

		$output  .=  "\n\t" . '<' . $itemtag . ' class="gallery-item gallery-columns-' . $columns .'">';
		$output  .=  "\n\t\t" . '<' . $icontag . ' class="gallery-icon"><a href="' . $img_lnk . '" title="' . $img_alt . '" rel="' . $img_rel . '"><img src="' . $img_src . '" alt="' . $img_alt . '" class="' . $img_class . ' attachment-' . $size . '" /></a></' . $icontag . '>';

		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "\n\t\t" . '<' . $captiontag . ' class="gallery-caption">' . $attachment->post_excerpt . '</' . $captiontag . '>';
		}

		$output .= "\n\t" . '</' . $itemtag . '>';
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= "\n</div>\n" . '<div class="gallery">';
	}
	$output .= "\n</div>\n";

	return $output;
}


// Loads fcstandard2014-style Search widget
function widget_fcstandard2014_search($args) {
	extract($args);
	$options = get_option('widget_fcstandard2014_search');
	$title = empty($options['title']) ? __( 'Search', 'fcstandard2014' ) : $options['title'];
	$button = empty($options['button']) ? __( 'Find', 'fcstandard2014' ) : $options['button'];
?>
		<?php echo $before_widget ?>
				<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
			<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
				<div>
					<input id="s" name="s" class="text-input" type="text" value="<?php the_search_query() ?>" size="10" tabindex="1" accesskey="S" />
					<input id="searchsubmit" name="searchsubmit" class="submit-button" type="submit" value="<?php echo $button ?>" tabindex="2" />
				</div>
			</form>
		<?php echo $after_widget ?>
<?php
}

// Widget: Search; element controls for customizing text within Widget plugin
function widget_fcstandard2014_search_control() {
	$options = $newoptions = get_option('widget_fcstandard2014_search');
	if ( $_POST['search-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['search-title'] ) );
		$newoptions['button'] = strip_tags( stripslashes( $_POST['search-button'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_fcstandard2014_search', $options );
	}
	$title = attribute_escape( $options['title'] );
	$button = attribute_escape( $options['button'] );
?>
			<p><label for="search-title"><?php _e( 'Title:', 'fcstandard2014' ) ?> <input class="widefat" id="search-title" name="search-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="search-button"><?php _e( 'Button Text:', 'fcstandard2014' ) ?> <input class="widefat" id="search-button" name="search-button" type="text" value="<?php echo $button; ?>" /></label></p>
			<input type="hidden" id="search-submit" name="search-submit" value="1" />
<?php
}

// Loads fcstandard2014-style Meta widget
function widget_fcstandard2014_meta($args) {
	extract($args);
	$options = get_option('widget_meta');
	$title = empty($options['title']) ? __('Meta', 'fcstandard2014') : $options['title'];
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<?php wp_register() ?>
				<li><?php wp_loginout() ?></li>
				<?php wp_meta() ?>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Loads the fcstandard2014-style Home link widget 
function widget_fcstandard2014_homelink($args) {
	extract($args);
	$options = get_option('widget_fcstandard2014_homelink');
	$title = empty($options['title']) ? __( 'Home', 'fcstandard2014' ) : $options['title'];
	if ( !is_front_page() || is_paged() ) {
?>
			<?php echo $before_widget; ?>
				<?php echo $before_title; ?><a href="<?php bloginfo('home'); ?>/" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>" rel="home"><?php echo $title; ?></a><?php echo $after_title; ?>
			<?php echo $after_widget; ?>
<?php }

}

// Loads the control functions for the Home Link, allowing control of its text
function widget_fcstandard2014_homelink_control() {
	$options = $newoptions = get_option('widget_fcstandard2014_homelink');
	if ( $_POST['homelink-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['homelink-title'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_fcstandard2014_homelink', $options );
	}
	$title = attribute_escape( $options['title'] );
?>
			<p><?php _e('Adds a link to the home page on every page <em>except</em> the home.', 'fcstandard2014'); ?></p>
			<p><label for="homelink-title"><?php _e( 'Title:', 'fcstandard2014' ) ?> <input class="widefat" id="homelink-title" name="homelink-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="homelink-submit" name="homelink-submit" value="1" />
<?php
}

function widget_fcstandard2014_rsslinks($args) {
	extract($args);
	$options = get_option('widget_fcstandard2014_rsslinks');
	$title = empty($options['title']) ? __( 'RSS Links', 'fcstandard2014' ) : $options['title'];
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?> <?php _e( 'Posts RSS feed', 'fcstandard2014' ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', 'fcstandard2014' ) ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> <?php _e( 'Comments RSS feed', 'fcstandard2014' ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', 'fcstandard2014' ) ?></a></li>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Loads the control functions for the RSS Links, allowing control of its text
function widget_fcstandard2014_rsslinks_control() {
	$options = $newoptions = get_option('widget_fcstandard2014_rsslinks');
	if ( $_POST['rsslinks-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['rsslinks-title'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_fcstandard2014_rsslinks', $options );
	}
	$title = attribute_escape( $options['title'] );
?>
			<p><label for="rsslinks-title"><?php _e( 'Title:', 'fcstandard2014' ) ?> <input class="widefat" id="rsslinks-title" name="rsslinks-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="rsslinks-submit" name="rsslinks-submit" value="1" />
<?php
}

// Loads, checks that Widgets are loaded and working
function fcstandard2014_widgets_init() {
	if ( !function_exists('register_sidebars') )
		return;

	// Finished intializing Widgets plugin, now let's load the fcstandard2014 default widgets; first, fcstandard2014 search widget
	$widget_ops = array(
		'classname'    =>  'widget_search',
		'description'  =>  __( "A search form for your blog (fcstandard2014)", "fcstandard2014" )
	);
	wp_register_sidebar_widget( 'search', __( 'Search', 'fcstandard2014' ), 'widget_fcstandard2014_search', $widget_ops );
	unregister_widget_control('search');
	wp_register_widget_control( 'search', __( 'Search', 'fcstandard2014' ), 'widget_fcstandard2014_search_control' );

	// fcstandard2014 Meta widget
	$widget_ops = array(
		'classname'    =>  'widget_meta',
		'description'  =>  __( "Log in/out and administration links (fcstandard2014)", "fcstandard2014" )
	);
	wp_register_sidebar_widget( 'meta', __( 'Meta', 'fcstandard2014' ), 'widget_fcstandard2014_meta', $widget_ops );
	unregister_widget_control('meta');
	wp_register_widget_control( 'meta', __('Meta'), 'wp_widget_meta_control' );

	//fcstandard2014 Home Link widget
	$widget_ops = array(
		'classname'    =>  'widget_home_link',
		'description'  =>  __( "Link to the front page when elsewhere (fcstandard2014)", "fcstandard2014" )
	);
	wp_register_sidebar_widget( 'home_link', __( 'Home Link', 'fcstandard2014' ), 'widget_fcstandard2014_homelink', $widget_ops );
	wp_register_widget_control( 'home_link', __( 'Home Link', 'fcstandard2014' ), 'widget_fcstandard2014_homelink_control' );

	//fcstandard2014 RSS Links widget
	$widget_ops = array(
		'classname'    =>  'widget_rss_links',
		'description'  =>  __( "RSS links for both posts and comments (fcstandard2014)", "fcstandard2014" )
	);
	wp_register_sidebar_widget( 'rss_links', __( 'RSS Links', 'fcstandard2014' ), 'widget_fcstandard2014_rsslinks', $widget_ops );
	wp_register_widget_control( 'rss_links', __( 'RSS Links', 'fcstandard2014' ), 'widget_fcstandard2014_rsslinks_control' );
}

// Loads the admin menu; sets default settings for each
function fcstandard2014_add_admin() {
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			check_admin_referer('fcstandard2014_save_options');
			update_option( 'fcstandard2014_basefontsize', strip_tags( stripslashes( $_REQUEST['vp_basefontsize'] ) ) );
			update_option( 'fcstandard2014_basefontfamily', strip_tags( stripslashes( $_REQUEST['vp_basefontfamily'] ) ) );
			update_option( 'fcstandard2014_headingfontfamily', strip_tags( stripslashes( $_REQUEST['vp_headingfontfamily'] ) ) );
			update_option( 'fcstandard2014_posttextalignment', strip_tags( stripslashes( $_REQUEST['vp_posttextalignment'] ) ) );
			update_option( 'fcstandard2014_layoutwidth', strip_tags( stripslashes( $_REQUEST['vp_layoutwidth'] ) ) );
			update_option( 'fcstandard2014_maxwidth', strip_tags( stripslashes( $_REQUEST['vp_maxwidth'] ) ) );
			update_option( 'fcstandard2014_minwidth', strip_tags( stripslashes( $_REQUEST['vp_minwidth'] ) ) );
			update_option( 'fcstandard2014_sidebarposition', strip_tags( stripslashes( $_REQUEST['vp_sidebarposition'] ) ) );
			update_option( 'fcstandard2014_sidebartextalignment', strip_tags( stripslashes( $_REQUEST['vp_sidebartextalignment'] ) ) );
			update_option( 'fcstandard2014_avatarsize', strip_tags( stripslashes( $_REQUEST['vp_avatarsize'] ) ) );
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			check_admin_referer('fcstandard2014_reset_options');
			delete_option('fcstandard2014_basefontsize');
			delete_option('fcstandard2014_basefontfamily');
			delete_option('fcstandard2014_headingfontfamily');
			delete_option('fcstandard2014_posttextalignment');
			delete_option('fcstandard2014_layoutwidth');
			delete_option('fcstandard2014_maxwidth');
			delete_option('fcstandard2014_minwidth');
			delete_option('fcstandard2014_sidebarposition');
			delete_option('fcstandard2014_sidebartextalignment');
			delete_option('fcstandard2014_avatarsize');
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
		add_action('admin_head', 'fcstandard2014_admin_head');
	}
	add_theme_page( __( 'fcstandard2014 Theme Options', 'fcstandard2014' ), __( 'Theme Options', 'fcstandard2014' ), 'edit_themes', basename(__FILE__), 'fcstandard2014_admin' );
}


// Admin theme options menu
function fcstandard2014_admin() { // Theme options menu 
	if ( $_REQUEST['saved'] ) { ?><div id="message1" class="updated fade"><p><?php printf(__('fcstandard2014 theme options saved. <a href="%s">View site.</a>', 'fcstandard2014'), get_bloginfo('home') . '/'); ?></p></div><?php }
	if ( $_REQUEST['reset'] ) { ?><div id="message2" class="updated fade"><p><?php _e('fcstandard2014 theme options reset.', 'fcstandard2014'); ?></p></div><?php }

	$check = ' checked="checked"';
	$basefont = get_option('fcstandard2014_basefontfamily');
	$headfont = get_option('fcstandard2014_headingfontfamily');
?>

<div class="wrap">

	<h2><?php _e('fcstandard2014 Theme Options', 'fcstandard2014'); ?></h2>
	<?php printf( __('%1$s<p>Thanks for selecting the <a href="http://www.plaintxt.org/themes/fcstandard2014/" title="fcstandard2014 theme for WordPress">fcstandard2014</a> theme by <span class="vcard"><a class="url fn n" href="http://scottwallick.com/" title="scottwallick.com" rel="me designer"><span class="given-name">Scott</span> <span class="additional-name">Allan</span> <span class="family-name">Wallick</span></a></span>. Please read the included <a href="%2$s" title="Open the readme.html" rel="enclosure" id="readme">documentation</a> for more information about fcstandard2014 and its advanced features. <strong>If you find this theme useful, please consider <label for="paypal">donating</label>.</strong> You must click on <i><u>S</u>ave Options</i> to save any changes. You can also discard your changes and reload the default settings by clicking on <i><u>R</u>eset</i>.</p>', 'fcstandard2014'), fcstandard2014_donate(), get_template_directory_uri() . '/readme.html' ); ?>

	<form action="<?php echo wp_specialchars( $_SERVER['REQUEST_URI'] ) ?>" method="post">
		<?php wp_nonce_field('fcstandard2014_save_options'); echo "\n"; ?>
		<h3><?php _e('Typography', 'fcstandard2014'); ?></h3>
		<table class="form-table" summary="fcstandard2014 typography options">
			<tr valign="top">
				<th scope="row"><label for="vp_basefontsize"><?php _e('Base font size', 'fcstandard2014'); ?></label></th> 
				<td>
					<input id="vp_basefontsize" name="vp_basefontsize" type="text" class="text" value="<?php if ( get_option('fcstandard2014_basefontsize') == "" ) { echo "90%"; } else { echo attribute_escape( get_option('fcstandard2014_basefontsize') ); } ?>" tabindex="1" size="10" />
					<p class="info"><?php _e('The base font size globally affects the size of text throughout your blog. This can be in any unit (e.g., px, pt, em), but I suggest using a percentage (%). Default is 90%.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Base font family', 'fcstandard2014'); ?></th> 
				<td>
					<input id="vp_basefontArial" name="vp_basefontfamily" type="radio" class="radio" value="1"<?php if ( $basefont == 1 ) echo $check; ?> tabindex="2" /> <label for="vp_basefontArial" class="arial">Arial</label><br />
					<input id="vp_basefontCourier" name="vp_basefontfamily" type="radio" class="radio" value="2"<?php if ( $basefont == 2 ) echo $check; ?> tabindex="3" /> <label for="vp_basefontCourier" class="courier">Courier</label><br />
					<input id="vp_basefontGeorgia" name="vp_basefontfamily" type="radio" class="radio" value="3"<?php if ( $basefont == 3 ) echo $check; ?> tabindex="4" /> <label for="vp_basefontGeorgia" class="georgia">Georgia</label><br />
					<input id="vp_basefontLucidaConsole" name="vp_basefontfamily" type="radio" class="radio" value="4"<?php if ( $basefont == 4 ) echo $check; ?> tabindex="5" /> <label for="vp_basefontLucidaConsole" class="lucida-console">Lucida Console</label><br />
					<input id="vp_basefontLucidaUnicode" name="vp_basefontfamily" type="radio" class="radio" value="5"<?php if ( $basefont == 5 ) echo $check; ?> tabindex="6" /> <label for="vp_basefontLucidaUnicode" class="lucida-unicode">Lucida Sans Unicode</label><br />
					<input id="vp_basefontTahoma" name="vp_basefontfamily" type="radio" class="radio" value="6"<?php if ( $basefont == 6 ) echo $check; ?> tabindex="7" /> <label for="vp_basefontTahoma" class="tahoma">Tahoma</label><br />
					<input id="vp_basefontTimes" name="vp_basefontfamily" type="radio" class="radio" value="7"<?php if ( ( $basefont == '' ) || ( $basefont == 7 ) ) echo $check; ?> tabindex="8" /> <label for="vp_basefontTimes" class="times">Times</label><br />
					<input id="vp_basefontTrebuchetMS" name="vp_basefontfamily" type="radio" class="radio" value="8"<?php if ( $basefont == 8 ) echo $check; ?> tabindex="9" /> <label for="vp_basefontTrebuchetMS" class="trebuchet">Trebuchet MS</label><br />
					<input id="vp_basefontVerdana" name="vp_basefontfamily" type="radio" class="radio" value="9"<?php if ( $basefont == 9 ) echo $check; ?> tabindex="10" /> <label for="vp_basefontVerdana" class="verdana">Verdana</label>
					<p class="info"><?php printf(__('The base font family sets the font for everything except content headings. The selection is limited to %1$s fonts, as they will display correctly. Default is <span class="times">Times</span>.', 'fcstandard2014'), '<cite><a href="http://en.wikipedia.org/wiki/Web_safe_fonts" title="Web safe fonts - Wikipedia">web safe</a></cite>'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Heading font family', 'fcstandard2014'); ?></th> 
				<td>
					<input id="vp_headingfontArial" name="vp_headingfontfamily" type="radio" class="radio" value="1"<?php if ( ( $headfont == '' ) || ( $headfont == 1 ) ) echo $check; ?> tabindex="2" /> <label for="vp_headingfontArial" class="arial">Arial</label><br />
					<input id="vp_headingfontCourier" name="vp_headingfontfamily" type="radio" class="radio" value="2"<?php if ( $headfont == 2 ) echo $check; ?> tabindex="3" /> <label for="vp_headingfontCourier" class="courier">Courier</label><br />
					<input id="vp_headingfontGeorgia" name="vp_headingfontfamily" type="radio" class="radio" value="3"<?php if ( $headfont == 3 ) echo $check; ?> tabindex="4" /> <label for="vp_headingfontGeorgia" class="georgia">Georgia</label><br />
					<input id="vp_headingfontLucidaConsole" name="vp_headingfontfamily" type="radio" class="radio" value="4"<?php if ( $headfont == 4 ) echo $check; ?> tabindex="5" /> <label for="vp_headingfontLucidaConsole" class="lucida-console">Lucida Console</label><br />
					<input id="vp_headingfontLucidaUnicode" name="vp_headingfontfamily" type="radio" class="radio" value="5"<?php if ( $headfont == 5 ) echo $check; ?> tabindex="6" /> <label for="vp_headingfontLucidaUnicode" class="lucida-unicode">Lucida Sans Unicode</label><br />
					<input id="vp_headingfontTahoma" name="vp_headingfontfamily" type="radio" class="radio" value="6"<?php if ( $headfont == 6 ) echo $check; ?> tabindex="7" /> <label for="vp_headingfontTahoma" class="tahoma">Tahoma</label><br />
					<input id="vp_headingfontTimes" name="vp_headingfontfamily" type="radio" class="radio" value="7"<?php if ( $headfont == 7 ) echo $check; ?> tabindex="8" /> <label for="vp_headingfontTimes" class="times">Times</label><br />
					<input id="vp_headingfontTrebuchetMS" name="vp_headingfontfamily" type="radio" class="radio" value="8"<?php if ( $headfont == 8 ) echo $check; ?> tabindex="9" /> <label for="vp_headingfontTrebuchetMS" class="trebuchet">Trebuchet MS</label><br />
					<input id="vp_headingfontVerdana" name="vp_headingfontfamily" type="radio" class="radio" value="9"<?php if ( $headfont == 9 ) echo $check; ?> tabindex="10" /> <label for="vp_headingfontVerdana" class="verdana">Verdana</label>
					<p class="info"><?php printf(__('The heading font family sets the font for all content headings. The selection is limited to %1$s fonts, as they will display correctly. Default is <span class="arial">Arial</span>. ', 'fcstandard2014'), '<cite><a href="http://en.wikipedia.org/wiki/Web_safe_fonts" title="Web safe fonts - Wikipedia">web safe</a></cite>'); ?></p>
				</td>
			</tr>
		</table>
		<h3><?php _e('Layout', 'fcstandard2014'); ?></h3>
		<table class="form-table" summary="fcstandard2014 layout options">
			<tr valign="top">
				<th scope="row"><label for="vp_layoutwidth"><?php _e('Layout width', 'fcstandard2014'); ?></label></th> 
				<td>
					<input id="vp_layoutwidth" name="vp_layoutwidth" type="text" class="text" value="<?php if ( get_option('fcstandard2014_layoutwidth') == "" ) { echo "80%"; } else { echo attribute_escape( get_option('fcstandard2014_layoutwidth') ); } ?>" tabindex="20" size="10" />
					<p class="info"><?php _e('The layout width determines the normal width of the entire layout. This can be in any unit (e.g., px, pt, em), but I suggest using a percentage (%). Default is <span>80%</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="vp_maxwidth"><?php _e('Maximum width', 'fcstandard2014'); ?></label></th> 
				<td>
					<input id="vp_maxwidth" name="vp_maxwidth" type="text" class="text" value="<?php if ( get_option('fcstandard2014_maxwidth') == "" ) { echo "55em"; } else { echo attribute_escape( get_option('fcstandard2014_maxwidth') ); } ?>" tabindex="21" size="10" />
					<p class="info"><?php _e('The maximum width determines how wide the layout can be. When viewed in a large screen, this keeps text lines from running long (i.e., difficult hard to read). Note that this has no effect in Internet Explorer 6 and below. You may leave this blank. Default is <span>55em</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="vp_minwidth"><?php _e('Minimum width', 'fcstandard2014'); ?></label></th> 
				<td>
					<input id="vp_minwidth" name="vp_minwidth" type="text" class="text" value="<?php if ( get_option('fcstandard2014_minwidth') == "" ) { echo "35em"; } else { echo attribute_escape( get_option('fcstandard2014_minwidth') ); } ?>" tabindex="22" size="10" />
					<p class="info"><?php _e('The minimum width determines how narrow the layout can be. When viewed in a small area, this keeps the layout from becoming too narrow. Note that this has no effect in Internet Explorer 6 and below. You may leave this blank. Default is <span>35em</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="vp_posttextalignment"><?php _e('Post text alignment', 'fcstandard2014'); ?></label></th> 
				<td>
					<select id="vp_posttextalignment" name="vp_posttextalignment" tabindex="23" class="dropdown">
						<option value="center" <?php if ( get_option('fcstandard2014_posttextalignment') == "center" ) { echo 'selected="selected"'; } ?>><?php _e('Centered', 'fcstandard2014'); ?> </option>
						<option value="justify" <?php if ( get_option('fcstandard2014_posttextalignment') == "justify" ) { echo 'selected="selected"'; } ?>><?php _e('Justified', 'fcstandard2014'); ?> </option>
						<option value="left" <?php if ( ( get_option('fcstandard2014_posttextalignment') == "") || ( get_option('fcstandard2014_posttextalignment') == "left") ) { echo 'selected="selected"'; } ?>><?php _e('Left', 'fcstandard2014'); ?> </option>
						<option value="right" <?php if ( get_option('fcstandard2014_posttextalignment') == "right" ) { echo 'selected="selected"'; } ?>><?php _e('Right', 'fcstandard2014'); ?> </option>
					</select>
					<p class="info"><?php _e('Choose one of the options for the alignment of the post entry text. Default is <span>left</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="vp_sidebarposition"><?php _e('Sidebar position', 'fcstandard2014'); ?></label></th> 
				<td>
					<select id="vp_sidebarposition" name="vp_sidebarposition" tabindex="24" class="dropdown">
						<option value="left" <?php if ( get_option('fcstandard2014_sidebarposition') == "left" ) { echo 'selected="selected"'; } ?>><?php _e('Left of content', 'fcstandard2014'); ?> </option>
						<option value="right" <?php if ( ( get_option('fcstandard2014_sidebarposition') == "") || ( get_option('fcstandard2014_sidebarposition') == "right") ) { echo 'selected="selected"'; } ?>><?php _e('Right of content', 'fcstandard2014'); ?> </option>
					</select>
					<p class="info"><?php _e('The sidebar can be positioned to the left or the right of the main content column. Default is <span>right of content</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="vp_sidebartextalignment" class="dropdown"><?php _e('Sidebar text alignment', 'fcstandard2014'); ?></label></th> 
				<td>
					<select id="vp_sidebartextalignment" name="vp_sidebartextalignment" tabindex="25" class="dropdown">
						<option value="center" <?php if ( ( get_option('fcstandard2014_sidebartextalignment') == "") || ( get_option('fcstandard2014_sidebartextalignment') == "center") ) { echo 'selected="selected"'; } ?>><?php _e('Centered', 'fcstandard2014'); ?> </option>
						<option value="left" <?php if ( get_option('fcstandard2014_sidebartextalignment') == "left" ) { echo 'selected="selected"'; } ?>><?php _e('Left', 'fcstandard2014'); ?> </option>
						<option value="right" <?php if ( get_option('fcstandard2014_sidebartextalignment') == "right" ) { echo 'selected="selected"'; } ?>><?php _e('Right', 'fcstandard2014'); ?> </option>
					</select>
					<p class="info"><?php _e('Choose one of the options for the alignment of the sidebar text. Default is <span>centered</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
		</table>
		<h3><?php _e('Content', 'fcstandard2014'); ?></h3>
		<table class="form-table" summary="fcstandard2014 content options">
			<tr valign="top">
				<th scope="row"><label for="vp_avatarsize"><?php _e('Avatar size', 'plaintxtblog'); ?></label></th> 
				<td>
					<input id="vp_avatarsize" name="vp_avatarsize" type="text" class="text" value="<?php if ( get_option('fcstandard2014_avatarsize') == "" ) { echo "40"; } else { echo attribute_escape( get_option('fcstandard2014_avatarsize') ); } ?>" size="6" />
					<p class="info"><?php _e('Sets the avatar size in pixels, if avatars are enabled. Default is <span>40</span>.', 'fcstandard2014'); ?></p>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input name="save" type="submit" value="<?php _e('Save Options', 'fcstandard2014'); ?>" tabindex="26" accesskey="S" />  
			<input name="action" type="hidden" value="save" />
			<input name="page_options" type="hidden" value="vp_basefontsize,vp_basefontfamily,vp_headingfontfamily,vp_posttextalignment,vp_layoutwidth,vp_maxwidth,vp_minwidth,vp_sidebarposition,vp_sidebartextalignment,vp_avatarsize" />
		</p>
	</form>
	<h3 id="reset"><?php _e('Reset Options', 'fcstandard2014'); ?></h3>
	<p><?php _e('Resetting deletes all stored fcstandard2014 options from your database. After resetting, default options are loaded but are not stored until you click <i>Save Options</i>. A reset does not affect the actual theme files in any way. If you are uninstalling fcstandard2014, please reset before removing the theme files to clear your databse.', 'fcstandard2014'); ?></p>
	<form action="<?php echo wp_specialchars( $_SERVER['REQUEST_URI'] ) ?>" method="post">
		<?php wp_nonce_field('fcstandard2014_reset_options'); echo "\n"; ?>
		<p class="submit">
			<input name="reset" type="submit" value="<?php _e('Reset Options', 'fcstandard2014'); ?>" onclick="return confirm('<?php _e('Click OK to reset. Any changes to these theme options will be lost!', 'fcstandard2014'); ?>');" tabindex="27" accesskey="R" />
			<input name="action" type="hidden" value="reset" />
			<input name="page_options" type="hidden" value="vp_basefontsize,vp_basefontfamily,vp_headingfontfamily,vp_posttextalignment,vp_layoutwidth,vp_maxwidth,vp_minwidth,vp_sidebarposition,vp_sidebartextalignment,vp_avatarsize" />
		</p>
	</form>
</div>
<?php
}


// sub menu options

class bootstrap_submenu extends Walker_Nav_Menu {

   function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu\">\n";
   }

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       $item_html = '';
       parent::start_el($item_html, $item, $depth, $args);

       if ( $item->is_dropdown && $depth === 0 ) {
           $item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
           $item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
       }

       $output .= $item_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if ( $element->current )
        $element->classes[] = 'active';

        $element->is_dropdown = !empty( $children_elements[$element->ID] );

        if ( $element->is_dropdown ) {
            if ( $depth === 0 ) {
                $element->classes[] = 'dropdown';
            } elseif ( $depth === 1 ) {
                // Extra level of dropdown menu, 
                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
                $element->classes[] = 'dropdown-submenu';
            }
        }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
?>