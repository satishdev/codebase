var dropMenuTimer,dropMenuTimer2;
var tempUP;
var wesport = {};

function change_password(){
    $.showModal({
        message:$.change_psw_form(),
        width:400,
        height:280,
        resizable: false,
        buttons:
            [{
                text: "Cancel",
                click: function() {$(this).dialog("close");}
            },
            {
                text: "Change Password",
                click: function() {validate_password_form();}
            }]
    });
}

function validate_password_form(){
    $('#password_form').validate({
        rules:{
            psw:{
                required:true
            },
            password:{
                required:true
            },
            password2:{
                required:true,
                equalTo: "#password"
            }
        },
        messages:{
            psw:{
                required:'Enter Old Password'
            },
            password:{
                required:'Enter New Password'
            },
            password2:{
                required:'Enter New Password',
                equalTo: 'New Password do not match'
            }
        },
        submitHandler:function(form){
            // $('#modal_message').dialog('close');
            ajax_psw_form();
        }
    });
    $('#password_form').submit();
}

function ajax_psw_form(){
    dataP=$('#password_form').serialize();
    $.ajax({
        url:site_url+'changepass/change_password',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            if(dataR=='0'){
                alert('Please enter the correct password');
                $('#psw').focus();
            }else{
                alert('Password changed successfully');
                $('#modal_message').dialog('close');
            }
        }
    });
}


/*********************************************************************************************************************************/
/**************************************************** NEW JS *********************************************************************/
/*********************************************************************************************************************************/
/*********************************************************************************************************************************/

$(function(){
	$('#search_filter_type').toggle(function(){
		var me = $(this);
		me.addClass('active');
        $('#user_type_selector_options').fadeIn();
		
		$('body').trigger('click').bind('click', function(){
			me.trigger('click');
		});
	},
	function(){
		$('#user_type_selector_options').hide();
		$('#search_filter_type').removeClass('active');
		$('body').unbind('click');
	});

	$('#user_settings').toggle(function(){
		var me = $(this);
		var overflow = $('#user_settings').width()
		$('#settings_drop_wrap .settings').addClass('active');
		if(overflow >= 140){
			$('#settings_drop_wrap .settins_drop,#user_settings').addClass('overflow');
		}
        $('#settings_drop_wrap .settins_drop').fadeIn();
		
		$('body').trigger('click').bind('click', function(){
			me.trigger('click');
		});
	},
	function(){
		$('#settings_drop_wrap .settins_drop').hide();
		$('#settings_drop_wrap .settings').removeClass('active');
		$('body').unbind('click');
	});

    $('.menu_search').focus(function(){
        if($(this).val()=='Search...'){
            $(this).val('');
        }
    });

    $('.menu_search').blur(function(){
        if($(this).val()==''){
            $(this).val('Search...');
        }
    });

    $('#user_type_selector_options .menu_link').live('click',function(){
        $('.user_type_selector').text($(this).text());
        //$('#search_type_id').val($(this).attr('rel'));
        $('#user_type_selector_options').slideUp('fast',function(){ $('.menu_bar .menu_link').removeClass('active'); });
		/*var post_url = ["players/allplayers", "cb/allclubs", "players/allplayers", "teams/allteams"]
		$('form#srch').attr('action', base_url+post_url[$(this).attr('rel')]);*/
    });

    $('.menu_left .schedule_match').live('click', function(){
        var me = $(this);

        $.scheduleMatch({
            team: me.attr('rel')=="2"
        });
    });

    $('#cancel_match').live('click', function(){
        $('.ui-icon.ui-icon-closethick').trigger('click');
    });

    $('#save_match.active').live('click', function(){
        var me = $(this);
        var form = $('#match_form');
        form.validate();
        if(form.valid()){
            $.ajax({
                url:site_url+'schedule/schedule_match',
                data:$('#match_form').serialize(),
                type:'POST',
                dataType:'json',
                beforeSend: function(){
                    me.removeClass('active');
                },
                success:function(data){
                    $('#popup_footer').find('.success, .error').hide();
                    if(data.error){
                        $('#popup_footer .error').show();
                        me.addClass('active');
                    }else{
                        $('#popup_footer .success').show();

                        setTimeout(function(){
                            $('.ui-icon.ui-icon-closethick').trigger('click');
                            location = base_url+"players/scheduler";
                        }, 800);
                    }                    
                },
                error: function(){
                    $('#popup_footer').find('.success, .error').hide();
                    $('#popup_footer').find('.error').show();
                    me.addClass('active');
                }
            });
        }
    });

    $('#fancybox-comments-ftr .txt_comment').die('focus').live('focus', function(){
        if($.trim($(this).val()) == "Write a comment..."){
            $(this).val("").removeClass('blur');
        }        
    });

    $('#fancybox-comments-ftr .txt_comment').die('blur').live('blur', function(){
        if($.trim($(this).val()) == ""){
            $(this).val("Write a comment...").addClass('blur');
        }
    });

    $('#fancybox-comments-ftr .txt_comment').die('keydown').live('keydown', function(e){
        var me = $(this);
        var key = e.keyCode || e.charCode || e.which;
        var param = [];

        if($.trim(me.val()) !=  "" && key == 13){
            e.preventDefault();
            param.push("img_id="+me.attr('img_id'));
            param.push("comment="+me.val());
            $.ajax({
                url:site_url+'pcomments/addcomments',
                data: param.join("&"),
                type:'POST',
                dataType:'json',
                success:function(dataR){
                    me.val('').trigger('blur')
                    $("#fancybox-comments").html($.getImageContents({data: dataR}));
                }
            });
        }
    });

});



