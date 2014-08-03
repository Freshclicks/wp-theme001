<?php get_header() ?>
<div id="main-content" class="container">
	<div class="col-sm-8 clearfix padding-five">
	<section id="primary" class="hfeed">
		<?php the_post() ?>
			<h2 class="page-title"><span class="page-cat"><?php echo single_cat_title(); ?></span></h2>
			<div class="archive-meta">
				<?php if ( !(''== category_description()) ) : echo apply_filters('archive_meta', category_description()); endif; ?>
            </div>
			<?php rewind_posts() ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php // Post thumbnail conditional display.
                    //if ( fcstandard2014_autoset_featured_img() !== false ) : ?>
                <div class="boxgrid-border col-sm-6">
                    <div class="boxgrid caption">
                    <?php 
                        if ( has_post_thumbnail($thumbnail->ID)) {
                            echo '<a href="' . get_permalink( $thumbnail->ID  ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                            echo get_the_post_thumbnail($thumbnail->ID, 'medium', array('class' => ' img-responsive'));
                            echo '</a>';
                        }
                        ?>
                        <div class="cover boxcaption">
                            <H3 class="text-center"><?php the_title() ?></H3>
                            <?php
                                echo '<p class="text-center"><a href="' . get_permalink( $thumbnail->ID  ) . '" title="' . esc_attr( $thumbnail->post_title ) . '" class="btn btn-default btn-xs">View work</a></p>'; 
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
                <div id="nav-below" class="navigation">
                    <div class="nav-previous"><?php next_posts_link(__('&lsaquo; Older posts', 'fcstandard2014')) ?></div>
                    <div class="nav-next"><?php previous_posts_link(__('Newer posts &rsaquo;', 'fcstandard2014')) ?></div>
                </div>
	</section><!-- #primary col-sm-8 -->
    </div>
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>