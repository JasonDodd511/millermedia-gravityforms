<?php
/**
 * Plugin Name: Gravity Forms Quiz Groups
 * Depends: lib-modern-framework
 * Description: Extension features for the gravity forms quiz plugin that provides advanced insights.
 * Version: 0.1.2
 * Author: Kevin Carwile
 * Author URI:
 * GitHub Plugin URI: https://github.com/JasonDodd511/millermedia-gravityforms
 * GitHub Branch:     master
 * GitHub Languages:
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/* Load Only Once */
if ( ! class_exists( 'MillerMediaGravityFormsPlugin' ) )
{
	class MillerMediaGravityFormsPlugin
	{
		public static function init()
		{
			/* Plugin Core */
			$plugin	= \MillerMedia\GravityForms\Plugin::instance();
			$plugin->setPath( rtrim( plugin_dir_path( __FILE__ ), '/' ) );
			
			/* Plugin Settings */
			$settings = \MillerMedia\GravityForms\Settings::instance();
			$plugin->addSettings( $settings );
			
			/* Connect annotated resources to wordpress core */
			$framework = \Modern\Wordpress\Framework::instance()
				->attach( $plugin )
				//->attach( $settings )
				;
			
		}
		
		public static function status() {
			if ( ! class_exists( 'ModernWordpressFramework' ) ) {
				echo '<td colspan="3" class="plugin-update colspanchange">
						<div class="update-message notice inline notice-error notice-alt">
							<p><strong style="color:red">INOPERABLE.</strong> Please activate <a href="' . admin_url( 'plugins.php?page=tgmpa-install-plugins' ) . '"><strong>Modern Framework for Wordpress</strong></a> to enable the operation of this plugin.</p>
						</div>
					  </td>';
			}
		}
	}
	
	/* Autoload Classes */
	require_once 'vendor/autoload.php';
	
	/* Bundled Framework */
	if ( file_exists( __DIR__ . '/framework/plugin.php' ) ) {
		include_once 'framework/plugin.php';
	}

	/* Register plugin dependencies */
	include_once 'includes/plugin-dependency-config.php';
	
	/* Register plugin status notice */
	add_action( 'after_plugin_row_' . plugin_basename( __FILE__ ), array( 'MillerMediaGravityFormsPlugin', 'status' ) );
	
	/**
	 * DO NOT REMOVE
	 *
	 * This plugin depends on the modern wordpress framework.
	 * This block ensures that it is loaded before we init.
	 */
	if ( class_exists( 'ModernWordpressFramework' ) ) {
		MillerMediaGravityFormsPlugin::init();
	}
	else {
		add_action( 'modern_wordpress_init', array( 'MillerMediaGravityFormsPlugin', 'init' ) );
	}
	
}

