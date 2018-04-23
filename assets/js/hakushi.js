$(function(){
    //class on click example
    //$(document).on("click", ".my-class", function(){
        //do something
    //});

    //hide alerts
    // $("#system-alert").slideUp("slow");
    setTimeout(function(){
        $("#system-alert").slideUp("slow");
    }, 1800);

    //click to call js submit for single/generic form
    $(document).on("click", ".js-submit-btn", function(){
        submitJSForm();
    });

    $("#js-pw-check").click(function() {
        if($('input[name=newpassword]').val() == $('input[name=passwordconfirm]').val()){
            submitJSForm();
        }
        else{
            $('#passwordconfirm').css('border-color', '#AA4444');
            $('#passwordconfirm').css('background-color', '#FCD6D6');
            $(document).scrollTop($("#passwordconfirm").offset().top); 
        }
    });
    //also prompt with error if you unfocus with mismatching passswords
    $('#passwordconfirm').blur(function(){
        if($('input[name=newpassword]').val() == $('input[name=passwordconfirm]').val()){
            $('#passwordconfirm').removeAttr( 'style');
        }
        else{
            $('#passwordconfirm').css('border-color', '#AA4444');
            $('#passwordconfirm').css('background-color', '#FCD6D6');
        }
    });
})

//reordering auto-ajax function
function updateOrder(uid, pos){
    $.ajax({
        type: "POST",
        data: {moveuid: uid, movepos: pos},
        cache: false,
        success: function(response){
            //$(".reorder-badge").show().delay(500).fadeOut("fast");
        }
    });
}

//js form submit function
function submitJSForm(formid){
    //either provide a form id or to use the generic function, make sure form has id #js-submit-form and is the only form on the page
    formid = formid || "js-submit-form";
    document.getElementById(formid).submit();
}