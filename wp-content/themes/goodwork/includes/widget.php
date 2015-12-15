<?php

//Add an action that will load all widgets
add_action( 'widgets_init', 'rb_load_widgets' );

//Function that registers the widgets
function rb_load_widgets() {
	register_widget('rb_email_widget');
	register_widget('rb_phone_widget');
}

/*-----------------------------------------------------------------------------------

	Plugin Name: RB Email Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that displays your email address
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_email_widget extends WP_Widget {
	
	function rb_email_widget (){
		
		$widget_ops = array( 'classname' => 'email', 'description' => 'A widget that displays your email address' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'email-widget' );
		$this->WP_Widget( 'email-widget', 'Krown Email Widget', $widget_ops, $control_ops );
		
	}
		
	function widget($args, $instance){
			
		extract($args);
			
		$email = $instance['email'];
			
		echo $before_widget;

		echo '<a href="mailto:' . $email . '"><i class="krown-icon-email"></i>' . $email . '</a>';

		echo $after_widget;
			
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		$instance['email'] = strip_tags($new_instance['email']);
			
		return $instance;
			
	}
		
	function form($instance){
		
		$defaults = array(  'email' => '' );
			
		$instance = wp_parse_args((array) $instance, $defaults);
			
		?>
			
			
			<p>
				<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email Address:', 'goodwork'); ?></label>
				<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
			</p>
			
		<?php
			
	}
		
}

/*-----------------------------------------------------------------------------------

	Plugin Name: RB Phone Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that displays your phone number
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_phone_widget extends WP_Widget {
	
	function rb_phone_widget (){
		
		$widget_ops = array( 'classname' => 'phone', 'description' => 'A widget that displays your phone number' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'phone-widget' );
		$this->WP_Widget( 'phone-widget', 'Krown Phone Widget', $widget_ops, $control_ops );
		
	}
		
	function widget($args, $instance){
			
		extract($args);
			
		$phone = $instance['phone'];
		$phone_to_call = $instance['phone_to_call'];
			
		echo $before_widget;

		echo '<a href="tel:' . $phone_to_call . '"><i class="krown-icon-phone-1"></i>' . $phone . '</a>';

		echo $after_widget;
			
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['phone_to_call'] = strip_tags($new_instance['phone_to_call']);
			
		return $instance;
			
	}
		
	function form($instance){
		
		$defaults = array(  'phone' => '', 'phone_to_call' => '' );
			
		$instance = wp_parse_args((array) $instance, $defaults);
			
		?>
			
			
			<p>
				<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Phone Number(to display):', 'goodwork'); ?></label>
				<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'phone_to_call' ); ?>"><?php _e('Phone Number(to call):', 'goodwork'); ?></label>
				<input id="<?php echo $this->get_field_id( 'phone_to_call' ); ?>" name="<?php echo $this->get_field_name( 'phone_to_call' ); ?>" value="<?php echo $instance['phone_to_call']; ?>" style="width:100%;" />
			</p>
			
		<?php
			
	}
		
}

?>