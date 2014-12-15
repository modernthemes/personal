<?php
/**
 * Personal Theme Customizer
 *
 * @package personal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function personal_theme_customizer( $wp_customize ) {
	
	//allows donations
    class personal_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() { 
        ?>

        <?php
        }
    }	
	
	// Donations
    $wp_customize->add_section(
        'personal_theme_info',
        array(
            'title' => __('Like Personal? Help Us Out.', 'personal'),
            'priority' => 5,
            'description' => __('We do all we can do to make all our themes free for you. While we enjoy it, and it makes us happy to help out, a little appreciation can help us to keep theming.</strong><br/><br/> Please help support our mission and continued development with a donation of $5, $10, $20, or if you are feeling really kind $100..<br/><br/> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7LMGYAZW9C5GE" target="_blank" rel="nofollow"><img class="" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="Make a donation to ModernThemes" /></a>'), 
        )
    );   
	 
    //Donations section
    $wp_customize->add_setting('personal_help', array(   
			'sanitize_callback' => 'personal_no_sanitize', 
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new personal_Info( $wp_customize, 'personal_help', array(
        'section' => 'personal_theme_info', 
        'settings' => 'personal_help',  
        'priority' => 10
        ) )
    ); 
	
	// Fonts  
    $wp_customize->add_section(
        'personal_typography',
        array(
            'title' => __('Google Fonts', 'personal' ),  
            'priority' => 39,
        )
    ); 
	
    $font_choices = 
        array(
			'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans', 
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Oswald:400,700' => 'Oswald',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato', 
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'personal_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'description' => __('Select your desired font for the headings. Raleway is the default Heading font.', 'personal'),
            'section' => 'personal_typography',
            'choices' => $font_choices
        )
    );
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'personal_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'description' => __( 'Select your desired font for the body. Open Sans is the default Body font.', 'personal' ), 
            'section' => 'personal_typography',  
            'choices' => $font_choices 
        ) 
    );
	
	// Logo upload
    $wp_customize->add_section( 'personal_logo_section' , array(  
	    'title'       => __( 'Icons', 'personal' ),
	    'priority'    => 20,  
	    'description' => 'Upload your site favicon and Apple Icons.', 
	));
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri() . '/images/favicon.png'),
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'personal' ),
			   'type' 			=> 'image',
               'section'        => 'personal_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
            )
        )
    );
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'personal' ),
               'type'           => 'image',
               'section'        => 'personal_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
            )
        )
    );
	
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'personal' ),
               'type'           => 'image',
               'section'        => 'personal_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
            )
        )
    );
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'personal' ),
               'type'           => 'image',
               'section'        => 'personal_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
            )
        )
    );
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'personal' ),
               'type'           => 'image',
               'section'        => 'personal_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 14,
            )
        )
    );

	// Highlight and link color
    $wp_customize->add_setting( 'personal_link_color', array(
        'default'           => ' ',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'personal_link_color', array(
        'label'	   => 'Link and Highlight Color', 
        'section'  => 'colors',
        'settings' => 'personal_link_color',
    ) ) );
	
	// Front Page Top Background
	$wp_customize->add_section( 'frontpage-background' , array(
    	'title' => __( 'Top Background ', 'personal' ),
    	'priority' => 23, 
    	'description' => __( 'Pick a good picture. Make a good first impression.', 'personal' ) 
	) );
	
	$wp_customize->add_setting('active_top',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);      
	
	$wp_customize->add_control( 
    'active_top', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Top Section',  
        'section' => 'frontpage-background', 
		'priority'   => 1
    ));
	
	// Top page background
	$wp_customize->add_setting( 'background_picture', array(
		'sanitize_callback' => 'esc_url_raw', 
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'background_picture', array(
		'label'    => __( 'Top Background Picture', 'personal' ),
		'section'  => 'frontpage-background', 
		'settings' => 'background_picture', 
		'priority'   => 2
	))); 
	
	// Top greeting
	$wp_customize->add_setting( 'top_greeting' , 
	array( 
		'default' => 'Say Hi',
		'sanitize_callback' => 'personal_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_greeting', array( 
    'label' => __( 'Greeting', 'personal' ), 
    'section' => 'frontpage-background',
    'settings' => 'top_greeting',
	'type' => 'text',    
	'priority'   => 3
	)));
	
	// Top Name
	$wp_customize->add_setting( 'top_name' , 
	array( 
		'default' => 'What is your name?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_name', array(  
    'label' => __( 'Name', 'personal' ), 
    'section' => 'frontpage-background',
    'settings' => 'top_name',
	'type' => 'text',   
	'priority'   => 4
	)));
	
	// Top Name
	$wp_customize->add_setting( 'top_cta' , 
	array( 
		'sanitize_callback' => 'personal_sanitize_text',
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_cta', array(  
    'label' => __( 'Call-to-action', 'personal' ),
    'section' => 'frontpage-background',
    'settings' => 'top_cta',
	'type' => 'text',   
	'priority'   => 5
	) ) );
	
	// Front Page Title Section
	$wp_customize->add_section( 'frontpage-about-me' , array(
    	'title' => __( 'About Me ', 'personal' ),
    	'priority' => 24, 
    	'description' => __( 'Tell the world what you are.', 'personal' ) 
	) );
	
	$wp_customize->add_setting('active_about',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);   
	
	$wp_customize->add_control( 
    'active_about', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide About Me Section',  
        'section' => 'frontpage-about-me', 
		'priority'   => 1
    ));
	
	// About Me Title
	$wp_customize->add_setting( 'about_me_title' , 
	array( 
		'default' => 'About Me',
		'sanitize_callback' => 'personal_sanitize_text',  
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'about_me_title', array(  
    'label' => __( 'About Me Title', 'personal' ),
    'section' => 'frontpage-about-me',
    'settings' => 'about_me_title', 
	'type' => 'text',
	'priority'   => 1
	) ) );
	
	// Front Page Title Caption
	$wp_customize->add_setting( 'title_caption' , 
	array( 
		'default' => 'Tell the world what you are',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_caption', array(
    'label' => __( 'Title Caption', 'personal' ),
    'section' => 'frontpage-about-me', 
    'settings' => 'title_caption',
	'type' => 'text',   
	'priority'   => 2
	) ) );
	
	// Front Page Overview
	$wp_customize->add_section( 'frontpage-overview' , array(
    	'title' => __( 'Overview ', 'personal' ),
    	'priority' => 25, 
    	'description' => __( 'Customize your Overview section down below as a widget.', 'personal' ) 
	) );
	
	$wp_customize->add_setting('active_overview',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);     
	
	$wp_customize->add_control( 
    'active_overview',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Overview Section',  
        'section' => 'frontpage-overview', 
		'priority'   => 1
    ));
	
	// File upload
	$wp_customize->add_setting( 'resume-upload',
	array(
		'sanitize_callback' => 'esc_url_raw', 
		) 
	);
 
	$wp_customize->add_control(
    new WP_Customize_Upload_Control(
        $wp_customize,
        'resume-upload',
        array(
            'label' => 'Resume Upload',
            'section' => 'frontpage-overview',
            'settings' => 'resume-upload'
    )));
	
	// Resume text
	$wp_customize->add_setting( 'resume_text' , 
	array( 
		'default' => 'View Resume',
		'sanitize_callback' => 'personal_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resume_text', array( 
	'default' => 'View Resume',   
    'label' => __( 'Resume Text', 'personal' ), 
    'section' => 'frontpage-overview',
    'settings' => 'resume_text',
	'type' => 'text',   
	'priority'   => 1 
	) ) );
	
	$wp_customize->add_setting(
    'resume_link_color',
    array(
        'default'     => '#24a9e2',
		'sanitize_callback' => 'sanitize_hex_color',
    )); 
	
	$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'resume_link_color',
        array(
            'label'      => __( 'Resume link color', 'personal' ),
            'section'    => 'frontpage-overview', 
            'settings'   => 'resume_link_color' 
    )));
	
	// Front Page Skills
	$wp_customize->add_section( 'frontpage-skills' , array(
    	'title' => __( 'Skills', 'personal' ),
    	'priority' => 26, 
    	'description' => __( 'Pick some skills and put a percentage to them.', 'personal' ) 
	));
	
	$wp_customize->add_setting('active_skills',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);      
	
	$wp_customize->add_control( 
    'active_skills', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Skills Section',  
        'section' => 'frontpage-skills', 
		'priority'   => 1
    ));
	
	// Skills Title
	$wp_customize->add_setting( 'skills_title' , 
	array( 
		'default' => 'Some of my skills',
		'sanitize_callback' => 'personal_sanitize_text', 
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skills_title', array(  
    'label' => __( 'Skills Title', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'skills_title', 
	'type' => 'text',
	'priority'   => 2
	)));
	
	// Front Page Skill 1
	$wp_customize->add_setting( 'personal_skill_1' , 
	array( 
		'default' => 'What is your first skill?',
		'sanitize_callback' => 'personal_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_skill_1', array(
    'label' => __( 'First Skill', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'personal_skill_1',
	'priority'   => 3
	)));
	
	// Skill 1 Percentage
	$wp_customize->add_setting( 'skill_percentage_1' , 
	array( 
		'default' => '81',
		'sanitize_callback' => 'personal_sanitize_text', 
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skill_percentage_1', array(
	'default' => '81',
    'label' => __( 'First Skill Percentage', 'personal' ),
    'section' => 'frontpage-skills', 
    'settings' => 'skill_percentage_1',
	'priority'   => 4  
	) ) );
	
	// Front Page Skill 2
	$wp_customize->add_setting( 'personal_skill_2' , 
	array( 
		'default' => 'Now the second skill',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_skill_2', array(
	'default' => 'Now the second skill', 
    'label' => __( 'Second Skill', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'personal_skill_2',
	'priority'   => 5 
	)));
	
	// Skill 2 Percentage
	$wp_customize->add_setting( 'skill_percentage_2' , 
	array( 
		'default' => '92',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skill_percentage_2', array(
	'default' => '92',
    'label' => __( 'Second Skill Percentage', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'skill_percentage_2',
	'priority'   => 6 
	)));
	
	// Front Page Skill 3
	$wp_customize->add_setting( 'personal_skill_3' , 
	array( 
		'default' => 'and then the third skill',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_skill_3', array(
	'default' => 'and then the third skill',
    'label' => __( 'Third Skill', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'personal_skill_3',
	'priority'   => 7
	)));
	
	// Skill 3 Percentage
	$wp_customize->add_setting( 'skill_percentage_3' , 
	array( 
		'default' => '64',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skill_percentage_3', array(
	'default' => '64',
    'label' => __( 'Third Skill Percentage', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'skill_percentage_3',
	'priority'   => 8  
	)));
	
	// Front Page Skill 4
	$wp_customize->add_setting( 'personal_skill_4' , 
		array( 'default' => 'Finally, the fourth skill',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_skill_4', array(
	'default' => 'Finally, the fourth skill', 
    'label' => __( 'Fourth Skill', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'personal_skill_4',
	'priority'   => 9  
	)));  
	
	// Skill 4 Percentage
	$wp_customize->add_setting( 'skill_percentage_4' , 
	array( 
		'default' => '77',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
		 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skill_percentage_4', array(
	'default' => '77',
    'label' => __( 'Fourth Skill Percentage', 'personal' ),
    'section' => 'frontpage-skills',
    'settings' => 'skill_percentage_4',
	'priority'   => 10
	)));
	
	// Skill bar color
	$wp_customize->add_setting(
    'skill_bar_color',
    array(
        'default'     => '#24a9e2',
		'sanitize_callback' => 'sanitize_hex_color', 
    )); 
	
	$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'skill_bar_color',
        array(
            'label'      => __( 'Skill Bar Color', 'personal' ),
            'section'    => 'frontpage-skills', 
            'settings'   => 'skill_bar_color'  
    )));
	
	// Work Experience Section
	$wp_customize->add_section( 'frontpage-work-experience' , array(
    	'title' => __( 'Work Experience', 'personal' ),
    	'priority' => 27, 
    	'description' => __( 'Your work is your experience.', 'personal' )  
	));
	
	$wp_customize->add_setting('active_work',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);      
	
	$wp_customize->add_control( 
    'active_work', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Work Experience Section',  
        'section' => 'frontpage-work-experience',  
		'priority'   => 1
    ));
	
	// Number of Sections 
	$wp_customize->add_setting( 'personal_work_sections', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'personal_sanitize_work_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_work_sections', array(
		'label'    => __( 'Number of Work Examples', 'personal' ),
		'section'  => 'frontpage-work-experience',
		'settings' => 'personal_work_sections',
		'type'     => 'radio',
		'priority'   => 2,
		'choices'  => array(
			'option1' => 'All', 
			'option2' => '3',
			'option3' => '2',
			'option4' => '1'
			),
	)));
	
	// Work Title
	$wp_customize->add_setting( 'work_title' , 
	array( 
		'default' => 'Work Experience',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_title', array(  
    'label' => __( 'Work Section Title', 'personal' ),  
    'section' => 'frontpage-work-experience',
    'settings' => 'work_title', 
	'type' => 'text',
	'priority'   => 3
	)));
	
	// Work Experience Logo 1
	$wp_customize->add_setting( 'work_logo1', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'work_logo1', array(
		'label'    => __( 'Company Logo', 'personal' ),
		'section'  => 'frontpage-work-experience',
		'settings' => 'work_logo1',
		'priority' => 4 
	)));
	
	// Work Experience Title
	$wp_customize->add_setting( 'work_title1' , 
	array( 
		'default' => 'Where did you work?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_title1', array(
    'label' => __( 'Work Title', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_title1',
	'type' => 'text',    
	'priority'   => 5
	)));
	
	// Work Experience Years
	$wp_customize->add_setting( 'work_caption1' , 
	array( 
		'default' => 'What years were you there?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_caption1', array( 
    'label' => __( 'Work Years', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_caption1',
	'type' => 'text',   
	'priority'   => 6 
	)));
	
	// Work Experience Logo 2
	$wp_customize->add_setting( 'work_logo2', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'work_logo2', array(
		'label'    => __( 'Company Logo', 'personal' ),
		'section'  => 'frontpage-work-experience', 
		'settings' => 'work_logo2',
		'priority'   => 7 
	)));
	
	// Work Experience TItle
	$wp_customize->add_setting( 'work_title2' , 
	array( 
		'default' => 'Where did you work?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_title2', array( 
	'default' => 'Where did you work?',   
    'label' => __( 'Work Title', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_title2',
	'type' => 'text',    
	'priority'   => 8
	)));
	
	// Work Experience Years
	$wp_customize->add_setting( 'work_caption2' , 
	array( 
		'default' => 'What years were you there?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_caption2', array( 
    'label' => __( 'Work Years', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_caption2',
	'type' => 'text',    
	'priority'   => 9
	)));
	
	// Work Experience Logo 3
	$wp_customize->add_setting( 'work_logo3', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'work_logo3', array( 
		'label'    => __( 'Company Logo', 'personal' ),
		'section'  => 'frontpage-work-experience', 
		'settings' => 'work_logo3',
		'priority'   => 10
	)));
	
	// Work Experience Title
	$wp_customize->add_setting( 'work_title3' , 
	array( 
		'default' => 'Where did you work?',
		'sanitize_callback' => 'personal_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_title3', array(  
    'label' => __( 'Work Title', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_title3',
	'type' => 'text',    
	'priority'   => 11
	) ) );
	
	// Work Experience Years
	$wp_customize->add_setting( 'work_caption3' , 
	array( 
		'default' => 'What years were you there?',
		'sanitize_callback' => 'personal_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_caption3', array( 
	'default' => 'What years were you there?',  
    'label' => __( 'Work Years', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_caption3',
	'type' => 'text',    
	'priority'   => 12
	) ) );
	
	// Work Experience Logo 4
	$wp_customize->add_setting( 'work_logo4', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'work_logo4', array(
		'label'    => __( 'Company Logo', 'personal' ),
		'section'  => 'frontpage-work-experience', 
		'settings' => 'work_logo4', 
		'priority'   => 13 
	) ) );
	
	// Work Experience Title
	$wp_customize->add_setting( 'work_title4' , 
	array( 
		'default' => 'Where did you work?',
		'sanitize_callback' => 'personal_sanitize_text', 
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_title4', array(
    'label' => __( 'Work Title', 'personal' ), 
    'section' => 'frontpage-work-experience',
    'settings' => 'work_title4',
	'type' => 'text',    
	'priority'   => 14
	) ) );
	
	// Work Experience Years
	$wp_customize->add_setting( 'work_caption4' , 
	array( 
		'default' => 'What years were you there?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'work_caption4', array(
    'label' => __( 'Work Years', 'personal' ),  
    'section' => 'frontpage-work-experience',
    'settings' => 'work_caption4', 
	'type' => 'text',    
	'priority'   => 15
	) ) );
	
	// Education Section
	$wp_customize->add_section( 'frontpage-education' , array(
    	'title' => __( 'Education', 'personal' ),  
    	'priority' => 28,    
    	'description' => __( 'Education is important.', 'personal' )  
	) );
	
	$wp_customize->add_setting('active_education',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox', 
	    ) 
	);       
	
	$wp_customize->add_control( 
    'active_education',  
    array(
        'type' => 'checkbox',
        'label' => 'Hide Education Section',  
        'section' => 'frontpage-education',  
		'priority'   => 1 
    ));
	
	// Education Title
	$wp_customize->add_setting( 'education_title' , 
	array( 
		'default' => 'Education',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'education_title', array(  
    'label' => __( 'Education Title', 'personal' ),  
    'section' => 'frontpage-education',
    'settings' => 'education_title',  
	'type' => 'text',
	'priority'   => 2
	) ) );
	
	// School 1
	$wp_customize->add_setting( 'school_name1' , 
	array( 
		'default' => 'What was the name and when did you go?',
		'sanitize_callback' => 'personal_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_name1', array(  
    'label' => __( 'School Name and Years Attended', 'personal' ), 
    'section' => 'frontpage-education',
    'settings' => 'school_name1',
	'type' => 'text',   
	'priority'   => 3
	) ) );
	
	// School Years 1
	$wp_customize->add_setting( 'school_major1' , 
	array( 
		'default' => 'What did you study?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_major1', array( 
	'default' => 'What did you study?',  
    'label' => __( 'School Details', 'personal' ),   
    'section' => 'frontpage-education',
    'settings' => 'school_major1', 
	'type' => 'text',    
	'priority'   => 4
	) ) );
	
	// School 2
	$wp_customize->add_setting( 'school_name2' , 
	array( 
		'default' => 'What was the name and when did you go?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_name2', array(
    'label' => __( 'School Name and Years Attended', 'personal' ), 
    'section' => 'frontpage-education',
    'settings' => 'school_name2',
	'type' => 'text',    
	'priority'   => 5
	) ) );
	
	// School Years 2
	$wp_customize->add_setting( 'school_major2' , 
	array( 
		'default' => 'What did you study?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_major2', array(
    'label' => __( 'School Details', 'personal' ),  
    'section' => 'frontpage-education', 
    'settings' => 'school_major2',
	'type' => 'text',    
	'priority'   => 6
	) ) );
	
	// School 3
	$wp_customize->add_setting( 'school_name3' , 
	array( 
		'default' => 'What was the name and when did you go?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_name3', array(
    'label' => __( 'School Name and Years Attended', 'personal' ), 
    'section' => 'frontpage-education',
    'settings' => 'school_name3',
	'type' => 'text',    
	'priority'   => 7
	) ) );
	
	// School Years 3
	$wp_customize->add_setting( 'school_major3' , 
	array( 
		'default' => 'What did you study?',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'school_major3', array(  
    'label' => __( 'School Details', 'personal' ),  
    'section' => 'frontpage-education',
    'settings' => 'school_major3',
	'type' => 'text',    
	'priority'   => 8  
	) ) ); 
	
	// Detail Spinner
	$wp_customize->add_section( 'frontpage-details' , array(
    	'title' => __( 'Detail Spinner', 'personal' ), 
    	'priority' => 29,   
    	'description' => __( 'Details are your personality. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right"', 'personal' ) 
	) );
	
	$wp_customize->add_setting('active_details',
	array(
	        'sanitize_callback' => 'personal_sanitize_checkbox',
	    ) 
	);       
	
	$wp_customize->add_control( 
    'active_details', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Details Section',  
        'section' => 'frontpage-details',  
		'priority'   => 1 
    ));
	
	// Detail Title
	$wp_customize->add_setting( 'detail_title' , 
	array( 
		'default' => 'Some interesting things about me',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_title', array(
    'label' => __( 'Put your title here', 'personal' ),  
    'section' => 'frontpage-details',
    'settings' => 'detail_title',
	'type' => 'text',   
	'priority'   => 2
	) ) );
	
 	// Detail Icon 1
	$wp_customize->add_setting( 'detail_icon_1' , 
	array( 
		'default' => 'fa-users',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_icon_1', array(
    'label' => __( 'First Icon', 'personal' ),  
    'section' => 'frontpage-details',
    'settings' => 'detail_icon_1',
	'priority'   => 3
	) ) ); 
	
	// Detail Spinner 1
	$wp_customize->add_setting( 'odometer_detail_1' , 
	array( 
		'default' => 'Years Experience',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_detail_1', array( 
	'default' => 'Years Experience',
    'label' => __( 'First Detail', 'personal' ),  
    'section' => 'frontpage-details',
    'settings' => 'odometer_detail_1',
	'priority'   => 4
	) ) ); 
	
	// Detail Spinner 1 Number
	$wp_customize->add_setting( 'odometer_number_1' , 
	array( 
		'default' => '8',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_number_1', array(
	'default' => '8',
    'label' => __( 'First Number', 'personal' ), 
    'section' => 'frontpage-details', 
    'settings' => 'odometer_number_1',
	'priority'   => 5  
	) ) );
	
	// Detail Icon 2
	$wp_customize->add_setting( 'detail_icon_2' , 
	array( 
		'default' => 'fa-smile-o',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_icon_2', array(
    'label' => __( 'Second Icon', 'personal' ),   
    'section' => 'frontpage-details',
    'settings' => 'detail_icon_2', 
	'priority'   => 6 
	) ) ); 
	
	// Detail Spinner 2
	$wp_customize->add_setting( 'odometer_detail_2' , 
	array( 
		'default' => 'Happy Clients',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_detail_2', array(
    'label' => __( 'Second Detail', 'personal' ),  
    'section' => 'frontpage-details',
    'settings' => 'odometer_detail_2',
	'priority'   => 7 
	) ) );
	
	// Detail Spinner 2 Number
	$wp_customize->add_setting( 'odometer_number_2' , 
	array( 
		'default' => '43',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_number_2', array(
    'label' => __( 'Second Number', 'personal' ),
    'section' => 'frontpage-details',
    'settings' => 'odometer_number_2',
	'priority'   => 8 
	) ) );
	
	// Detail Icon 3
	$wp_customize->add_setting( 'detail_icon_3' , 
	array( 
		'default' => 'fa-book',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_icon_3', array(
    'label' => __( 'Third Icon', 'personal' ),    
    'section' => 'frontpage-details',
    'settings' => 'detail_icon_3', 
	'priority'   => 9 
	) ) ); 
	
	// Detail Spinner 3
	$wp_customize->add_setting( 'odometer_detail_3' , 
	array( 
		'default' => 'Books Read',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_detail_3', array(
    'label' => __( 'Third Detail', 'personal' ),
    'section' => 'frontpage-details',
    'settings' => 'odometer_detail_3',
	'priority'   => 10
	) ) );
	
	// Detail Spinner 3 Number
	$wp_customize->add_setting( 'odometer_number_3' , 
	array( 
		'default' => '162',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_number_3', array(
    'label' => __( 'Third Number', 'personal' ),
    'section' => 'frontpage-details', 
    'settings' => 'odometer_number_3',
	'priority'   => 11  
	) ) );
	
	// Detail Icon 4
	$wp_customize->add_setting( 'detail_icon_4' , 
	array( 
		'default' => 'fa-graduation-cap',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_icon_4', array(
    'label' => __( 'Fourth Icon', 'personal' ),    
    'section' => 'frontpage-details',
    'settings' => 'detail_icon_4',  
	'priority'   => 12 
	) ) ); 
	
	// Detail Spinner 4
	$wp_customize->add_setting( 'odometer_detail_4' , 
	array( 
		'default' => 'College Years',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_detail_4', array(
    'label' => __( 'Fourth Detail', 'personal' ),
    'section' => 'frontpage-details',
    'settings' => 'odometer_detail_4',
	'priority'   => 13 
	) ) ); 
	
	// Detail Spinner 4 Number
	$wp_customize->add_setting( 'odometer_number_4' , 
	array( 
		'default' => '6',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_number_4', array(
    'label' => __( 'Fourth Number', 'personal' ), 
    'section' => 'frontpage-details',
    'settings' => 'odometer_number_4',
	'priority'   => 14 
	) ) );
	
	// Detail Icon 5
	$wp_customize->add_setting( 'detail_icon_5' , 
	array( 
		'default' => 'fa-male',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'detail_icon_5', array(
    'label' => __( 'Fifth Icon', 'personal' ),   
    'section' => 'frontpage-details',
    'settings' => 'detail_icon_5',  
	'priority'   => 15
	) ) ); 
	
	// Detail Spinner 5
	$wp_customize->add_setting( 'odometer_detail_5' , 
	array( 
		'default' => 'Years Old',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_detail_5', array(
    'label' => __( 'Fifth Detail', 'personal' ),
    'section' => 'frontpage-details',
    'settings' => 'odometer_detail_5', 
	'priority'   => 16 
	) ) );  
	
	// Detail Spinner 5 Number
	$wp_customize->add_setting( 'odometer_number_5' , 
	array( 
		'default' => '27',
		'sanitize_callback' => 'personal_sanitize_text',   
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'odometer_number_5', array(
    'label' => __( 'Fifth number', 'personal' ), 
    'section' => 'frontpage-details',
    'settings' => 'odometer_number_5', 
	'priority'   => 17 
	) ) );
	
    // Detail Spinner Background
	$wp_customize->add_setting( 'details_background', array(
		'default' => (get_stylesheet_directory_uri() . '/images/facts-bg.jpg'),
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'details_background', array(  
		'label'    => __( 'Remember, this is a background picture.', 'personal' ),
		'section'  => 'frontpage-details',  
		'settings' => 'details_background', 
		'priority'   => 18 
	) ) );
	
	// Add Contact Section
	$wp_customize->add_section( 'contact-section' , array(
    	'title' => __( 'Contact', 'personal' ),
    	'priority' => 33, 
    	'description' => __( 'Customize your Contact Area:', 'personal' )
	) );
	
	$wp_customize->add_setting('active_contact',
	    array(
	        'sanitize_callback' => 'personal_sanitize_checkbox', 
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_contact', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Contact Section',  
        'section' => 'contact-section',  
		'priority'   => 1 
    ));
	
	$wp_customize->add_setting( 'contact_title' , 
	array( 
		'default' => 'Get In Touch',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_title', array(   
    'label' => __( 'Contact Area Title', 'personal' ),  
    'section' => 'contact-section',
    'settings' => 'contact_title',
	'type' => 'text',    
	'priority'   => 2
	) ) );
	
	$wp_customize->add_setting( 'contact_text' , 
	array( 
		'default' => 'Contact me directly or fill out the form below.',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_text', array(   
    'label' => __( 'Contact Area Text', 'personal' ),  
    'section' => 'contact-section',
    'settings' => 'contact_text',
	'type' => 'text',    
	'priority'   => 3 
	) ) );
	
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer', 'personal' ),
    	'priority' => 35, 
    	'description' => __( 'Customize your footer area:', 'personal' )
	) );
	
	// Footer Byline Text
	$wp_customize->add_setting( 'personal_footerid' , 
	array( 
		'sanitize_callback' => 'personal_sanitize_text',
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_footerid', array(
	'default' => 'Theme: personal by modernthemes.net', 
    'label' => __( 'Footer Byline Text', 'personal' ), 
    'section' => 'footer-custom',
    'settings' => 'personal_footerid'
	) ) );

	// Footer Phone Number
	$wp_customize->add_setting( 'personal_phone' ,
	array( 
		'default' => 'Enter phone number',
		'sanitize_callback' => 'personal_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_phone', array(
	'default' => 'Enter phone number',
    'label' => __( 'Phone Number', 'personal' ),
    'section' => 'footer-custom', 
    'settings' => 'personal_phone' 
	) ) );

	// Footer Email
	$wp_customize->add_setting( 'personal_email' ,  
	array( 
		'default' => 'Enter e-mail',
		'sanitize_callback' => 'personal_sanitize_text',  
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'personal_email', array(
	'default' => 'Enter e-mail', 
    'label' => __( 'Email', 'personal' ),
    'section' => 'footer-custom',
    'settings' => 'personal_email' 
	) ) );

	// Set site name and description to be previewed in real-time 
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage'; 

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'personal-customizer', get_template_directory_uri() . '/js/personal-customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true ); 
	
	// Remove background image option
	$wp_customize->remove_section( 'background_image' );
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10; 
	$wp_customize->remove_section('nav'); 

}
add_action('customize_register', 'personal_theme_customizer');

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function personal_sanitize_hex_color( $color ) {
	if ( '#FF0000' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function personal_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	}
}

//work experience radio
function personal_sanitize_work_content( $input ) {
    $valid = array(
        'option1' => 'All', 
		'option2' => '3',
		'option3' => '2',
		'option4' => '1',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//Checkboxes
function personal_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function personal_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function personal_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Sanitizes Fonts 
function personal_sanitize_fonts( $input ) {  
    $valid = array(
            'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans', 
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Oswald:400,700' => 'Oswald',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato', 
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt', 
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function personal_no_sanitize( $input ) {
} 

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function personal_add_customizer_css() {
	$color = personal_sanitize_hex_color( get_theme_mod( 'personal_link_color' ) );
	?>
	<!-- personal customizer CSS -->
	<style>
	   
		body {
			border-color: <?php echo $color; ?>;
		}
		a, a:hover {
			color: <?php echo $color; ?>;
		}
		
		.overview a { color: <?php echo get_theme_mod( 'resume_link_color' ); ?>; }
		
		.progressBar div { background-color: <?php echo get_theme_mod( 'skill_bar_color' ); ?>; }   
		 
	</style>
<?php }
add_action( 'wp_head', 'personal_add_customizer_css' );