<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ays-pro.com/
 * @since             1.0.0
 * @package           Gallery_Photo_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       Interactive Onboarding Tool
 * Description:       Create Options as admin side
 * Version:           1.0.0
 * Author:            Krishna Savan
 * Author URI:        https://www.linkedin.com/in/krishna-savani-60a131123/
 */

if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


/**
 * The main class.
 */

if( ! defined( 'IOT_PLUGIN_URL' ) ) {
    define( 'IOT_PLUGIN_URL', plugin_dir_url(__FILE__ ) );
}

if( ! defined( 'IOT_PLUGIN_DIR_PATH' ) )
    define( 'IOT_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

    if( ! defined( 'IOT_ROOT_PATH' ) )
    define( 'IOT_ROOT_PATH', __FILE__  );


    if(!defined('IOT_OPTIONS'))
	define('IOT_OPTIONS', 'interactive-onboarding-tool');
	

class Interactive_Onboarding_Tool{

    /**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Interactive_Onboarding_Tool    $loader    Maintains and registers all hooks for the plugin.
	 */
	public $loader;

	/**
	 * Currently plugin version.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * The name of the plugin.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $plugin_name = 'interactive-onboarding-tool';

	/**
	 * Plugin textdomain.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $domain = 'interactive-onboarding-tool';

	/**
	 * Plugin file.
	 *
	 * @var string
	 */
	private $file = __FILE__;

	/**
	 * Holds class object
	 *
	 * @var   object
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Initialize the SP_EASY_ACCORDION_FREE() class
	 *
	 * @since  2.0.0
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Interactive_Onboarding_Tool ) ) {
			self::$instance = new Interactive_Onboarding_Tool();
			self::$instance->setup();
		}
		return self::$instance;
	}


    	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 2.0.0
	 */
	public function setup() {
		$this->define_constants();
    
		$this->includes();
        $this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_common_hooks();

     
	
	
	}

	/**
	 * Define constant if not already set
	 *
	 * @since 2.0.0
	 *
	 * @param string      $name Define constant.
	 * @param string|bool $value Define constant.
	 */
	public function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Define constants
	 *
	 * @since 2.0.0
	 */
	public function define_constants() {
		$this->define( 'IOT_EA_VERSION', $this->version );
		$this->define( 'IOT_PLUGIN_NAME', $this->plugin_name );
		$this->define( 'IOT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'IOT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		$this->define( 'IOT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'IOT_PLUGIN_INCLUDES', IOT_PLUGIN_PATH . '/includes' );
	}

 
    private function define_admin_hooks() {
        $plugin_admin = new Interactive_Onboarding_Tool_Activator();
        register_activation_hook( 'IOT_ROOT_PATH', array($this,'activate_interactive_onboarding_tool' ));
        register_deactivation_hook( 'IOT_ROOT_PATH', array($this, 'deactivate_interactive_onboarding_tool' ));
       
        $this->loader->add_action( 'plugins_loaded', self::$instance ,  'activate_interactive_onboarding_tool');
		
	
        $this->loader->add_action('admin_menu', $plugin_admin, 'iot_settings_menu_page');
        $this->loader->add_action('admin_enqueue_scripts',  $plugin_admin ,'iot_admin_enqueue_style'  );
		// $this->loader->add_action( 'admin_init', $plugin_admin , 'iot_register_mysettings' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_nearest_clinician_data',  $plugin_admin ,'get_nearest_clinician_data' );
		$this->loader->add_action( 'wp_ajax_get_nearest_clinician_data',  $plugin_admin ,'get_nearest_clinician_data' );
		
      
		$this->loader->add_action( 'wp_ajax_nopriv_get_available_clinician_data',  $plugin_admin ,'get_available_clinician_data' );
		$this->loader->add_action( 'wp_ajax_get_available_clinician_data',  $plugin_admin ,'get_available_clinician_data' );

	}


	
	public function define_common_hooks(){
		$plugin_frontend = new Interactive_Onboarding_Tool_Frontend();
		$this->loader->add_action('wp_enqueue_scripts',  $plugin_frontend ,'iot_wp_enqueue_style'  );
		$this->loader->add_shortcode( 'IOT_Screeen', $plugin_frontend ,  'shortcode_interactive_onboarding_tool');
	}

    public function activate_interactive_onboarding_tool(){
        if(is_admin()){
            add_option("activated_IOT_options",IOT_OPTIONS);
         
        }
    }
    public function deactivate_interactive_onboarding_tool(){
        if(is_admin()){
            delete_option("activated_IOT_options",IOT_OPTIONS);
         
        }
    }
	public function includes() {

    require_once (IOT_PLUGIN_DIR_PATH . 'admin/class-interactive-onboarding-activator.php');
    require_once (IOT_PLUGIN_DIR_PATH . 'admin/class-interactive-onboarding-edit.php');
    require_once (IOT_PLUGIN_DIR_PATH . 'includes/class-action-filter-loader.php');
	require_once (IOT_PLUGIN_DIR_PATH . 'admin/actions/iot-admin-actions-setting.php');
	require_once (IOT_PLUGIN_DIR_PATH . 'public/iot-pubic-actions.php');

    }

    private function load_dependencies() {
        $this->loader = new IOT_Free_Loader;
	}

	public function run() {
    $this->loader->run();
    }
    



}


function iot_activate_class() {
	$plugin = Interactive_Onboarding_Tool::init();
	$plugin->loader->run();
}

iot_activate_class();


	