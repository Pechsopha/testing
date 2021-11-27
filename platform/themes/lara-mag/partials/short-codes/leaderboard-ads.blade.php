@php
    $leaderboardAds = get_leaderboard_ads(session('all_ads'));
@endphp

@if (count($leaderboardAds) > 0)
    <div class="leaderboard-ads mt-1">
        @foreach ($leaderboardAds as $ad)
            @if ($ad->is_html)
                {!! $ad->html !!}
            @else
                <a href="{{ $ad->url }}" class="d-block ads-wrapper mt-1 d-flex align-items-center justify-content-center">
                    <img src="{{ get_image_url($ad->image) }}" alt="{{ $ad->name }}" />
                </a>
            @endif
        @endforeach
    </div>
@endif