$(document).ready(function(){
	var apikey,q="";
	$("input[type=submit]").click(function(e){
		var jsurl = okhub_widget_url + "okhub-widget.js?type=search";
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
		customstylesjs = '';
		if ( $("input[name=q]").val() !== "") {
			q = $("input[name=q]").val();
			urlparams = urlparams +"&q="+q;
		}
		if ( $("input[name=country]").val() !== "" && $("input[name=country]").val() != undefined && $("input[name=country]").val() != "undefined") {
			q = $("input[name=country]").val();
			urlparams = urlparams +"&country="+q;
		}
		if ( $("select[name=country]").val() !== "" && $("select[name=country]").val() != undefined && $("select[name=country]").val() != "undefined") {
			q = $("select[name=country]").val();
			countriesParamStr = '';
			for(i in q){
			    if(countriesParamStr){
				countriesParamStr += '|';
			    }
			    countriesParamStr += q[i];
			}
			urlparams = urlparams +"&country="+countriesParamStr;
		}
		if ( $("input[name=region]").val() !== "" && $("input[name=region]").val() != undefined && $("input[name=region]").val() != "undefined") {
			q = $("input[name=country]").val();
			urlparams = urlparams +"&country="+q;
		}
		if ( $("select[name=region]").val() !== "" && $("select[name=region]").val() != undefined && $("select[name=region]").val() != "undefined") {
			q = $("select[name=region]").val();
			regionsParamStr = '';
			for(i in q){
			    if(regionsParamStr){
				regionsParamStr += '|';
			    }
			    regionsParamStr += q[i];
			}
			urlparams = urlparams +"&region="+regionsParamStr;
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
			customstyles += ' #open-knowledge-hub-widget, #open-knowledge-hub-widget a { color: ' + customcolor + '; } ';
		}	
		url = url + urlparams;
		url2 = url2 + urlparams;
		
		$('.widgetcustomstyles').remove();
		$('#okhub-widget-css-extras').remove();
		$('#okhub-widget-css-extras-script').remove();
		if(customstyles) {
		    /* following used to show css extras for widget on remote sites */
		    customstylesjs = "// <![CDATA[";
		    customstylesjs += "\n";
		    customstylesjs += "var head  = document.getElementsByTagName('head')[0];";
		    customstylesjs += "var widgetCssExtrasId = 'okhub-widget-css-extras';";
		    customstylesjs += "if (!document.getElementById(widgetCssExtrasId))";
		    customstylesjs += "{";
		    customstylesjs += "var head  = document.getElementsByTagName('head')[0];";
		    customstylesjs += "var okhubcssextraslink  = document.createElement('style');";
		    customstylesjs += "okhubcssextraslink.id   = widgetCssExtrasId;";
		    customstylesjs += "okhubcssextraslink.type = 'text/css';";
	            customstylesjs += "okhubcssextraslink.media = 'all';";
	            customstylesjs += "okhubcssextraslink.innerHTML = '" + customstyles + "';";
	            customstylesjs += "head.appendChild(okhubcssextraslink);";
	            customstylesjs += "}";
	            customstylesjs += "\n";
	            customstylesjs += "// ]]>";
	            customstylesjs = '<script class="okhub-widget-css-extras-script" type="text\/javascript">' + customstylesjs + '</script>';
	            /* following code to show css extras on local demo */
	            customstyles = '<style class="widgetcustomstyles">' + customstyles + '</style>';
		}
		
		$("#results1").val("");
		$("#results1").val('<script class="okhub-widget-script" src="' + url + '" type="text\/javascript"><\/script>' + customstylesjs + '<div id="open-knowledge-hub-widget"><\/div>');
		$("#dynamic-demo-hub-widget script").each(function(){
			$(this).attr('src', url2);
		});
		$.getScript( url2 );
		$("#dynamic-demo-hub-widget script").append(customstyles);
		e.preventDefault();
		return false;
	});
	$("#step5").mouseover(function(e){
		$(this).css("cursor","hand");		
	});
	$("#step5").click(function(e){
		$(this).hide();	
			
	});
});