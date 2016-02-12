$(document).ready(
		function() {
				var country_options = '';
				country_options += '<option value=""></option>';
				for (i in hub_countries_array) {
					country_options += '<option value="' + i + '">'
							+ hub_countries_array[i] + '</option>';
				}
				if(country_options){
				    	var placeholdertext = $("input[name=country]").attr('placeholder');
					$("input[name=country]").replaceWith(
							'<select id="country" name="country" placeholder="' + placeholdertext + '" multiple="multiple">'
									+ country_options + '</select>');
					$('#country').tokenize({
						placeholder: placeholdertext
					});
				}
				
				var region_options = '';
				region_options += '<option value=""></option>';
				for (i in hub_regions_array) {
					region_options += '<option value="' + i + '">'
							+ hub_regions_array[i] + '</option>';
				}
				if(region_options){
				    	var placeholdertext = $("input[name=region]").attr('placeholder');
					$("input[name=region]").replaceWith(
							'<select id="region" name="region" placeholder="' + placeholdertext + '" multiple="multiple">'
									+ region_options + '</select>');
					$('#region').tokenize({
						placeholder: placeholdertext
					});
				}

		});
