<?php get_header() ?>
<div id="main-content" class="container">
	<section id="primary" class="col-sm-8 hfeed">
    	<?php get_breadcrumb(); ?>
		<?php
		the_post() ?>
			<h2 class="page-title"><?php the_title(); ?></h2>
            <p><?php the_content() ?></p>

		<?php $myposts = get_posts('');
			foreach($myposts as $post) :
			setup_postdata($post);
		?>
 			<div id="post-<?php the_ID() ?>" class="<?php fcstandard2014_post_class() ?>">
				<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'fcstandard2014'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h3>
                        <div class="row">
                            <?php // Post thumbnail conditional display.
                            if ( fcstandard2014_autoset_featured_img() !== false ) : ?>
                                <div class="col-sm-2">
                                    <?php 
    									if ( has_post_thumbnail($thumbnail->ID)) {
      									echo '<a href="' . get_permalink( $thumbnail->ID  ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
      									echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail', array('class' => ' img-responsive'));
      									echo '</a>';
    									}
									?>
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

			<?php endforeach; wp_reset_postdata(); ?>
            <div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('&lsaquo; Older posts', 'fcstandard2014')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts &rsaquo;', 'fcstandard2014')) ?></div>
			</div>
	</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>