$.extend({


spinner: function(){
    return "<img class='spinner' src='"+base_url+"css/images/spinner.gif' />";
},

roundedButton: function(opts){
    var config = {
        id: "new_button",
        css: false,
        label: "Button",
        href: false
    };
    if(opts) $.extend(config, opts);

    var btn = [];
    btn.push("<a id='"+config.id+"' class='btnRC active"+(config.css?" "+config.css:"")+"'"+(config.href?" href='"+config.href+"'":"")+">");
    btn.push("<span class='inner-btn'><span class='label'>"+config.label+"</span></span>");
    btn.push("</a>");
    
    return btn.join("");
},

selectBox: function(opts){
    var config = {
        id: "new_select_box",
        classa: false,
        name: false,
        prefill: false,
        options: [{id: 0, label: "Select Option"}],
        onChange: false,
        title: false
    };
    if(opts) $.extend(config, opts);
    var s = [];
    s.push("<select id='"+config.id+"' class='select"+(config.classa?" "+config.classa:"")+"'"+(config.onChange?" onChange='"+config.onChange+"'":"")+(config.name?" name='"+config.name+"'":"")+(config.title?" title='"+config.title+"'":"")+">");
    if(config.prefill){
        s.push("<option value='"+config.prefill.id+"'>"+config.prefill.label+"</option>");
    }
    if(config.options.length){
        for(var i in config.options){
            s.push("<option value='"+config.options[i].id+"'>"+config.options[i].label+"</option>");
        }
    }
    s.push("</select>");

    return s.join("");
},

scheduleMatch: function(opts){
    var config = {        
        team: false
    };
    if(opts) $.extend(config, opts);

    $.showModal({
        buttons:false,
        height:450,
        width:650,
        title: "Schedule Match",
        message:"<div id='popup_data' class='data schedule_match'>"+$.spinner()+"</div><div id='popup_footer' class='popup_footer'></div>",
        dialogClass: "wesp_popup footer_true",
        resizable: false
    });

    $.getMatchInfo({
        params: {user_id: $('#user_id').val()},
        team: config.team,
    });

    
},

getMatchInfo: function(opts){
    var config = {
        team: false,
    };
    if(opts) $.extend(config, opts);

    var url = "";
    if(config.team){
        url = site_url+'schedule/teams';
    }else{
        url = site_url+'schedule/players';
    }

    $.ajax({
        url: url,
        data:config.params,
        type:'POST',
        dataType:'json',
        success:function(data){
            var mydata = {
                p1: {id: $('#user_id').val(), name: $('#user_name').val()},
                p2: data
            };
            $.createMatchView({data: mydata, team: config.team});            
        }
    });
    
},

createMatchView: function(opts){
    var config = {
        data: {
            p1: {id: 0, label: "Player 1"},
            p2: [{id: 0, label: "Select Opponent"}],
            sports: [{id: 0, label: "Select Sport"}],            
            club: [{id: 0, label: "Select Club"}],
            courts: [{id: 0, label: "Select Court"}]
        }
    };
    if(opts) $.extend(config, opts);

    var match = [];

    match.push("<div class='create_match'>");
    match.push("<form id='match_form'>");
    match.push("<ul class='wesp-form'>");

    if(config.team){
        match.push("<li>");
        match.push("<label for='team1'>Your Team:</label>");
        match.push($.selectBox({
                        id: "team1",
                        classa: "field required",
                        name: "p1",
                        title: "Please select Your Team",
                        prefill: {id: '', label: "Select Team"},
                        options: config.data.p2
                    }));
        //match.push("<span id='team1'>"+config.data.p1.name+"</span>");
        //match.push("<input type='hidden' name='p1' value='"+config.data.p1.id+"' />");
        match.push("<input type='hidden' id='match_type' name='type' value='2' />");
        match.push("</li>");

        match.push("<li>");
        match.push("<label for='team2'>Opponent Team:</label>");
        match.push($.resetOpponentTeams(config.data.p2));
        match.push("<img id='team2_spin' class='loading_spin m_data_spin' />");
        match.push("</li>");
        match.push("<li id='other_team2' style='display:none'></li>");        
    }else{
        match.push("<li>");
        match.push("<label for='player1'>You:</label>");
        match.push("<span id='player1'>"+config.data.p1.name+"</span>");
        match.push("<input type='hidden' name='p1' value='"+config.data.p1.id+"' />");
        match.push("<input type='hidden' id='match_type' name='type' value='1' />");
        match.push("</li>");

        match.push("<li>");
        match.push("<label for='player2'>sFriend:</label>");
        match.push($.selectBox({
                        id: "player2",
                        classa: "field required",
                        name: "p2",
                        title: "Please select sFriend",
                        onChange: "$.changeMatchPlayer2(this)",
                        prefill: {id: '', label: "Select Opponent"},
                        options: config.data.p2
                    }));        
        match.push("</li>");
        match.push("<li id='other_player2' style='display:none'></li>");

        match.push("<li>");
        match.push("<label for='sport_name'>Sport Name:</label>");
        match.push($.resetSports([]));
        match.push("<img id='sport_name_spin' class='loading_spin m_data_spin' />");
        match.push("</li>");       
    }    
    
    match.push("<li>");
    match.push("<label for='club_name'>Club Name:</label>");
    match.push($.resetClubs([]));
    match.push("<img id='club_name_spin' class='loading_spin m_data_spin' />");
    match.push("</li>");    
    match.push("<li id='other_club' style='display:none'></li>");

    match.push("<li>");
    match.push("<label for='court_name'>Court Name:</label>");
    match.push($.resetCourts([]));
    match.push("<img id='court_name_spin' class='loading_spin m_data_spin' />");
    match.push("</li>");

    match.push("<li>");
    match.push("<label for='location'>Location:</label>");
    match.push("<input type='text' id='location' class='text field required' name='location' title='Please enter Location' />");
    match.push("</li>");

    match.push("<li>");
    match.push("<label for='start_time'>Start Time:</label>");
    match.push("<input type='text' id='start_time' class='text field required' name='start_time' readonly='readonly' title='Please enter Start Time' />");
    match.push("</li>");

    match.push("<li>");
    match.push("<label for='end_time'>End Time:</label>");
    match.push("<input type='text' id='end_time' class='text field required' name='end_time' readonly='readonly' title='Please enter End Time' />");
    match.push("</li>");

    match.push("<li>");
    match.push("<label for='referee_name'>Referee Name:</label>");
    match.push("<input type='text' id='referee_name' class='text field required' name='referee_name' title='Please enter Referee Name' />");
    match.push("</li>");

    match.push("<li>");
    match.push("<label for='note'>Note:</label>");
    match.push("<textarea id='note' class='field required' name='note' title='Please enter note'></textarea>");
    match.push("</li>");

    match.push("</ul>");
    match.push("</form>");
    match.push("</div>");

    $('#popup_data').html(match.join(""));

    var footer = [];
    footer.push("<div class='success'>Match Scheduled Successfully</div>");
    footer.push("<div class='error'>Error while scheduling Match</div>");
    footer.push($.roundedButton({id: "cancel_match", css: "popup_cancel", label: "Cancel"}));
    footer.push($.roundedButton({id: "save_match", css: "popup_save", label: "Schedule Match"}));

    $('#popup_footer').html(footer.join(""));

    $.bindMatchDates();
},

changeMatchPlayer2: function(me){
    var me = $(me);
    var value = me.val();
    if(value == 'other'){
        var p = [];
        p.push("<div class='li'><label for='other_player2_name'>Other Player Name:</label><input type='text' id='other_player2_name' class='text field' /></div>");
        p.push("<div><label for='other_player2_email'>Email Address:</label><input type='text' id='other_player2_email' class='text field' /></div>");
        $('#other_player2').html(p.join("")).slideDown();
    }else if(value == 0){
        $.resetSports([]);
    }else if(value && value > 0){
        /*$('#other_player2').slideUp(function(){
            $(this).html("");
        });*/
        var param = [];
        param.push("pid="+value);
        param.push("match_type="+$('#match_type').val());
        $.ajax({
            url:site_url+'schedule/sports',
            data: param.join("&"),
            type:'POST',
            dataType:'json',
            beforeSend: function(){
                $('#sport_name_spin').fadeIn();
            },
            success:function(data){
                $('#sport_name_spin').fadeOut();
                $.resetSports(data);
            }
        });
    }

    $.resetClubs([]);
    $.resetCourts([]);
},

changeMatchSport: function(me){
    var me = $(me);
    var value = me.val();

    if(value == 0){
        $.resetClubs([]);
    }else if(value && value > 0){
        var param = [];
        param.push("sid="+value);
        param.push("match_type="+$('#match_type').val());
        $.ajax({
            url:site_url+'schedule/clubs',
            data: param.join("&"),
            type:'POST',
            dataType:'json',
            beforeSend: function(){
                $('#club_name_spin').fadeIn();
            },
            success:function(data){
                $('#club_name_spin').fadeOut();
                $.resetClubs(data);
            }
        });
    }

    $.resetCourts([]);
},

changeMatchClub: function(me){
    var me = $(me);
    var value = me.val();
    if(value == 'other'){
        var c = [];
        c.push("<div class='li'><label for='other_club_name'>Other Club Name:</label><input type='text' id='other_club_name' class='text field' /></div>");
        $('#other_club').html(c.join("")).slideDown();
    }else if(value == 0){
        $.resetCourts([]);
    }else if(value && value > 0){
        /*$('#other_club').slideUp(function(){
            $(this).html("");
        });*/
        var param = [];
        param.push("cid="+value);
        param.push("match_type="+$('#match_type').val());
        $.ajax({
            url:site_url+'schedule/courts',
            data: param.join("&"),
            type:'POST',
            dataType:'json',
            beforeSend: function(){
                $('#court_name_spin').fadeIn();
            },
            success:function(data){
                $('#court_name_spin').fadeOut();
                $.resetCourts(data);
            }
        });
    }
},

changeMatchTeam2: function(me){
    var me = $(me);
    var value = me.val();
    if(me.val() == 'other'){
        var p = [];
        p.push("<div class='li'><label for='other_team2_name'>Other Team Name:</label><input type='text' id='other_team2_name' class='text field' /></div>");
        $('#other_team2').html(p.join("")).slideDown();
    }else if(value == 0){
        $.resetClubs([]);
    }else if(value && value > 0){
        /*$('#other_team2').slideUp(function(){
            $(this).html("");
        });*/
        var param = [];
        param.push("team_id="+value);
        param.push("match_type="+$('#match_type').val());
        $.ajax({
            url:site_url+'schedule/clubs',
            data: param.join("&"),
            type:'POST',
            dataType:'json',
            beforeSend: function(){
                $('#club_name_spin').fadeIn();
            },
            success:function(data){
                $('#club_name_spin').fadeOut();
                $.resetClubs(data);
            }
        });
    }
},

resetOpponentTeams: function(data){
    var d = $.selectBox({
                id: "team2",
                classa: "field required",
                name: "p2",
                title: "Please select Opponent Team",
                onChange: "$.changeMatchTeam2(this)",
                prefill: {id: 0, label: "Select Team"},
                options: data
            });
    if($('#team2').length){
        $('#team2').replaceWith(d);
    }else{
        return d;
    }
},

resetSports: function(data){
    var d = $.selectBox({
                id: "sport_name",
                classa: "field required",
                name: "sport_name",
                title: "Please select Sport Name",
                onChange: "$.changeMatchSport(this)",
                prefill: {id: '', label: "Select Sports"},
                options: data
            });
    if($('#sport_name').length){
        $('#sport_name').replaceWith(d);
    }else{
        return d;
    }
},

resetClubs: function(data){
    var d =$.selectBox({
                id: "club_name",
                classa: "field required",
                name: "club_name",
                title: "Please select Club Name",
                onChange: "$.changeMatchClub(this)",
                prefill: {id: '', label: "Select Club"},
                options: data
            });
    if($('#club_name').length){
        $('#club_name').replaceWith(d);
    }else{
        return d;
    }
},

resetCourts: function(data){
    var d = $.selectBox({
                id: "court_name",
                classa: "field required",
                name: "court_name",
                title: "Please select Court Name",
                prefill: {id: '', label: "Select Court"},
                options: data
            });
    if($('#court_name').length){
        $('#court_name').replaceWith(d);
    }else{
        return d;
    }
},

bindMatchDates: function(){
    $("#start_time").datetimepicker({
                        beforeShow: function(){
                            return {minDate: new Date(), maxDate: $("#end_time").datepicker("getDate") || null}
                        },
                        dateFormat:'yy-mm-dd',
                        timeFormat: 'hh:mm',
                        changeMonth: true,
                        changeYear: true
                    });
    $("#end_time").datetimepicker({
                        beforeShow: function(){
                            return {minDate: $("#start_time").datepicker("getDate") || null}
                        },
                        dateFormat:'yy-mm-dd',
                        timeFormat: 'hh:mm',
                        changeMonth: true,
                        changeYear: true
                    });
},

getImageContents: function(opts){
    var config = {
        data: {            
            image: {
                img_id: 57,
                desc: "",
                time: "",
                id: 58,
                name: $('#user_name').val(),
                img: ""
            },
            user: {
                id: 58,
                name: "test",
                img: "http://localhost/wesp/uploads/th_Desert.jpg"
            },
            comments: [
                /*{
                    id: 58,
                    name: "test",
                    img: "http://localhost/wesp/uploads/th_Penguins1.jpg",
                    comment: "Speech is silver, Silence is gold...",
                    time: "30 minutes ago"
                }*/
            ]
        }
    };
    if(opts) $.extend(config, opts);

    var o = [];

    o.push("<div id='fancybox-comments-hdr'>");
    o.push("<img class='user_img' src='"+config.data.image.img+"' />");
    o.push("<div class='this_img_info'>");
    o.push("<div class='user_name'>"+config.data.image.name+"</div>");
    o.push("<div class='img_upload_time'>"+config.data.image.time+"</div>");
    o.push("</div>");
    o.push("<div class='this_img_desc'>"+config.data.image.desc+"</div>");
    o.push("</div>");

    o.push("<div id='fancybox-comments-body'>");
    for(var i in config.data.comments){
        o.push($.addComment(config.data.comments[i]));
    }
    o.push("</div>");

    o.push("<div id='fancybox-comments-ftr'>");
    o.push("<img class='user_img_small' src='"+base_url+config.data.user.img+"' />");
    o.push("<textarea class='txt_comment blur' img_id='"+config.data.image.img_id+"'>Write a comment...</textarea>");
    o.push("</div>");

    return o.join("");
},

addComment: function(obj){
    var c = [];
    c.push("<div class='i_comment'>");
    c.push("<img class='i_cmt_img' src='"+obj.img+"' />");
    c.push("<div class='i_cmt'>");
    c.push("<div class='i_cmt_content'>"+obj.comment+"</div>")
    c.push("<div class='i_cmt_time'>"+obj.time+"</div>");
    c.push("</div>");
    c.push("</div>");

    return c.join("");
},

initUploader: function(opts){
    var config = {          
        id: false,
        action: false,
        size: (2*1024),
        formId: false,          
        removeItemURL: false,
        onRemoveComplete: false,
        onCancel: false,
        onSubmit: false,
        onProgress: false,
        onComplete: false,
        buildIn: false,
        showList: true,
        uploadText: "Upload a file",
        enableDragDrop: true,
        onInvalidExtn: false,
        onSizeError: false,
        buttonCss: "messaging-icn",
        multiple: false,
        showMessage: false,
     custom_settings: {}
    };
    if(opts) $.extend(config, opts);
    
    /*console.log("enableDragDrop: " + config.enableDragDrop);*/
    if(config.action && $('#'+config.id).length){
        var uploader = new qq.FileUploader({
            element: document.getElementById(config.id),
            id: config.id,
            action: config.action,
            debug: false,
            multiple: config.multiple,
            buildIn: config.buildIn,
            showList: config.showList,
            uploadText: config.uploadText,
            enableDragDrop: config.enableDragDrop,
            onInvalidExtn: config.onInvalidExtn,
            onSizeError: config.onSizeError,
            sizeLimit: config.size,
            removeItemURL: config.removeItemURL,
            //allowedExtensions: config.allowedExtensions,
            buttonCss: config.buttonCss,
        custom_settings: config.custom_settings,
            onCancel: function(id, name){
                //console.log("cancel: " + id + " : " + name);
                if(config.onCancel){config.onCancel(id, name);}
            },
            showMessage: function(msg, obj){
                $(obj._listElement).append("<li class='qq-error'>"+msg+"<a class='qq-upload-remove qq-e'>Remove</a></li>");
                if(config.showMessage){config.showMessage(msg);}
            },
            onSubmit: function(id, name){           
                if(config.onSubmit){config.onSubmit(id, name);}
            },
            onComplete: function(id, name, response){           
                if(config.onComplete){config.onComplete(id, name, response);}
            },
            onProgess: function(id, fileName, loaded, total){
                if(config.onProgess){config.onProgess(id, name, loaded, total);}
            }
        });
            
        if(config.removeItemURL){
            $(".qq-upload-list .qq-upload-remove").die("click").live("click touchend", function(e){
                e.stopPropagation();
                if($(this).hasClass("qq-e")){
                    $(this).closest("li.qq-error").remove();
                }else{
                    if($(this).hasClass("old")){
                        $(this).closest("li.qq-item").remove();
                    }else{
                        $.removeUploadedFiles({
                            obj: $(this),
                            url: config.removeItemURL,
                            type: 0
                        });
                    }
                }
            });
        }           
            
    }

},

removeUploadedFiles: function(opts){
    var config = {
        obj: false,
        url: false,
        type: 0, /*0: single 1: multiple    */
        onComplete: false
    };
    if(opts) $.extend(config, opts);
        
    if(config.type===0){/*single file remove*/
        var parent = $(config.obj).closest("li.qq-item");
        var r = $(config.obj).attr("rel");
        var param = [];
        param.push("filename[]="+ r);
    }else if(config.type===1){/*multiple file remove*/
        var parent = $(config.obj).closest("ul");   
            
        var param = [];
            
        var items = $(parent).find(".qq-upload-remove");

        $(items).each(function(){
            var r = $(this).attr("rel");                
            param.push("filename[]="+ r);
        });         
    }       
        
    $.ajax({
        type: "POST",
        data: param.join("&"),
        url: config.url,
        dataType:'json',
        success: function(){
            parent.remove();
            if(config.onComplete) config.onComplete(data);
        }
    });
}

});
