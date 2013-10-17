(function($) {
	/*
		jquery.twitter.js v1.5
		Last updated: 08 July 2009

		Created by Damien du Toit
		http://coda.co.za/blog/2008/10/26/jquery-plugin-for-twitter

		Licensed under a Creative Commons Attribution-Non-Commercial 3.0 Unported License
		http://creativecommons.org/licenses/by-nc/3.0/
	*/

	$.fn.getTwitter = function(options) {

		$.fn.getTwitter.defaults = {
			userName: null,
			loaderText: "Loading tweet..."
		};

		var o = $.extend({}, $.fn.getTwitter.defaults, options);

		return this.each(function() {
			var c = $(this);

			// hide container element, remove alternative content, and add class
			c.hide().empty().addClass("twitted");

			// add twitter list to container element
			var twitterListHTML = "<ul id=\"twitter_update_list\"><li></li></ul>";
			c.append(twitterListHTML);

			var tl = $("#twitter_update_list");

			// hide twitter list
			tl.hide();

			// add preLoader to container element
			var preLoaderHTML = $("<p class=\"preLoader\">"+o.loaderText+"</p>");
			c.append(preLoaderHTML);

			// show container element
			c.show();

			$.getScript("http://twitter.com/javascripts/blogger.js");
			$.getScript("http://twitter.com/statuses/user_timeline/"+o.userName+".json?callback=twitterCallback2&count=1", function() {
				// remove preLoader from container element
				$(preLoaderHTML).remove();

					tl.find("li").each(function() {
						var timestampHTML = $(this).children("a");
						var timestamp = timestampHTML.html();
						timestampHTML.remove();
						$(this).attr("title", timestamp);
					});
					
				tl.show();

				// add unique class to first list item
				tl.find("li:first").addClass("firstTweet");

				// add unique class to last list item
				tl.find("li:last").addClass("lastTweet");
			});
		});
	};
})(jQuery);