<?php
/*
Template Name: Display Subpages
*/
get_header() ?>
<?php $this_page_id=$wp_query->post->ID; ?>
	<div id="main-content" class="container">
		<section id="primary" class="col-sm-8 hfeed">
    		<?php get_breadcrumb(); ?>
			<?php the_post() ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content() ?>
			    	<?php query_posts(array('showposts' => 20, 'post_parent' => $this_page_id, 'post_type' => 'page')); while (have_posts()) { the_post(); ?>
			<div class="col-sm-6">
            	<div class="boxgrid-border">
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
			</div><!-- *col-sm-6 -->
        		<?php } ?>
     		<div class="clearfix"></div>
            <?php edit_post_link(__('Edit this entry.', 'fcstandard2014'),'<p class="entry-edit">','</p>') ?>
		</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>
<script type="text/javascript">
			$(document).ready(function(){
    		$('.boxgrid.caption').hover(function(){
        	$(".cover", this).stop().animate({top:'95px'},{queue:false,duration:150});
    		}, function() {
        		$(".cover", this).stop().animate({top:'135px'},{queue:false,duration:160});
   			});
		});
	</script>