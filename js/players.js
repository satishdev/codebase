$(function(){

var ac = [];
ac.push("<ul class='relation_list'>");
ac.push("<li class='tip'><span class='shade'></span><span class='bg'></span></li>");
for(var i in wesport.relations){
	ac.push("<li><a class='rel-item' rel='"+wesport.relations[i].id+"'>"+wesport.relations[i].label+"</a></li>");
}
ac.push("</ul>");
$('#content_wrapper.friends .n_act.relation').parent().append(ac.join(""));


$('#content_wrapper.friends .n_act.relation').die('click').live('click', function(e){
	$(this).next('.relation_list').fadeIn();
	$('body').one('click', function(){
		$('.relation_list').hide();
	});
});

$('#content_wrapper.friends .relation_list .rel-item').die('click').live('click', function(){
	var me = $(this), param = [];
	
	param.push("pid="+me.closest('.msg_actions').attr('rel'));
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

$('#content_wrapper.players .act-status').die('click').live('click', function(){
	if(!($(this).hasClass('loading') || $(this).attr('status') == "w")){
		togglePlayersSelection($(this));
	}
});

$('#content_wrapper.players .more_player_sports').die('click').live('click', function(){
	$.showModal({
	    buttons:false,
        height:280,
        width:450,
        title: "Player Sports Details",
        message:"<div id='popup_data' class='data pl_sports_info'>"+$.spinner()+"</div>",
        dialogClass: "wesp_popup",
        resizable: false
	});

	var me = $(this);

	$.ajax({
		url:site_url+'players/playersSports',
		data:"pid="+me.attr('rel'),
		type:'POST',
		dataType:'json',
		success:function(data){
			var m = [];
			if(data.length){
				m.push("<div class='pl_sports_hdr'><div class='pl_s_name'>Sport</div><div class='pl_ex_level'>Expert Level</div></div>");
				m.push("<div class='pl_sports_data'>");
				m.push("<ul class='pl_sports_list'>");			
				for(var i in data){
					m.push("<li class='s_row'><div class='pl_s_name'>"+data[i].name+"</div><div class='pl_ex_level'>"+data[i].level+"</div></li>");
				}
				m.push("</ul>");
				m.push("</div>");
			}else{
				m.push("<div class='no_no'>No Sports Found</div>");
			}
			

			$('#popup_data').html(m.join(""));
		}
	});
});

});

$('#main_content .schedule_player_sports').die('click').live('click', function(){
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
		url:site_url+'players/playersschedulesports',
		data:"pid="+me.attr('uid')+"&sid="+me.attr('rel'),
		type:'POST',
		dataType:'json',
		success:function(data){
			var m = [];
			if(data.length){
				m.push('<table id="table-3" width="100%"  >');
				m.push('<tr style="font-weight:bold"><th>Sport Name</th><th>sFriend Name</th><th>Expertise-level</th><th>Location</th><th>Referee Name</th><th>Result</th><th>Date played</th></tr>');
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


function togglePlayersSelection(me){
	var from = {"a": 0, "r": 1, "w": 2};
	var to = ["w", "a", "r"];
	var to_text = ["sFriend Request Sent", "Add", "Removoe"];
	
	$.ajax({
		url:site_url+'players/joinpl',
		data:"pid="+me.attr('rel')+"&selected="+from[me.attr('status')],
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