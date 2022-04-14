<?php
    if (! defined('ABSPATH')) {
        die();
    }
    
    $options_data = get_option('iot-option-group');
    $options_data =   maybe_unserialize($options_data);
    

    $screens = $options_data['iot-option-group']['screens'];
    $screen1 =$options_data['iot-option-group']['screen1']['options'];
    $screen1_title =  stripslashes($options_data['iot-option-group']['screen1']['title']);
    $screen1_description = stripslashes($options_data['iot-option-group']['screen1']['description']);
    $screen2 = $options_data['iot-option-group']['screen2']['options'];
    $screen2_title =  stripslashes($options_data['iot-option-group']['screen2']['title']);
    $screen2_description =  stripslashes($options_data['iot-option-group']['screen2']['description']);
    
    $screen4 = $options_data['iot-option-group']['screen4']['options'];
    $screen4_title =  stripslashes($options_data['iot-option-group']['screen4']['title']);
    $screen4_description = stripslashes( $options_data['iot-option-group']['screen4']['description']);
    $screen5 = $options_data['iot-option-group']['screen5']['options'];
    $screen5_title =  stripslashes($options_data['iot-option-group']['screen5']['title']);
    $screen5_description =  stripslashes($options_data['iot-option-group']['screen5']['description']);
    $screen6 = $options_data['iot-option-group']['screen6']['options'];
    $screen6_title =  stripslashes($options_data['iot-option-group']['screen6']['title']);
    $screen6_description =  stripslashes($options_data['iot-option-group']['screen6']['description']);
    $screen7 = $options_data['iot-option-group']['screen7'];
    $screen8 = $options_data['iot-option-group']['screen8']['options'];
    $screen8_title =  stripslashes($options_data['iot-option-group']['screen8']['title']);
    $screen8_description =  stripslashes($options_data['iot-option-group']['screen8']['description']);

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


    ?>
