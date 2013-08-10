$(document).ready(	
	function() {
		$container = $(".container");
		$container.wtGallery({
			num_display:4,
			screen_width:590,
			screen_height:360,
			padding:10,
			thumb_width:125,
			thumb_height:70,
			thumb_margin:5,
			text_align:"top",
			caption_align:"bottom",
			auto_rotate:false,
			delay:5000,					
			cont_imgnav:true,
			cont_thumbnav:true,
			display_play:true,
			display_imgnav:true,
			display_imgnum:false,
			display_thumbnav:true,
			display_thumbnum:false,					
			display_arrow:true,
			display_tooltip:false,
			display_timer:true,
			display_indexes:true,
			mouseover_pause:false,
			mouseover_text:false,
			mouseover_info:false,
			mouseover_caption:true,
			mouseover_buttons:false,
			transition:"h.slide",
			transition_speed:800,
			scroll_speed:600,
			vert_size:45,
			horz_size:45,					
			vstripe_delay:90,
			hstripe_delay:90,
			move_one:false,
			shuffle:false
		});
		
		var $submitButton = $("#submit-btn");
		var $resetButton =  $("#reset-btn");
		var $effects = $("#effects");		
		var $textAlign = $("input[name='text-align']");
		var $captionType = $("input[name='cap-type']");
		var $thumbsAlign = $("input[name='thumbs-align']");
		var $playCB = $("#play-cb");
		var $imgnavCB = $("#imgnav-cb");
		var $imgNumCB = $("#imgnum-cb");
		var $thumbnavCB = $("#thumbnav-cb");
		var $thumbnumCB = $("#thumbnum-cb");
		var $indexCB = $("#page-cb");
		var $timerCB = $("#timer-cb");
		var $arrowCB = $("#arrow-cb");
		var $mouseoverText = $("#mouseover-text");
		var $mouseoverCaption = $("#mouseover-caption");
		var $mouseoverInfo = $("#mouseover-info");
		var $mouseoverBtns = $("#mouseover-btns");
				
		$submitButton.click(function() {
			$container.undoChanges()
			.setEffect($effects.val())
			.setTextAlign($textAlign.filter(":checked").val())
			.setCaptionType($captionType.filter(":checked").val())
			.setThumbsAlign($thumbsAlign.filter(":checked").val())
			.setPlayButton($playCB.prop("checked"))
			.setDButtons($imgnavCB.prop("checked"))	
			.setImageNumber($imgNumCB.prop("checked"))
			.setTimerBar($timerCB.prop("checked"))
			.setIndexes($indexCB.prop("checked"))
			.setThumbButtons($thumbnavCB.prop("checked"))	
			.setThumbNumber($thumbnumCB.prop("checked"))
			.setSelectArrow($arrowCB.prop("checked"))
			.setMouseoverText($mouseoverText.prop("checked"))
			.setMouseoverCaption($mouseoverCaption.prop("checked"))
			.setMouseoverInfo($mouseoverInfo.prop("checked"))
			.setMouseoverButtons($mouseoverBtns.prop("checked"))
			.updateChanges();	
		});
		
		$resetButton.click(function() {
			init();
			$submitButton.trigger("click");
		});
		
		var init = function() {
			$effects.val("h.slide");
			$("input#top-align").prop("checked", true);
			$("input#inside-cap").prop("checked", true);
			$("input#thumbs-bottom-align").prop("checked", true);
			$playCB.prop("checked", "checked");
			$imgnavCB.prop("checked", "checked");
			$imgNumCB.prop("checked", "");
			$timerCB.prop("checked", "checked");
			$indexCB.prop("checked", "checked");
			$thumbnavCB.prop("checked", "checked");
			$thumbnumCB.prop("checked", "");
			$arrowCB.prop("checked", "checked");
			$mouseoverText.prop("checked", "");
			$mouseoverCaption.prop("checked", "checked").attr("disabled", false);
			$mouseoverInfo.prop("checked", "").attr("disabled", false);
			$mouseoverBtns.prop("checked", "").attr("disabled", false);
		}
		/*
		$captionType.change(function() {		
			var val = $(this).filter(":checked").val();
			$mouseoverCaption.attr("disabled", (val == "tooltip"));
		});
			
		$imgnavCB.change(function() {
			$mouseoverBtns.attr("disabled", !$(this).prop("checked")); 	
		});
		
		$imgNumCB.change(function() {
			$mouseoverInfo.attr("disabled", (!$(this).prop("checked") && !$timerCB.prop("checked")));	
		});
		
		$timerCB.change(function() {	
			$mouseoverInfo.attr("disabled", (!$(this).prop("checked") && !$imgNumCB.prop("checked"))); 							
		});
		*/
		init();
	}
);