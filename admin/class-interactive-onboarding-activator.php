<?php
if (!class_exists('Interactive_Onboarding_Tool_Activator'))
{
    class Interactive_Onboarding_Tool_Activator
    {

        public function iot_settings_menu_page()
        {
            add_menu_page('Interactive Onboarding Tool', 'IOT', 'manage_options', 'interactive_onboarding_tool', array(
                $this,
                'iot_settings_menu_fun'
            ));

        }

        public function iot_admin_enqueue_style()
        {

            wp_enqueue_style('admin_iot', IOT_PLUGIN_URL . 'admin/css/style.css');
            wp_enqueue_script('admin-iot', IOT_PLUGIN_URL . 'admin/js/custom.js', array() , '1.0.0', true);

        }

        public function iot_settings_menu_fun()
        {
            include_once ('actions/iot-admin-actions.php');
        }

        public function get_nearest_clinician_data()
        {
            $location_state = esc_html($_POST['location_state']);
            $consultation = esc_html($_POST['consultation']);
            $state = '';
            $location_html_code = '';
            global $wpdb;
            switch ($location_state)
            {
                case 'New Soth Wales':
                    $state = 'NSW';
                break;
                case 'Victoria':
                    $state = 'VIC';
                break;
                case 'Queensland':
                    $state = 'QLD';
                break;
                case 'South Australia':
                    $state = 'SA';
                break;
                case 'Tasmania':
                    $state = 'TAS';
                break;
                case 'Canberra':
                    $state = 'ACT';
                break;
                case 'Wastern Australia':
                    $state = 'WA';
                break;
                case 'Northern Territory':
                    $state = 'NT';
                break;
                default:
                    $state = 'NSW';
                break;

            }

            $term = get_term_by('name', $state, 'loc_state');

            $table_prefix = $wpdb->prefix;

            // $f2f_clinic_psychologist = $wpdb->get_results("SELECT post_id FROM `wp_postmeta` WHERE `meta_key` = 'consultation' AND `meta_value` = 'In-person (a face-to-face consultation)'");
            // $f2f_clinic_dr = array();
            // foreach( $f2f_clinic_psychologist as $f2f_clinic){
            // $f2f_clinic_dr[] = $f2f_clinic->post_id;
            // }
            // $locations = $wpdb->get_results("SELECT ID FROM `{$table_prefix}term_relationships` JOIN `{$table_prefix}posts` on `{$table_prefix}posts`.`ID` = `{$table_prefix}term_relationships`.`object_id` WHERE `term_taxonomy_id` = 26 and `{$table_prefix}posts`.`post_status` = 'publish'");
            

            // $located_area = array();
            // foreach($locations as $locate ){
            //      $available_psychologist = get_post_meta( $locate->ID , 'available_psychologist',true);
            //       if(isset( $available_psychologist)){
            //         foreach( $available_psychologist as $psychologist){
            //             if(in_array($psychologist , $f2f_clinic_dr )){
            //                 $located_area[] = $locate->ID;
            //             }
            //         }
            //     }
            // }
            // $nearest_clinician = array_unique($located_area);
            // advanced
            //  curerent
            $locations = $wpdb->get_results("SELECT ID FROM `{$table_prefix}term_relationships` JOIN `{$table_prefix}posts` on `{$table_prefix}posts`.`ID` = `{$table_prefix}term_relationships`.`object_id` WHERE `term_taxonomy_id` =  $term->term_id and `{$table_prefix}posts`.`post_status` = 'publish' and post_type='nvp_locations'");

            $location_html_code = "<div class='nearest_location_area_listed'>";
            foreach ($locations as $locate)
            {
                $address = get_post_meta($locate->ID, 'address', true);
                $phone_num = get_post_meta($locate->ID, 'phone_number', true);
                $fax_num = get_post_meta($locate->ID, 'fax_number', true);
                $working_hours = get_post_meta($locate->ID, 'hours_weekday', true);
                $map = get_post_meta($locate->ID, 'google_maps_meta', true);
                $hours_weekend = get_post_meta($locate->ID, 'hours_weekend', true);

                $location_html_code .= '<div class="wrap_locations">';
                $location_html_code .= '<div class="form-group"><input type="checkbox" name="nearest_clinicians[]" value="' . $locate->ID . '" id="' . get_the_title($locate->ID) . '"/><label for="' . get_the_title($locate->ID) . '"></label></div><div class="locations">
                    <h3> ' . get_the_title($locate->ID) . '</h3>
                    <p> <b><i> Address </i> </b> : ' . (!empty($address) ? $address : '') . '  </p>
                    <p> <b><i> Phone number </i> </b> :' . (!empty($phone_num) ? $phone_num : '') . ' </p>
                    <span> Working hours </span>
                    <div class="working_hrs"> <p> ' . (!empty($working_hours) ? '<b><i> week </i> </b> :' . $working_hours : '') . ' </p> <p>' . (!empty($hours_weekend) ? '<b><i> weekend </i> </b> :' . $hours_weekend : '') . ' </p>  </div>
                    <div class="connect_map"> <a href="' . (!empty($map) ? $map : '') . '" > <b> CONNECT WITH MAP </b> </a>  </div>
                  </div>
               </div>';

            }
            $location_html_code .= '</div>';

            echo $location_html_code;

            die;
        }

        public function get_available_clinician_data()
        {

            global $wpdb;

            $av_consultation = $_POST['av_consultation'];
            $av_location_area = $_POST['av_location_area'];
            $av_gender = $_POST['av_gender'];
            $av_who_treatment = $_POST['av_who_treatment'];
            $av_what_treatment = $_POST['av_what_treatment'];
            $av_language = $_POST['av_language'];
            $clinic_Data = $_POST['clinic'];
            $state = '';
            switch ($av_location_area)
            {
                case 'New Soth Wales':
                    $state = 'NSW';
                break;
                case 'Victoria':
                    $state = 'VIC';
                break;
                case 'Queensland':
                    $state = 'QLD';
                break;
                case 'South Australia':
                    $state = 'SA';
                break;
                case 'Tasmania':
                    $state = 'TAS';
                break;
                case 'Canberra':
                    $state = 'ACT';
                break;
                case 'Wastern Australia':
                    $state = 'WA';
                break;
                case 'Northern Territory':
                    $state = 'NT';
                break;
                default:
                    $state = 'NSW';
                break;

            }
            $term = get_term_by('name', $state, 'loc_state');
            $table_prefix = $wpdb->prefix;

            switch ($av_gender)
            {
                case 'Female clinician':
                    $av_gender_arr = array(
                        'female'
                    );
                break;
                case 'Male clinician':
                    $av_gender_arr = array(
                        'male'
                    );
                break;
                default:
                    $av_gender_arr = array(
                        'female',
                        'male'
                    );
                break;

            }
            $available_clinicians = array();
            foreach ($clinic_Data as $clinic)
            {
                $available_psychologist = get_post_meta($clinic, 'available_psychologist', true);
                foreach ($available_psychologist as $ac_psycho)
                {
                    $available_clinicians[] = $ac_psycho;
                }

            }

            $locations_common_data = $wpdb->get_results("SELECT ID FROM `{$table_prefix}term_relationships` JOIN `{$table_prefix}posts` on `{$table_prefix}posts`.`ID` = `{$table_prefix}term_relationships`.`object_id` WHERE `term_taxonomy_id` =  $term->term_id and `{$table_prefix}posts`.`post_status` = 'publish' and post_type='nvp_locations'");
            $common_data = $wpdb->get_results("SELECT t1.ID FROM `wp_posts` as t1 WHERE t1.`post_type`= 'nvp_psychologist' and t1.post_status= 'publish'");
            $exact_matches = array();
            $close_matches = array();
            $location_exact_data = array();
            $location_close_data = array();
            $location_others_data = array();
            $matches_count = array();
            $exact_matches_html = '';
            $close_matches = '';
            $others_consideration = '';
            $others_consideration = array();
            $i = 0;
            $matches_results_get = array();
            foreach ($common_data as $c_data)
            {
                $db_consultation = get_post_meta($c_data->ID, 'consultation', true);
                $db_location_area = get_post_meta($c_data->ID, 'clinician_loations', true);
                $db_gender = get_post_meta($c_data->ID, 'gender', true);
                $db_who_treatment = get_post_meta($c_data->ID, 'treatment_provide', true);
                $db_what_treatment = get_post_meta($c_data->ID, 'treatment_category', true);
                $db_language = get_post_meta($c_data->ID, 'clinician_languages', true);
                $available_psychologist = get_post_meta($c_data->ID, 'available_psychologist', true);

                    if ($av_consultation == 'In-person (a face-to-face consultation)')
                    {
                        if (trim($db_consultation) == trim($av_consultation) && in_array($db_gender, $av_gender_arr) && trim($db_who_treatment) == trim($av_who_treatment) && trim($db_what_treatment) == trim($av_what_treatment) && trim($db_language) == trim($av_language) && trim($db_location_area) == trim($av_location_area) && in_array($c_data->ID, $available_clinicians))
                        {
                            $exact_matches[] = $c_data->ID;
                        }

                    }
                    else
                    {
                        if (trim($db_consultation) == trim($av_consultation) && in_array($db_gender, $av_gender_arr) && trim($db_who_treatment) == trim($av_who_treatment) && trim($db_what_treatment) == trim($av_what_treatment) && trim($db_language) == trim($av_language) && trim($db_location_area) == trim($av_location_area))
                        {
                            $exact_matches[] = $c_data->ID;
                        }

                    }

                    if (trim($db_consultation) == trim($av_consultation)){ 
                        $matches_results_get[$c_data->ID]['consultation'] = 1;
                        $i++;
                    }

                    if (in_array($db_gender, $av_gender_arr)){
                        $matches_results_get[$c_data->ID]['gener'] = 1;
                        $i++;
                    }
                    if (trim($db_who_treatment) == trim($av_who_treatment)){
                        $matches_results_get[$c_data->ID]['av_who_treatment'] = 1;
                        $i++;
                    }
                    if (trim($db_what_treatment) == trim($av_what_treatment)){
                        $matches_results_get[$c_data->ID]['av_what_treatment'] = 1;
                        $i++;
                    }
                    if (trim($db_language) == trim($av_language)){
                        $matches_results_get[$c_data->ID]['av_language'] = 1;
                        $i++;
                    }
                    if (in_array($c_data->ID, $available_clinicians)){
                        $matches_results_get[$c_data->ID]['available_clinicians'] = 1;
                        $i++;
                    }

                    $matches_count[$c_data->ID] = $i;

                $i = 0;

            }

            $close_matches = array_filter($matches_count, function ($n){ return ($n == 5); });

            $others_consideration = array_filter($matches_count, function ($n){ return ($n == 3); });

            $exact_matches_html .= "<div class='exact_match_section'> <h3> Exact Matches: </h3>";
            foreach ($exact_matches as $exact_key => $exact_match){
                foreach ($clinic_Data as $clinic){
                    $available_cli = get_post_meta($clinic, 'available_psychologist', true);
                       if (in_array($exact_match, $available_cli)){
                        $location_exact_data[] = get_the_title($clinic);
                    }

                }

                $cat_data = $wpdb->get_col("SELECT `name` FROM `wp_term_relationships` join wp_terms on wp_terms.term_id = wp_term_relationships.term_taxonomy_id WHERE `object_id` = $exact_match");

                $clinican_link = get_permalink($exact_match);
                $clinican_img = wp_get_attachment_image_src(get_post_thumbnail_id($exact_match) , 'single-post-thumbnail');
                $clinican_title = get_the_title($exact_match);
                $exact_matches_html .= '<div class="col-xs-12 col-sm-3"><div class="pyschologist-block"><a href="' . $clinican_link . '" title="' . $clinican_title . '"><img src="' . $clinican_img[0] . '" data-spai="1" alt="' . $clinican_title . ', Counsellor" class="portrait thumbnail socially-awkward-large" width="133" height="160" itemprop="image" data-spai-upd="138"></a><h2 class="entry-title" itemprop="headline"><a href="' . $clinican_link . '" rel="bookmark" itemprop="url"><div class="read-plus"></div>' . $clinican_title . '</a><p></p>' . implode(",", $location_exact_data) . '<p>' . implode(",", $cat_data) . '</p><a class="book_now_url" href="">BOOK NOW</a></h2></div></div>';
            }
            $exact_matches_html .= "</div>";

            if (empty($exact_matches)){
                $exact_matches_html .= "<div class='notify_matches'>Sorry, We didn't find exact matches..you can checkout other matches here </div>";
            }

            $close_matches_html .= "<div class='close_match_section'> <h3> close Matches: </h3><div class='close_innerdiv_col'>";
            foreach ($close_matches as $close_key => $close_match){
                foreach ($locations_common_data as $loc_com_data){
                    $available_cli_close = get_post_meta($loc_com_data->ID, 'available_psychologist', true);
                    if (in_array($close_key, $available_cli_close)){
                        $location_close_data[] = get_the_title($loc_com_data->ID);
                    }
                }

                $cat_data = $wpdb->get_col("SELECT `name` FROM `wp_term_relationships` join wp_terms on wp_terms.term_id = wp_term_relationships.term_taxonomy_id WHERE `object_id` = $close_key");

                $clinican_link = get_permalink($close_key);
                $clinican_img = wp_get_attachment_image_src(get_post_thumbnail_id($close_key) , 'single-post-thumbnail');
                $clinican_title = get_the_title($close_key);
                $close_matches_html .= '<div class="col-xs-12 col-sm-3"><div class="pyschologist-block"><a href="' . $clinican_link . '" title="' . $clinican_title . '"><img src="' . $clinican_img[0] . '" data-spai="1" alt="' . $clinican_title . ', Counsellor" class="portrait thumbnail socially-awkward-large" width="133" height="160" itemprop="image" data-spai-upd="138"></a><h2 class="entry-title" itemprop="headline"><a href="' . $clinican_link . '" rel="bookmark" itemprop="url"><div class="read-plus"></div>' . $clinican_title . '</a><p>' . implode(",", array_unique($location_close_data)) . '</p><p>' . implode(",", $cat_data) . '</p><a class="book_now_url" href="">BOOK NOW</a></h2></div></div>';
            }
            $close_matches_html .= "</div></div>";

            $others_consideration_html .= "<div class='other_consideratiob_section'> <h2> Others consider: </h2><div class='others_consider_col'>";

            foreach ($others_consideration as $other_key => $others_consider) {
                
                foreach ($locations_common_data as $loc_com_data){
                    $available_cli_close = get_post_meta($loc_com_data->ID, 'available_psychologist', true);
                    if (in_array($close_key, $available_cli_close)){
                        $location_others_data[] = get_the_title($loc_com_data->ID);
                    }
                }

                $cat_data = $wpdb->get_col("SELECT `name` FROM `wp_term_relationships` join wp_terms on wp_terms.term_id = wp_term_relationships.term_taxonomy_id WHERE `object_id` = $other_key");

                $clinican_link = get_permalink($other_key);
                $clinican_img = wp_get_attachment_image_src(get_post_thumbnail_id($other_key) , 'single-post-thumbnail');
                $clinican_title = get_the_title($other_key);
                $others_consideration_html .= '<div class="col-xs-12 col-sm-3"><div class="pyschologist-block"><a href="' . $clinican_link . '" title="' . $clinican_title . '"><img src="' . $clinican_img[0] . '" data-spai="1" alt="' . $clinican_title . ', Counsellor" class="portrait thumbnail socially-awkward-large" width="133" height="160" itemprop="image" data-spai-upd="138"></a><h2 class="entry-title" itemprop="headline"><a href="' . $clinican_link . '" rel="bookmark" itemprop="url"><div class="read-plus"></div>' . $clinican_title . '</a><p></p>' . implode(",", $location_others_data) . '<p>' . implode(",", $cat_data) . '</p><a class="book_now_url" href="">BOOK NOW</a></h2></div></div>';
            }
            $others_consideration_html .= "</div></div>";

            $response = array();

            $headline = '<div class="headline"><h2> Here are your recommneded NVP clinicians </h2><p> Based on your preferences, we ahve found these matching profiles.To make a booking, click on the clinician\'s  <b>Book Now</b> button. </p></div>';
            $response['exact_match_html'] = $headline . "<div class='best_results_clinician'>" . $exact_matches_html . $close_matches_html . $others_consideration_html . "</div>";

            // print_r($close_matches);
            // echo "---";
            // print_r($exact_matches);
            // echo "---";
            // print_r($others_consideration);
            // echo "---";
            // print_r($matches_count);
            // echo "---";
            // print_r($matches_results_get);
            echo json_encode($response);

            die;
        }

    }

}
// new Interactive_Onboarding_Tool_Activator();

