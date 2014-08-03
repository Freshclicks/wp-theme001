<div class="comments">
<?php
	$req = get_settings('require_name_email'); // Checks if fields are required
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( ! empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
	<div class="nopassword"><?php _e('Enter the password to view comments to this post.', 'fcstandard2014') ?></div>
</div>
<?php
			return;
		endif;
	endif;
?>
<?php if ( $comments ) : ?>
<?php global $fcstandard2014_comment_alt ?>

<?php
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
	get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>

<?php if ( $comment_count ) : ?>
<?php $fcstandard2014_comment_alt = 0 ?>

	<h3 class="comment-header" id="numcomments"><?php printf(__($comment_count > 1 ? '%d Comments' : 'One Comment', 'fcstandard2014'), $comment_count) ?></h3>
	<ol id="comments" class="commentlist">
<?php foreach ($comments as $comment) : ?>
<?php if ( get_comment_type() == "comment" ) : ?>
		<li id="comment-<?php comment_ID() ?>" class="commentlist">
			<div class="comment-author vcard col-sm-2 text-muted"><small><?php fcstandard2014_commenter_link() ?> <?php _e('', 'fcstandard2014') ?></small></div>
			<?php if ($comment->comment_approved == '0') : ?><span class="unapproved"><?php _e('Your comment is awaiting moderation.', 'fcstandard2014') ?></span><?php endif; ?>
            <div class="">
			<?php comment_text() ?>
            </div>
			<div class="comment-meta">
				<?php printf(__('<small><span class="pull-right text-muted comment-datetime">%1$s at %2$s</span></small>', 'fcstandard2014'),
						get_comment_date('l, F j, Y'),
						get_comment_time(),
						'#comment-' . get_comment_ID() );
				?>
			</div>
		</li>

<?php endif; ?>
<?php endforeach; ?>

	</ol>

<?php endif; ?>

<?php if ( $ping_count ) : ?>
<?php $fcstandard2014_comment_alt = 0 ?>

	<h3 class="comment-header" id="numpingbacks"><?php printf(__($ping_count > 1 ? '%d Trackbacks/Pingbacks' : 'One Trackback/Pingback', 'fcstandard2014'), $ping_count) ?></h3>
	<ol id="pingbacks" class="commentlist">

<?php foreach ( $comments as $comment ) : ?>
<?php if ( get_comment_type() != "comment" ) : ?>

		<li id="comment-<?php comment_ID() ?>" class="commentlist">
			<div class="comment-meta"> 
				<?php printf(__('<span class="pingback-author fn">%1$s</span> <span class="pingback-datetime">on %2$s at %3$s</span>', 'fcstandard2014'),
					get_comment_author_link(),
					get_comment_date('l, F j, Y'),
					get_comment_time());
				?> <?php edit_comment_link(__('Edit', 'fcstandard2014'), '<span class="comment-edit"> | ', '</span>'); ?>
			</div>
			<?php if ($comment->comment_approved == '0') : ?><span class="unapproved"><?php _e('Your trackback/pingback is awaiting moderation.', 'fcstandard2014') ?></span><?php endif; ?>
			<?php comment_text() ?>
		</li>

<?php endif ?>
<?php endforeach; ?>

	</ol>

<?php endif ?>
<?php endif ?>

<?php if ( 'open' == $post->comment_status ) : ?>

	<h3 id="respond"><?php _e('Post a Comment', 'fcstandard2014') ?></h3>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<div id="mustlogin"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'fcstandard2014'),
			get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></div>

<?php else : ?>

	<div class="formcontainer">	

		<form role="form" id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

<?php if ( $user_ID ) : ?>

			<div id="loggedin"><?php printf(__('Logged in as <a href="%1$s" title="View your profile" class="fn">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'fcstandard2014'),
					get_option('siteurl') . '/wp-admin/profile.php',
					wp_specialchars($user_identity, true),
					get_option('siteurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></div>

<?php else : ?>

			<div id="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', 'fcstandard2014') ?> <?php if ($req) _e('Required fields are marked <span class="req-field">*</span>', 'fcstandard2014') ?></div>
			<div class="form-group">
    			<label for="author" class="col-lg-2 control-label"><?php _e('Name', 'fcstandard2014') ?> <?php if ($req) _e('<span class="req-field">*</span>', 'fcstandard2014') ?></label>
    			<div class="col-lg-10">
      				<input id="author" name="author" class="form-control" type="text" value="<?php echo $comment_author ?>" />
    			</div>
  			</div>
			<div class="form-group">
    			<label for="email" class="col-lg-2 control-label"><?php _e('Email', 'fcstandard2014') ?> <?php if ($req) _e('<span class="req-field">*</span>', 'fcstandard2014') ?></label>
    			<div class="col-lg-10">
      				<input id="email" name="email" class="form-control" type="text" value="<?php echo $comment_author_email ?>" />
    			</div>
  			</div>
			<div class="form-group">
    			<label for="url" class="col-lg-2 control-label"><?php _e('Website', 'fcstandard2014') ?></label>
    			<div class="col-lg-10">
      				<input id="url" name="url" class="form-control" type="text" value="<?php echo $comment_author_url ?>" />
    			</div>
  			</div>
<?php endif ?>
			<div class="form-group">
				<div class="form-label"><label for="comment"><?php _e('Comment', 'fcstandard2014') ?></label></div>
				<div class="form-textarea"><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" tabindex="6"></textarea></div>
			</div>
			<div class="form-submit"><input class="btn btn-default" id="submit" name="submit" type="submit" value="<?php _e('Submit comment', 'fcstandard2014') ?>" tabindex="7" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>

<?php do_action('comment_form', $post->ID); ?>

		</form>
	</div>

<?php endif ?>
<?php endif ?>

</div>