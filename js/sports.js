$(function(){
	
$('.opt_box_wrapper.sport .act-status').die('click').live('click', function(){
	if(!($(this).hasClass('loading') || $(this).attr('href'))){
		toggleSportSelection($(this));
	}
});

});

function toggleSportSelection(me){
	var from = {"a": 0, "r": 1};
	var to = ["r", "a"];
	var to_text = ["Added", "Add"];
	
	$.ajax({
		url:site_url+'sports/joinsp',
		data:"sid="+me.attr('rel')+"&selected="+from[me.attr('status')],
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



