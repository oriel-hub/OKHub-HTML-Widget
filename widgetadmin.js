$(document).ready(function(){
	$("#footer").hide();
	var apikey,q="",countries;
	var demoapikey = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
	$("#cntry").tokenInput([
		{name: 'Afghanistan', id: 'Afghanistan'}, 
		{name: 'Åland Islands', id: 'Åland Islands'}, 
		{name: 'Albania', id: 'Albania'}, 
		{name: 'Algeria', id: 'Algeria'}, 
		{name: 'American Samoa', id: 'American Samoa'}, 
		{name: 'Andorra', id: 'Andorra',}, 
		{name: 'Angola', id: 'Angola'}, 
		{name: 'Anguilla', id: 'Anguilla'}, 
		{name: 'Antarctica', id: 'Antarctica'}, 
		{name: 'Antigua and Barbuda',name: 'Antigua and Barbuda'}, 
		{name: 'Argentina', id: 'Argentina'}, 
		{name: 'Armenia', id: 'Armenia'}, 
		{name: 'Aruba', id: 'Aruba'}, 
		{name: 'Australia', id: 'Australia'}, 
		{name: 'Austria', id: 'Austria'}, 
		{name: 'Azerbaijan', id: 'Azerbaijan'}, 
		{name: 'Bahamas', id: 'Bahamas'}, 
		{name: 'Bahrain', id: 'Bahrain'}, 
		{name: 'Bangladesh', id: 'Bangladesh'}, 
		{name: 'Barbados', id: 'Barbados'}, 
		{name: 'Belarus', id: 'Belarus'}, 
		{name: 'Belgium', id: 'Belgium'}, 
		{name: 'Belize', id: 'Belize'}, 
		{name: 'Benin', id: 'Benin'}, 
		{name: 'Bermuda', id: 'Bermuda'}, 
		{name: 'Bhutan', id: 'Bhutan'}, 
		{name: 'Bolivia',id: 'Bolivia'}, 
		{name: 'Bosnia and Herzegovina', id: 'Bosnia and Herzegovina'}, 
		{name: 'Botswana', id: 'Botswana'}, 
		{name: 'Bouvet Island', id: 'Bouvet Island'}, 
		{name: 'Brazil', id: 'Brazil'}, 
		{name: 'British Indian Ocean Territory', id: 'British Indian Ocean Territory'}, 
		{name: 'Brunei Darussalam', id: 'Brunei Darussalam'}, 
		{name: 'Bulgaria', id: 'Bulgaria'}, 
		{name: 'Burkina Faso', id: 'Burkina Faso'}, 
		{name: 'Burundi', id: 'Burundi'}, 
		{name: 'Cambodia', id: 'Cambodia'}, 
		{name: 'Cameroon', id: 'Cameroon'}, 
		{name: 'Canada', id: 'Canada'}, 
		{name: 'Cape Verde', id: 'Cape Verde'}, 
		{name: 'Cayman Islands', id: 'Cayman Islands'}, 
		{name: 'Central African Republic', id: 'Central African Republic'}, 
		{name: 'Chad', name: 'Chad'}, 
		{name: 'Chile', id: 'Chile'}, 
		{name: 'China', id: 'China'}, 
		{name: 'Christmas Island', id: 'Christmas Island'}, 
		{name: 'Cocos (Keeling) Islands', id: 'Cocos (Keeling) Islands'}, 
		{name: 'Colombia', id: 'Colombia'}, 
		{name: 'Comoros', id: 'Comoros'}, 
		{name: 'Congo', id:  'Congo'}, 
		{name: 'Congo, The Democratic Republic of the', id:'Congo, The Democratic Republic of the'}, 
		{name: 'Cook Islands', id: 'Cook Islands'}, 
		{name: 'Costa Rica', id: 'Costa Rica'}, 
		{name: 'Cote D\'Ivoire', id: 'Cote D\'Ivoire'}, 
		{name: 'Croatia', id: 'Croatia'}, 
		{name: 'Cuba', id: 'Cuba'}, 
		{name: 'Cyprus', id: 'Cyprus'}, 
		{name: 'Czech Republic', id: 'Czech Republic'}, 
		{name: 'Denmark', id: 'Denmark'}, 
		{name: 'Djibouti', id:  'Djibouti'}, 
		{name: 'Dominica', id: 'Dominica'}, 
		{name: 'Dominican Republic', id: 'Dominican Republic'}, 
		{name: 'Ecuador', id: 'Ecuador'}, 
		{name: 'Egypt', id: 'Egypt'}, 
		{name: 'El Salvador', id: 'El Salvador'}, 
		{name: 'Equatorial Guinea', id:'Equatorial Guinea'}, 
		{name: 'Eritrea', id:'Eritrea'}, 
		{name: 'Estonia', id: 'Estonia'}, 
		{name: 'Ethiopia', id:'Ethiopia'}, 
		{name: 'Falkland Islands (Malvinas)', id:  'Falkland Islands (Malvinas)'}, 
		{name: 'Faroe Islands', id: 'FO'}, 
		{name: 'Fiji', id: 'FJ'}, 
		{name: 'Finland', id: 'FI'}, 
		{name: 'France', id: 'FR'}, 
		{name: 'French Guiana', id: 'GF'}, 
		{name: 'French Polynesia', id: 'PF'}, 
		{name: 'French Southern Territories', id: 'TF'}, 
		{name: 'Gabon', id:'Gabon'}, 
		{name: 'Gambia', id:'Gambia'}, 
		{name: 'Georgia', id: 'Georgia'}, 
		{name: 'Germany', id: 'Germany'}, 
		{name: 'Ghana', id: 'Ghana'}, 
		{name: 'Gibraltar', id: 'Gibraltar'}, 
		{name: 'Greece', id: 'Greece'}, 
		{name: 'Greenland', id: 'Greenland'}, 
		{name: 'Grenada', id: 'Grenada'}, 
		{name: 'Guadeloupe', id: 'Guadeloupe'}, 
		{name: 'Guam', id: 'Guam'}, 
		{name: 'Guatemala', id: 'Guatemala'}, 
		{name: 'Guernsey', id: 'Guernsey'}, 
		{name: 'Guinea', id: 'Guinea'}, 
		{name: 'Guinea-Bissau', id: 'Guinea-Bissau'}, 
		{name: 'Guyana', id: 'Guyana'}, 
		{name: 'Haiti', id: 'Haiti'}, 
		{name: 'Heard Island and Mcdonald Islands', id: 'Heard Island and Mcdonald Islands'}, 
		{name: 'Holy See (Vatican City State)', id: 'Holy See (Vatican City State)'}, 
		{name: 'Honduras', id: 'Honduras'}, 
		{name: 'Hong Kong', id: 'Hong Kong'}, 
		{name: 'Hungary', id: 'Hungary'}, 
		{name: 'Iceland', id: 'Iceland'}, 
		{name: 'India', id: 'India'}, 
		{name: 'Indonesia', id: 'Indonesia'}, 
		{name: 'Iran, Islamic Republic Of', id:'Iran, Islamic Republic Of'}, 
		{name: 'Iraq', id: 'Iraq'}, 
		{name: 'Ireland', id: 'Ireland'}, 
		{name: 'Isle of Man', id: 'Isle of Man'}, 
		{name: 'Israel', id: 'Israel'}, 
		{name: 'Italy', id: 'Italy'}, 
		{name: 'Jamaica', id: 'Jamaica'}, 
		{name: 'Japan', id: 'Japan'}, 
		{name: 'Jersey', id: 'Jersey'}, 
		{name: 'Jordan', id: 'Jordan'}, 
		{name: 'Kazakhstan', id:'Kazakhstan'}, 
		{name: 'Kenya', id: 'Kenya'}, 
		{name: 'Kiribati', id: 'Kiribati'}, 
		{name: 'Korea, Democratic People\'S Republic of', id: 'Korea, Democratic People\'S Republic of'}, 
		{name: 'Korea, Republic of', id: 'Korea, Republic of'}, 
		{name: 'Kuwait', id: 'Kuwait'}, 
		{name: 'Kyrgyzstan', id: 'Kyrgyzstan'}, 
		{name: 'Lao People\'S Democratic Republic', id:'Lao People\'S Democratic Republic'}, 
		{name: 'Latvia', id: 'Latvia'}, 
		{name: 'Lebanon', id:  'Lebanon'}, 
		{name: 'Lesotho', id: 'Lesotho'}, 
		{name: 'Liberia', id:  'Liberia'}, 
		{name: 'Libyan Arab Jamahiriya', id: 'Libyan Arab Jamahiriya'}, 
		{name: 'Liechtenstein', id: 'Liechtenstein'}, 
		{name: 'Lithuania', id: 'Lithuania'}, 
		{name: 'Luxembourg', id: 'Luxembourg'}, 
		{name: 'Macao', id: 'Macao'}, 
		{name: 'Macedonia, The Former Yugoslav Republic of', id: 'Macedonia, The Former Yugoslav Republic of'}, 
		{name: 'Madagascar', id: 'Madagascar'}, 
		{name: 'Malawi', id: 'Malawi'}, 
		{name: 'Malaysia', id:'Malaysia'}, 
		{name: 'Maldives', id: 'Maldives'}, 
		{name: 'Mali', id: 'Mali'}, 
		{name: 'Malta', id: 'Malta'}, 
		{name: 'Marshall Islands', id: 'Marchall Islands'}, 
		{name: 'Martinique', id: 'Martinique'}, 
		{name: 'Mauritania', id: 'Mauritania'}, 
		{name: 'Mauritius', id: 'Mauritius'}, 
		{name: 'Mayotte', id: 'Mayotte'}, 
		{name: 'Mexico', id: 'Mexico'}, 
		{name: 'Micronesia, Federated States of', id: 'Micronesia, Federated States of'}, 
		{name: 'Moldova, Republic of', id: 'Moldova, Republic of'}, 
		{name: 'Monaco', id: 'Monaco'}, 
		{name: 'Mongolia', id: 'Mongolia'}, 
		{name: 'Montserrat', id: 'Montserrat'}, 
		{name: 'Morocco', id: 'Morocco'}, 
		{name: 'Mozambique', id: 'Mozambique'}, 
		{name: 'Myanmar', id: 'Myanmar'}, 
		{name: 'Namibia', id: 'Namibia'}, 
		{name: 'Nauru', id: 'Nauru'}, 
		{name: 'Nepal', id: 'Nepal'}, 
		{name: 'Netherlands', id: 'Netherlands'}, 
		{name: 'Netherlands Antilles', id: 'Netherlands Antilles'}, 
		{name: 'New Caledonia', id: 'New Caledonia'}, 
		{name: 'New Zealand', id: 'New Zealand'}, 
		{name: 'Nicaragua', id: 'Nicaragua'}, 
		{name: 'Niger', id: 'Niger'}, 
		{name: 'Nigeria', id: 'Nigeria'}, 
		{name: 'Niue', id: 'Niue'}, 
		{name: 'Norfolk Island', id: 'Norfolk Island'}, 
		{name: 'Northern Mariana Islands', id: 'Northern Mariana Islands'}, 
		{name: 'Norway', id: 'Norway'}, 
		{name: 'Oman', id: 'Oman'}, 
		{name: 'Pakistan', id: 'Pakistan'}, 
		{name: 'Palau', id: 'Palau'}, 
		{name: 'Palestinian Territory, Occupied', id: 'Palestinian Territory, Occupied'}, 
		{name: 'Panama', id: 'Panama'}, 
		{name: 'Papua New Guinea', id: 'Papua New Guinea'}, 
		{name: 'Paraguay', id: 'Paraguay'}, 
		{name: 'Peru', id: 'Peru'}, 
		{name: 'Philippines', id: 'Philippines'}, 
		{name: 'Pitcairn', id: 'Pitcairn'}, 
		{name: 'Poland', id: 'Poland'}, 
		{name: 'Portugal', id: 'Portugal'}, 
		{name: 'Puerto Rico', id: 'Puerto Rico'}, 
		{name: 'Qatar', id: 'Qatar'}, 
		{name: 'Reunion', id: 'Reunion'}, 
		{name: 'Romania', id: 'Romania'}, 
		{name: 'Russian Federation', id: 'Russian Federation'}, 
		{name: 'RWANDA', id: 'Rwanda'}, 
		{name: 'Saint Helena', id: 'Saint Helena'}, 
		{name: 'Saint Kitts and Nevis', id: 'Saint Kitts and Nevis'}, 
		{name: 'Saint Lucia', id: 'Saint Lucia'}, 
		{name: 'Saint Pierre and Miquelon', id: 'Saint Pierre and Miquelon'}, 
		{name: 'Saint Vincent and the Grenadines', id: 'Saint Vincent and the Grenadines'}, 
		{name: 'Samoa', id: 'Samoa'}, 
		{name: 'San Marino', id: 'San Marino'}, 
		{name: 'Sao Tome and Principe', id: 'Sao Tome and Principe'}, 
		{name: 'Saudi Arabia', id: 'Saudi Arabia'}, 
		{name: 'Senegal', id: 'Senegal'}, 
		{name: 'Serbia and Montenegro', id: 'Serbia and Montenegro'}, 
		{name: 'Seychelles', id: 'Seychelles'}, 
		{name: 'Sierra Leone', id: 'Sierra Leone'}, 
		{name: 'Singapore', id: 'Singapore'}, 
		{name: 'Slovakia', id: 'Slovakia'}, 
		{name: 'Slovenia', id: 'Slovenia'}, 
		{name: 'Solomon Islands', id: 'Solomon Islends'}, 
		{name: 'Somalia', id: 'Somalia'}, 
		{name: 'South Africa', id: 'South Africa'}, 
		{name: 'South Georgia and the South Sandwich Islands', id: 'South Georgia and the South Sandwich Islands'}, 
		{name: 'Spain', id: 'Spain'}, 
		{name: 'Sri Lanka', id: 'Sri Lanka'}, 
		{name: 'Sudan', id: 'Sudan'}, 
		{name: 'Suriname', id: 'Suriname'}, 
		{name: 'Svalbard and Jan Mayen', id: 'Svalbard and Jan Mayen'}, 
		{name: 'Swaziland', id: 'Swaziland'}, 
		{name: 'Sweden', id: 'Sweden'}, 
		{name: 'Switzerland', id: 'Switzerland'}, 
		{name: 'Syrian Arab Republic', id: 'Syrian Arab Republic'}, 
		{name: 'Taiwan, Province of China', id: 'Taiwan'}, 
		{name: 'Tajikistan', id: 'Tajikistan'}, 
		{name: 'Tanzania, United Republic of', id: 'Tanzania'}, 
		{name: 'Thailand', id: 'Thailand'}, 
		{name: 'Timor-Leste', id: 'Timor-Leste'}, 
		{name: 'Togo', id: 'Togo'}, 
		{name: 'Tokelau', id: 'Tokelau'}, 
		{name: 'Tonga', id: 'Tonga'}, 
		{name: 'Trinidad and Tobago', id: 'Trinidad and Tobago'}, 
		{name: 'Tunisia', id: 'Tunisia'}, 
		{name: 'Turkey', id: 'Turkey'}, 
		{name: 'Turkmenistan', id: 'Turkmenistan'}, 
		{name: 'Turks and Caicos Islands', id: 'Turks and Caicos Islands'}, 
		{name: 'Tuvalu', id: 'Tuvalu'}, 
		{name: 'Uganda', id: 'Uganda'}, 
		{name: 'Ukraine', id: 'Ukraine'}, 
		{name: 'United Arab Emirates', id: 'United Aran Emirates'}, 
		{name: 'United Kingdom', id: 'United Kingdom'}, 
		{name: 'United States', id: 'United States'}, 
		{name: 'United States Minor Outlying Islands', id: 'United States Minor Outlying Islands'}, 
		{name: 'Uruguay', id: 'Uruguay'}, 
		{name: 'Uzbekistan', id: 'Uzbekistan'}, 
		{name: 'Vanuatu', id: 'Vanuatu'}, 
		{name: 'Venezuela', id: 'Venezuela'}, 
		{name: 'Viet Nam', id: 'Viet nam'}, 
		{name: 'Virgin Islands, British', id: 'Virgin Islands, British'}, 
		{name: 'Virgin Islands, U.S.', id: 'Virgin Islands, U.S.'}, 
		{name: 'Wallis and Futuna', id: 'Wallis and Futuna'}, 
		{name: 'Western Sahara', id: 'Western Sahara'}, 
		{name: 'Yemen', id: 'Yemen'}, 
		{name: 'Zambia', id: 'Zambia'}, 
		{name: 'Zimbabwe', id: 'Zimbabwe'} 
		], {hintText: "Country/Region e.g. India",               
		});
	$("input[type=submit]").click(function(e){
		var jsurl = widgetadminurl + "okhub_widget.js?type=search";
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
			//console.log(q);
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
		$("#results1").val('<link href="' + widgetadminurl + 'okhub.css" rel="stylesheet" type="text\/css">' + customstyles + '<script src="' + url + '" type="text\/javascript"><\/script><div id="open-knowledge-hub-widget"><\/div>');
		$("#dynamic-demo-hub-widget script").each(function(){
			$(this).attr('src', url2);
		});
		$.getScript( url2 );
		$("#dynamic-demo-hub-widget script").append(customstyles);
			
	});
	$("#step5").mouseover(function(e){
		$(this).css("cursor","hand");		
	});
	$("#step5").click(function(e){
		$(this).hide();
		$("#footer").show();		
			
	});
});