<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme License and Updater
/*-----------------------------------------------------------------------------------------------------*/

define( 'OT_SL_STORE_URL', 'http://organicthemes.com' );
define( 'OT_SL_SEED_THEME', 'Seed Theme' );

if( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
	// Load theme updater
	include( dirname( __FILE__ ) . '/includes/EDD_SL_Theme_Updater.php' );
}

function seed_theme_sl_updater() {

	// Retrieve our license key from the DB
	$license = trim( get_option( 'seed_license_key' ) );

	// Setup the updater
	$edd_updater = new EDD_SL_Theme_Updater( array( 
			'remote_api_url'=> OT_SL_STORE_URL, 	// our store URL that is running EDD
			'version' 		=> '2.2.2', 	        // the current theme version we are running
			'license' 		=> $license,			// the license key (used get_option above to retrieve from DB)
			'item_name' 	=> OT_SL_SEED_THEME,	// the name of this theme
			'author'		=> 'Organic Themes'		// the author's name
		)
	);
}
add_action( 'admin_init', 'seed_theme_sl_updater' );

function seed_theme_license_menu() {
	add_theme_page( 'Theme License', 'Theme License', 'manage_options', 'seed-license', 'seed_theme_license_page' );
}
add_action('admin_menu', 'seed_theme_license_menu');

