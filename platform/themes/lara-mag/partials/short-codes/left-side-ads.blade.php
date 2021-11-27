@php
    $leftAds = get_left_side_ads(session('all_ads'));
@endphp    

@if (count($leftAds) > 0)
    <div class="side-ads d-flex flex-column align-items-end">
        @foreach ($leftAds as $ad)
            @if ($ad->is_html)
                {!! $ad->html !!}
            @else
                <a href="{{ $ad->link }}" class="d-block ads-wrapper mt-2">
                    <img src="{{ get_image_url($ad->image) }}" alt="{{ $ad->name }}" />
                </a>
            @endif
        @endforeach
    </div>
@endif