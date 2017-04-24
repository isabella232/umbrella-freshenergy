(function() {
	var $ = jQuery;

	$(function() {
        var load_more = $('#mwen-hp-nav-below .load-more'),
            ajax_opts = {
                url: HPP.ajax_url,
                data: {
                    action: 'mwen_homepage_load_more_posts',
                    paged: (HPP.paged == 0)? 1:HPP.paged,
                    is_home: true
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    var html = data.html;
                    if (html.trim() == '') {
                        load_more.html("<span>You've reached the end!</span>");
                    } else {
                        var markup = $(html);
                        $(markup).appendTo('#homepage-bottom');
                    }

                    HPP.query.post__not_in = data.post__not_in;

                    load_more.parent().removeClass('loading');
                },
                error: function() {
                    load_more.parent().removeClass('loading');
                    throw "There was an error fetching more posts";
                }
            };

        load_more.click(function() {
            load_more.parent().addClass('loading');
            ajax_opts.data.query = HPP.query;
            $.ajax(ajax_opts);
            return false;
        });
    });

})();
