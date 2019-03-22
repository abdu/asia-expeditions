var baseUrl = location.protocol+'//'+location.host;
function readURL(input,img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imag = $('#'+img).attr('src', e.target.result);
            if (imag) {
                $(this).hide();
            }else{
                $(this).show();
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(function(){

    $(".checkData").on('click', function(){        
        if ( ! $(this).prop('checked') ) {            
            var dataId = $(this).val();
            var tourId = $('#tour_id').val();
            var actionType = $(this).attr('action');
            $.ajax({
                method: 'GET',
                url: baseUrl+'/admin/check-hotel',
                data : { 'data_id': dataId, 'tour_id':tourId, 'type': actionType },
                dataType: 'json',
                success: function(respon){
                    console.log(respon.hotel);
                },
                error: function (respon) {
                    alert('Something went wrong');
                }       
            });
        }
    });

    $(".btnSearch").on('change', function(){
        var Action = $(this).attr('action-to');
        var DataId = $(this).val();
        $.ajax({
            method: "GET",  
            url: baseUrl+'/admin/search-data',
            data : { 'dataId': DataId, 'action': Action },
            dataType: 'json',           
            success: function (respon) {
                var data = '';
                var hotels = '';
                $.each(respon.data, function(i, index){
                    data +="<option value="+index.id+">"+index.title+"</optoin>";
                });

                $.each(respon.hotel, function(h, hindex){
                    hotels += '<div><label style="font-weight: 400;"><input type="checkbox" name="hotel[]" value="'+hindex.id+'"> '+hindex.name+'</label></div>';
                });
                $("#province").html(data);
                $(".wrapperHotel").html(hotels);
            },
            error: function (respon) {
                alert('Something went wrong');
            }       
        });
    });



    $("#choosImg, #blah").click(function(){
        $("#imgInp").click();
    });
    $("#imgInp").change(function(){
        readURL(this, 'blah');
        $("#blah").show();
    });

    $("#choosFlag, #blahFlag").click(function(){
        $("#imgFlag").click();
    });

    $("#imgFlag").change(function(){
      readURL(this, "blahFlag");
        $("#blahFlag").show();
    });

    $("#uploadSlide, #ImgShow").click(function(){
        $("#slideImg").click();
    });
    $("#slideImg").change(function(){
        readURL(this, "ImgShow");
        $("#ImgShow").show();
    });
})

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
          var filesAmount = input.files.length;
          for (i = 0; i < filesAmount; i++) {
              var reader = new FileReader();
              $(".item_Image").remove();
              reader.onload = function(event) {
                $($.parseHTML('<img class=\"item_Image\" title="Click remove this">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
              }
              reader.readAsDataURL(input.files[i]);
          }        
        }
    };

    $("#choosGallery").click( function (){
      $('#gallery').click();
    });
    
    $('#gallery').on('change', function() {
        imagesPreview(this, 'div.placeImage');
    });
});


