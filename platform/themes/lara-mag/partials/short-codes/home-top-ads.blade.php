<!-- ads on top home -->
@foreach (get_below_navigation_ads(session('all_ads')) as $belowNavbarAds)
    <div class="home-top-ad" style="margin-top: .75rem">
        @if ($belowNavbarAds->is_html)
            {!! $belowNavbarAds->html !!}
        @else
            <a href="{{ $belowNavbarAds->link }}" class="d-block ads-wrapper d-flex align-items-center justify-content-center">
                <img src="{{ get_image_url($belowNavbarAds->image) }}" alt="{{ $belowNavbarAds->name }}" />
            </a>
        @endif
    </div>
@endforeach
