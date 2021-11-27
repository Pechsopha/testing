@if (is_plugin_active('blog'))
    @if ($sidebar == 'footer_sidebar')
        <section class="footer-item">
            <section class="footer-item-head">
                <span>{{ $config['name'] }}</span>
            </section><!-- end .footer-item-head -->
            <section class="footer-item-content">
    @else
        <section class="sidebar-item">
            <section class="sidebar-item-head tf">
                <span><i class="fa fa-newspaper-o" aria-hidden="true"></i>{{ $config['name'] }}</span>
            </section><!-- end .sidebar-item-head -->
            <section class="sidebar-item-content">
    @endif
            @foreach(get_popular_posts($config['number_display']) as $post)
                <section class="sidebar-new-item">
                    <section class="sidebar-new-item-thumb fleft thumb-full">
                        <img src="{{ get_object_image($post->image, 'thumb') }}" class="attachment-full size-full wp-post-image" alt="{{ $post->name }}"/>
                    </section>
                    <!-- end .sidebar-new-item-thumb -->
                    <section class="sidebar-new-item-info">
                        <h2 class="post1-item-list">
                            <a class="white-space" href="{{ $post->url }}">{{ $post->name }}</a>
                        </h2><!-- end .post1-item-list -->
                        <section class="sidebar-new-item-des">
                            <i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($post->created_at, 'Y-m-d') }}
                        </section><!-- end .sidebar-new-item-des -->
                    </section><!-- end .sidebar-new-item-info -->
                    <section class="cboth"></section><!-- end .cboth -->
                </section><!-- end .sidebar-new-item -->
            @endforeach
        </section><!-- end .sidebar-item-contentt -->
    </section><!-- end .sidebar-item -->
@endif

@php
    $belowPopularPostAds = get_below_popular_post_ads(session('all_ads'));
@endphp

@if (count($belowPopularPostAds))
    <div class="below-popular-post-ads mt-1 d-flex flex-column">
        @foreach ($belowPopularPostAds as $ad)
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