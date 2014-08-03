<?php
/*
Template Name: Display Social Monitor
*/
get_header() ?>
<?php 
	$exact_search = urlencode($_POST['exact_search']);
	$any_search = $_GET['any'];
	$none_search = $_GET['none'];
	$type = $_POST['type']; 
?>
<?php $this_page_id=$wp_query->post->ID; ?>
	<div id="main-content" class="container">
		<section id="primary" class="col-sm-8 hfeed">
    		<?php get_breadcrumb(); ?>
			<?php the_post() ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content() ?>
			<div class="col-sm-12 text-center">
              <form class="form-inline txt-shadow" role="form" method="post" >
  				<div class="form-group">
    		<label class="sr-only" for="social-search">Search</label>
    		<input type="search" class="form-control col-sm-12" id="social_search" name="exact_search" placeholder="Search term...">
  			</div>
        <div class="form-group">
         	<select class="form-control" name="type"> 
  				<option selected value="all">all</option>
  				<option value="social">social sites</option>
  				<option value="image">Image sites</option>
 				<option value="news">News sites</option>
			</select>
         </div>
         <button type="submit" class="btn btn-info" onclick="_gaq.push(['_trackEvent', 'SMOR', 'submit', $_POST['exact_search']]);">Submit</button>
         
	</form>
            	<?php 
					if (!empty ($exact_search)) {
					$thritydays_ago_ts = strtotime(date("Y-m-d",(time() - 60*60*24*30)));
					include '../fc_single2014/social/call_apis.php';
					$decoded = json_decode($results_json);
					
					print "<h2>Results for " .$exact_search. " on ".$type." sites.</h2>";
					print '<p>Save results as an: <a href="rss.php?q='.$exact_search.'&any='.$any_search.'&none='.$none_search.'&t='.$type.'">RSS Feed</a>	</p>';
					
	foreach($decoded as $mydata) {
		$counter++;
		print "<div class='row well ". $mydata->id ."'>";
		print "<div class='col-sm-1'><strong>". $mydata->network ."</strong><br />";
		//print "<p><small><a href='".$mydata->user_url."'>".$mydata->user_name. "</a></small></p>";
		print "<p><a href='".$mydata->user_url."'><img src='".$mydata->user_img."' /></a></p>";
		print "</div>";
		print "<div class='col-sm-8'>";
			print "<h4><a href='" . $mydata->url . "'>" . $mydata->title . "</a></h4>";
			print "<p>" . $mydata->description . "</p>";
			print "<p><a href='" . $mydata->url . "'>" . $mydata->url . "</a></p>";
			print "<p><small>Posted on: ". date('l jS \of F Y h:i:s A',$mydata->timestamp) . " by <a href='".$mydata->user_url."'>". $mydata->user_name ."</a> via ".$mydata->source.".</small></p>";
		print "</div>";
		print "<div class='col-sm-3'><img src='". $mydata->image . "' class='img-responsive' /></div>";
		print "</div>";
	}
					} //if no query
?>
			</div><!-- *col-sm-12 -->
     		<div class="clearfix"></div>
            <?php edit_post_link(__('Edit this entry.', 'fcstandard2014'),'<p class="entry-edit">','</p>') ?>
		</section><!-- #primary col-sm-8 -->
    <?php get_sidebar() ?>
</div><!-- #main-content container -->
<?php get_footer() ?>
