$(function() {

    //define list type variables as js variables
    // var listtitle = "<?php echo ucfirst($listtitle); ?>";
    // var listnoun = "<?php echo ucfirst($listnoun); ?>";

    //pull in from hidden input
    var listnoun = $('#listnoun').val();

    //fade out saved notification
    $('.notif-alert').delay(4000).fadeOut();

    //MODALS

    //autofocus modal inputs
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('input:first').focus();
    });

//ALLOWANCE CODE

    //click to call js submit for single/generic form
    //does this work with classes?
    $(".js-submit-btn").click(function() {
        submitJSForm();
    });

    //show, hide auto-refill options
    $('#budget-refill-input').change(function(){
        if(this.checked){
            $("#refill-options-group").removeClass("hidden");
        }
        else{
            $("#refill-options-group").addClass("hidden");
        }
    });

    //if weekly or monthly, form show/hide
    $('#refill-frequency-input').change(function(){
        if($(this).val() == 'weekly'){
            $("#refill-weekly-group").removeClass("hidden");
            $("#refill-monthly-group").addClass("hidden");
        }
        else if($(this).val() == 'monthly'){
            $("#refill-weekly-group").addClass("hidden");
            $("#refill-monthly-group").removeClass("hidden");
        }
    });

    //clears forms on modal closing, hides hidden elements and shows hidden elements that should be unhidden
    //using .on() because we're using a class name... this will clear all forms on a page
    $(".form-modal").on("hidden.bs.modal", function () {
        $('form').trigger("reset");
        //rehide any unhidden form elements or show any default non-hidden classes that GOT hidden
        $('.form-hidden').addClass("hidden");
        $(".default-show").removeClass("hidden");
    });

    //trigger deduct modal
    $(document).on("click", ".deduct-btn", function(){
        var deductUID = $(this).data('uid');
        var deductName = $(this).data('name');
        var currentBalance = $(this).data('balance');
        currentBalance = "$"+((currentBalance/100).toFixed(2));
        $('input[name="deduct-uid"]').val(deductUID);
        $(".say-budget-name").text(deductName);
        $(".say-current-balance").text(currentBalance);
    });
    

    //trigger delete modal
    $("#delete-me-btn").click(function(){
        var deleteName = $(this).data('name');
        var currentBalance = $(this).data('balance');
        currentBalance = "$"+((currentBalance/100).toFixed(2));
        $(".say-delete-budget-name").text(deleteName);
        $(".say-delete-current-balance").text(currentBalance);
    });

    //click to call js submit delete form
    $("#delete-budget-submit-btn").click(function(){
        if(($('#delete-you-sure-1').is(':checked'))&&($('#delete-you-sure-2').is(':checked'))&&($('#delete-you-sure-3').is(':checked'))){
            submitJSForm("budget-delete-form");
        }
        else{
            $("#must-check-to-delete").addClass("text-danger bold");
            $("#must-check-to-delete").removeClass("text-success");
            $("#must-check-to-delete").text("You gotta check these boxes if you wanna delete!!!");
            $("#must-check-to-delete").removeClass("hidden");
        }
    });

    //check state of checks
    $('.delete-you-sure').change(function(){
        if(($('#delete-you-sure-1').is(':checked'))&&($('#delete-you-sure-2').is(':checked'))&&($('#delete-you-sure-3').is(':checked'))){
            $("#must-check-to-delete").addClass("text-success bold");
            $("#must-check-to-delete").removeClass("text-danger");
            $("#must-check-to-delete").removeClass("hidden");
            $("#must-check-to-delete").text("Alright, now all you have to do is hit that button!");
            $("#delete-budget-submit-btn").removeClass("disabled-fade");
        }
        else{
            $("#must-check-to-delete").removeClass("text-success");
            $("#delete-budget-submit-btn").addClass("disabled-fade");
        }
    });

    //populate unshare modal
    $(document).on("click", ".unshare-btn", function(){
        var unshareuser = $(this).data('shareduser');
        var shareuid = $(this).data('uid');
        $(".say-unshare-user").text(unshareuser);
        $('input[name="share-uid"]').val(shareuid);
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
    formid = formid || "js-submit-form";
    document.getElementById(formid).submit();
}