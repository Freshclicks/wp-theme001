	<div id="footer-modules">
    	<div class="container">
            <div class="col-sm-3">
                <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
					<ul class="footer-container">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</ul>
				<?php endif; ?>
            </div>
            <div class="col-sm-3">
                <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
					<ul class="footer-container">
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					</ul>
				<?php endif; ?>
            </div>
            <div class="col-sm-3">
                <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
					<ul class="footer-container">
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					</ul>
				<?php endif; ?>
            </div>
            <div class="col-sm-3">
                <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
					<ul class="footer-container">
						<?php dynamic_sidebar( 'sidebar-6' ); ?>
					</ul>
				<?php endif; ?>
            </div>
		</div> <!-- #footer-modules -->
	</div><!-- #footer-modules container -->
   	<div id="footer">
    	<div class="container" class="row">
			<div id="footer-menu" > 
            	<div class="col-xs-6"> 
                	&copy; <?php echo( date('Y') ); ?> <?php bloginfo('name'); ?> 
				</div>
				<div class="col-xs-6"> 
					<a class="pull-right" href="http://freshclicks.net">FreshClicks - Web design &amp; Marketing</a>
                </div>
			</div>
            
		</div><!-- #container -->
    </div><!-- #footer -->

<?php wp_footer() // Do not remove; helps plugins work ?>

	</div><!-- #page -->
	<!-- Latest compiled and minified JavaScript -->
     <script src="http://code.jquery.com/jquery.js"></script>
    <script  src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  	<script type="text/javascript" >
		$(function(){
  			$('#home-carousel').carousel();
		});
	</script>
</body><!-- end trasmission -->
</html>