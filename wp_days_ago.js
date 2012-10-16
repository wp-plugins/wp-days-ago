function get_wp_days_ago (postId, mode, prepend, append) {
	jQuery.ajax({
        type: 'POST',
        url: wp_days_ago_script.ajaxurl,
        data: {
            action: 'wp_days_ago_ajax',
            postId: postId,
			mode: mode,
			prepend: prepend,
			append: append
        },
        success: function(data, textStatus, XMLHttpRequest) {
			jQuery("#wp_days_ago-" + postId).html(data);
        }
    });
}