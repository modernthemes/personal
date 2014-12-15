<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package personal
 */

?>  
 
<?php

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

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php personal_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
