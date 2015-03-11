<html>
<head>
<title>OKHub Web Widget Customisation</title>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<?php include('/var/www/includes/nav.shtml'); ?>
<link href="http://www.okhub.org/static/globalnav.css" rel="stylesheet"
	type="text/css">
<script>
	$(document).ready(function(){
		$("#footer").hide();
		var apikey,q="";
		var demoapikey = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
		$("input[name=submit]").click(function(e){
			var jsurl = "http://data.okhub.org/apps/widget/okhub_widget.js?type=search";
			if ( $("input[name=apikey]").val() == "") {
				alert("Please enter you API key");
			}else{
				apikey=$("input[name=apikey]").val();
				url = jsurl + "&_token_guid="+apikey;	
				url2 = jsurl + "&_token_guid="+demoapikey;	
				urlparams = '';
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
				url = url + urlparams;
				url2 = url2 + urlparams;
				
				$("#results1").val("");
				$("#results1").val('<script src="' + url + '" type="text\/javascript"><\/script><div id="open-knowledge-hub-widget"><\/div>');
				//var demohtml = '<script src="' + url2 + '" type="text\/javascript"><\/script><div id="open-knowledge-hub-widget"><\/div>';
				//alert(demohtml);
				//$("#dynamic-demo-hub-widget").html(demohtml);
				$("#dynamic-demo-hub-widget script").each(function(){
					$(this).attr('src', url2);
				});
				$.getScript( url2 );
				
			}
		});
		$("#step5").mouseover(function(e){
			$(this).css("cursor","hand");		
		});
		$("#step5").click(function(e){
			$(this).hide();
			$("#footer").show();		
				
		});
	});
	</script>
<style>
/* Added by P.Mason, IDS */
body {
	margin: 0;
	padding: 0;
}

#wrap {
	width: 980px;
	margin: 0 auto;
}

textarea {
	width: 100%;
	height: 400px;
	display: block;
	margin: 10px 0px;
}

#dynamic-demo-hub-widget {
	width: 25% !important;
	right: 20px;
	float: right;
}

#open-knowledge-hub-widget {
	padding: 10px !important;
	background-color: #ee9;
	width:100% !important;
}

#open-knowledge-hub-widget {
	top: 10px;
	width: 20%;
	height: 650px;
	font-size: 13px;
	padding: 20px;
	color: #2b2b2b;
	font-family: Lato, sans-serif;
	line-height: 1.25;
	border: 1px dotted gray;
}

#main_container {
	width: 70%;
	float: none;
}

#okhub-overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: 0.5;
	filter: alpha(opacity =   50);
}

#okhub-modal {
	position: absolute;
	top: 10px;
	left: 10px;
	background: rgba(0, 0, 0, 0.2);
	border-radius: 14px;
	padding: 8px;
	width: 400px;
	min-height: 500px;
}

#okhub-content-header {
	border-radius: 8px;
	background: #fff;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 2px;
	padding-bottom: 2px;
}

#okhub-content {
	border-radius: 8px;
	background: #fff;
	padding: 20px;
	padding-top: 2px;
	max-height: 350px;
	overflow-y: scroll;
}

#okhub-content-footer {
	border-radius: 8px;
	background: #fff;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 12px;
	padding-bottom: 12px;
	min-height: 50px;
}

#okhub-close {
	float: right;
}

ul {
	margin: 0;
	padding: 0;
}

ul.okhub_sources li {
	list-style-type: none;
	margin-right: 5px;
	padding: 0;
	display: inline;
	width: 40px;
	background-color: yellow;
	font-size: 10px;
}

a {
	color: blue;
	text-decoration: none;
}

ul.okhub_list li {
	list-style-type: none;
	margin-top: 10px;
	padding: 0;
	display: block;
	width: 90%;
}
</style>
</head>
<body>
	<div id="wrap">
		<div id="dynamic-demo-hub-widget">
			<script src="http://data.okhub.org/apps/widget/okhub_widget.js?type=search&_token_guid=5c96d95b-c729-4624-b1c2-14c6b98dc9ce" type="text/javascript"></script>
			<div id="open-knowledge-hub-widget">Sample Widget</div>
		</div>
		<div id="main_container">

			<h2>OkHub Javascript Web Widget</h2>
			<p>
				Step 1. <a
					href='http://api.okhub.org/accounts/login/?next=/profiles/view/'
					target=_new>Register to get your API key</a>. The API key is
				required both on the widget and wrapper class.
			</p>

			<div>
				<p>Step 2. Customise the widget</p>
				<div class="form-item"><input type="text" name="apikey"
					placeholder="Enter you API Key (this is required)"
					style="width: 100%; height: 30px;" /></div> 
				<div class="form-item"><input type="text"
					name="q" placeholder="Search Parameter"
					style="width: 100%; height: 30px;" /></div>  
				<div class="form-item"><input type="text"
					name="country" placeholder="Country/Region"
					style="width: 100%; height: 30px;" /></div> 
				<div class="form-item"><input type="text"
					name="theme" placeholder="Theme" style="width: 100%; height: 30px;" /></div> 
				<div class="form-item"><input type="text" name="widget_title"
					placeholder="Title for the Widget"
					style="width: 100%; height: 30px;" /></div> 
				<div class="form-item form-submit"><input
					type="submit" name="submit" value="Customise" /></div>

				<p>Step 3. Copy and Paste the code snippet below and replace the
					{your-api-key} with your apikey.</p>
				<textarea style='width: 100%; height: 50px;' id='results1' disabled>
						<script src=\
						"http://opendataph.com/okhub/okhub_widget.js?type=search&_token_guid={your-api-key}\
						" type=\"text/javascript\"></script>
<div id=\"open-knowledge-hub-widget\"></div>
</textarea>
				<br> <br /> <br /> <br />
				<p>
					Step 4. Download, add and modify the CSS file. <a
						href='../okhub.css' target=_new>Link to sample css</a><br />
			
			</div>
			<div style='display: none;'>
				<h3>Other Parameters</h3>
				<ul class='paramslist'>
					<li>q={search_parameter}, e.g. <pre>&q=ICT</pre>
					</li>
					<li>country={country_name}, e.g. <pre>&country=India</pre>
					</li>
					<li>theme={theme_name}, e.g. <pre>&theme=Education</pre>
					</li>
					<li>Or Combination of any two or all three paramaters, e.g. <pre>&theme=Education&q=ICT&country=India</pre>
					</li>
					<li>widget_title={title}, e.g. <pre>&widget_title=Development Resources</pre>
					</li>

				</ul>
				<br />
			</div>
			<hr width='100%'>



		</div>
	</div>
	<!--wrap-->

</body>
</html>
