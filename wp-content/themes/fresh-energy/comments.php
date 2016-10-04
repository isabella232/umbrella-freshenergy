<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>

			<section id="comments">
				<header>
					<h3>
						<a href="#comment-form">Add a comment</a>
						<?php echo count($comments) ?> comment<?php echo (count($comments))!=1?'s':'' ?>
					</h3>
				</header>
				
				<ol class="comment-list">
				<?php foreach ($comments as $comment) : ?> 
	
					<li id="comment-<?php comment_ID() ?>">
						<div class="meta">
							<cite><?php comment_author_link() ?></cite>
							<p class="date"><?php comment_date('m.d.Y') ?></p>
						</div>
						<div class="comment">
							<?php if ($comment->comment_approved == '0') : ?> 
							<em>Your comment is awaiting moderation.</em>
							<?php endif; ?>
							<?php comment_text() ?>
						</div>
					</li>
	
	
				<?php endforeach; /* end for each comment */ ?>
				</ol>
	
			</section> 
<?php else : // this is displayed if there are no comments so far ?>
	
	<section id="comments">
		<h3>Leave a comment</h3>
	</section>
	<br />
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->

	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>

			<section id="comment-form">
	
				<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
				</div>

				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<div class="input text">You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.
				</div>
				<?php else : ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

				<?php if ( is_user_logged_in() ) : ?>

				<div class="input text">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a>
				</div>

				<?php else : ?>

				<div class="input text">
					<label for="author">Name</label>
					<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="30" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="styled" />
				</div>

				<div class="input text">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="30" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="styled" />
				</div>

				<div class="input text">
					<label for="url">Website</label>
					<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="30" tabindex="3" class="styled" />
				</div>

				<?php endif; ?>

				<!--<p><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

				<div class="input textarea">
					<label for="comment">Comments</label>
					<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
				</div>
				<div class="input submit">
					<input type="submit" value="Add Comment" />
					<?php comment_id_fields(); ?>
				</div>	
				<?php do_action('comment_form', $post->ID); ?>

				</form>

			<?php endif; // If registration required and not logged in ?>
			</section>

<?php endif; // if you delete this the sky will fall on your head ?>
