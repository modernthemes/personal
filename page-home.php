<?php
/**
 * Template Name: Home Page
 *
 * @package personal
 */
?>

<?php
// This makes the contact form send you lovely correspondence  

if(isset($_POST['submitted'])) {

        if(trim($_POST['contactName']) === '') {
               $nameError = 'Please enter your name.';
               $hasError = true;
        } else {  

               $name = trim($_POST['contactName']);
        }

        if(trim($_POST['email']) === '')  {
               $emailError = 'Please enter your email address.';
               $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
               $emailError = 'You entered an invalid email address.';
               $hasError = true;
        } else {
               $email = trim($_POST['email']); 
        }

        if(trim($_POST['comments']) === '') {
               $commentError = 'Please enter a message.';
               $hasError = true;
        } else {
               if(function_exists('stripslashes')) {
                      $comments = stripslashes(trim($_POST['comments']));
               } else {
                       $comments = trim($_POST['comments']);
               }
        }

        if(!isset($hasError)) {
               $emailTo = get_option('tz_email');
               if (!isset($emailTo) || ($emailTo == '') ){
                       $emailTo = get_option('admin_email');
               }
               $subject = 'New Contact Submission From '.$name;
               $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
               $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

               wp_mail($emailTo, $subject, $body, $headers);
               $emailSent = true;
        }
} ?> 