$(function(){	

    var fullnameStatus = false;
    var usernameStatus = false;
    var passwordStatus = false;
    var repasswordStatus = false;
    var emailStatus = false;
    var phoneStatus = false;
    var fullName_error = $('.fullname');
    var username_error = $('.username');
    var password_error = $('.password');
    var repassword_error = $('.repassword');
    var email_error = $('.email');
    var phone_error = $('.phone');
   
    $("#fullname").focusout( function(){
        checkFullname();
    });
    $("#username").focusout( function(){
        checkUser();
    });
    $("#password").focusout( function(){
        checkPassword();
    });
    $("#repassword").focusout( function(){
        checkRepassword();
    });
    $("#email").focusout( function(){
        checkEmail();
    });
    $("#phone").focusout( function(){
        checkPhone();
    });
   
    function checkFullname(){
        if ($("#fullname").val() == '') {
            $(fullName_error).addClass('has-error');
            fullnameStatus = false;
            $("#fullname").focus();
        }else{
            $(fullName_error).removeClass('has-error');   
            fullnameStatus = true;    
        }
    }

    function checkUser(){
        if ($("#username").val() == '' ) {
            $(username_error).addClass('has-error');
            usernameStatus = false;
            $("#username").focus();
        }else{
            $(username_error).removeClass('has-error');  
            usernameStatus = true;         
        }
    }

    function checkPassword(){
        if ($("#password").val() == '') {
            $(password_error).addClass('has-error');
            passwordStatus = false;
            $("#password").focus();
        }else{
            $(password_error).removeClass('has-error');       
            passwordStatus = true;
        }
    }
    function checkRepassword(){
        if ($("#repassword").val() != $("#password").val()) {
            $(repassword_error).addClass('has-error');
            repasswordStatus = false;
            $("#repassword").focus();
        }else{
            $(repassword_error).removeClass('has-error');       
            repasswordStatus = true;
        }
    }
    function checkEmail (){
        var emailReg = RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        if (!emailReg.test( $("#email").val())) {
            $(email_error).addClass('has-error');
            emailStatus = false;
            $("#email").focus();
        }else{
            $(email_error).removeClass('has-error');
            emailStatus = true;
        }
    }
    function checkPhone(){
        if ($("#phone").val() == '') {
            $(phone_error).addClass('has-error');
            phoneStatus = false;
            $('#phone').focus();
        }else{
            $(phone_error).removeClass('has-error');       
            phoneStatus = true;
        }
    }

    $("#country_sort").on('change', function(){
        $('form#form_sort').submit();
    });

    // get update user
    $(".btnUpdate, .btnAnd").on('click', function(){
    	var Id = $(this).attr('data-id');
        $(fullName_error).removeClass('has-error');
        $(username_error).removeClass('has-error');
        $(password_error).removeClass('has-error');
        $(repassword_error).removeClass('has-error');
        $(email_error).removeClass('has-error');
        $(phone_error).removeClass('has-error'); 
    	if( $(this).attr('data-action') == 'edit'){
            $("#exampleModalLabel").text('Update User');
            $("#btnSave").text('Update');
            $("#btnSave").attr('name', 'btn_Update');
	    	$.ajax({
		        url: baseUrl+'/admin/update',
		        method: 'get',
		        data:{'id':Id},
		        dataType: 'json',
                beforeSend: function() {
                   $(".Dataloading").css({'display':'block'});
                },
		        success: function(result){
		        	$('#fullname').val(result.data.first);
		        	$('#username').val(result.data.name);
		        	$('#password').val(result.data.password_text);
		        	$('#repassword').val(result.data.password_text);
		        	$('#email').val(result.data.email);
		        	$('#phone').val(result.data.phone);
                    $("#id").val(result.data.id);
		        },
                complete: function() {
                    $(".Dataloading").css({'display': 'none'});
                    $(".Dataloading").html('');
                },
                error: function (respon) {
                  alert('Error');
                }
	    	});
	    }else{ 
        $("#exampleModalLabel").text('Create new user');   
            $("#btnSave").text('Save');       
            $("#btnSave").attr('name', 'btn_Save');
	    	$('#fullname').val('');
        	$('#username').val('');
        	$('#password').val('');
        	$('#repassword').val('');
        	$('#email').val('');
        	$('#phone').val('');
            $("#id").val('');
	    }
    });

    $("#btnSave").on('click', function(e){
       var dataAction = $(this).attr('name');
       if (fullnameStatus == true && usernameStatus == true && passwordStatus == true && repasswordStatus == true && emailStatus == true && phoneStatus == true)
       {
            $.ajax({
                url: baseUrl+'/admin/userAdd',
                method: 'POST',
                data:{ fullname:$('#fullname').val(),                
                    username: $('#username').val(),
                    password: $('#password').val(),
                    repassword: $('#repassword').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    dataAction: dataAction,
                    id: $("#id").val(),
                    _token: $("input[name='_token']").val(),
                },
                dataType: 'json',
                beforeSend: function() {
                   $(".Dataloading").css({'display': 'block'});
                },
                success: function(respon){
                    if (respon.status != 'No' ) {
                        $(email_error).removeClass('has-error');
                        $(".Dataloading").css({'display': 'block'});
                    }else{
                        $(email_error).addClass('has-error');
                        $(".Dataloading").css({'display': 'block'});
                    }
                },
                complete: function() {                    
                    setTimeout( function(){
                        $(".Dataloading").css({'display': 'none'});
                        // $(".Dataloading").html('');
                    }, 6000);             
                    // location.reload();       
                },
                error: function (respon) {
                  alert('Error');
                }
            });
        }else{
            checkFullname();
            checkUser();
            checkPassword();
            checkRepassword();
            checkEmail();
            checkPhone();
        }
    });

    $(".btnStatus ").on('click', function(){
        var name = $(this).attr('data-name');
        $("#StatusBtn").attr('action', $(this).attr('data-action'));  
        var id = $(this).attr('data-id');
        $("#ectiveId").val(id);
        $("#messageShow").html('Do you want to disable'+' <strong>'+name+'</strong>');
    });

    $("#StatusBtn").on('click', function(){
         $.ajax({
            url: baseUrl+'/admin/userEdit',
            method: 'POST',
            data:{id: $("#ectiveId").val(), action:$(this).attr('action'), _token: $("input[name='_token']").val() },
            dataType: 'json',
            beforeSend: function() {
                $(".Dataloading").css({'display': 'block'});
            },
            success: function(respon){
                $(".Dataloading").css({'display': 'block'});
            },
            complete: function() {                    
                setTimeout( function(){
                    $(".Dataloading").css({'display': 'none'});
                    $(".Dataloading").html('');
                }, 6000);
                location.reload();
            },
            error: function (respon) {
              alert('Error');
            }
        });
    });


    $("#VOT").on('focusin', function(){
        var emailReg = RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        var email = $(this).val();
        if (emailReg.test(email)){
            var addHtml = '<div class="EM"><div class="IM"><span>'+email+'</span><input type="hidden" name="email" class="emailto" data="'+email+'"> <span class="vM fa fa-remove (alias)"></span></div></div>';
            $("#addMail div.EM:last").after(addHtml);
            $(this).val('');   
            $(this).focus();        
        }
    });

    $(document).on('click', '.vM', function(){
        remove = $(this).closest('.EM');
        $(remove).remove();
        $("#VOT").focus();
    });

    $(document).on('click', '.item-mail', function(){
        var email = $(this).attr('data-image');
        $("#VOT").val(email);
        $("#VOT").focus();
        $("#list-Down").css({'display': 'none'});
    });

    $(document).on("click", "#btnSendEmail", function(e){
        var email = '';
        $(".emailto").each(function(i, index){
            email += $(index).attr('data')+",";
        });
        if (email == '') {
            $("#VOT").focus();
            e.preventDefault();    
        }
        $("#allEmail").val(email.slice(0, -1));
    });
});

function SearchEmailS (){
    var emailName = $("#VOT").val();    
    $.ajax({        
        url: baseUrl +'/admin/getsearchmail',
        method: 'GET',
        data:{ mail: emailName},
        dataType: 'text',
        success: function(result){          
            $("#list-Down").css({'display': 'block'});
            if (result.status != 0) {
                $("#list-Down").html(result);
            }
        }
    });
} 