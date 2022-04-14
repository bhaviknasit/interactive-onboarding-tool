<?php 
    

    
    if(isset($_POST['submit_iot']) && $_GET['page'] == 'interactive_onboarding_tool'){
       
        $post_data['iot-option-group'] = $_POST['iot-option-group'];
        $post_data = maybe_serialize( $post_data);
        update_option('iot-option-group',$post_data);

     
    }
    ?>
 