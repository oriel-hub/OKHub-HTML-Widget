<!DOCTYPE html>
<html>
	<head>
		<title>OKhub Web Widget Customisation</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.tokeninput.js"/></script>
		<?php include('/var/www/includes/nav.shtml'); ?>
		<link href="http://www.okhub.org/static/globalnav.css" rel="stylesheet" type="text/css">
		<link href="http://data.okhub.org/sites/all/themes/skeletontheme/css/style.css" rel="stylesheet" type="text/css">
		 <link rel="stylesheet" href="css/token-input.css" type="text/css" />
		<link href="okhub.css" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
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
		<div id="okhub-widget">

			<div id="dynamic-demo-hub-widget">
				<script src="<?php echo $widget_url; ?>okhub_widget.js?type=search&_token_guid=50ae9726-efa9-4b40-a623-85823df5aac2" type="text/javascript"></script>
				<div id="open-knowledge-hub-widget">Sample Widget</div>
			</div>
			<div id="open-knowledge-hub-widget-main-container">
	
				<h2>OKHub Javascript Web Widget</h2>
								
				<div class="text_container">
					<p><strong>Want to easily give your users the chance to search through 1000's of freely accessible research documents on poverty reduction in the developing world, from the OKHub content providers?</strong></p>
					<p>The OKHub Javascript Web Widget allows you to create content relevant to your users and embed it in your website with a few simple lines of code. The widget then automatically displays the latest development research from a wide variety of trusted sources based on your preferences, like the widget to the right.</p>
					<p><strong>Why not create a widget for your site today?</strong></p>
				</div>
				
				<div class="step" id="step1">
					<p><span class="steptext">Step 1.</span>  Customise the widget (optional)</p>
					<div class="form-item"><input type="text"
						name="q" placeholder="Search Parameter e.g. Water"

						style="" /></div>  
					<div class="form-item">
					<input type="text" id="cntry" name="country" placeholder="Country/Region e.g. India" style="" /></div> 
					<div class="form-item"><input type="text"
						name="theme" placeholder="Theme e.g. Education" style="" /></div> 
					<div class="form-item"><input type="text" name="widget_title"
						placeholder="Title for the Widget e.g. Development Resources"

						style="" /></div> 
					<div class="form-item"><input type="text" name="text_color"
						placeholder="Widget Text Colour e.g. red or #ff0000"

						style="" /></div> 
					<div class="form-item"><input type="text" name="background_color"
						placeholder="Widget Background Colour e.g. red or #ff0000"

						style="" /></div> 
					<div class="form-item form-submit"><input
						type="submit" name="customisesubmit" value="Update" /></div>
					<p class="note">Note: You can also use Boolean Logic for filtering results. For Search Parameter e.g. "Gender AND Climate". For Country/Region e.g. "India OR Namibia"</p>
				</div>				
				
				<div class="step" id="step2">
				<p><span class="steptext">Step 2.</span> <a
						href='http://api.okhub.org/accounts/login/?next=/profiles/view/'
						target=_new>Register to get your API key</a>. The API key is required for the widget to work on your website.
				</p>
				<div class="form-item"><input type="text" name="apikey"
						placeholder="Enter you API Key (this is required)"

						style="" /></div> 
				<div class="form-item form-submit"><input
						type="submit" name="apikeysubmit" value="Submit API key" /></div>
				</div>
				
				<div class="step-intructions" id="step3-intructions">
				 <p><span class="steptext">Step 3.</span> Your custom widget code will appear here once you have entered you API key above</p>
				</div>
				
				<div class="step" id="step3">
					<p><span class="steptext">Step 3.</span> Copy and Paste the code snippet below and add to your website.</p>
					<textarea style='width: 100%; height: 100px;' id='results1' disabled>&nbsp;</textarea>
					<p class="note">Note: The widget is supplied with a link to our standard stylesheet. You can overwrite these on your site.</p>
				</div>
				

			</div>
		</div>
	</div><!--wrap-->

	</body>
</html>
