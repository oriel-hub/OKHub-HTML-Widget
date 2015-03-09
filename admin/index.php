<html>
<head>
	<title>OKHub Web Widget Customisation</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>	
	<script>
	$(document).ready(function(){
		$("#footer").hide();
		var apikey,q="";
		$("input[name=submit]").click(function(e){
			var url = "http://data.okhub.org/apps/widget/okhub_widget.js?type=search";
			if ( $("input[name=apikey]").val() == "") {
				alert("Please enter you API key");
			}else{
				apikey=$("input[name=apikey]").val();
				url = url + "&_token_guid="+apikey;		
			
				if ( $("input[name=q]").val() !== "") {
					q = $("input[name=q]").val();
					url = url +"&q="+q;
				}
				if ( $("input[name=country]").val() !== "") {
					q = $("input[name=country]").val();
					url = url +"&country="+q;
				}
				if ( $("input[name=theme]").val() !== "") {
					q = $("input[name=theme]").val();
					url = url +"&theme="+q;
				}
				if ( $("input[name=widget_title").val() !== "") {
					q = $("input[name=widget_title]").val();
					url = url +"&widget_title="+q;
				}
				$("#result").val("");
				$("#results1").val("");
				$("#result").val(url);
				$("#results1").val("<script src='"+url+"' type='text\/javascript'><\/script><div id='open-knowledge-hub-widget'></div>");
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
		body{ 
			font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;			
		}
		p{ 
			font-size:14px;
		}
		ul{
			margin:0;
			padding:0;	
		}
		ul.paramslist li{
		    list-style-type: none;
		    padding: 0px;
		    font-size:14px;			
		}
		ul.type_footer li{
		    list-style-type: none;
		    padding: 0px;
		    font-size:12px;				
		}
		a {
		  color: blue;
		  text-decoration: none;		 
		}
		

	</style>
</head>
<body>

<?php include('/var/www/includes/nav.shtml'); ?>
<link href="http://www.okhub.org/static/globalnav.css" rel="stylesheet" type="text/css">

<style>
/* Added by P.Mason, IDS */
body { margin: 0; padding: 0;}
#wrap { width: 980px; margin: 0 auto;}
textarea { width: 100%; height: 400px; display: block; margin: 10px 0px; }
#open-knowledge-hub-widget{ padding: 10px !important; background-color: #ee9; width: 25% !important; }
</style>

<div id="wrap">
<?php
/* search parameters */
if (isset($_GET['type'])){
	$type = $_GET['type'];	
}
require_once('../wrapper/okhubwrapper.wrapper.inc');
$valid_api_key = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
$okhubapi = new OkhubApiWrapper;
$sources = array('opendocs','eldis','observaction','bridge','heart','pids','ccccc','ella','serpp');
$object_types = array('themes','countries','regions','organisations','subjects');

echo "<div style='width:100%;float:left;'><h2>OkHub Javascript Web Widget</h2>";
echo "<p>Step 1. <a href='http://api.okhub.org/accounts/login/?next=/profiles/view/' target=_new>Register to get your API key</a>. The API key is required both on the widget and wrapper class.</p>";
echo "<p>Step 2. Copy and Paste the code snippet below and replace  the {your-api-key} with your apikey.</p>";
echo "<textarea style='width:100%;height:50px;' id='results1' disabled><script src=\"http://opendataph.com/okhub/okhub_widget.js?type=search&_token_guid={your-api-key}\" type=\"text/javascript\"></script>
<div id=\"open-knowledge-hub-widget\"></div>
</textarea><br><br/>";

echo "<div style='width:45%;float:left;'><p>Step 3. Customise the widget</p>";
?>
<input type="text" name="apikey" placeholder="Enter you API Key (this is required)" style="width:100%;height:30px;"/><br/>
<input type="text" name="q" placeholder="Search Parameter" style="width:100%;height:30px;"/><br/>
<input type="text" name="country" placeholder="Country/Region" style="width:100%;height:30px;"/><br/>
<input type="text" name="theme" placeholder="Theme" style="width:100%;height:30px;"/><br/><br/>
<input type="text" name="widget_title" placeholder="Title for the Widget" style="width:100%;height:30px;"/><br/><br/>
<input type="submit" name="submit" value="Customise" /><br/><br/>

<textarea id="result" style="width:100%;height:50px;" placeholder="Resulting script source url" disabled></textarea>
<?php
echo "<br/><br/><p>Step 4. Download, add and modify the CSS file.  <a href='../okhub.css' target=_new>Link to sample css</a><br/></div>";
echo "<div style='width:45%;float:right;'><h3>Other Parameters</h3>";
echo "<ul class='paramslist'><li>q={search_parameter}, e.g. <pre>&q=ICT</pre></li>";
echo "<li>country={country_name}, e.g. <pre>&country=India</pre></li>";
echo "<li>theme={theme_name}, e.g. <pre>&theme=Education</pre></li>";
echo "<li>Or Combination of any two or all three paramaters, e.g. <pre>&theme=Education&q=ICT&country=India</pre></li>";
echo "<li>widget_title={title}, e.g. <pre>&widget_title=Development Resources</pre></li>";

echo "</ul><br/></div>";
echo "<hr width='100%'>";


$output ="<p id='step5'>Click to View Categories/Parameter Values</p><div id='footer'><table><tr>";
foreach($object_types as $object_type){
	$response = $okhubapi->getAll($object_type, 'hub', $valid_api_key, 'full');
	$output .= "<td valign='top'><h5>".strtoupper($object_type)."</h5><ul class='type_footer' id='".$object_type."'>";
	foreach($response->getAllList($object_type) as $i=>$v){
		foreach($v as $k=>$n){
			$output .= "<li>".$n['title'];
			if ($object_type == "countries"){
				if (isset($n['iso_two_letter_code'])){
					$output .= "(".$n['iso_two_letter_code'].")";
				}
			}
			$output .= "</li>";	
		}
	}
	$output .= "</ul></td>";	
}
$output .= "</tr></table></div>";
echo $output;

?>
</div> <!--wrap-->
</body>
</html>