<div class="iot_main_class_container">
    <div class="iot_sub_main_class">
        <div class="iot_heading">
            <h2> Interactive Onboarding Tool </h2>
        </div>
        <form method="post" action="<?php echo  $_SERVER['REQUEST_URI']; ?>"  id="iot_foprm_data">
            <?php settings_fields('iot-option-group'); ?>
            <div class="iot_screens_mainclass">
                <!-- screen 1 -->
                <div class="iot_class_screen1 iot_class_sc">
                    <div class="screen_header screens_<?php echo $scren1_chk; ?>">
                        <h3> Screen 1 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen1_off" <?php echo $scren1_chk;
                         ?> ></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen1_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen1][title]" value="<?php echo (isset($screen1_title ) ? trim($screen1_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen1][description]" rows="4" cols="50"> <?php  echo (isset($screen1_description ) ? trim($screen1_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen1_add" id="screen1_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen1)) {
                                        $a= 1;
                                        foreach($screen1 as $scrn1) {
                                        ?>
                                <tr id="screen1_row_<?php echo $a; ?>">
                                    <td><input type="text" name="iot-option-group[screen1][options][]" placeholder="add Clinician Consultation" value="<?php echo  stripslashes($scrn1); ?>"></td>
                                    <td><button type="button" name="screen1_remove" class="btn btn-danger btn_remove" data-type="screen1" id="<?php echo $a; ?>">X</button></td>
                                </tr>
                                <?php
                                    $a++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 2 -->
                <div class="iot_class_screen2 iot_class_sc">
                    <div class="screen_header screens_<?php echo $scren2_chk; ?>">
                        <h3> Screen 2 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen2_off"  <?php echo $scren2_chk; ?> ></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen2_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen2][title]" value="<?php echo (isset($screen2_title ) ? trim($screen2_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen2][description]" rows="4" cols="50"> <?php  echo (isset($screen2_description ) ? trim($screen2_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen2_add" id="screen2_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen2)) {
                                        $b= 1;
                                        foreach($screen2 as $scrn2) {
                                        ?>
                                <tr id="screen2_row_<?php echo $b; ?>">
                                    <td><input type="text" name="iot-option-group[screen2][options][]" placeholder="Located area" value="<?php echo  stripslashes($scrn2); ?>"></td>
                                    <td><button type="button" name="screen2_remove" class="btn btn-danger btn_remove" data-type="screen2" id="<?php echo $b; ?>">X</button></td>
                                </tr>
                                <?php
                                    $b++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 3 -->
                <div class="iot_class_screen3 ">
                    <div class="screen_header">
                        <h3> Screen 3 </h3>
                        <span> Depending on user selection </span>
                    </div>
                </div>
                <!-- screen 4 -->
                <div class="iot_class_screen4 iot_class_sc">
                    <div class="screen_header screens_<?php echo $scren4_chk; ?>">
                        <h3> Screen 4 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen4_off" <?php echo $scren4_chk; ?>></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen4_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen4][title]" value="<?php echo (isset($screen4_title ) ? trim($screen4_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen4][description]" rows="4" cols="50"> <?php  echo (isset($screen4_description ) ? trim($screen4_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen4_add" id="screen4_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen4)) {
                                        $c= 1;
                                        foreach($screen4 as $scrn4) {
                                        ?>
                                <tr id="screen4_row_<?php echo $c; ?>">
                                    <td><input type="text" name="iot-option-group[screen4][options][]" placeholder="add Clinician Consultation" value="<?php echo stripslashes($scrn4); ?>"></td>
                                    <td><button type="button" name="screen4_remove" class="btn btn-danger btn_remove" data-type="screen4" id="<?php echo $c; ?>">X</button></td>
                                </tr>
                                <?php
                                    $c++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>

             
                 <!-- screen 4 -->
                    <!-- screen 5 -->
                 <div class="iot_class_screen5 iot_class_sc">
                    <div class="screen_header screens_<?php echo $scren5_chk; ?>">
                        <h3> Screen 5 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen5_off" <?php echo $scren5_chk; ?>></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen5_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen5][title]" value="<?php echo (isset($screen5_title ) ? trim($screen5_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen5][description]" rows="4" cols="50"> <?php  echo (isset($screen5_description ) ? trim($screen5_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen5_add" id="screen5_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen5)) {
                                        $d= 1;
                                        foreach($screen5 as $scrn5) {
                                        ?>
                                <tr id="screen5_row_<?php echo $d; ?>">
                                    <td><input type="text" name="iot-option-group[screen5][options][]" placeholder="add Clinician Consultation" value="<?php echo stripslashes($scrn5); ?>"></td>
                                    <td><button type="button" name="screen5_remove" class="btn btn-danger btn_remove" data-type="screen5" id="<?php echo $d; ?>">X</button></td>
                                </tr>
                                <?php
                                    $d++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 5 -->

                    <!-- screen 6 -->
                    <div class="iot_class_screen6 iot_class_sc">
                    <div class="screen_header  screens_<?php echo $scren6_chk; ?>">
                        <h3> Screen 6 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen6_off" <?php echo $scren6_chk; ?>></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen6_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen6][title]" value="<?php echo (isset($screen6_title ) ? trim($screen6_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen6][description]" rows="4" cols="50"> <?php  echo (isset($screen6_description ) ? trim($screen6_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen6_add" id="screen6_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen6)) {
                                        $e= 1;
                                        foreach($screen6 as $scrn6) {
                                        ?>
                                <tr id="screen6_row_<?php echo $e; ?>">
                                    <td><input type="text" name="iot-option-group[screen6][options][]" placeholder="add Clinician Consultation" value="<?php echo stripslashes($scrn6); ?>"></td>
                                    <td><button type="button" name="screen6_remove" class="btn btn-danger btn_remove" data-type="screen6" id="<?php echo $e; ?>">X</button></td>
                                </tr>
                                <?php
                                    $e++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 6 -->

                 <!-- screen 7 -->
                 <div class="iot_class_screen7 iot_class_sc">
                    <div class="screen_header screens_<?php echo $scren7_chk; ?>">
                        <h3> Screen 7 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen7_off" <?php echo $scren7_chk; ?>></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen7_dynamic_field">
                             <?php 
                                $f = 0;
                             foreach($screen7 as $scrn7) { 

                                ?>

                            <tr id="screen7_row_<?php echo $f; ?>">
                                <td>
                                    <div class="screening_headings">
                                        <label>Title</label>
                                        <div class="form-class"><input type="text" name="iot-option-group[screen7][<?php echo $f; ?>][title]" value="<?php echo trim($scrn7['title']); ?>" /></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="screening_headings">
                                        <label>Description</label>
                                        <div class="form-class"><textarea name="iot-option-group[screen7][<?php echo $f; ?>][description]" rows="4" cols="50"> <?php echo trim($scrn7['description']); ?>  </textarea></div>
                                    </div>
                                </td>
                                <td><button type="button" name="screen7_remove" id="<?php echo $f; ?>" class="btn btn-danger btn_remove" data-type="screen7">X</button></td>
                             </tr>
                             <?php
                            $f++; 
                            }
                             ?>

                                <tr class="add_more">
                                    <td><button type="button" name="screen7_add" id="screen7_add" class="btn btn-success">Add More</button></td>
                                </tr>
                               
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 7 -->



                       <!-- screen 8 -->
                       <div class="iot_class_sc" id="iot_class_screen8">
                    <div class="screen_header  screens_<?php echo $scren8_chk; ?>">
                        <h3> Screen 8 </h3>
                        <label class="switch">Turn off Screen <input type="checkbox" name="iot-option-group[screens][]" value="screen8_off"  <?php echo $scren8_chk; ?>></label>
                    </div>
                    <div class="screen_header_body_content hide">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="screen8_dynamic_field">
                                <tr>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Title</label>
                                            <div class="form-class"><input type="text" name="iot-option-group[screen8][title]" value="<?php echo (isset($screen8_title ) ? trim($screen8_title)  : ''); ?>"/></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="screening_headings">
                                            <label>Description</label>
                                            <div class="form-class"><textarea id="w3review" name="iot-option-group[screen8][description]" rows="4" cols="50"> <?php  echo (isset($screen8_description ) ? trim($screen8_description)  : '');?> </textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" name="screen8_add" id="screen8_add" class="btn btn-success">Add More</button></td>
                                </tr>
                                <?php 
                                    if(isset($screen8)) {
                                        $e= 1;
                                        foreach($screen8 as $scrn8) {
                                        ?>
                                <tr id="screen8_row_<?php echo $e; ?>">
                                    <td><input type="text" name="iot-option-group[screen8][options][]" placeholder="Language" value="<?php echo stripslashes($scrn8); ?>"></td>
                                    <td><button type="button" name="screen8_remove" class="btn btn-danger btn_remove" data-type="screen8" id="<?php echo $e; ?>">X</button></td>
                                </tr>
                                <?php
                                    $e++;
                                    } 
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- screen 6 -->


                
                <div class="submit_buttons"> <input type="submit" name="submit_iot" value="save"/> </div>
            </div>
        </form>
    </div>
</div>