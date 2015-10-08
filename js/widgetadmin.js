$(document).ready(function(){
	$("#footer").hide();
	var apikey,q="";
	var demoapikey = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
	$("input[type=submit]").click(function(e){
		var jsurl = okhub_wrapper_url + "okhub-widget.js?type=search";
		if ( $("input[name=apikey]").val() != "") {
			$(".step").show();
			$(".step-intructions").hide();
		}
		
		if($("input[name=apikey]").val() == "" && $(this).attr('name') == "apikeysubmit"){
			alert("Please enter you API key");
		}
		
		apikey=$("input[name=apikey]").val();
		url = jsurl + "&_token_guid="+apikey;	
		url2 = jsurl + "&_token_guid="+demoapikey;	
		urlparams = '';
		customstyles = '';
		if ( $("input[name=q]").val() !== "") {
			q = $("input[name=q]").val();
			urlparams = urlparams +"&q="+q;
		}
		if ( $("input[name=country]").val() !== "") {
			q = $("input[name=country]").val();
			urlparams = urlparams +"&country="+q;
		}
		if ( $("input[name=theme]").val() !== "") {
			q = $("input[name=theme]").val();
			urlparams = urlparams +"&theme="+q;
		}
		if ( $("input[name=widget_title").val() !== "") {
			q = $("input[name=widget_title]").val();
			urlparams = urlparams +"&widget_title="+q;
		}
		if ( $("input[name=background_color").val() !== "") {
			customcolor = $("input[name=background_color").val();
			customstyles += ' #open-knowledge-hub-widget { background-color: ' + customcolor + '; } ';
		}
		if ( $("input[name=text_color").val() !== "") {
			customcolor = $("input[name=text_color").val();
			customstyles += ' #open-knowledge-hub-widget { color: ' + customcolor + '; } ';
		}
		url = url + urlparams;
		url2 = url2 + urlparams;
		
		if(customstyles) {
			customstyles = '<style>' + customstyles + '</style>';
		}
		
		$("#results1").val("");
		$("#results1").val('<link href="' + okhub_wrapper_url + 'okhub-widget.css" rel="stylesheet" type="text\/css">' + customstyles + '<script class="okhub-widget-script" src="' + url + '" type="text\/javascript"><\/script><div id="open-knowledge-hub-widget"><\/div>');
		$("#dynamic-demo-hub-widget script").each(function(){
			$(this).attr('src', url2);
		});
		$.getScript( url2 );
		$("#dynamic-demo-hub-widget script").append(customstyles);
		return false;
	});
	$("#step5").mouseover(function(e){
		$(this).css("cursor","hand");		
	});
	$("#step5").click(function(e){
		$(this).hide();
		$("#footer").show();		
			
	});
});