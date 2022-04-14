$( document ).ready(function() {
initMultiStepForm();

function initMultiStepForm() {
    const progressNumber = document.querySelectorAll(".step").length;
    const slidePage = document.querySelector(".slide-page");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    const pages = document.querySelectorAll(".page");
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const stepsNumber = pages.length;

    if (progressNumber !== stepsNumber) {
        console.warn(
            "Error, number of steps in progress bar do not match number of pages"
        );
    }

    document.documentElement.style.setProperty("--stepNumber", stepsNumber);

    let current = 1;

    for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener("click", function (event) {
            event.preventDefault();

            inputsValid = validateInputs(this);
            // inputsValid = true;

            if (inputsValid) {
                slidePage.style.marginLeft = `-${
                    (100 / stepsNumber) * current
                }%`;
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });
    }

    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener("click", function (event) {
            event.preventDefault();
            slidePage.style.marginLeft = `-${
                (100 / stepsNumber) * (current - 2)
            }%`;
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    }

    $('form#idClinics').submit(function (e) {
        e.preventDefault();
        
        console.log(" e.preventDefault(); e.preventDefault();");
    
            // bullet[current - 1].classList.add("active");
            // progressCheck[current - 1].classList.add("active");
            // progressText[current - 1].classList.add("active");
            // current += 1;
    
            var av_consultation = $('#f_screen1 input[type="checkbox"]:checked').val();
            var av_location_area = $('#f_screen2 input[type="checkbox"]:checked').val();
            var av_gender = $('#f_screen4 input[type="checkbox"]:checked').val();
            var av_who_treatment = $('#f_screen5 input[type="checkbox"]:checked').val();
            var av_what_treatment = $('#f_screen6 input[type="checkbox"]:checked').val();
            var av_language = $('#f_screen8 input[type="checkbox"]:checked').val();
            var clinic = [];
            $('input[name="nearest_clinicians[]"]:checked').each(function() {
                clinic.push($(this).val());
            });
    
           
          
            jQuery.ajax({
                type: "post",
                dataType:"text",
                url: 'https://newviewpsychology.com.au/wp-admin/admin-ajax.php',
                 data: {
                    action:'get_available_clinician_data' ,
                    av_consultation : av_consultation,
                    av_location_area : av_location_area,
                    av_gender : av_gender,
                    av_who_treatment: av_who_treatment,
                    av_what_treatment :av_what_treatment,
                    av_language : av_language,
                    clinic : clinic
    
    
    
                  
                },
                beforeSend : function(){
                    $(".fetch_data_clinicians").html('<h3>getting Available Clinican</h3><div class="loader"></div>');
                    $('.form-outer').hide();
                    $(".fetch_data_clinicians").removeClass('hide');
                   
                },
                success: function(response){
                  
                     $(".container_form").hide();
                    var data = jQuery.parseJSON(response);
                   
                    var exact_clinicians = data.exact_match_html;
                  
                     $(".fetch_data_clinicians").html(exact_clinicians);
                
            
                }
            });
    
            // setTimeout(function () {
            //     alert("Your Form Successfully Signed up");
            //     location.reload();
            // }, 800);
    
    
    
        });
    
    
  
    function validateInputs(ths) {
        let inputsValid = true;

        const inputs =
            ths.parentElement.parentElement.querySelectorAll("input");
        for (let i = 0; i < inputs.length; i++) {
            const valid = inputs[i].checkValidity();
            if (!valid) {
                inputsValid = false;
                inputs[i].classList.add("invalid-input");
            } else {
                inputs[i].classList.remove("invalid-input");
            }
        }
        return inputsValid;
    }
}



$('#f_screen1 input[type="checkbox"]').on('change', function() {
    $('#f_screen1 input[type="checkbox"]').not(this).prop('checked', false);

    if($('#f_screen1 input[type="checkbox"]:checked').val() == 'In-person (a face-to-face consultation)'){
        $('.submit_locations').removeClass('hide').addClass('show');
        $('.next-1').hide();
        $('#f_screen3').removeClass('hide');
    }
    else{
        console.log("gfdgdg");
        $('.submit_locations').addClass('hide').removeClass('show');
        $('.next-1').show(); 
        $('#f_screen3').addClass('hide');
    }
 });


 $('#f_screen2 input[type="checkbox"]').on('change', function() {
    $('#f_screen2 input[type="checkbox"]').not(this).prop('checked', false);
 });
 $('#f_screen4 input[type="checkbox"]').on('change', function() {
    $('#f_screen4 input[type="checkbox"]').not(this).prop('checked', false);
 });
 $('#f_screen5 input[type="checkbox"]').on('change', function() {
    $('#f_screen5 input[type="checkbox"]').not(this).prop('checked', false);
 });
 $('#f_screen6 input[type="checkbox"]').on('change', function() {
     
    $('#f_screen6 input[type="checkbox"]').not(this).prop('checked', false);
    var get_c = $(this).attr('data-type');
    if ($(this).prop('checked')==true){ 
    
        $('.info_items').addClass('hide');
        $('.'+get_c).removeClass('hide');
  
    }

    else{
        $('.info_items').addClass('hide');
        $('.'+get_c).addClass('hide');
    }
    

 });
 $('#f_screen8 input[type="checkbox"]').on('change', function() {
    $('#f_screen8 input[type="checkbox"]').not(this).prop('checked', false);
 });

 $('.submit_locations').on('click', function() {
 
    var location_state = $('#f_screen2 input[type="checkbox"]:checked').val();
    var consultation = $('#f_screen1 input[type="checkbox"]:checked').val();

 jQuery.ajax({
    type: "post",
    dataType:"text",
    url: 'https://newviewpsychology.com.au/wp-admin/admin-ajax.php',
     data: {
        action:'get_nearest_clinician_data' ,
        location_state: location_state,
        consultation : consultation
    },
    beforeSend : function(){
        $('form').find("#get_nearest_locations_data").html('<div class="loader"></div>');
        $('#get_nearest_locations_data').removeClass('get_data_ajax_clinic');
    },
    success: function(response){
      
        console.log(response);
        $('form').find("#get_nearest_locations_data").html(response);
        $('#get_nearest_locations_data').addClass('get_data_ajax_clinic');
     


    }
});



});
 



});
