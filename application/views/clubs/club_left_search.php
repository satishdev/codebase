<script>
$(document).ready(function() {
$('.club_search').focus(function(){
        if($(this).val()=='Search with club name'){
            $(this).val('');
        }
    });

    $('.club_search').blur(function(){
        if($(this).val()==''){
            $(this).val('Search with club name');
        }
    });
	$('.club_search_zip').focus(function(){
        if($(this).val()=='Search with zip code'){
            $(this).val('');
        }
    });

    $('.club_search_zip').blur(function(){
        if($(this).val()==''){
            $(this).val('Search with zip code');
        }
    });
});	
</script>
<div id="lns_wrap">
<div class="lns_hdr">Search WeSport</div>
<form id="appl_form" method="post" action="<?php echo site_url('cb/clubs');?>" name="appl_form">
<div class="lns_ca">
	<div class="lns_item">
    	<label class="lns_lbl" for="lns_search_f">Club name</label>
        <input type="text" class="text lns_obj club_search" id="cname" name="cname" value="<?php if($cname!='') echo $cname;else echo "Search with club name";?>" />
    </div>
    <div class="lns_item">
    	<label class="lns_lbl" for="lns_search_l">Location or Zipcode</label>
        <input type="text" class="text lns_obj club_search_zip" id="zip" name="zip" value="<?php if($zip!='') echo $zip;else echo "Search with zip code";?>" />
    </div>
    <div class="lns_ftr"><input type="submit" name="serach" value="Search" class="lns_btn" /></div>
</div></form>
</div>