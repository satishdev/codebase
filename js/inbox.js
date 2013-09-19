$(function(){
		   
$('.msg_item.player .btn').die('click').live('click', function(){
	playerNotificationResponse($(this));
});
$('.msg_item.player .btn_schedule').die('click').live('click', function(){
	var me = $(this), param = [];
	var sh_type=me.closest('.msg_actions').attr('ntype');
	var sh_status=me.closest('.btn_schedule').attr('status');
	param.push("schedule_id="+me.closest('.msg_actions').attr('rel'));
	param.push("schedule_type="+sh_type);
	param.push("status="+sh_status);
	if(sh_status==4){
		param.push("score="+$('#score').val());
	}
	if((sh_type==6 || sh_type==7) && (sh_status==1 || sh_status==2 || sh_status==3)){
		win_loss_update(me,sh_type,sh_status);
	}else{
	$.ajax({
		url:site_url+'players/approvent',
		data:param.join("&"),
		type:'POST',
		dataType:'json',
		beforeSend:function(){
			me.html("loading...")
		},
		success:function(dataR){
			if((dataR.type==2 || dataR.type==3 || dataR.type==4 || dataR.type==5) && dataR.status==2)
			me.closest('.n_actions').html('Accepted');
			else if((dataR.type==2 || dataR.type==3 || dataR.type==4 || dataR.type==5) && dataR.status==1)
			me.closest('.n_actions').html('Declined ');
			else if((dataR.type==6 || dataR.type==7) && dataR.status==4)
			me.closest('.n_actions').html('Won');
			else if((dataR.type==6 || dataR.type==7) && dataR.status==5)
			me.closest('.n_actions').html('Loss ');
			else if((dataR.type==6 || dataR.type==7) && dataR.status==6)
			me.closest('.n_actions').html('No Result');
		}
	});
	}
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

});

function win_loss_update(me,sh_type,sh_status){
var param = [];	
param.push("<div class='act_wrap'><span class='label_score' >Score</span></div>");
param.push("<div class='act_wrap'><textarea id='score' name='score' class='score'></textarea></div>");
if(sh_status==1){
param.push("<div class='act_wrap'><a class='n_act btn_schedule main' status='4'>Update</a></div>");
}else if(sh_status==2){
	param.push("<div class='act_wrap'><a class='n_act btn_schedule main' status='5'>Update</a></div>");
}else if(sh_status==3){
	param.push("<div class='act_wrap'><a class='n_act btn_schedule main' status='6'>Update</a></div>");
}
param.push("<div class='clear'></div>");
	me.closest('.n_actions').html(param.join(""));
}
function playerNotificationResponse(me){
	var param = [];
	var actions = me.closest('.msg_actions');
	var status = me.attr('status');
	var team = (actions.attr('ntype') == 2);
	
	var url = site_url+'players/joinpl';
	var relations = wesport.relations;
	var selected_relation = 0;
	
	if(team){
		var url = site_url+'teams/jointm';
		relations = wesport.team_relations;
		selected_relation = 2;
		param.push("tid="+actions.attr('rel'));
	}else{
		param.push("pid="+actions.attr('rel'));
	}
	
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
				
				if(!team){
					ac.push("<ul class='relation_list'>");
					ac.push("<li class='tip'><span class='shade'></span><span class='bg'></span></li>");
					for(var i in relations){
						ac.push("<li><a class='rel-item' rel='"+relations[i].id+"'>"+relations[i].label+"</a></li>");
					}
					ac.push("</ul>");
				}
			}else{
				ac.push("<a class='n_act relation'>Rejected</a>");
			}
			ac.push("</div><div class='clear'></div></div>");

			actions.html(ac.join(""));
		}
	});
}
function inbox_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/inbox/inbox_grid',
            datatype: "json",
            width:648,
            height:600,
            mtype: 'POST',
            recordtext: "Message(s)",
            recordtext: "Viewing {0} - {1} of {2} Message(s)",
            pgtext : "Page {0} of {1}",
            colNames:['From','Subject', 'Date'],
            colModel:[
                    {name:'first_name',index:'u.first_name', width:80},
                    {name:'subject',index:'i.subject', width:150},
                    {name:'date',index:'i.create_date', width:80}
            ],
            rowNum:10,
            rowList:[10,20,50],
            pager: '#grid_pager',
            sortname: 'i.create_date',
            viewrecords: false,
            sortorder: "desc",
            caption:"Message(s)",
            loadtext:'Loading..',
            postData:{
                //user_type:$('[name=users_type]').val(),
               // status:$('[name=status]').val()
            },
            loadComplete:function(data){
                $('#inbox_messages').find('.label_span').html($('#inbox_messages').find('.label_span').html()+' ('+data.records+')');
            }
    });
}

function inbox_sent_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/inbox/inbox_sent_grid',
            datatype: "json",
            width:648,
            height:600,
            mtype: 'POST',
            recordtext: "Message(s)",
            recordtext: "Viewing {0} - {1} of {2} Message(s)",
            pgtext : "Page {0} of {1}",
            colNames:['To','Subject', 'Date'],
            colModel:[
                    {name:'first_name',index:'u.first_name', width:80},
                    {name:'subject',index:'i.subject', width:150},
                    {name:'date',index:'i.create_date', width:80}
                    
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'i.create_date',
            viewrecords: false,
            sortorder: "desc",
            caption:"Message(s)",
            loadtext:'Loading..',
            postData:{
                //user_type:$('[name=users_type]').val(),
               // status:$('[name=status]').val()
            }
    });
}

