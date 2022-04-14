<?php

$options_data = get_option('iot-option-group');
$options_data = maybe_unserialize($options_data);
$screens = $options_data['iot-option-group']['screens'];
$screen1 = $options_data['iot-option-group']['screen1'];
$screen1_options = $options_data['iot-option-group']['screen1']['options'];
$screen2 = $options_data['iot-option-group']['screen2'];
$screen2_options = $options_data['iot-option-group']['screen2']['options'];
$screen4 = $options_data['iot-option-group']['screen4'];
$screen4_options = $options_data['iot-option-group']['screen4']['options'];

$screen5 = $options_data['iot-option-group']['screen5'];
$screen5_options = $options_data['iot-option-group']['screen5']['options'];

$screen6 = $options_data['iot-option-group']['screen6'];
$screen6_options = $options_data['iot-option-group']['screen6']['options'];

$screen7 = $options_data['iot-option-group']['screen7'];

$screen8 = $options_data['iot-option-group']['screen8'];
$screen8_options = $options_data['iot-option-group']['screen8']['options'];


if(!empty($screens)){
    if(in_array('screen1_off' , $screens)) { $scren1_chk = "checked"; } else { $scren1_chk = "" ; }
}

if(!empty($screens)){
   if(in_array('screen2_off' , $screens)) { $scren2_chk = "checked"; } else { $scren2_chk = "" ; }
}

if(!empty($screens)){
    if(in_array('screen4_off' , $screens)) { $scren4_chk = "checked"; } else { $scren4_chk = "" ; }
}

if(!empty($screens)){
    if(in_array('screen5_off' , $screens)) { $scren5_chk = "checked"; } else { $scren5_chk = "" ; }
}

if(!empty($screens)){
    if(in_array('screen6_off' , $screens)) { $scren6_chk = "checked"; } else { $scren6_chk = "" ; }
}

if(!empty($screens)){
    if(in_array('screen7_off' , $screens)) { $scren7_chk = "checked"; } else { $scren7_chk = "" ; }
}

if(!empty($screens)){
    if(in_array('screen8_off' , $screens)) { $scren8_chk = "checked"; } else { $scren8_chk = "" ; }
}

$html_code = '';

$html_code .= ' <div class="container_form">
<div class="form-outer">
<div class="progress-bar"> 
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
    <div class="step"><p></p><div class="bullet"><span></span></div><div class="check fas fa-check"></div></div>
</div>
<form id="idClinics"  action=""  method="post" enctype="multipart/form-data">';



if (isset($screen1))
{
    $a = 1;
    $html_code .= '<div class="page slide-page" id="f_screen1">';
                        $html_code .= '<h2 class="fs-title">' . stripslashes($screen1['title']) . '</h2>';
                        $html_code .= '<h3 class="fs-subtitle">' . stripslashes($screen1['description']) . '</h3>';
                        foreach ($screen1_options as $scrn1){
                            $scre1_label = strtolower($scrn1);
                            $html_code .= '<div class="form-group"><input type="checkbox" id="' . $scre1_label . '" name="' . stripslashes($scrn1) . '" value="' . stripslashes($scrn1) . '"><label for="' . $scre1_label . '">' . stripslashes($scrn1) . '</label></div>';
                        }
                        $html_code .= '<div class="field"><button class="firstNext next">Next</button></div>
                        </div>';
}

if (isset($screen2))
{
    $b = 1;
                    $html_code .= ' <div class="page" id="f_screen2">';
                    $html_code .= '<h2 class="fs-title">' .stripslashes ($screen2['title']) . '</h2>';
                    $html_code .= '<h3 class="fs-subtitle">' .stripslashes( $screen2['description']) . '</h3>';
                    foreach ($screen2_options as $scrn2){
                        $scre2_label = strtolower($scrn2);
                        $html_code .= '<div class="form-group"><input type="checkbox" id="' . $scre2_label . '" name="' . $scrn2 . '" value="' . $scrn2 . '"><label for="' . $scre2_label . '">' . $scrn2 . '</label></div>';
                    }
                    $html_code .= '<div class="field btns"><button class="prev-1 prev">Previous</button><button class="next-1 next">Next</button>  <button class="submit_locations hide next">Next</button></div>
                    </div>';
}


                    $html_code .= '<div class="page hide" id="f_screen3">
                                        <h2 class="fs-title">Nearest Clinician</h2>
                                        <div id="get_nearest_locations_data" class="scrollbar"></div>
                                        <div class="field btns">
                                        <button class="prev-3 prev">Previous</button>
                                        <button class="next-3 next">Next</button>
                                        </div>
                                    </div>';



