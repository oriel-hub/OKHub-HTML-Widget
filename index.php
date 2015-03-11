<html>
	<head>
		<title>OKHub Web Widget Customisation</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<?php include('/var/www/includes/nav.shtml'); ?>
		<link href="http://www.okhub.org/static/globalnav.css" rel="stylesheet" type="text/css">
		<link href="okhub.css" rel="stylesheet" type="text/css">
		<link href="widgetadmin.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
			var widgetadminurl = '<?php 
			$widget_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			echo $widget_url;
			?>';
		</script>
		<script type="text/javascript" src="widgetadmin.js"></script>
	</head>
	<body>

		<div id="wrap">
			<div id="dynamic-demo-hub-widget">
				<script src="<?php echo $widget_url; ?>okhub_widget.js?type=search&_token_guid=5c96d95b-c729-4624-b1c2-14c6b98dc9ce" type="text/javascript"></script>
				<div id="open-knowledge-hub-widget">Sample Widget</div>
			</div>
			<div id="main_container">
	
				<h2>OkHub Javascript Web Widget</h2>
				<div class="step" id="step1">
				<p><span class="steptext">Step 1.</span> <a
						href='http://api.okhub.org/accounts/login/?next=/profiles/view/'
						target=_new>Register to get your API key</a>. The API key is required for the widget to work on your website.
				</p>
				<div class="form-item"><input type="text" name="apikey"
						placeholder="Enter you API Key (this is required)"
						style="width: 100%; height: 30px;" /></div> 
				<div class="form-item form-submit"><input
						type="submit" name="apikeysubmit" value="Submit API key" /></div>
				</div>
				<div class="step" id="step2">
					<p><span class="steptext">Step 2.</span>  Customise the widget (optional)</p>
					<div class="form-item"><input type="text"
						name="q" placeholder="Search Parameter e.g. Water"
						style="width: 100%; height: 30px;" /></div>  
					<div class="form-item"><input type="text"
						name="country" placeholder="Country/Region e.g. India"
						style="width: 100%; height: 30px;" /></div> 
					<div class="form-item"><input type="text"
						name="theme" placeholder="Theme e.g. Education" style="width: 100%; height: 30px;" /></div> 
					<div class="form-item"><input type="text" name="widget_title"
						placeholder="Title for the Widget e.g. Development Resources"
						style="width: 100%; height: 30px;" /></div> 
					<div class="form-item"><input type="text" name="text_color"
						placeholder="Widget Text Colour e.g. red or #ff0000"
						style="width: 100%; height: 30px;" /></div> 
					<div class="form-item"><input type="text" name="background_color"
						placeholder="Widget Background Colour e.g. red or #ff0000"
						style="width: 100%; height: 30px;" /></div> 
					<div class="form-item form-submit"><input
						type="submit" name="customisesubmit" value="Customise" /></div>
					<p class="note">Note: You can also use Boolean Logic for filtering results. For Search Parameter e.g. "Gender AND Climate". For Country/Region e.g. "India OR Namibia"</p>
				</div>
				
				<div class="step" id="step3">
					<p><span class="steptext">Step 3.</span> Copy and Paste the code snippet below and add to your website.</p>
					<textarea style='width: 100%; height: 100px;' id='results1' disabled>&nbsp;</textarea>
					<p class="note">Note: The widget is supplied with a link to our standard stylesheet. You can overwrite these on your site.</p>
				</div>
				

			</div>
		</div>
		<!--wrap-->

	</body>
</html>
