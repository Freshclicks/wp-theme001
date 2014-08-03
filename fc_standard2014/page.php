<?php get_header(); ?>
<div id="main-content" class="container">
	<section id="primary" class="col-sm-8 hfeed">
		<?php echo get_breadcrumb(); ?>
        <?php the_post(); ?>
        <div id="post-<?php the_ID(); ?>" class="<?php fcstandard2014_post_class() ?>">
        	<header>
            	<h1 class="page-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
            	<?php the_content() ?>
            	<?php link_pages('<div class="page-link">'.__('Pages: ', 'fcstandard2014'), '</div>', 'number'); ?>
            	<?php edit_post_link(__('Edit this entry.', 'fcstandard2014'),'<p class="entry-edit">','</p>') ?>
            </div>
        </div><!-- .post -->
    	<?php if ( get_post_custom_values('comments') ) comments_template() // Add a key/value of "comments" to load comments on a page ?>
	</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>