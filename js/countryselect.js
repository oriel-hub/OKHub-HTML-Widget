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

		});
