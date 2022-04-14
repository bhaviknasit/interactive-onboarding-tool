var $ = jQuery;
$(function() {
$(document).ready(function(){  
   
  
  
    $('#screen1_add').on('click',function(){  
        var screen1tr_length = $('.iot_class_screen1 table tr').length;
        var i = screen1tr_length - 2;
         i++;  
         $('#screen1_dynamic_field').append('<tr id="screen1_row_'+i+'"><td><input type="text" name="iot-option-group[screen1][options][]" placeholder="add Clinician Consultation"/></td><td><button type="button" name="screen1_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen1">X</button></td></tr>');  
    });  


    $('#screen2_add').on('click',function(){  
        var screen2tr_length = $('.iot_class_screen2 table tr').length;
        var i = screen2tr_length - 2;
        i++;  
        $('#screen2_dynamic_field').append('<tr id="screen2_row_'+i+'"><td><input type="text" name="iot-option-group[screen2][options][]" placeholder="Located area"/></td><td><button type="button" name="screen2_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen2">X</button></td></tr>');  
   });  


   $('#screen3_add').on('click',function(){  
    var screen3tr_length = $('.iot_class_screen3 table tr').length;
    var i = screen3tr_length - 2;
    i++;  
    $('#screen3_dynamic_field').append('<tr id="screen3_row_'+i+'"><td><input type="text" name="iot-option-group[screen3][options][]" placeholder="Located area"/></td><td><button type="button" name="screen3_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen3">X</button></td></tr>');  
});  


$('#screen4_add').on('click',function(){  
    var screen4tr_length = $('.iot_class_screen4 table tr').length;
    var i = screen4tr_length - 2;
    i++;  
    $('#screen4_dynamic_field').append('<tr id="screen4_row_'+i+'"><td><input type="text" name="iot-option-group[screen4][options][]" placeholder="Gender Clinician"/></td><td><button type="button" name="screen4_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen4">X</button></td></tr>');  
});  


$('#screen5_add').on('click',function(){  
    var screen5tr_length = $('.iot_class_screen5 table tr').length;
    var i = screen5tr_length - 2;
    i++;  
    $('#screen5_dynamic_field').append('<tr id="screen5_row_'+i+'"><td><input type="text" name="iot-option-group[screen5][options][]" placeholder="Needs Treatment"/></td><td><button type="button" name="screen5_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen5">X</button></td></tr>');  
});  


$('#screen6_add').on('click',function(){  
    var screen6tr_length = $('.iot_class_screen6 table tr').length;
    var i = screen6tr_length - 2;
    i++;  
    $('#screen6_dynamic_field').append('<tr id="screen6_row_'+i+'"><td><input type="text" name="iot-option-group[screen6][options][]" placeholder="What Treatment"/></td><td><button type="button" name="screen6_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen6">X</button></td></tr>');  
});  
$('#screen7_add').on('click',function(){  
    var screen7tr_length = $('.iot_class_screen7 table tr').length;
    var screen7tr_length = screen7tr_length ? parseInt(screen7tr_length) - parseInt(2)  : 0;
    console.log(screen7tr_length);
    var k = screen7tr_length;
    k++;  
    $('#screen7_dynamic_field tbody').find('tr:last').before(' <tr id="screen7_row_'+k+'"><td> <div class="screening_headings"> <label>Title</label> <div class="form-class"><input type="text" name="iot-option-group[screen7]['+k+'][title]"/></div></div></td><td> <div class="screening_headings"> <label>Description</label> <div class="form-class"><textarea name="iot-option-group[screen7]['+k+'][description]" rows="4" cols="50"> </textarea></div></div></td><td><button type="button" name="screen7_remove" id="'+k+'" class="btn btn-danger btn_remove" data-type="screen7">X</button></td> </tr>');  
});  


$('#screen8_add').on('click',function(){  
    var screen8tr_length = $('.iot_class_screen8 table tr').length;
    var i = screen8tr_length - 2;
    i++;  
    $('#screen8_dynamic_field').append('<tr id="screen8_row_'+i+'"><td><input type="text" name="iot-option-group[screen8][options][]" placeholder="Language"/></td><td><button type="button" name="screen8_remove" id="'+i+'" class="btn btn-danger btn_remove" data-type="screen8">X</button></td></tr>');  
});  




    $(document).on('click', '.btn_remove', function(){  
      
        var screen_type = $(this).attr("data-type"); 
        console.log(screen_type) ;
        var option_remove_id = $(this).attr("id");   
        console.log(option_remove_id) ;

        $('#'+screen_type+'_row_'+option_remove_id+'').remove();  
       
        
         
        
    });  


    $(document).on('click', '.screen_header', function(){ 

    
       $(this).next().slideToggle( "slow", function() {
      $(this).find('.screen_header_body_content').removeClass('hide');
            
      });
           
        });


        $(document).on('click', 'input[name="iot-option-group[screens][]"]', function(){ 
            if($(this).is(':checked'))
            {
                $(this).parent().parent().addClass('screens_checked'); 
            }
            else{
                console.log("Fsdf");

                $(this).parent().parent().removeClass('screens_checked'); console.log("sssss");
            }
            // 

        });
//     $('#submit').click(function(){            
//         $.ajax({  
//              url:"name.php",  
//              method:"POST",  
//              data:$('#add_name').serialize(),  
//              success:function(data)  
//              {  
//                   alert(data);  
//                   $('#add_name')[0].reset();  
//              }  
//         });  
//    });  
   
    // function remove_row(data_type_class){
    //     $(this).attr("data-type-class");  
     
    //         $('#row'+button_id+'').remove(); 

    //     });
    // }
});  

});