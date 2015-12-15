<?php

/**
 * Plugin Name: Google Apps Login Premium
 * Plugin URI: http://wp-glogin.com/
 * Description: Simple secure login and user management for Wordpress through your Google Apps domain (uses secure OAuth2, and MFA if enabled)
 * Version: 2.2
 * Author: Dan Lester
 * Author URI: http://wp-glogin.com/
 * License: Premium Paid per WordPress site and Google Apps domain
 * Network: true
 * Text Domain: google-apps-login
 * Domain Path: /lang
 * 
 * Do not copy or redistribute without authorization from author Lesterland Ltd (contact@wp-glogin.com)
 * 
 * You need to have purchased a license to install this software on one website, to be used in 
 * conjunction with a Google Apps domain containing the number of users you specified when you
 * purchased this software.
 * 
 * You are not authorized to use or distribute this software beyond the single site license that you
 * have purchased.
 * 
 * You must not remove or alter any copyright notices on any and all copies of this software.
 * 
 * Please report violations to contact@wp-glogin.com
 * 
 * Copyright Lesterland Ltd, registered company in the UK number 08553880
 * 
 */

require_once( plugin_dir_path(__FILE__).'/core/core_google_apps_login.php' );

class premium_google_apps_login extends core_google_apps_login {
	
	protected $PLUGIN_VERSION = '2.2';
	
	// Singleton
	private static $instance = null;
	
