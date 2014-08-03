<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FreshClicks - Standard2014
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <span class="text-muted post-meta-date"><small>Published on <?php the_date('M d Y', '', ''); ?></small></span>
                    <header>
                        <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <span class="text-muted post-meta-author"><small>by <?php echo get_the_author_link(); ?> | <?php printf(__('Topics: %1$s', 'sandbox'), get_the_category_list(', '), get_the_tag_list('', ', ', '. ')) ?></small></span>
                    <div class="single-content">
                        <?php the_content('<span class="more-link">'.__('Read More', 'fcstandard2014').'</span>'); ?>
                        <?php link_pages('<div class="page-link">'.__('Pages: ', 'fcstandard2014'), "</div>\n", 'number'); ?>
                    </div>
</article><!-- #post -->
<div class="clearfix"></div>