if (isset($screen4))
{
    $a = 1;
                    $html_code .= '<div class="page" id="f_screen4">';
                    $html_code .= '<h2 class="fs-title">' . stripslashes($screen4['title']) . '</h2>';
                    $html_code .= '<h3 class="fs-subtitle">' . stripslashes($screen4['description']) . '</h3>';
                    foreach ($screen4_options as $scrn4){
                        $scre4_label = strtolower($scrn4);
                        $html_code .= '<div class="form-group"><input type="checkbox" id="' . stripslashes($scre4_label) . '" name="' . stripslashes($scrn4) . '" value="' . stripslashes($scrn4) . '"><label for="' . stripslashes($scre4_label) . '">' . stripslashes($scrn4) . '</label></div>';
                    }
                    $html_code .= '<div class="field btns">
                                    <button class="prev-4 prev">Previous</button>
                                    <button class="next-4 next">Next</button>
                                    </div>
                                    </div>';

}



if (isset($screen5))
{
                                $a = 1;
                                $html_code .= '<div class="page" id="f_screen5">';
                                $html_code .= '<h2 class="fs-title">' .stripslashes( $screen5['title'] ). '</h2>';
                                $html_code .= '<h3 class="fs-subtitle">' .stripslashes( $screen5['description']) . '</h3><div class="who_needs_treatment">';
                                foreach ($screen5_options as $scrn5)
                                {

                                    $scre5_label = strtolower($scrn5);
                                    $html_code .= '<div class="form-group"><input type="checkbox" id="' . stripslashes($scre5_label) . '" name="' . stripslashes($scrn5) . '" value="' . stripslashes($scrn5) . '"><label for="' . stripslashes($scre5_label) . '">' . stripslashes($scrn5) . '</label></div>';

                                }
                                $html_code .= '</div><div class="field btns">
                                <button class="prev-5 prev">Previous</button>
                                <button class="next-5 next">Next</button>
                            </div></div>';

}


if (isset($screen6))
{
    $in = 1;
    $html_code .= '<div class="page" id="f_screen6">';
    $html_code .= '<h2 class="fs-title">' . stripslashes($screen6['title']) . '</h2>';
    $html_code .= '<h3 class="fs-subtitle">' . stripslashes($screen6['description']) . '</h3><div class="needs_treatment">';
    foreach ($screen6_options as $scrn6)
    {

        $scre6_label = strtolower($scrn6);
        $html_code .= '<div class="form-group"><input type="checkbox" id="' . stripslashes($scre6_label) . '"  name="' . stripslashes($scrn6) . '" value="' . stripslashes($scrn6) . '" data-type="gen_info_'.$in.'"><label for="' . stripslashes($scre6_label) . '">' . stripslashes($scrn6) . '</label></div>';
        $in++;
    }
    $html_code .= '</div><div class="field btns">
    <button class="prev-6 prev">Previous</button>
    <button class="next-6 next">Next</button>
</div></div>';

}




if (isset($screen7))
{
    $info = 1;
    $html_code .= '<div class="page" id="f_screen7">';
    // $html_code .= '<h2 class="fs-title">'.$screen1['title'].'</h2>';
    $html_code .= '<div class="general_info">';
    foreach ($screen7 as $scrn7)
    {

        $html_code .= '<div class="gen_info_'.$info.' hide info_items">
                        <div><h3>' . stripslashes($scrn7['title']) . '</h3></div>
                        <div><p>' . stripslashes($scrn7['description']) . '</p></div>
                        </div>';
        $info++;

    }
    $html_code .= '</div><div class="field btns">
    <button class="prev-7 prev">Previous</button>
    <button class="next-7 next">Next</button>
</div></div>';

}



if (isset($screen8))
{
    $a = 1;
    $html_code .= '<div class="page" id="f_screen8">';
    $html_code .= '<h2 class="fs-title">' . stripslashes($screen8['title']) . '</h2>';
    $html_code .= '<h3 class="fs-subtitle">' . stripslashes($screen8['description']) . '</h3>';
    foreach ($screen8_options as $scrn8)
    {

        $scre8_label = strtolower($scrn8);
        $html_code .= '<div class="form-group"><input type="checkbox" id="' . stripslashes($scre8_label) . '" name="' . stripslashes($scrn8) . '" value="' . stripslashes($scrn8) . '"><label for="' . stripslashes($scre8_label) . '">' . stripslashes($scrn8) . '</label></div>';

    }
    $html_code .= '<div class="field btns">
    <button class="prev-8 prev">Previous</button>
    <input type="submit" value="submit" name="submit_clinics" class="submit_form_clinics btn">
</div></div>';
     $html_code .= '</form></div></div>';
}

return $html_code;

?>


