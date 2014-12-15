<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package personal
 */
?>

	</section><!-- #content -->  

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info col-1-1"> 
        	<a href="#go-to-top"><span class="up-arrow"><i class="fa fa-angle-up"></i></span></a>
            <br /><br />
            
    		<div class="footer-social grid grid-pad">
    			<div class="col-1-1">
        			<?php echo personal_media_icons(); ?>
        		</div><!-- .col-1-1 -->
    		</div><!-- .footer-social -->
            
            <div class="grid footer-pad"> 
            	<div class="phone"> 
                	<?php printf( __( 'P: ', 'personal' )); echo get_theme_mod( 'personal_phone' ); ?>
                </div><!-- .phone -->
                <div class="email">
            		<?php printf( __( 'E: ', 'personal' )); ?><a href="mailto:<?php echo get_theme_mod( 'personal_email' ); ?>"><?php echo get_theme_mod( 'personal_email' ); ?></a> 
                </div><!-- .email -->
        	</div> <!-- .footer-pad -->
            
            <div class="grid footer-pad"> 
            	<div class="col-1-1">
                
                <?php if ( get_theme_mod( 'personal_footerid' ) ) : ?>
        			<?php echo get_theme_mod( 'personal_footerid' ); ?>  
				<?php else : ?>  
    				<?php	printf( __( 'Theme: %1$s by %2$s', 'personal' ), 'personal', '<a href="http://modernthemes.net/" rel="designer">modernthemes.net</a>' ); ?> 
				<?php endif; ?>
           
            	</div><!-- .col-1-1 -->
            </div> <!-- .footer-pad -->
            
            
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
