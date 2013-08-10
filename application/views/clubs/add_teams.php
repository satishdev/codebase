<script>

$(function(){

var searchCall = {};

$('#i-search.teams').live('keyup', function(){
	if(searchCall){
		clearTimeout(searchCall);
	}
	
	if($.trim($(this).val()) != ""){
		searchCall = setTimeout(function(){
					$.ajax({
						url:site_url+'clubs/search_teams',
						data:"search="+$('#i-search').val(),
						type:'POST',
						dataType:'json',
						beforeSend:function(){
						},
						success:function(data){
							var t = [];
							
							if(data.records.length){
								for(var i in data.records){
									t.push("<div class='contact_card fl'>");
									t.push("<div class='contact_left'>");
									t.push("<div class='image_area'><img class='contact_img' src='"+base_url+(data.records[i].logo!=""?"images/teams/th_"+data.records[i].logo:"css/images/no_team.jpg")+"' /></div>");
									t.push("</div>");
									t.push("<div class='contact_right'>");
									t.push("<div class='line c1'><h3>"+data.records[i].name+"</h3></div>");
									//t.push("<div class='line c2'>"+data[i].sname+"</div>");
									//t.push("<div class='line c3'>Players: "+data[i].cnt+"</div>");
									t.push("<div class='more'><a href='"+base_url+"teams/viewteam/"+data.records[i].id+"'>More..</a></div>");
									t.push("</div>");
									t.push("<div class='contact_ftr'>");
									t.push("<div class='owner'>Captain: Raju</div>")
									t.push("</div>");
									t.push("</div>");
								}
								t.push("<div class='clear'></div>");
							}else{
								t.push("<div class='no_no'>No Teams Found</div>");
							}
							
							$('#i-search-result').html(t.join(""));
						}
					})
					
				}, 600);
	}else{
		searchCall = setTimeout(function(){
			$('#i-search-result').html("");
		}, 600);
	}
})

})

</script>

<div id='content_header'>
	<div class='hdr-text'>Add Teams</div>
</div>

<div id="content_wrapper">

<div class="i-search-wrapper">
	<div class="i-search-for">Search Teams</div>
    <div class="i-search-ca"><input type="text" id="i-search" class="i-search teams" /></div>
</div>

<div id="i-search-result" class="opt_box_wrapper team"></div>

</div>