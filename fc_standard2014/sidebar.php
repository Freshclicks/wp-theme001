		<div id="sidebar" class="col-sm-4">
        	<aside> 
        	<div id="secondary" class="widget-area" role="complementary">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<ul id="sidebar">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</ul>
				<?php else: 
					// If no sidebar widgets are set, display these default widgets
				?>
                    <div id="contents" class="well">
                    
                    <div class="">
                        <h4>Search</h4>
                         <?php get_search_form(); ?>
                    </div>
                    <h5>Content</h5>
                    <?php wp_list_pages('sort_column=post_title') ?>
                    </div>
                    <div id="categories" class="well">
                        <h4><?php _e('Categories', 'fcstandard2014'); ?></h4>
                        <?php wp_list_categories('title_li=&orderby=name&use_desc_for_title=1&hierarchical=1') ?>
                    </div>
    
                    <div id="tag-cloud" class="well">
                        <h4><?php _e('Tags', 'fcstandard2014'); ?></h4>
                        <p><?php wp_tag_cloud() ?></p>
                    </div>
				<?php endif; // End Widgets ?>

            </div><!-- #secondary .widget-area -->
            </aside> 
		</div><!-- #primary .sidebar -->