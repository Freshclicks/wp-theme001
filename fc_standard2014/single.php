<?php get_header(); ?>
<div id="main-content" class="container">
	<section id="primary" class="col-sm-8 hfeed">
    <?php echo get_breadcrumb(); ?>
	<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="<?php fcstandard2014_post_class(); ?>">
			<span class="text-muted"><small>Published on <?php the_date('M d Y', '', ''); ?></small></span>
            <header>
            	<h1 class="single-title"><?php the_title(); ?></h1>
            </header>
			<span class="text-muted"><small>by <?php echo get_the_author_link(); ?> | <?php printf(__('Topics: %1$s', 'sandbox'), get_the_category_list(', '), get_the_tag_list('', ', ', '. ')) ?></small></span>
			<div class="single-content">
				<?php the_content('<span class="more-link">'.__('Read More', 'fcstandard2014').'</span>'); ?>
				<?php link_pages('<div class="page-link">'.__('Pages: ', 'fcstandard2014'), "</div>\n", 'number'); ?>
			</div>
		</div><!-- .post -->
		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link(__('&lsaquo; %link', 'fcstandard2014')) ?></div>
			<div class="nav-next"><?php next_post_link(__('%link &rsaquo;', 'fcstandard2014')) ?></div>
		</div>
	</section><!-- #primary col-sm-8 -->
    
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>