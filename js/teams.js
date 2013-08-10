$(function(){
		   
$('.opt_box_wrapper.team .act-status').die('click').live('click', function(){
	if(!($(this).hasClass('loading') || $(this).attr('status') == "w")){
		toggleTeamSelection($(this));
	}
});

		   
$('.msg_item.player .btn').die('click').live('click', function(){
	teamNotificationResponse($(this));
});

$('.msg_item.player .n_act.relation').die('click').live('click', function(){
	if($(this).next('.relation_list')){
		$(this).next('.relation_list').fadeIn();
		$('body').one('click', function(){
			$('.relation_list').hide();
		});
	}
});

$('.relation_list .rel-item').die('click').live('click', function(){
	var me = $(this), param = [];
	
	param.push("tid="+me.closest('.msg_actions').attr('rel'));
	param.push("uid="+me.closest('.msg_actions').attr('uid'));
	param.push("selected=3");
	param.push("relation_id="+me.attr('rel'));
	$.ajax({
		url:site_url+'players/joinpl',
		data:param.join("&"),
		type:'POST',
		dataType:'json',
		success:function(dataR){
			me.closest('.relation_list').prev('.relation').html(me.html());
		}
	});
});
$('#main_content .schedule_team_sports').die('click').live('click', function(){
	$.showModal({
	    buttons:false,
        height:280,
        width:850,
        title: "Match Details",
        message:"<div id='popup_data' class='data pl_sports_info'>"+$.spinner()+"</div>",
        dialogClass: "wesp_popup",
        resizable: false
	});

	var me = $(this);

	$.ajax({
		url:site_url+'teams/teamschedulesports',
		data:"tid="+me.attr('uid')+"&sid="+me.attr('rel'),
		type:'POST',
		dataType:'json',
		success:function(data){
			var m = [];
			if(data.length){
				m.push('<table id="table-3" width="100%"  >');
				m.push('<tr style="font-weight:bold"><th>Sport Name</th><th>Opponent Team</th><th>Expertise-level</th><th>Location</th><th>Referee Name</th><th>Result</th><th>Date played</th></tr>');
				m.push("<ul class='pl_sports_list'>");			
				for(var i in data){
			 		m.push("<tr><td>"+data[i].sname+"</td><td>"+data[i].pname+"</td>");
				m.push("<td>"+data[i].level+"</td><td>"+data[i].location+"</td>");
				m.push("<td>"+data[i].referee_name+"</td><td>"+data[i].match_result+"</td><td>"+data[i].start_date+"</td></tr>");
				}
				m.push("</table>");
				m.push("");
			}else{
				m.push("<div class='no_no'>No Sports Found</div>");
			}
			

			$('#popup_data').html(m.join(""));
		}
	});
});
$('#join_team_in_profile').die('click').live('click', function(){
    var me = $(this);
    me.hide();
    $.ajax({
        url:site_url+'teams/jointm',
        data:"tid="+me.attr('rel')+"&selected=0",
        type:'POST',
        dataType:'',
        beforeSend:function(){
             $('#team_request_spin').fadeIn();
        },
        success:function(dataR){
            $('#team_request_spin').fadeOut(function(){
                $('#team_request_status').html("<span class='tr_status'>Pending Request</span>");
            });
            me.remove();
        }
    });
});


});

function teamNotificationResponse(me){
	var param = [];
	var actions = me.closest('.msg_actions');
	var status = me.attr('status');
	
	var url = site_url+'teams/jointeam';
	var relations = wesport.relations;
	var selected_relation = 0;
	
		relations = wesport.team_relations;
		selected_relation = 2;
		param.push("tid="+actions.attr('rel'));
		param.push("uid="+actions.attr('uid'));
		param.push("selected="+status);	
	$.ajax({
		url:url,
		data:param.join("&"),
		type:'POST',
		dataType:'json',
		beforeSend:function(){
			actions.html("loading...")
		},
		success:function(dataR){
			var ac = [];
			ac.push("<div class='n_actions'><div class='act_wrap'>");
			if(status == 2){
				ac.push("<a class='n_act relation'>"+relations[selected_relation].label+"</a>");
				
					ac.push("<ul class='relation_list'>");
					ac.push("<li class='tip'><span class='shade'></span><span class='bg'></span></li>");
					for(var i in relations){
						ac.push("<li><a class='rel-item' rel='"+relations[i].id+"'>"+relations[i].label+"</a></li>");
					}
					ac.push("</ul>");
				}
			
			ac.push("</div><div class='clear'></div></div>");

			actions.html(ac.join(""));
		}
	});
}
function toggleTeamSelection(me){
	var from = {"a": 0, "r": 1, "w": 2};
	var to = ["w", "a", "r"];
	var to_text = ["Request Sent", "Join", "Removoe"];
	
	$.ajax({
		url:site_url+'teams/jointm',
		data:"tid="+me.attr('rel')+"&selected="+from[me.attr('status')],
		type:'POST',
		dataType:'',
		beforeSend:function(){
			me.addClass('loading');
		},
		success:function(dataR){
			me.removeClass('loading');
			me.html(to_text[dataR]);
			me.attr('status', to[dataR]);
		}
	});
}