function seed_theme_license_page() {
	$license 	= get_option( 'seed_license_key' );
	$status 	= get_option( 'seed_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Theme License Options', 'organicthemes'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('seed_theme_license'); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('License Key', 'organicthemes'); ?>
						</th>
						<td>
							<input id="seed_license_key" name="seed_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="seed_license_key"><?php _e('Enter your license key', 'organicthemes'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e('Activate License', 'organicthemes'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green; line-height:2;margin-right:12px;"><?php _e('Active', 'organicthemes'); ?></span>
									<?php wp_nonce_field( 'organic_nonce', 'organic_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_deactivate" value="<?php _e('Deactivate License', 'organicthemes'); ?>"/>
								<?php } else {
									wp_nonce_field( 'organic_nonce', 'organic_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_activate" value="<?php _e('Activate License', 'organicthemes'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}

function seed_theme_register_option() {
	// creates our settings in the options table
	register_setting('seed_theme_license', 'seed_license_key', 'seed_theme_sanitize_license' );
}
add_action('admin_init', 'seed_theme_register_option');

function seed_theme_sanitize_license( $new ) {
	$old = get_option( 'seed_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'seed_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function seed_theme_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_activate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'organic_nonce', 'organic_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'seed_license_key' ) );	

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'activate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( OT_SL_SEED_THEME )
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'seed_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'seed_theme_activate_license');

function seed_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'organic_nonce', 'organic_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'seed_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( OT_SL_SEED_THEME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'seed_license_key_status' );

	}
}
add_action('admin_init', 'seed_theme_deactivate_license');

function seed_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( 'seed_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( OT_SL_SEED_THEME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}

/*-----------------------------------------------------------------------------------------------------//
/*	Theme Setup
/*-----------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'seed_setup' ) ) :

function seed_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'organicthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'seed-featured-large', 1600, 1200, true ); // Large Featured Image
	add_image_size( 'seed-featured-medium', 1000, 1000, true ); // Medium Featured Image
	add_image_size( 'seed-featured-small', 640, 640, true ); // Small Featured Image
	
	// Post Formats
	add_theme_support( 'post-formats', array( 
		'gallery',
		'link',
		'image',
		'audio',
		'status',
		'quote',
		'video'	
		) 
	);

	// Create Menus
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organicthemes' ),
		'social-menu' => __( 'Social Menu', 'organicthemes' ),
	));
	
	// Custom Header
	$defaults = array(
		'width'                 => 980,
		'height'                => 280,
		'flex-height'           => true,
		'flex-width'            => true,
		'default-text-color'    => '333333',
		'header-text'           => false,
		'uploads'               => true,
	);
	add_theme_support( 'custom-header', $defaults );
	
	// Custom Background
	$defaults = array(
		'default-color'          => 'EEEEEE',
	);
	add_theme_support( 'custom-background', $defaults );
}
endif; // seed_setup
add_action( 'after_setup_theme', 'seed_setup' );

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function seed_cat_id_to_name( $id ) {
	$cat = get_category( $id );
	if ( is_wp_error( $cat ) )
		return false;
	return $cat->cat_name;
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('seed_enqueue_scripts') ) {
	function seed_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'seed-style', get_stylesheet_uri() );
		wp_enqueue_style( 'seed-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'seed-style' ), '1.0' );
		wp_enqueue_style( 'seed-style-ie8', get_template_directory_uri() . '/css/style-ie8.css', array( 'seed-style' ), '1.0' );
		
		// IE Conditional Styles
		global $wp_styles;
		$wp_styles->add_data('seed-style-ie8', 'conditional', 'lt IE 9');
		
		// Resgister Scripts
		wp_register_script( 'seed-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'seed-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'seed-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'seed-hover' ), '20130729' );
		wp_register_script( 'seed-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'seed-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'seed-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'seed-superfish', 'seed-fitvids', 'seed-isotope', 'jquery-masonry' ), '20130729', true );
		wp_enqueue_script( 'seed-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );
		
		// IE Conditional Scripts
		global $wp_scripts;
		$wp_scripts->add_data( 'seed-html5shiv', 'conditional', 'lt IE 9' );
		
		// Load Flexslider on front page and slideshow page template
		if ( is_home() || is_front_page() || is_single() || is_page_template('template-slideshow.php') || is_page_template('template-blog.php') ) {
			wp_enqueue_script( 'seed-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}
	
		// Load single scripts only on single pages
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	    	wp_enqueue_script( 'comment-reply' );
	    }
	}
}
add_action('wp_enqueue_scripts', 'seed_enqueue_scripts');

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration			       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div class="row">
		<div class="eleven columns">
			<div class="postarea">
    <?php
}
function mytheme_close_woocommerce_content_wrappers() {
	?>
    		</div>
    	</div>
 
        <div class="five columns">
        	<?php get_sidebar( 'post' ); ?>
        </div>
        
 	</div>
    <?php
}
add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce default product columns
function loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_widgets_init() {
	register_sidebar(array(
		'name'=> __( "Page Sidebar", 'organicthemes' ),
		'id' => 'page-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Blog Sidebar", 'organicthemes' ),
		'id' => 'blog-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Post Sidebar", 'organicthemes' ),
		'id' => 'post-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Left Sidebar", 'organicthemes' ),
		'id' => 'left-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Widgets", 'organicthemes' ),
		'id' => 'footer',
		'before_widget'=>'<div id="%1$s" class="widget %2$s"><div class="footer-widget">',
		'after_widget'=>'</div></div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
}
add_action( 'widgets_init', 'organic_widgets_init' );

/*-----------------------------------------------------------------------------------------------------//
	Add Stylesheet To Visual Editor
-------------------------------------------------------------------------------------------------------*/
	
add_action( 'init', 'seed_add_editor_styles' );
/**
* Apply theme's stylesheet to the visual editor.
*
* @uses add_editor_style() Links a stylesheet to visual editor
* @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
function seed_add_editor_styles() {
	add_editor_style( 'css/style-editor.css' );
}
	
/*-----------------------------------------------------------------------------------------------------//	
	Post Format Meta Boxes       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "create_metaboxes");
add_action('save_post', 'save_metaboxes');

$metaboxes = array(
    'link_url' => array(
        'title' => __('Link Information', 'organicthemes'),
        'applicableto' => 'post',
        'location' => 'side',
        'display_condition' => 'post-format-link',
        'priority' => 'default',
        'fields' => array(
            'l_url' => array(
                'title' => __('Link URL: ', 'organicthemes'),
                'type' => 'text',
                'description' => '',
                'size' => 20
            )
        )
    ),
    'quote_author' => array(
        'title' => __('Quote Author', 'organicthemes'),
        'applicableto' => 'post',
        'location' => 'side',
        'display_condition' => 'post-format-quote',
        'priority' => 'default',
        'fields' => array(
            'q_author' => array(
                'title' => __('Author: ', 'organicthemes'),
                'type' => 'text',
                'description' => '',
                'size' => 20
            )
        )
    )
);

function create_metaboxes() {
	global $metaboxes;
	 
    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

function show_metaboxes( $post, $args ) {
    global $metaboxes;
 	
    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $metaboxes[$args['id']]['fields'];
 
    /** Nonce **/
    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
    
    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            switch ( $field['type'] ) {
                default:
                case "text":
                
                if ( isset($custom[$id]) ) {
                
                    $output .= '<label for="' . esc_attr( $id ) . '">' . $field['title']  . '</label><input id="' . esc_attr( $id ) . '" type="text" name="' . esc_attr( $id ) . '" value="' . $custom[$id][0] . '" size="' . $field['size'] . '" />';
                    
                } else {
                	
                	$output .= '<label for="' . esc_attr( $id ) . '">' . $field['title']  . '</label><input id="' . esc_attr( $id ) . '" type="text" name="' . esc_attr( $id ) . '" value="" size="' . $field['size'] . '" />';
                	
                }
 
                break;
            }
        }
    }
 
    echo $output;
}

function save_metaboxes( $post_id ) {
    global $metaboxes;
 
    // verify nonce
    if ( isset($_POST['post_format_meta_box_nonce']) && ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;
 
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
 
    // check permissions
    if ( 'page' == isset($_POST['post_type']) ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
 
    $post_type = get_post_type();
 
    // loop through fields and save the data
    foreach ( $metaboxes as $id => $metabox ) {
        // check if metabox is applicable for current post type
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $metaboxes[$id]['fields'];
 
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];
 
                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}

	
add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );

function display_metaboxes() {
    global $metaboxes;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
 
            <?php
            $formats = $ids = array();
            foreach ( $metaboxes as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
 
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
            
            function displayMetaboxes() {
                // Hide all post format metaboxes
                $(ids).hide();
                // Get current post format
                var selectedElt = $("input[name='post_format']:checked").attr("id");
 
                // If exists, fade in current post format metabox
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }
 
            $(function() {
                // Show/hide metaboxes on page load
                displayMetaboxes();
 
                // Show/hide metaboxes on change event
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });
 
        // ]]></script>
        <?php
    endif;
}
	
/*----------------------------------------------------------------------------------------------------//
/*	Content Width
/*----------------------------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Adjust content_width value based on the presence of widgets
 */
function seed_content_width() {
	if ( ! is_active_sidebar( 'post-sidebar' ) || is_active_sidebar( 'page-sidebar' ) || is_active_sidebar( 'blog-sidebar' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'seed_content_width' );
	
/*-----------------------------------------------------------------------------------------------------//	
	Comments Function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'seed_comment' ) ) :
function seed_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
	?>
	<li <?php comment_class(); ?> id="<?php echo esc_attr( 'li-comment-' . get_comment_ID() ); ?>">
	
		<article id="<?php echo esc_attr( 'comment-' . get_comment_ID() ); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organicthemes' ),
							sprintf( '<span class="fn">%s</span>', wp_kses_post( get_comment_author_link() ) ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for seed_comment()

/*-----------------------------------------------------------------------------------------------------//	
	Comments Disabled On Pages By Default		       	     	 
-------------------------------------------------------------------------------------------------------*/

function seed_default_comments_off( $data ) {
    if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
    } 

    return $data;
}
add_filter( 'wp_insert_post_data', 'seed_default_comments_off' );

/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function seed_excerpt_length( $length ) {
	return 38;
}
add_filter( 'excerpt_length', 'seed_excerpt_length', 999 );

function seed_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __('Read More', 'organicthemes') .'</a>';
}
add_filter('excerpt_more', 'seed_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	Add Excerpt To Pages		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action( 'init', 'seed_add_excerpts_to_pages' );
function seed_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*-----------------------------------------------------------------------------------------------------//
/*	Pagination Function
/*-----------------------------------------------------------------------------------------------------*/

function seed_get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => __('&laquo;', 'organicthemes'),
		'next_text' => __('&raquo;', 'organicthemes'),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------------------------//
/*	Custom Page Links
/*-----------------------------------------------------------------------------------------------------*/

function seed_wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'seed_wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init_featurevid");
add_action('save_post', 'save_featurevid');

function admin_init_featurevid(){
	add_meta_box("featurevid-meta", __("Featured Video Embed Code", 'organicthemes'), "meta_options_featurevid", "post", "normal", "high");
}

function meta_options_featurevid(){
	global $post;
	$custom = get_post_custom($post->ID);
	$featurevid = isset( $custom["featurevid"] ) ? esc_attr( $custom["featurevid"][0] ) : '';

	echo '<textarea name="featurevid" cols="60" rows="4" style="width:97.6%" />'.$featurevid.'</textarea>';
}

function save_featurevid($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if ( isset($_POST["featurevid"]) ) { 
		update_post_meta($post->ID, "featurevid", $_POST["featurevid"]); 
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Add Home Link To Custom Menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Strip inline width and height attributes from WP generated images		       	     	 
-------------------------------------------------------------------------------------------------------*/
 
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
	return $html; 
	}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*-----------------------------------------------------------------------------------------------------//
	Body Class
-------------------------------------------------------------------------------------------------------*/

function seed_body_class( $classes ) {
	if ( is_singular() )
		$classes[] = 'seed-singular';

	if ( is_active_sidebar( 'right-sidebar' ) )
		$classes[] = 'seed-right-sidebar';

	if ( '' != get_theme_mod( 'background_image' ) ) {
		// This class will render when a background image is set
		// regardless of whether the user has set a color as well.
		$classes[] = 'seed-background-image';
	} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ) ) ) {
		// This class will render when a background color is set
		// but no image is set. In the case the content text will
		// Adjust relative to the background color.
		$classes[] = 'seed-relative-text';
	}

	return $classes;
}
add_action( 'body_class', 'seed_body_class' );

/*---------------------------------------------------------------------------------------------//
	Retrieve email value from Customizer and add mailto protocol
/*---------------------------------------------------------------------------------------------*/

function seed_get_email_link() {
	$email = get_theme_mod( 'seed_link_email' );

	if ( ! $email )
		return false;

	return 'mailto:' . sanitize_email( $email );
}

/*-----------------------------------------------------------------------------------------------------//
	Filters wp_title to print a neat <title> tag based on what is being viewed.
-------------------------------------------------------------------------------------------------------*/

function seed_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'organicthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'seed_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/includes/customizer.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
include_once( get_template_directory() . '/organic-shortcodes/organic-shortcodes.php' );