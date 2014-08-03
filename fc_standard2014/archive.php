<?php
/*
archive
*/ ?>
<?php get_header() ?>
<div id="main-content" class="container">
	<section id="primary" class="col-sm-8 hfeed">
    	<?php get_breadcrumb(); ?>
		<?php the_post() ?>

		<?php if ( is_day() ) : ?>
			<h2 class="page-title"><?php printf(__('Daily Archives: <span>%s</span>', 'fcstandard2014'), get_the_time(__('F jS, Y', 'fcstandard2014'))) ?></h2>
			<?php elseif ( is_month() ) : ?>
			<h2 class="page-title"><?php printf(__('Monthly Archives: <span>%s</span>', 'fcstandard2014'), get_the_time(__('F Y', 'fcstandard2014'))) ?></h2>
			<?php elseif ( is_year() ) : ?>
			<h2 class="page-title"><?php printf(__('Yearly Archives: <span>%s</span>', 'fcstandard2014'), get_the_time(__('Y', 'fcstandard2014'))) ?></h2>
			<?php elseif ( is_author() ) : ?>
			<h2 class="page-title"><?php printf(__('Author Archives: <span class="vcard"><span class="fn n">%s</span></span>', 'fcstandard2014'), 	get_the_author() ) ?></h2>
			<div class="archive-meta"><?php if ( !(''== $authordata->user_description) ) : echo apply_filters('archive_meta', $authordata->user_description); endif; ?></div>
			<?php elseif ( is_category() ) : ?>
			<h2 class="page-title"><span class="page-cat"><?php echo single_cat_title(); ?></span></h2>
			<div class="archive-meta"><?php if ( !(''== category_description()) ) : echo apply_filters('archive_meta', category_description()); endif; ?></div>
			<?php elseif ( is_tag() ) : ?>
			<h2 class="page-title"><?php _e('Tag:', 'fcstandard2014') ?> <span class="tag-cat"><?php single_tag_title(); ?></span></h2>
			<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			<h2 class="page-title"><?php _e('Blog Archives', 'fcstandard2014') ?></h2>
		<?php endif; ?>

		<?php rewind_posts() ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID() ?>" class="<?php fcstandard2014_post_class() ?>">
				<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'fcstandard2014'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h3>
                <div class="row">
                    <?php // Post thumbnail conditional display.
                         if ( fcstandard2014_autoset_featured_img() !== false ) : ?>
                    <div class="col-sm-2">
                         <?php if ( has_post_thumbnail($thumbnail->ID)) {
      						echo '<a href="' . get_permalink( $thumbnail->ID  ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
      						echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail', array('class' => ' img-responsive'));
      						echo '12</a>';
						 } ?>
                    </div>
                    <div class="col-sm-10">
                    <?php else : ?>
                    <div class="col-sm-12">
                    <?php endif; ?>
                         <?php the_excerpt(); ?>
                    </div>
                </div><!-- /.row -->
				<span class="text-muted"><small>By <?php the_author_link(); ?> | <?php printf(__('Topics: %1$s | Tags: %2$s', 'sandbox'), get_the_category_list(', '), get_the_tag_list('', ', ', '. ')) ?></small></span>
                <span class="text-muted pull-right"><small>Published on <?php the_date('M d Y', '', ''); ?></small></span>
                        <hr/>
			</div><!-- .post -->
<?php endwhile ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('&lsaquo; Older posts', 'fcstandard2014')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts &rsaquo;', 'fcstandard2014')) ?></div>
			</div>
	</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>