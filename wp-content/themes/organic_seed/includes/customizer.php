<?php
/**
* Theme customizer with real-time update
*
* Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
*
* @package Seed
* @since Seed 2.0
*/
function seed_theme_customizer( $wp_customize ) {

	// Category Dropdown Control
	class Seed_Category_Dropdown_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public function render_content() {
		$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;', 'organicthemes' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}
	
	// Numerical Control
	class Seed_Customizer_Number_Control extends WP_Customize_Control {
	
		public $type = 'number';
		
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}
	
	}
	
	function seed_sanitize_categories( $input ) {
		$categories = get_all_category_ids();
	 
	    if ( in_array( $input, $categories ) ) {
	        return $input;
	    } else {
	    	return '';
	    }
	}
	
	function seed_sanitize_pages( $input ) {
		$pages = get_all_page_ids();
	 
	    if ( in_array( $input, $pages ) ) {
	        return $input;
	    } else {
	    	return '';
	    }
	}
	
	function seed_sanitize_transition_interval( $input ) {
	    $valid = array(
	        '2000' 		=> __( '2 Seconds', 'organicthemes' ),
	        '4000' 		=> __( '4 Seconds', 'organicthemes' ),
	        '6000' 		=> __( '6 Seconds', 'organicthemes' ),
	        '8000' 		=> __( '8 Seconds', 'organicthemes' ),
	        '10000' 	=> __( '10 Seconds', 'organicthemes' ),
	        '12000' 	=> __( '12 Seconds', 'organicthemes' ),
	        '20000' 	=> __( '20 Seconds', 'organicthemes' ),
	        '30000' 	=> __( '30 Seconds', 'organicthemes' ),
	        '60000' 	=> __( '1 Minute', 'organicthemes' ),
	        '999999999'	=> __( 'Hold Frame', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function seed_sanitize_transition_style( $input ) {
	    $valid = array(
	        'fade' 		=> __( 'Fade', 'organicthemes' ),
	        'slide' 	=> __( 'Slide', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function seed_sanitize_columns( $input ) {
	    $valid = array(
	        'one' 		=> __( 'One Column', 'organicthemes' ),
	        'two' 		=> __( 'Two Columns', 'organicthemes' ),
	        'three' 	=> __( 'Three Columns', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function seed_sanitize_align( $input ) {
	    $valid = array(
	        'left' 		=> __( 'Left Align', 'organicthemes' ),
	        'center' 		=> __( 'Center Align', 'organicthemes' ),
	        'right' 	=> __( 'Right Align', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function seed_sanitize_title_color( $input ) {
	    $valid = array(
	        'black' 	=> __( 'Black', 'organicthemes' ),
	        'white' 	=> __( 'White', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function seed_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	
	function seed_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}

	// Set site name and description text to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';

	// Set site title color to be previewed in real-time
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	//-------------------------------------------------------------------------------------------------------------------//
	// Logo Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_logo_section' , array(
		'title' 	=> __( 'Logo', 'organicthemes' ),
		'description' => __( 'Logo images have a max-height of 140px.', 'organicthemes' ),
		'priority' 	=> 10,
	) );

		// Logo uploader
		$wp_customize->add_setting( 'seed_logo', array(
			'default' 	=> get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seed_logo', array(
			'label' 	=> __( 'Logo', 'organicthemes' ),
			'section' 	=> 'seed_logo_section',
			'settings'	=> 'seed_logo',
			'priority'	=> 20,
		) ) );
		
		// Logo Align
		$wp_customize->add_setting( 'logo_align', array(
		    'default' => 'left',
		    'sanitize_callback' => 'seed_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_align', array(
		    'type' => 'radio',
		    'label' => __( 'Logo Alignment', 'organicthemes' ),
		    'section' => 'seed_logo_section',
		    'choices' => array(
		        'left' 		=> __( 'Left Align', 'organicthemes' ),
		        'center' 	=> __( 'Center Align', 'organicthemes' ),
		        'right' 	=> __( 'Right Align', 'organicthemes' ),
		    ),
		    'priority' => 40,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Site Title Section
	//-------------------------------------------------------------------------------------------------------------------//
		
		// Site Title Align
		$wp_customize->add_setting( 'title_align', array(
		    'default' => 'left',
		    'sanitize_callback' => 'seed_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_align', array(
		    'type' => 'radio',
		    'label' => __( 'Site Title & Tagline Alignment', 'organicthemes' ),
		    'section' => 'title_tagline',
		    'choices' => array(
		        'left' 		=> __( 'Left Align', 'organicthemes' ),
		        'center' 	=> __( 'Center Align', 'organicthemes' ),
		        'right' 	=> __( 'Right Align', 'organicthemes' ),
		    ),
		    'priority' => 40,
		) ) );
		
		// Site Title Color
		$wp_customize->add_setting( 'title_color', array(
		    'default' => 'black',
		    'sanitize_callback' => 'seed_sanitize_title_color',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_color', array(
		    'type' => 'radio',
		    'label' => __( 'Site Title & Tagline Color', 'organicthemes' ),
		    'section' => 'title_tagline',
		    'choices' => array(
		        'black' 	=> __( 'Black', 'organicthemes' ),
		        'white' 	=> __( 'White', 'organicthemes' ),
		    ),
		    'priority' => 60,
		) ) );
	
	//-------------------------------------------------------------------------------------------------------------------//
	// Colors Section
	//-------------------------------------------------------------------------------------------------------------------//
		
		// Menu Background Color
		$wp_customize->add_setting( 'nav_color', array(
		    'default' => '#242424',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_color', array(
		    'label' => 'Menu Background Color',
		    'section' => 'colors',
		    'settings' => 'nav_color',
		    'priority'    => 40,
		) ) );
		
		// Link Color
		$wp_customize->add_setting( 'link_color', array(
	        'default' => '#99cc33',
	        'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
	        'label' => 'Link Color',
	        'section' => 'colors',
	        'settings' => 'link_color',
	        'priority'    => 50,
	    ) ) );
	    
	    // Link Hover Color
	    $wp_customize->add_setting( 'link_hover_color', array(
	        'default' => '#99cc33',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
	        'label' => 'Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'link_hover_color',
	        'priority'    => 60,
	    ) ) );
	    
	    // Heading Link Color
	    $wp_customize->add_setting( 'heading_link_color', array(
	        'default' => '#333333',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_color', array(
	        'label' => 'Heading Link Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_color',
	        'priority'    => 70,
	    ) ) );
	    
	    // Heading Link Hover Color
	    $wp_customize->add_setting( 'heading_link_hover_color', array(
	        'default' => '#99cc33',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_hover_color', array(
	        'label' => 'Heading Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_hover_color',
	        'priority'    => 80,
	    ) ) );
	    
	    // Highlight Color
	    $wp_customize->add_setting( 'highlight_color', array(
	        'default' => '#99cc33',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
	        'label' => 'Highlight & Button Color',
	        'section' => 'colors',
	        'settings' => 'highlight_color',
	        'priority'    => 90,
	    ) ) );
	    
	//-------------------------------------------------------------------------------------------------------------------//
	// Featured Slideshow Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_slider_section' , array(
		'title'       => __( 'Featured Slideshow', 'organicthemes' ),
		'priority'    => 101,
	) );
		
		// Slider Transition Interval
		$wp_customize->add_setting( 'transition_interval', array(
	        'default' => '8000',
	        'sanitize_callback' => 'seed_sanitize_transition_interval',
	    ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_interval', array(
	        'type' => 'select',
	        'label' => __( 'Transition Interval', 'organicthemes' ),
	        'section' => 'seed_slider_section',
	        'choices' => array(
	            '2000' 		=> __( '2 Seconds', 'organicthemes' ),
	            '4000' 		=> __( '4 Seconds', 'organicthemes' ),
	            '6000' 		=> __( '6 Seconds', 'organicthemes' ),
	            '8000' 		=> __( '8 Seconds', 'organicthemes' ),
	            '10000' 	=> __( '10 Seconds', 'organicthemes' ),
	            '12000' 	=> __( '12 Seconds', 'organicthemes' ),
	            '20000' 	=> __( '20 Seconds', 'organicthemes' ),
	            '30000' 	=> __( '30 Seconds', 'organicthemes' ),
	            '60000' 	=> __( '1 Minute', 'organicthemes' ),
	            '999999999'	=> __( 'Hold Frame', 'organicthemes' ),
	        ),
	        'priority' => 10,
		) ) );
		
		// Slider Transition Style
		$wp_customize->add_setting( 'transition_style', array(
	        'default' => 'fade',
	        'sanitize_callback' => 'seed_sanitize_transition_style',
	    ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_style', array(
	        'type' => 'select',
	        'label' => __( 'Transition Style', 'organicthemes' ),
	        'section' => 'seed_slider_section',
	        'choices' => array(
	            'fade' 		=> __( 'Fade', 'organicthemes' ),
	            'slide' 	=> __( 'Slide', 'organicthemes' ),
		    ),
		    'priority' => 20,
		) ) );
		
		// Featured Slideshow Category
		$wp_customize->add_setting( 'category_slideshow_home' , array(
			'sanitize_callback' => 'seed_sanitize_categories',
		) );
		$wp_customize->add_control( new Seed_Category_Dropdown_Control( $wp_customize, 'category_slideshow_home', array(
			'label'		=> __( 'Featured Slideshow Category', 'organicthemes' ),
			'section'	=> 'seed_slider_section',
			'settings'	=> 'category_slideshow_home',
			'type'		=> 'dropdown-categories',
			'priority' => 30,
		) ) );
		
		// Featured Slideshow Posts Displayed
		$wp_customize->add_setting( 'postnumber_slideshow_home', array(
			'default' => '10',
			'sanitize_callback' => 'seed_sanitize_text',
		) );
		$wp_customize->add_control( new Seed_Customizer_Number_Control( $wp_customize, 'postnumber_slideshow_home', array(
			'label'		=> __( 'Featured Slideshow Posts Displayed', 'organicthemes' ),
			'section'	=> 'seed_slider_section',
			'settings'	=> 'postnumber_slideshow_home',
			'type'		=> 'number',
			'priority' => 40,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Home Page Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_home_section' , array(
		'title'       => __( 'Home Page', 'organicthemes' ),
		'priority'    => 102,
	) );
	
		// Featured Page Left
		$wp_customize->add_setting( 'page_left', array(
			'default' => '2',
			'sanitize_callback' => 'seed_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_left', array(
			'label'		=> __( 'Featured Page Left', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'page_left',
			'type'		=> 'dropdown-pages',
			'priority' => 40,
		) ) );
		
		// Featured Page Middle
		$wp_customize->add_setting( 'page_mid', array(
			'default' => '2',
			'sanitize_callback' => 'seed_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_mid', array(
			'label'		=> __( 'Featured Page Middle', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'page_mid',
			'type'		=> 'dropdown-pages',
			'priority' => 60,
		) ) );
		
		// Featured Page Right
		$wp_customize->add_setting( 'page_right', array(
			'default' => '2',
			'sanitize_callback' => 'seed_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_right', array(
			'label'		=> __( 'Featured Page Right', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'page_right',
			'type'		=> 'dropdown-pages',
			'priority' => 80,
		) ) );
	
		// Featured News Category
		$wp_customize->add_setting( 'category_news', array(
			'default' => '1',
			'sanitize_callback' => 'seed_sanitize_categories',
		) );
		$wp_customize->add_control( new Seed_Category_Dropdown_Control( $wp_customize, 'category_news', array(
			'label'		=> __( 'Featured News Category', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'category_news',
			'type'		=> 'dropdown-categories',
			'priority' => 100,
		) ) );
		
		// Featured News Posts Displayed
		$wp_customize->add_setting( 'postnumber_news', array(
			'default' => '3',
			'sanitize_callback' => 'seed_sanitize_text',
		) );
		$wp_customize->add_control( new Seed_Customizer_Number_Control( $wp_customize, 'postnumber_news', array(
			'label'		=> __( 'Featured News Posts Displayed', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'postnumber_news',
			'type'		=> 'number',
			'priority' => 120,
		) ) );
		
		// Featured Tabs Category
		$wp_customize->add_setting( 'category_tabs' , array(
			'default' => '1',
			'sanitize_callback' => 'seed_sanitize_categories',
		) );
		$wp_customize->add_control( new Seed_Category_Dropdown_Control( $wp_customize, 'category_tabs', array(
			'label'		=> __( 'Featured Tabs Category', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'category_tabs',
			'type'		=> 'dropdown-categories',
			'priority' => 140,
		) ) );
		
		// Featured Tabs Displayed
		$wp_customize->add_setting( 'postnumber_tabs', array(
			'default' => '3',
			'sanitize_callback' => 'seed_sanitize_text',
		) );
		$wp_customize->add_control( new Seed_Customizer_Number_Control( $wp_customize, 'postnumber_tabs', array(
			'label'		=> __( 'Featured Tabs Displayed', 'organicthemes' ),
			'section'	=> 'seed_home_section',
			'settings'	=> 'postnumber_tabs',
			'type'		=> 'number',
			'priority' => 180,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Page Templates
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_templates_section' , array(
		'title'       => __( 'Page Templates', 'organicthemes' ),
		'priority'    => 103,
	) );
		
		// Blog Template Category
		$wp_customize->add_setting( 'category_blog' , array(
			'default' => '1',
			'sanitize_callback' => 'seed_sanitize_categories',
		) );
		$wp_customize->add_control( new Seed_Category_Dropdown_Control( $wp_customize, 'category_blog', array(
			'label'		=> __( 'Blog Template Category', 'organicthemes' ),
			'section'	=> 'seed_templates_section',
			'settings'	=> 'category_blog',
			'type'		=> 'dropdown-categories',
			'priority' => 40,
		) ) );
		
		// Featured News Posts Displayed
		$wp_customize->add_setting( 'postnumber_blog', array(
			'default' => '10',
			'sanitize_callback' => 'seed_sanitize_text',
		) );
		$wp_customize->add_control( new Seed_Customizer_Number_Control( $wp_customize, 'postnumber_blog', array(
			'label'		=> __( 'Blog Posts Displayed', 'organicthemes' ),
			'section'	=> 'seed_templates_section',
			'settings'	=> 'postnumber_blog',
			'type'		=> 'number',
			'priority' => 60,
		) ) );
		
		// Portfolio Column Layout
		$wp_customize->add_setting( 'portfolio_columns', array(
		    'default' => 'three',
		    'sanitize_callback' => 'seed_sanitize_columns',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'portfolio_columns', array(
		    'type' => 'radio',
		    'label' => __( 'Portfolio Column Layout', 'organicthemes' ),
		    'section' => 'seed_templates_section',
		    'choices' => array(
		        'one' 		=> __( 'One Column', 'organicthemes' ),
		        'two' 		=> __( 'Two Columns', 'organicthemes' ),
		        'three' 	=> __( 'Three Columns', 'organicthemes' ),
		    ),
		    'priority' => 80,
		) ) );
		
		// Portfolio Template Category
		$wp_customize->add_setting( 'category_portfolio' , array(
			'default' => '1',
			'sanitize_callback' => 'seed_sanitize_categories',
		) );
		$wp_customize->add_control( new Seed_Category_Dropdown_Control( $wp_customize, 'category_portfolio', array(
			'label'		=> __( 'Portfolio Template Category', 'organicthemes' ),
			'section'	=> 'seed_templates_section',
			'settings'	=> 'category_portfolio',
			'type'		=> 'dropdown-categories',
			'priority' => 100,
		) ) );
		
		// Display Portfolio Info
		$wp_customize->add_setting( 'display_portfolio_info', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_portfolio_info', array(
			'label'		=> __( 'Show Portfolio Title & Excerpt?', 'organicthemes' ),
			'section'	=> 'seed_templates_section',
			'settings'	=> 'display_portfolio_info',
			'type'		=> 'checkbox',
			'priority' => 120,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Layout
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_layout_section' , array(
		'title'       => __( 'Layout', 'organicthemes' ),
		'priority'    => 104,
	) );
	
		// Enable Responsive Grid
		$wp_customize->add_setting( 'enable_responsive', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_responsive', array(
			'label'		=> __( 'Enable Responsive Grid?', 'organicthemes' ),
			'section'	=> 'seed_layout_section',
			'settings'	=> 'enable_responsive',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );
		
		// Display Post Author
		$wp_customize->add_setting( 'display_author_post', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_author_post', array(
			'label'		=> __( 'Show Post Author & Comment Link?', 'organicthemes' ),
			'section'	=> 'seed_layout_section',
			'settings'	=> 'display_author_post',
			'type'		=> 'checkbox',
			'priority' => 40,
		) ) );
		
		// Display Blog Author
		$wp_customize->add_setting( 'display_author_blog', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_author_blog', array(
			'label'		=> __( 'Show Blog Author & Comment Link?', 'organicthemes' ),
			'section'	=> 'seed_layout_section',
			'settings'	=> 'display_author_blog',
			'type'		=> 'checkbox',
			'priority' => 60,
		) ) );
		
		// Display Post Featured Image or Video
		$wp_customize->add_setting( 'display_feature_post', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_post', array(
			'label'		=> __( 'Show Post Featured Images?', 'organicthemes' ),
			'section'	=> 'seed_layout_section',
			'settings'	=> 'display_feature_post',
			'type'		=> 'checkbox',
			'priority' => 80,
		) ) );
		
		// Enable CSS3 Full Width Background
		$wp_customize->add_setting( 'background_stretch', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'background_stretch', array(
			'label'		=> __( 'Enable Full Width Background Image?', 'organicthemes' ),
			'section'	=> 'seed_layout_section',
			'settings'	=> 'background_stretch',
			'type'		=> 'checkbox',
			'priority' => 120,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Social Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'seed_social_section' , array(
		'title'       => __( 'Social Links', 'organicthemes' ),
		'priority'    => 105,
	) );
		
		// Display Social Share Buttons on Single Posts
		$wp_customize->add_setting( 'display_social_post', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_social_post', array(
			'label'		=> __( 'Show Share Buttons on Single Posts?', 'organicthemes' ),
			'section'	=> 'seed_social_section',
			'settings'	=> 'display_social_post',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );
		
		// Display Social Share Buttons on Blog Template
		$wp_customize->add_setting( 'display_social_blog', array(
			'default'	=> true,
			'sanitize_callback' => 'seed_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_social_blog', array(
			'label'		=> __( 'Show Share Buttons on Blog Template?', 'organicthemes' ),
			'section'	=> 'seed_social_section',
			'settings'	=> 'display_social_blog',
			'type'		=> 'checkbox',
			'priority' => 40,
		) ) );
		
		// Twitter User
		$wp_customize->add_setting( 'seed_user_twitter', array(
			 'default'	=> 'OrganicThemes', 
			 'sanitize_callback' => 'seed_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seed_user_twitter', array(
			'label'		=> __( 'Twitter User', 'organicthemes' ),
			'section'	=> 'seed_social_section',
			'settings'	=> 'seed_user_twitter',
			'type'		=> 'text',
			'priority' => 100,
		) ) );
	
}
add_action('customize_register', 'seed_theme_customizer');

/**
* Binds JavaScript handlers to make Customizer preview reload changes
* asynchronously.
*/
function seed_customize_preview_js() {
	wp_enqueue_script( 'seed-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ) );

	// CSS to style tabs (jQuery UI Tabs is disabled in the Customizer)
	wp_enqueue_style( 'seed-customizer-tabs', get_template_directory_uri() . '/css/customizer.css' );
}
add_action( 'customize_preview_init', 'seed_customize_preview_js' );