@if (session('pageType') != 3)
    @if (!empty($config['facebook_name']))
        <h3 class="widget_title facebook-title text-center py-3 mt-3 text-white font-weight-bold">{{ $config['facebook_name'] }}</h3>
    @endif
    @if (!empty($config['facebook_id']))
        <div class="fb-page mx-auto shadow-sm" data-href="{{ $config['facebook_id'] }}" data-tabs="timeline" data-small-header="false"
            data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="{{ $config['facebook_id'] }}" class="fb-xfbml-parse-ignore"><a
                        href="{{ $config['facebook_id'] }}">{{ $config['facebook_name'] }}</a></blockquote>
        </div>
    @endif
@endif

<!-- ads -->
{!! do_shortcode('[below-facebook-page-ads][/below-facebook-page-ads]') !!}