	public static function get_instance() {
		if (null == self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	protected function __construct() {
		parent::__construct();
		register_activation_hook($this->my_plugin_basename(), array( $this, 'ga_activation_hook' ) );
	}
	
	public function ga_activation_hook($network_wide) {
		// Inherit settings from basic version?
		// Save settings if we changed them
		$new_option = get_site_option($this->get_options_name());
		
		if (!$new_option){
			$old_option = get_site_option('galogin');
			if ($old_option && is_array($old_option)) {
				$new_option = Array();
				$default_options = $this->get_default_options();
				foreach ($default_options as $k => $v) {
					$new_option[$k] = isset($old_option[$k]) ? $old_option[$k] : $v;
				}
				add_site_option($this->get_options_name(), $new_option);
			}
		}
	}
	
	protected function checkRegularWPLogin($user, $username, $password, $options) {
		if (!empty($username) || !empty($password)) {
			// Should we allow this user login to continue?
			// Don't enforce if Google Login not configured
			if ($options['ga_disablewplogin'] && $options['ga_clientid'] != '' && $options['ga_clientsecret'] != '') {
				// Halt if user is on our domain
				$tryuser = get_user_by('login', $username);
				if ($tryuser && isset($tryuser->user_email)) {
					$email = $tryuser->user_email;
			
					$domain_list = $this->split_domainslist($options['ga_domainname']);
			
					$parts = explode("@", $email);
					if (count($parts) == 2) { // Pretty likely since got it from WP
						if (in_array(strtolower($parts[1]), $domain_list)) {
							$user = new WP_Error('ga_login_error', 
									sprintf(__('User with email address %s must use Login with Google', 'google-apps-login'),
											 $email) );
							// We do not want password check any more
						}
					}
				}
			}
		}
		return $user;
	}
	
	protected function checkRegularWPError($user, $username, $password) {
		if (!empty($username) || !empty($password)) {
			// Need to redirect back to wp-login.php?error=
			// to ensure regular WP auth will not override our error
			// with a successful username/password login
			$errarray = Array('error' => urlencode($user->get_error_message()));
			wp_redirect( add_query_arg( $errarray, site_url('wp-login.php')) );
			exit;
		}	
	}
	
	protected function createUserOrError($userinfo, $options) {
		$user = null;
		$google_email = $userinfo['email'];
		
		if (!$options['ga_autocreate']) {
			return new WP_Error('ga_login_error', 
								 sprintf( __('User %s does not exist', 'google-apps-login'),
								 		$google_email));
		}
		
		$domain_list = $this->split_domainslist($options['ga_domainname']);
		
		$parts = explode("@", $google_email);
		if (count($parts) != 2) {
			// Pretty unlikely since got it from Google
			$user = new WP_Error('ga_login_error', __('Invalid email address', 'google-apps-login'));
		} else {
			if (in_array(strtolower($parts[1]), $domain_list)) {
				// Yes, create user
				$user = $this->createUser($userinfo, $parts, $options);
			}
			else {
				$user = new WP_Error('ga_login_error', 
						sprintf( __('Email address needs to be in %s', 'google-apps-login'), 
								implode(', ', $domain_list) )
						.' ('
						.sprintf( __( '%s not authorized', 'google-apps-login' ),
								$google_email). ')'
										);
			}
		}
		return $user;
	}
	
	protected function createUser($userinfo, $parts, $options) {
		if (!function_exists('wp_insert_user')) {
			include 'wp-includes/registration.php';
		}

		/* $userinfo example: 
			"name": "Dan Lester",
			"given_name": "Dan",
			"family_name": "Lester",
			"link": "https://plus.google.com/115886881859296909934"
		*/
		
		$wpuserdata = Array(
			'user_login' => $userinfo['email'], // May need to de-dupe
			// 'user_nicename' - WP defaults to sanitize_title(user_login)
			'user_pass' => wp_generate_password(12, false),
			'user_email' => $userinfo['email'], // Should be unique since didn't match existing user
			'display_name' => empty($userinfo['name']) ? false : $userinfo['name'],
			// 'nickname' - WP defaults to username
			'first_name' => empty($userinfo['given_name']) ? false : $userinfo['given_name'],
			'last_name' => empty($userinfo['family_name']) ? false : $userinfo['family_name'],
			'user_url' => empty($userinfo['link']) ? false : $userinfo['link'],
			'role' => $options['ga_defaultrole']
		);
		
		$user_id = wp_insert_user($wpuserdata);
		
		if (is_wp_error($user_id)) {
			return $user_id;
		}
		return get_user_by('id', $user_id);
	}
	
	// ADMIN AND OPTIONS
	// *****************
	
	protected function ga_admin_init_domain() {
		add_settings_section('galogin_domain_section', __('Domain Control', 'google-apps-login'),
		array($this, 'ga_domainsection_text'), $this->get_options_name());
	
		add_settings_field('ga_domainname', __('My Google Apps domain', 'google-apps-login'),
		array($this, 'ga_do_settings_domainname'), $this->get_options_name(), 'galogin_domain_section');
		add_settings_field('ga_autocreate', __('Auto-create new users on my domain', 'google-apps-login'),
		array($this, 'ga_do_settings_autocreate'), $this->get_options_name(), 'galogin_domain_section');
		add_settings_field('ga_disablewplogin', __('Disable WordPress username/password login for my domain', 'google-apps-login'),
		array($this, 'ga_do_settings_disablewplogin'), $this->get_options_name(), 'galogin_domain_section');
		add_settings_field('ga_defaultrole', __('Default role for new Google users', 'google-apps-login'),
		array($this, 'ga_do_settings_defaultrole'), $this->get_options_name(), 'galogin_domain_section');
	}
	
	public function ga_domainsection_text() {
		echo '<p>';
		_e( 'By default, any existing account can authenticate either via Google (if a Gmail/Google Apps account), or by WordPress username/password.', 'google-apps-login');
		echo ' ';
		_e( 'To allow special behaviour on your Google Apps domain (auto-create users who don\'t yet exist, or disable regular WordPress username/password access for your users), fill in the following section.', 'google-apps-login');
		echo '</p> <p>';
		sprintf( __( 'Please read the <a href="%s" target="gainstr">instructions here</a> first.' , 'google-apps-login'), $this->calculate_instructions_url('d').'#domaincontrol' );
		echo '</p>';
	}
	
	public function ga_do_settings_domainname() {
		$options = $this->get_option_galogin();
		echo "<input id='input_ga_domainname' name='".$this->get_options_name()."[ga_domainname]' size='40' type='text' value='{$options['ga_domainname']}' />";
	}

	public function ga_do_settings_autocreate() {
		$options = $this->get_option_galogin();
		echo "<input id='input_ga_autocreate' name='".$this->get_options_name()."[ga_autocreate]' type='checkbox' ".($options['ga_autocreate'] ? 'checked' : '')." />";
	}
	
	public function ga_do_settings_disablewplogin() {
		$options = $this->get_option_galogin();
		echo "<input id='input_ga_disablewplogin' name='".$this->get_options_name()."[ga_disablewplogin]' type='checkbox' ".($options['ga_disablewplogin'] ? 'checked' : '')." />";
		echo '<div>';
		_e( 'Tick with caution - leave unchecked until you are confident Google Login is working for your own admin account' , 'google-apps-login');
		echo '</div>';
	}
	
	public function ga_do_settings_defaultrole() {
		$options = $this->get_option_galogin();
		echo "<select name='".$this->get_options_name()."[ga_defaultrole]' id='ga_defaultrole'>";
		wp_dropdown_roles( $options['ga_defaultrole'] );
		echo "</select>";
	}
	
	public function ga_options_validate($input) {
		$newinput = parent::ga_options_validate($input);
		
		$newinput['ga_domainname'] = trim($input['ga_domainname']);
		if(!preg_match('/^(([0-9a-z-]+\.)?[0-9a-z-]+\.[a-z]{2,7}([ ,]*))*$/', $newinput['ga_domainname'])) {
			add_settings_error(
			'ga_domainname',
			'invalid_domains',
			self::get_error_string('ga_domainname|invalid_domains'),
			'error'
					);
		}
		$newinput['ga_autocreate'] = isset($input['ga_autocreate']) ? $input['ga_autocreate'] : false;
		$newinput['ga_disablewplogin'] = isset($input['ga_disablewplogin']) ? $input['ga_disablewplogin'] : false;
		
		$newinput['ga_defaultrole'] = isset($input['ga_defaultrole']) && !is_null(get_role($input['ga_defaultrole'])) 
			? $input['ga_defaultrole'] 
			: get_option('default_role');
		
		return $newinput;
	}
	
	protected function get_error_string($fielderror) {
		$premium_local_error_strings = Array(
				'ga_domainname|invalid_domains' => __('Domain name should be a space-separated list of valid domains, in lowercase letters (or blank)', 'google-apps-login')
		);
		if (isset($premium_local_error_strings[$fielderror])) {
			return $premium_local_error_strings[$fielderror];
		}
		return parent::get_error_string($fielderror);
	}

	protected function get_options_menuname() {
		return 'galogin_list_premium';
	}
	
	protected function get_options_pagename() {
		return 'galogin_premium';
	}
	
	protected function get_options_name() {
		return 'galogin_premium';
	}
	
	protected function get_default_options() {
		return array_merge( parent::get_default_options(), 
			Array('ga_domainname' => '',
				  'ga_autocreate' => false,
				  'ga_disablewplogin' => false,
				  'ga_defaultrole' => get_option('default_role')) );
	}
	
	protected function get_wpglogincom_baseurl() {
		return 'http://wp-glogin.com/google-apps-login-premium/premium-setup/';
	}

	// AUX FUNCTIONS
	
	private function split_domainslist($listtext) {
		$outdomains = Array();
		$indomains = preg_split('/[, ]+/', $listtext);
		foreach ($indomains as $domain) {
			$domain = trim($domain);
			if (preg_match('/^([0-9a-z-]+\.)+[a-z]{2,7}$/', $domain)) {
				$outdomains[] = $domain;
			}
		}
		return $outdomains;
	}
	
	public function my_plugin_basename() {
		$basename = plugin_basename(__FILE__);
		if ('/'.$basename == __FILE__) { // Maybe due to symlink
			$basename = basename(dirname(__FILE__)).'/'.basename(__FILE__);
		}
		return $basename;
	}
	
}

// Global accessor function to singleton
function GoogleAppsLogin() {
	return premium_google_apps_login::get_instance();
}

// Initialise at least once
GoogleAppsLogin();

?>
