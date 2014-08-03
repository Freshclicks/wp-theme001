<?php get_header(); ?>
<div id="main-content" class="container">
	<section id="home" class="col-sm-8 hfeed" role="main">
    	<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
                
			<?php endwhile; ?>
			<?php // twentythirteen_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
    </section>
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>