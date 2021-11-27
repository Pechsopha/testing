@php
    $belowFacebookAds = get_below_faceboook_ads(session('all_ads'));
@endphp

@if (count($belowFacebookAds) > 0)
    <div class="below-facebook-ads d-flex flex-column mt-1">
        @foreach ($belowFacebookAds as $ad)
            @if ($ad->is_html)
                {!! $ad->html !!}
            @else
                <a href="{{ $ad->link }}" class="d-block ads-wrapper mt-1">
                    <img src="{{ get_image_url($ad->image) }}" alt="{{ $ad->name }}" />
                </a>
            @endif
        @endforeach
    </div>
@endif