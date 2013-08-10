/*common events for all the pages*/
$(function(){
	/*login click events*/
	$("#login_btn").live("click", function(){
		var FRM = $("#login_frm");
		$.login_validate(FRM);
	});
});

$.extend({
	login_validate: function(FRM){
		$(FRM).validate({
            rules: {
                uname: {
                	required: true
                },
                psw: {
                	required: true,
                	minlength: 6
                }
            },
            errorElement: "div",
            messages: {
                uname: "Username required",
                psw: "Password required",
                minlength: "Password must be at least 5 characters long"

            },
            errorPlacement: function(error, element){
                $(element).closest('label').append(error);
            },
            submitHandler: function(form){
            	$.login_post(form);
            }
        });
	},
	login_post: function(FRM){
		var data = $(FRM).serialize();
		$.ajax({
		    type: "POST",
		    url: base_url+"login",
		    data: data,
		    dataType: "json",
		    beforeSend: function(){
		        //console.log(data);
		       // $("#invalid_login").html("");
		    },
		    success: function(data){

		    	if(data.status){
		    		window.location.href = base_url+"login";
		    	}else{
		    		//$("#invalid_login").html(data.message);
					window.location.href = base_url+"login";
		    	}

		    },
		    error: function(e, a){
		       window.location.href = base_url+"login";
		    }
		});
	}
});