<?php get_header();?>

		<ul id="nav">
    		<li class="current"><a href="#section-1"></a></li>
    		<li><a href="#bio"></a></li>
    		<li><a href="#facts"></a></li>
    		<li><a href="#contact"></a></li>
		</ul><!-- #nav -->
  
    	<?php if( get_theme_mod( 'active_top' ) == '') : ?> 
	
  		<div id="slides">
    		<div id="section-1" class="slides-container section">
    			<?php if ( get_theme_mod( 'background_picture' ) ) : ?>
        		<img src="<?php echo esc_url( get_theme_mod( 'background_picture' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> 
				<?php else : ?>    
    	
				<?php endif; ?>
    		</div><!-- .slides-container section --> 
  		</div><!-- #slides --> 

    	<div class="home-overlay">
        	<div class="home-text">
            	
                <h1 class="home-cta">
            	<?php if ( get_theme_mod( 'top_greeting' ) ) : ?>
        			<span><?php echo get_theme_mod( 'top_greeting' ); ?></span>
				<?php else : ?>
				<?php endif; ?>
                
                <?php if ( get_theme_mod( 'top_name' ) ) : ?>
        			<?php echo get_theme_mod( 'top_name' ); ?>
				<?php else : ?>
				<?php endif; ?>
                </h1><!-- home-cta --> 
                
                <?php if ( get_theme_mod( 'top_cta' ) ) : ?>
        			<p><?php echo get_theme_mod( 'top_cta' ); ?></p> 
				<?php else : ?>  
				<?php endif; ?>
                
                <a href="#about"><span class="down-arrow"><i class="fa fa-angle-down"></i></span></a>
                
        	</div><!-- .home-text --> 
        </div><!-- .home-overlay -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
            
        <div id="bio" class="bio-section section">
        
        <?php if( get_theme_mod( 'active_about' ) == '') : ?> 
        
    	<div class="grid">
    		<div id="about" class="col-1-1 bio-header">
                
				<?php if ( get_theme_mod( 'about_me_title' ) ) : ?>
                    <h2 class="uppercase"><?php echo get_theme_mod( 'about_me_title' ); ?></h2>
				<?php else : ?>
				<?php endif; ?> 
                	
				<?php if ( get_theme_mod( 'title_caption' ) ) : ?>
        			<?php echo get_theme_mod( 'title_caption' ); ?>
				<?php else : ?>
				<?php endif; ?>
                    
     		</div><!-- .bio-header -->  
        </div><!-- .grid -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_overview' ) == '') : ?> 
	 
        <div class="grid">
			<?php if ( is_active_sidebar('overview-section') ) : ?>
        		<div class="col-1-2 overview about-block">
    				<?php dynamic_sidebar('overview-section'); ?>
                		<?php if ( get_theme_mod( 'resume-upload' ) ) : ?>
        					<a href="<?php echo get_theme_mod( 'resume-upload' ); ?>"><?php echo get_theme_mod( 'resume_text' ); ?></a>
        				<?php else : ?>
						<?php endif; ?>
     			</div><!-- .about-block -->
	 		<?php endif; ?> 
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_skills' ) == '') : ?>
            
        <div class="col-1-2 skills-info about-block">
            
            	<?php if ( get_theme_mod( 'skills_title' ) ) : ?>
            		<h5><?php echo get_theme_mod( 'skills_title' ); ?></h5>
				<?php else : ?>
				<?php endif; ?> 
        	
            
            <!-- Change the below data attribute -->
	        
           	<ul>
            	<li>
					<?php if ( get_theme_mod( 'personal_skill_1' ) ) : ?>
            			<p><?php echo get_theme_mod( 'personal_skill_1' ); ?></p>
                		<div class="progressBar" id="max<?php echo get_theme_mod( 'skill_percentage_1' ); ?>"><div></div></div>
					<?php else : ?>
					<?php endif; ?> 
                </li>
            	<li>
                	<?php if ( get_theme_mod( 'personal_skill_2' ) ) : ?>
            			<p><?php echo get_theme_mod( 'personal_skill_2' ); ?></p>
                		<div class="progressBar" id="max<?php echo get_theme_mod( 'skill_percentage_2' ); ?>"><div></div></div>
					<?php else : ?>
					<?php endif; ?> 
                </li>
            	<li>
                	<?php if ( get_theme_mod( 'personal_skill_3' ) ) : ?>
            			<p><?php echo get_theme_mod( 'personal_skill_3' ); ?></p>
                		<div class="progressBar" id="max<?php echo get_theme_mod( 'skill_percentage_3' ); ?>"><div></div></div>
					<?php else : ?>
					<?php endif; ?>
                </li>
            	<li>
                	<?php if ( get_theme_mod( 'personal_skill_4' ) ) : ?>
            			<p><?php echo get_theme_mod( 'personal_skill_4' ); ?></p>
                		<div class="progressBar" id="max<?php echo get_theme_mod( 'skill_percentage_4' ); ?>"><div></div></div>
					<?php else : ?>
					<?php endif; ?>
                </li>
            </ul> 
        	</div><!-- .skills-info --> 
        </div><!-- .grid --> 
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_work' ) == '') : ?>
        
        	<?php
    			$work_sections = get_theme_mod( 'personal_work_sections' );
    			if( $work_sections != '' ) {
        		switch ( $work_sections ) {
            	case 'option1':
                	// Do nothing. The theme already aligns the logo to the left
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.experience-4 { display:none }';
                	echo '</style>';
                	break;
            	case 'option3':
                	echo '<style type="text/css">';
                	echo '.experience-3, .experience-4 { display:none }';
                	echo '</style>';
                	break;
				case 'option4':
                	echo '<style type="text/css">';
                	echo '.experience-2, .experience-3, .experience-4 { display:none }';
                	echo '</style>';
                	break;
        			}
    				} 
			?>
        
        <div class="grid bottom-about">
        	<div class="col-1-2 about-block"> 
        		<?php if ( get_theme_mod( 'work_title' ) ) : ?>
            		<h5><?php echo get_theme_mod( 'work_title' ); ?></h5>
				<?php else : ?>
				<?php endif; ?> 
        
        	<article class="work-logo experience-1">
        		<?php if ( get_theme_mod( 'work_logo1' ) ) : ?>
        			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'work_logo1' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a> 
				<?php else : ?>
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_title1' ) ) : ?>
        			<h3><?php echo get_theme_mod( 'work_title1' ); ?></h3>
        		<?php else : ?>  
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_caption1' ) ) : ?>
        			<h4><?php echo get_theme_mod( 'work_caption1' ); ?></h4>
        		<?php else : ?> 
				<?php endif; ?> 
        	</article><!-- .work_logo --> 
        
        	<article class="work-logo experience-2">
        		<?php if ( get_theme_mod( 'work_logo2' ) ) : ?>
        			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'work_logo2' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a> 
				<?php else : ?>  
    	
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_title2' ) ) : ?>
        			<h3><?php echo get_theme_mod( 'work_title2' ); ?></h3>
        		<?php else : ?>  
    	
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_caption2' ) ) : ?>
        			<h4><?php echo get_theme_mod( 'work_caption2' ); ?></h4>
        		<?php else : ?> 
    	
				<?php endif; ?> 
        	</article><!-- .work_logo -->
        
        	<article class="work-logo experience-3">
        		<?php if ( get_theme_mod( 'work_logo3' ) ) : ?>
        			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'work_logo3' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a> 
				<?php else : ?>  
    	
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_title3' ) ) : ?>
        			<h3><?php echo get_theme_mod( 'work_title3' ); ?></h3>
        		<?php else : ?>  
    	
				<?php endif; ?>
            
        		<?php if ( get_theme_mod( 'work_caption3' ) ) : ?>
        			<h4><?php echo get_theme_mod( 'work_caption3' ); ?></h4> 
        		<?php else : ?> 
    	
				<?php endif; ?>
        	</article><!-- .work_logo -->
        
        	<article class="work-logo experience-4"> 
        		<?php if ( get_theme_mod( 'work_logo4' ) ) : ?>
        		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'work_logo4' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a> 
				<?php else : ?>  
    	
				<?php endif; ?> 
        
				<?php if ( get_theme_mod( 'work_title4' ) ) : ?>
        			<h3><?php echo get_theme_mod( 'work_title4' ); ?></h3>
        		<?php else : ?>  
    	
				<?php endif; ?>
        
				<?php if ( get_theme_mod( 'work_caption4' ) ) : ?>
        			<h4><?php echo get_theme_mod( 'work_caption4' ); ?></h4>
        		<?php else : ?>
    	 
				<?php endif; ?>
                  
        	</article><!-- .work_logo --> 
        </div><!-- .about-block -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_education' ) == '') : ?>

        <div class="col-1-2 about-block">
        
       		 <?php if ( get_theme_mod( 'education_title' ) ) : ?>
             	<h5><?php echo get_theme_mod( 'education_title' ); ?></h5>
			 <?php else : ?>
			 <?php endif; ?> 
             
             <?php if ( get_theme_mod( 'school_name1' ) ) : ?>   
        	 	<div class="school-name">
        			<h3><?php echo get_theme_mod( 'school_name1' ); ?></h3>
        	 	</div><!-- .school-name -->
             <?php else : ?>
			 <?php endif; ?>
        	 
             <?php if ( get_theme_mod( 'school_major1' ) ) : ?>
        	 	<div class="school-major">
        			<p><?php echo get_theme_mod( 'school_major1' ); ?></p>
       		 	</div><!-- .school-years -->
             <?php else : ?>
			 <?php endif; ?>
             
             <?php if ( get_theme_mod( 'school_name2' ) ) : ?>
             	<div class="school-name">
        			<h3><?php echo get_theme_mod( 'school_name2' ); ?></h3>
        	 	</div><!-- .school-name -->
             <?php else : ?>
			 <?php endif; ?>
        
        	 
        	<?php if ( get_theme_mod( 'school_major2' ) ) : ?>
                <div class="school-major"> 
        			<p><?php echo get_theme_mod( 'school_major2' ); ?></p>
                </div><!-- .school-years -->
        	<?php else : ?> 
			<?php endif; ?>
       		 
            
            <?php if ( get_theme_mod( 'school_name3' ) ) : ?>
             	<div class="school-name">
        			<h3><?php echo get_theme_mod( 'school_name3' ); ?></h3>
        		</div><!-- .school-name -->
            <?php else : ?>
			<?php endif; ?>
        	
            <?php if ( get_theme_mod( 'school_major3' ) ) : ?>
        		<div class="school-major">
        			<p><?php echo get_theme_mod( 'school_major3' ); ?></p>  
       			</div><!-- .school-years -->
            <?php else : ?>
			<?php endif; ?>
       
        </div><!-- .about-block -->
        </div><!-- .grid -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
    </div><!-- #bio -->
    
    <?php if( get_theme_mod( 'active_details' ) == '') : ?>
    
  		<input type="hidden" id="od1" value="<?php echo get_theme_mod( 'odometer_number_1' ); ?>" />  
  		<input type="hidden" id="od2" value="<?php echo get_theme_mod( 'odometer_number_2' ); ?>" />
  		<input type="hidden" id="od3" value="<?php echo get_theme_mod( 'odometer_number_3' ); ?>" />
  		<input type="hidden" id="od4" value="<?php echo get_theme_mod( 'odometer_number_4' ); ?>" />
  		<input type="hidden" id="od5" value="<?php echo get_theme_mod( 'odometer_number_5' ); ?>" />
 
  	<div id="facts" class="facts section" style="background: url('<?php echo get_theme_mod( 'details_background' ); ?>') center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">

  		<div class="grid"> 
        	
            <div class="col-1-1">
              
            	<?php if ( get_theme_mod( 'detail_title' ) ) : ?>
            		<h1><?php echo get_theme_mod( 'detail_title' ); ?></h1>   
            	<?php else : ?> 
				<?php endif; ?> 
        	
        	</div><!-- .col-1-1 -->
            
            <div class="details"> 
            	<div class="col-1-5 fact">
            
            		<?php if ( get_theme_mod( 'detail_icon_1' ) ) : ?>
            			<i class="fa <?php echo get_theme_mod( 'detail_icon_1' ); ?> fact-icon"></i>
                	<?php else : ?>
					<?php endif; ?>
                	
                	<div id="odometer1" class="odometer">00</div>
                
                	<?php if ( get_theme_mod( 'odometer_detail_1' ) ) : ?>
            			<h4><?php echo get_theme_mod( 'odometer_detail_1' ); ?></h4>   
            		<?php else : ?> 
					<?php endif; ?> 

            	</div><!-- .fact -->
            
            	<div class="col-1-5 fact">
            	
					<?php if ( get_theme_mod( 'detail_icon_2' ) ) : ?>
            			<i class="fa <?php echo get_theme_mod( 'detail_icon_2' ); ?> fact-icon"></i>
                	<?php else : ?>
					<?php endif; ?> 
                
                	<div id="odometer2" class="odometer">00</div>
                
                	<?php if ( get_theme_mod( 'odometer_detail_2' ) ) : ?>
            			<h4><?php echo get_theme_mod( 'odometer_detail_2' ); ?></h4>   
            		<?php else : ?> 
					<?php endif; ?> 
                
            	</div><!-- .fact -->
            
            	<div class="col-1-5 fact">
            	
					<?php if ( get_theme_mod( 'detail_icon_3' ) ) : ?>
            			<i class="fa <?php echo get_theme_mod( 'detail_icon_3' ); ?> fact-icon"></i>
                	<?php else : ?>
					<?php endif; ?>
                
                	<div id="odometer3" class="odometer">00</div>
                
                	<?php if ( get_theme_mod( 'odometer_detail_3' ) ) : ?>
            			<h4><?php echo get_theme_mod( 'odometer_detail_3' ); ?></h4>   
            		<?php else : ?> 
					<?php endif; ?> 
                
            	</div><!-- .fact -->
            
            	<div class="col-1-5 fact">
            	
					<?php if ( get_theme_mod( 'detail_icon_4' ) ) : ?>
            			<i class="fa <?php echo get_theme_mod( 'detail_icon_4' ); ?> fact-icon"></i>
                	<?php else : ?>
					<?php endif; ?> 
                
                	<div id="odometer4" class="odometer">00</div>
                
                	<?php if ( get_theme_mod( 'odometer_detail_4' ) ) : ?>
            			<h4><?php echo get_theme_mod( 'odometer_detail_4' ); ?></h4>   
            		<?php else : ?> 
					<?php endif; ?> 
                
            	</div><!-- .fact -->
             
            	<div class="col-1-5 fact">
            	 
					<?php if ( get_theme_mod( 'detail_icon_5' ) ) : ?>
            			<i class="fa <?php echo get_theme_mod( 'detail_icon_5' ); ?> fact-icon"></i>
                	<?php else : ?>
					<?php endif; ?> 
                
                	<div id="odometer5" class="odometer">00</div>
                
                	<?php if ( get_theme_mod( 'odometer_detail_5' ) ) : ?>
            		 	<h4><?php echo get_theme_mod( 'odometer_detail_5' ); ?></h4>   
            		<?php else : ?> 
					<?php endif; ?>
               
            	</div><!-- .fact --> 
              
            </div><!-- .details -->
        </div><!-- .grid -->
    </div><!-- #facts -->
    
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>
    
    <?php if( get_theme_mod( 'active_contact' ) == '') : ?>

    <div id="contact" class="grid contact section">
                	
        	<div class="col-1-1"> 
            	
				<?php if ( get_theme_mod( 'contact_title' ) ) : ?>
        			<h1 class="uppercase"><?php echo get_theme_mod( 'contact_title' ); ?></h1> 
        		<?php else : ?>
				<?php endif; ?>
                
                <?php if ( get_theme_mod( 'contact_text' ) ) : ?>
        			<p class="upper"><?php echo get_theme_mod( 'contact_text' ); ?></p> 
        		<?php else : ?>
				<?php endif; ?>

            </div><!-- .col-1-1 -->  
            
            <div class="col-1-1 form">     

           <?php if(isset($emailSent) && $emailSent == true) { ?>
             <div><p>Thanks, your email was sent successfully.</p></div>
				<?php } else { ?>
                
						<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p>Sorry, an error occured.<p>
						<?php } ?> 

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
  						<ul class="contact-form"> 
						<li class="contact-name">
						 <input type="text" name="contactName" id="contactName" placeholder="Your Name" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" />
							<?php if($nameError != '') { ?>
							<span><?php echo $nameError;?></span>
							<?php } ?>
					 	</li>

						<li class="contact-email">
						<input type="text" name="email" id="email" placeholder="Your Email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />
							<?php if($emailError != '') { ?>
							<span><?php echo $emailError;?></span>
							<?php } ?>
						</li>

 						<li class="contact-comments">
						<textarea name="comments" id="commentsText" placeholder="Your Message" rows="12" cols="30"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
							<span><?php echo $commentError;?></span>
							<?php } ?>
						</li>

						<li>
						<input type="submit" class="contact-submit" value="Send Message" />
						</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						</form>
 
                        <?php } ?>
                             
            </div><!-- .form -->  
        </div><!-- #contact -->
        
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>


<?php get_footer(); ?>
