(function() {
	/* encodeURIComponent(window.location.href) */
	var jQuery;
	var okhub_wrapper_api_url = "http://data.okhub.org/apps/widget2/api/";
	/** ****** Load jQuery if not present ******** */
	if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
		var script_tag = document.createElement('script');
		script_tag.setAttribute("type", "text/javascript");
		script_tag
				.setAttribute("src",
						"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
		if (script_tag.readyState) {
			script_tag.onreadystatechange = function() { // Support for old
															// versions of IE
				if (this.readyState == 'complete'
						|| this.readyState == 'loaded') {
					scriptLoadHandler();
				}
			};
		} else {
			script_tag.onload = scriptLoadHandler;
		}
		/* Try to find the head, otherwise default to the documentElement */
		(document.getElementsByTagName("head")[0] || document.documentElement)
				.appendChild(script_tag);
	} else {
		/* The jQuery version on the window is the one we want to use */
		jQuery = window.jQuery;
		main();
	}

	/** ****** Called once jQuery has loaded ***** */
	function scriptLoadHandler() {
		jQuery = window.jQuery.noConflict(true);
		main();
	}
	/*
	 * get script tags and returns reference to our okhub-widget.js will be used
	 * to get js parameters
	 */
	
	function getScriptUrl() {
		var scriptUrl = null;
		jQuery('script.okhub-widget-script').each(function() {
			scriptUrl = jQuery(this).attr('src');
		});
		return scriptUrl;
	}
	
	/* fetch parameters */
	function getQueryParameters(query) {
		var args1 = query.split('?');/* split uri */
		var args = args1[1].split('&');/* split parameter */
		var params = {};
		var pair;
		var key;
		var value;
		function decode(string) {
			return decodeURIComponent(string || "").replace('+', ' ');
		}
		for ( var i = 0; i < args.length; i++) {
			pair = args[i].split('=');
			key = decode(pair[0]);
			value = decode(pair[1]);
			params[key] = value;
		}
		return params;
	}
	
	function getOtherParams(params) {
		var p = [];
		if (params.q !== undefined) {
			p.push("q=" + params.q);
		}
		if (params.country !== undefined) {
			p.push("country=" + params.country);
		}
		if (params.theme !== undefined) {
			p.push("theme=" + params.theme);
		}
		return p.join("&");
	}
	
	function hub_navigate(params) {
		jQuery('#open-knowledge-hub-widget-content').html(
				"<div class='okhub-widget-message'>Searching....</div>");
		var pa = getOtherParams(params);
		var jsonp_url = okhub_wrapper_api_url + "?type=search&source="
				+ encodeURIComponent(window.location.href) + "&token_guid="
				+ params._token_guid + "&start_offset=" + params.start_offset
				+ "&callback=?&" + pa;
		var output = "<br/>";
		var footer = "<br/>";
		jQuery
				.getJSON(
						jsonp_url,
						function(data) {
							if(!data.metadata.total_results){
								jQuery('#open-knowledge-hub-widget-content')
								.html(
										"<h4>No results found for search criteria...</h4>");
							} else {
								var num_pages = 50;
								var pages = num_pages + Number(params.start_offset);
								var counter = 0;
								if (typeof data.metadata.prev_page != "undefined") {
									footer = footer
											+ "<button id='okhub_prev'> << Previous</button>";
								}
								if (typeof data.metadata.next_page != "undefined") {
									/* pagination */
									for ( var i = Number(params.start_offset) + 10; i < pages; i = i + 10) {
										counter++;
										if (counter < 5) {
											var page_id = "pageid_" + i;
											if (counter == 1) {
												footer = footer
														+ "<button id="
														+ page_id
														+ " class='selected_button'>"
														+ i / 10 + "</button>";
	
											} else {
												footer = footer + "<button id="
														+ page_id + ">" + i / 10
														+ "</button>";
											}
										}
									}
									footer = footer
											+ "<button id='okhub_next' > Next >> </button>";
								}
								footer = footer
										+ "<br><br/><img src='http://serp-p.pids.gov.ph/home/images/okhub-logo200.png' style='height:20px;'/>";

								var searchfeedbacktext = '';
								if (params.q != undefined) {
									searchfeedbacktext = 
											" search results for "
											+ params.q;
								} else {
									searchfeedbacktext = " search results";
								}								
								output = output + "<div class='okhub-widget-message'><h5>"
										+ data.metadata.total_results
										+ searchfeedbacktext
										+ "</h5></div>";
								if (typeof data.results != "undefined") {
									okhub_results(output, data.results, params)
								} else {
									//alert("Failed to connect to OKHub, please try again later...");
									jQuery('#open-knowledge-hub-widget-content')
											.html(
													"<h4>Unable to connect to OKHub, please try again later...</h4>");
									return false;
								}
								jQuery('#open-knowledge-hub-widget-footer').html(
										footer);
								jQuery('button#okhub_next')
										.click(
												function(e) {
													var qparams = getQueryParameters(data.metadata.next_page);
													hub_navigate(qparams);
												});
								jQuery('button#okhub_prev')
										.click(
												function(e) {
													var qparams = getQueryParameters(data.metadata.prev_page);
													hub_navigate(qparams);
												});
								/* pagination buttons */
								var counter = 0;
								if (typeof data.metadata.next_page != "undefined") {
									for ( var j = Number(params.start_offset) + 10; j < pages; j = j + 10) {
										counter++;
										if (counter < 5) {
											var pageid = "#pageid_" + j;
											jQuery(pageid)
													.click(
															function(e) {
																var off_set = Number(jQuery(
																		this)
																		.text());
																off_set = off_set * 10 - 10;
																var qparams = getQueryParameters(data.metadata.next_page);
																qparams['start_offset'] = off_set;
																hub_navigate(qparams);
															});
										}
									}
								}
							}
						});
	}
	
	function hub_search(param, token_guid) {
		var params = {};
		params._token_guid = token_guid;
		params.q = param;
		params.start_offset = 0;
		jQuery('#open-knowledge-hub-widget-content').html(
		"<div class='okhub-widget-message'>Searching ....</div>");
		hub_navigate(params);
	}
	
	function okhub_clear_contents() {
		jQuery('#okhub-overlay').hide();
		jQuery('#okhub-modal').hide();
		jQuery('#okhub-content-header').empty();
		jQuery('#okhub-content').empty();
		jQuery('#okhub-content-footer').empty();
	}
	
	function okhub_details(id, guid) {
		var top, left;
		var args = id.split('_');/* split parameter */
		var jsonp_url = okhub_wrapper_api_url + "?type=details&id=" + args[1]
				+ "&token_guid=" + guid + "&source="
				+ encodeURIComponent(window.location.href) + "&callback=?";
		var output = "";
		var footer = "<ul class='okhub_sources'>";
		var metadata_url = "";
		var title, author, description, url, hub_country, hubcountry = "";
		var eldis_theme, observaction_theme = "";
		jQuery('#okhub-overlay').show();
		jQuery
				.getJSON(
						jsonp_url,
						function(data) {
							if (typeof data.results == "undefined") {
								alert("Failed to connect to OKHub, please try again later...");
								okhub_clear_contents();
								jQuery('#open-knowledge-hub-widget-content')
										.html(
												"<h4>Unable to connect to OKHub, please try again later...</h4>");

								return false;
							} else {
								jQuery
										.each(
												data.results,
												function(index, value) {
													for ( var i in value) {
														title = value[i].title;
														authors = value[i].authors;
														url = value[i].url;
														description = value[i].description;
														year = value[i].publication_year;
														publisher = value[i].publisher;
														version = i;
														break;
													}
													var source_cnt = 0;
													for ( var i in value) {
														source_cnt++;
														footer = footer
																+ "<li id=oksource_"
																+ i
																+ "><a href='#'>"
																+ i
																		.toUpperCase()
																+ "</a></li> ";
													}
													if (source_cnt > 1) {
														footer = "<h5>Other sources</h5>"
																+ footer;
														jQuery(
																'#okhub-content-footer')
																.html(
																		footer
																				+ "</ul>");
														jQuery(
																'#okhub-content-footer')
																.show();
													} else {
														jQuery(
																'#okhub-content-footer')
																.hide();
													}
													for ( var i in value) {
														jQuery("#oksource_" + i)
																.click(
																		function(
																				e) {
																			var ii = e.currentTarget.id
																					.split("_");
																			var k = ii[1];
																			title = value[k].title;
																			authors = value[k].authors;
																			url = value[k].url;
																			description = value[k].description;
																			year = value[k].publication_year;
																			publisher = value[k].publisher;
																			headertitle = "<h3><a href='"
																					+ url
																					+ "' target=_new>"
																					+ title
																					+ "</a></h3>";
																			if (authors) {
																				headertitle = headertitle
																						+ authors;
																			}

																			if (publisher) {
																				headertitle = headertitle
																						+ "<br/><i>"
																						+ publisher
																						+ "</i>";
																			}
																			if (year) {
																				headertitle = headertitle
																						+ " ("
																						+ year
																						+ ")";
																			}
																			headertitle = headertitle
																					+ "<br/>Source: "
																					+ k
																							.toUpperCase();
																			jQuery(
																					'#okhub-content-header')
																					.html(
																							headertitle);
																			if (description) {
																				jQuery(
																						'#okhub-content')
																						.show();
																				jQuery(
																						'#okhub-content')
																						.html(
																								"<p>"
																										+ description
																										+ "</p>");
																			} else {
																				jQuery(
																						'#okhub-content')
																						.hide();
																			}

																		});
													}
													headertitle = "<h3><a href='"
															+ url
															+ "' target=_new>"
															+ title
															+ "</a></h3>";
													if (authors) {
														headertitle = headertitle
																+ authors;
													}
													if (publisher) {
														headertitle = headertitle
																+ "<br/><i>"
																+ publisher
																+ "</i>";
													}
													if (year) {
														headertitle = headertitle
																+ " ("
																+ year
																+ ")";
													}
													if (version) {
														headertitle = headertitle
																+ "<br/>Source: "
																+ version
																		.toUpperCase();
													}
													jQuery(
															'#okhub-content-header')
															.html(headertitle);
													if (description) {
														jQuery('#okhub-content')
																.show();
														jQuery('#okhub-content')
																.html(
																		"<p>"
																				+ description
																				+ "</p>");
													} else {
														jQuery('#okhub-content')
																.hide();
													}

												});

								jQuery('#okhub-modal').show();
								var modal = jQuery('#okhub-modal');
								top = Math.max(jQuery(window).height()
										- modal.outerHeight(), 0) / 2;
								left = Math.max(jQuery(window).width()
										- modal.outerWidth(), 0) / 2;
								modal.css({
									top : top + jQuery(window).scrollTop(),
									left : left + jQuery(window).scrollLeft()
								});
							}
						});
		jQuery('#okhub-close').click(function(e) {
			okhub_clear_contents();
		});
	}
	
	function okhub_results(output, titles, params) {
		output = output + "<ul  class='okhub_list'>";
		jQuery.each(titles, function(index, value) {
			if (value.title != null) {
				output = output + "<li id='okhub_" + index
						+ "' style='cursor:hand;'>" + value.title;
				if (typeof value.publisher == "object") {
					for (n in value.publisher) {
						output = output + ", <i>" + value.publisher[n]
								+ "</i> ";
						break;
					}
				}
				if (typeof value.publication_year == "object") {
					for (n in value.publication_year) {
						output = output + "  (" + value.publication_year[n]
								+ ")";
						break;
					}
				}
				output = output + "</li>";
			} else {
				output = output + "</li>";
			}
		});
		output = output + "</ul>";
		jQuery('#open-knowledge-hub-widget-content').html(output);
		jQuery.each(titles, function(index, value) {
			jQuery("#okhub_" + index).click(function(e) {
				jQuery(this).css("color", "gray");
				okhub_details(e.currentTarget.id, params._token_guid);
			});
		});

	}
	
	/** ******main function ******* */
	function main() {
		jQuery(document)
				.ready(
						function($) {
							var scr = getScriptUrl();
							var params = getQueryParameters(scr);

							/** ***** Load HTML ****** */
							var stru = "<div id='open-knowledge-hub-widget-header' style='width:100%;height:10%;'></div>"
									+ "<div id='open-knowledge-hub-widget-content' style='padding-right:10px;margin:0px;width:100%;height:80%;overflow-y:scroll;'></div>"
									+ "<div id='open-knowledge-hub-widget-footer' style='width:100%;height:10%;'></div>"
									+ "<div id='okhub-overlay'></div>"
									+ "<div id='okhub-modal'>"
									+ "<div id='okhub-content-header'></div>"
									+ "<div id='okhub-content'></div>"
									+ "<div id='okhub-content-footer'></div>"
									+ "<a href='#' id='okhub-close'>X</a>"
									+ "</div>";
							$('#open-knowledge-hub-widget').html(stru);
							$('#okhub-overlay').hide();
							$('#okhub-modal').hide();
							if (params.widget_title === undefined) {
								params.widget_title = "Development Resources";
							}
							var header = "<h3>"
									+ params.widget_title
									+ "</h3><input type='text' name='okhub_search' placeholder='Search' style='float:right;'>"
									+ "<input type='hidden' name='okhub_token_guid' value="
									+ params._token_guid + ">";
							$('#open-knowledge-hub-widget-header').html(header);
							$('input[name=okhub_search]')
									.keypress(
											function(e) {
												var key = e.which;
												if (key == 13) {
													var okhub_search = $(
															'input[name=okhub_search]')
															.val();
													var okhubguid = $(
															'input[name=okhub_token_guid]')
															.val();
													hub_search(okhub_search,
															okhubguid);
												}
											});
							/* displays search results */
							if (params.type == "search") {
								params.start_offset = 0;
								hub_navigate(params);
							}
						});
	}

})();
