<?php
if ( ! class_exists( 'Interactive_Onboarding_Tool_Edit' ) ) {
    class  Interactive_Onboarding_Tool_Edit {

        public function __construct(){
            $this->iot_display_plugin_setup_page();
           
        

        }

        public function iot_display_plugin_setup_page(){
            include_once( 'actions/iot-admin-actions.php' );
        }

       

        
    }
}

