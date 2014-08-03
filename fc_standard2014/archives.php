<?php get_header() ?>
<div id="main-content" class="container">
	<section id="primary" class="col-sm-8 hfeed">
    	<?php echo get_breadcrumb(); ?>
		<?php the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php fcstandard2014_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
					<?php the_content(); ?>

					<div class="alignleft content-column">
						<h3><?php _e('Archives by Category', 'fcstandard2014') ?></h3>
						<ul>
						<?php wp_list_categories('title_li=&orderby=name&show_count=1&use_desc_for_title=1&feed=RSS') ?>
						</ul>
					</div>
					<div class="alignright content-column">
						<h3><?php _e('Archives by Month', 'fcstandard2014') ?></h3>
						<ul>
							<?php wp_get_archives('type=monthly&show_post_count=1') ?>
						</ul>
					</div>
					<div class="full-column">
						<h3><?php _e('Archives by Tag', 'fcstandard2014') ?></h3>
						<p><?php wp_tag_cloud() ?></p>
					</div>
					<?php edit_post_link(__('Edit this entry.', 'fcstandard2014'),'<p class="entry-edit">','</p>') ?>

				</div>
			</div><!-- .post -->

		<?php if ( get_post_custom_values('comments') ) comments_template() // Add a key/value of "comments" to load comments on a page ?>
	</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>