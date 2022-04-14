<?php
   if (! defined('ABSPATH')) {
    die();
}


if ( ! class_exists( 'Interactive_Onboarding_Tool_Frontend' ) ) {
    class  Interactive_Onboarding_Tool_Frontend {
    
        public function  iot_wp_enqueue_style(){

            wp_enqueue_style( 'form_style',  IOT_PLUGIN_URL. 'public/css/form-style.css' );

            wp_enqueue_script( 'public_iot_jquery',  'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js',array(), '1.0.0', true  );
            wp_enqueue_script( 'public_iot_custom_jquery',   IOT_PLUGIN_URL. 'public/js/custom.js' ,array(), '1.0.0', true  );
            wp_enqueue_script( 'public_iot_jquery_easying',  'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',array(), '1.0.0', true  );
          
          
        }

         
        public function shortcode_interactive_onboarding_tool($attr){
            
            return include (IOT_PLUGIN_DIR_PATH . 'public/iot-frontend.php');
        }

  

    }

} 
        

?>
