<?php
/**
 * Comments template
 */
?>

<?php if ( post_password_required() ) : ?>
	<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'goodwork' ); ?></p>
<?php
		return;
	endif;
?>

	<div id="comments">
	
		<?php if ( have_comments() ) : ?>
		
			<h3 id="comments-title" class="icon-none closed" data-show="<?php _e( 'Show Comments', 'goodwork' ); ?>" data-hide="<?php _e( 'Hide Comments', 'goodwork' ); ?>" data-no="<?php echo get_comments_number();?>"><?php _e( 'Show Comments', 'goodwork' ); ?> (<?php echo get_comments_number();?>)</h3>

		<?php else : 

			if ( ! comments_open() ) {
				
				_e( 'Comments are closed.', 'goodwork' );

			} else { ?>

				<h3 id="comments-title" class="icon-none closed" data-show="<?php _e( 'Show Comments', 'goodwork' ); ?>" data-hide="<?php _e( 'Hide Comments', 'goodwork' ); ?>" data-no="0"><?php _e( 'Show Comments', 'goodwork' ); ?> (0)</h3>

			<?php }

		?>

		<?php endif; ?>

		<div id="commentsShow" class="hidden">

			<?php if ( ! have_comments() ) : ?>

				<p style="margin:35px 0"><?php _e( 'There are not comments on this post yet. Be the first one!', 'goodwork' ); ?></p>

			<?php endif; ?>

			<ol id="singlecomments" class="commentlist"><?php wp_list_comments( array( 'callback' => 'krown_comment' ) ); ?></ol>

			<div class="comment-form-wrapper">

			<?php 
			
			 $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="column_container span4 ffirst"><label for="autor">' . __('Name', 'goodwork') . '<span> ' . __(' (required)', 'goodwork') . '</span></label><input id="author" name="author" type="text" value=""/></div>',
				'email'  => '<div class="column_container span4"><label for="email">' . __('Email', 'goodwork') . '<span> ' . __(' (required)', 'goodwork') . '</span></label><input id="email" name="email" type="text" value="" /></div>',
				'url'    => '<div class="column_container span4 flast"><label for="url">' . __('Website', 'goodwork') . '<span> ' . __(' (optional)', 'goodwork') . '</span></label><input id="url" name="url" type="text" value="" /></div>' ) ),
				'comment_field' => '<div class="column_container span12 ffirst flast"><label for="comment">' . __('Your Message', 'goodwork') . '<span> ' . __(' (required)', 'goodwork') . '</span></label><textarea id="comment" name="comment" rows="8"></textarea></div>',
				'must_log_in' => '<p style="margin-bottom:25px" class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'goodwork' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as' => '<p style="margin-bottom:25px" class="logged-in-as">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'goodwork' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'id_form' => 'comment-form',
				'id_submit' => 'submit',
				'title_reply' => __( 'Add Your Comment', 'goodwork' ),
				'title_reply_to' => __( 'Leave a Reply to %s', 'goodwork' ),
				'cancel_reply_link' => __( 'Cancel reply', 'goodwork' ),
				'label_submit' => __( 'Submit', 'goodwork' ),
			); 
			
			comment_form($defaults); 
			
			?>

			</div>

		</div>	
		
	</div>

<?php

	/* This is the function which filters the comments */

	function krown_comment( $comment, $args, $depth ) {

		global $retina;
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment clearfix">

			<?php $av_size = isset( $retina ) && $retina === 'true' ? 96 : 48; ?>
			
			<div class="user"><?php echo get_avatar( $comment, $av_size, $default=''); ?></div>

			<div class="message">
				
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3 ) ) ); ?>

				<div class="info">
					<h4><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?></h4>
					<span class="meta"><?php echo comment_date('F jS, Y \a\t g:i A'); ?></span>
				</div>

				<?php comment_text(); ?>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'goodwork' ); ?></em>
				<?php endif; ?>

			</div>

		</li>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'goodwork' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'goodwork'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
		
	}

?>