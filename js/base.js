
$(function() 
{
	 $("#dialog")
	.dialog({ autoOpen: false, 
		modal: true,
		show: { effect: 'fade', duration: 2000 },
		hide: { effect: 'fade', duration: 2000 },
		close: function() {	targetRemoveGlow(); },
	});


	 $("#infoButton")
       .text("") // sets text to empty
	.css(
	{ "z-index":"2",
	  "background":"rgba(0,0,0,0)", "opacity":"0.9", 
	  "position":"absolute", "top":"4px", "left":"4px"
	}) // adds CSS
    .html("");
});