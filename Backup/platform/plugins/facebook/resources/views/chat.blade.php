<div id="fb-root"></div>
<script>
    'use strict';
    window.fbAsyncInit = function() {
        FB.init({
            appId            : "{{ setting('facebook_app_id', config('plugins.facebook.general.app_id')) }}",
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.2'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-customerchat"
     attribution=setup_tool
     page_id="{{ setting('facebook_page_id') }}"
     theme_color="#0084ff">
</div>
