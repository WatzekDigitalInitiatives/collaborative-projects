<?php
/**
 * The footer of the theme
 */
global $sidebar;

?>

		</article>

		<!-- Content Wrapper End -->

		<!-- Sidebars -->

		<?php if ( $sidebar['sidebar_type'] == 'left-sidebar' && is_active_sidebar( $sidebar['sidebar_id'] ) ) : ?>

			<aside id="sidebarLeft" class="sidebar clearfix">
				<?php dynamic_sidebar( $sidebar['sidebar_id'] ); ?>
			</aside>

		<?php elseif ( $sidebar['sidebar_type'] == 'right-sidebar' && is_active_sidebar( $sidebar['sidebar_id'] ) ) : ?>

			<aside id="sidebarRight" class="sidebar clearfix">
				<?php dynamic_sidebar( $sidebar['sidebar_id'] ); ?>
			</aside>

		<?php endif; 

			if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && is_active_sidebar( 'rb_shop_widget' ) ) : ?>

			<aside id="sidebarBottom" class="sidebar clearfix">
				<div class="row-fluid">
            		<?php dynamic_sidebar( 'rb_shop_widget' ); ?>
           		</div>
			</aside>

		<?php endif; ?>

	</div>

	<!-- Main Wrapper End -->

	<!-- Footer #1 Wrapper Start -->

	<?php if(get_option('rb_o_ftrtype') == 'full') : ?>

	<footer id="footer1" class="clearfix">

		<div class="row-fluid">

			<?php if( get_option( 'rb_o_ftrareas' ) == 'four' ) : ?>

				<div class="column_container span3">
					<?php if ( is_active_sidebar( 'rb_footer_widget_1' ) )
						dynamic_sidebar( 'rb_footer_widget_1' ); ?>
				</div>

				<div class="column_container span3 clearfix">
					<?php if ( is_active_sidebar( 'rb_footer_widget_2' ) )
						dynamic_sidebar( 'rb_footer_widget_2' ); ?>
				</div>

				<div class="column_container span3 clearfix">
					<?php if ( is_active_sidebar( 'rb_footer_widget_3' ) )
						dynamic_sidebar( 'rb_footer_widget_3' ); ?>
				</div>

				<div class="column_container span3">
					<?php if ( is_active_sidebar( 'rb_footer_widget_4' ) )
						dynamic_sidebar( 'rb_footer_widget_4' ); ?>
				</div>

			<?php elseif ( get_option( 'rb_o_ftrareas' ) == 'three' ) : ?>

				<div class="column_container span4">
					<?php if ( is_active_sidebar('rb_footer_widget_1' ) )
						dynamic_sidebar( 'rb_footer_widget_1' ); ?>
				</div>

				<div class="column_container span4 clearfix">
					<?php if ( is_active_sidebar( 'rb_footer_widget_2' ) )
						dynamic_sidebar( 'rb_footer_widget_2' ); ?>
				</div>

				<div class="column_container span4">
					<?php if ( is_active_sidebar( 'rb_footer_widget_3' ) )
						dynamic_sidebar( 'rb_footer_widget_3' ); ?>
				</div>

			<?php elseif ( get_option( 'rb_o_ftrareas' ) == 'two' ) : ?>

				<div class="column_container span6">
					<?php if ( is_active_sidebar( 'rb_footer_widget_1' ) )
						dynamic_sidebar( 'rb_footer_widget_1' ); ?>
				</div>

				<div class="column_container span6">
					<?php if ( is_active_sidebar( 'rb_footer_widget_2' ) )
						dynamic_sidebar( 'rb_footer_widget_2' ); ?>
				</div>

			<?php elseif ( get_option( 'rb_o_ftrareas' ) == 'one' ) : ?>

				<div class="column_container span12">
					<?php if ( is_active_sidebar( 'rb_footer_widget_1' ) )
						dynamic_sidebar( 'rb_footer_widget_1' ); ?>
				</div>

			<?php endif; ?>

		</div>

    </footer>

    <?php endif; ?>

	<!-- Footer #1 Wrapper End -->

	<!-- Footer #2 Wrapper Start -->

	<footer id="footer2" class="clearfix">

		<div class="clearfix">

			<div class="left clearfix">
				<?php if ( is_active_sidebar( 'rb_footer_widget_5' ) )
					dynamic_sidebar( 'rb_footer_widget_5' ); ?>
			</div>

			<div class="right clearfix">
				<?php if ( is_active_sidebar('rb_footer_widget_6' ) )
					dynamic_sidebar( 'rb_footer_widget_6' ); ?>
			</div>

		</div>

    </footer>

	<!-- Footer #2 Wrapper End -->

	<div id="oldie">
		<p><?php _e( 'This is a unique website which will require a more modern browser to work!', 'goodwork' ); ?>
		<a href="https://www.google.com/chrome/" target="_blank"><?php _e( 'Please upgrade today!', 'goodwork' ); ?></a>
		</p>
	</div>

	<?php wp_footer(); ?>

</body>
</html>