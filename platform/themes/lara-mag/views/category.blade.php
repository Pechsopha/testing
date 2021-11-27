@php
    set_page_type(2);
    $popupAds = get_popup_ads(session('all_ads'))->shuffle()->pop();
@endphp

@if ($popupAds)
    <div class="popup-ads">
        <div class="popup-content rounded shadow position-relative">
            <button type="button" class="btn-close close-btn" aria-label="Close"></button>
            <a class="popup-ads-container" href="{{ $popupAds->link }}">
                <img class="rounded-top" onload="showPopup()" src="{{ get_image_url($popupAds->image) }}" alt="{{ $popupAds->name }}"/> 
            </a>
            <div class="popup-header d-flex justify-content-center bg-dark rounded-bottom">
                <p class="mb-0 me-2 text-light">Close in <span timeCloe></span>s</p>
            </div>
        </div>
    </div>
@endif

<div class="pb-3 bg-white">
    <div class="main-container shadow bg-white">
        <!-- left ad-->
        <div class="left-ads-container d-none d-lg-block">
            {!! do_shortcode('[left-side-ads][/left-side-ads]') !!}
        </div>
        <!-- right ads -->
        <div class="right-ads-container d-none d-lg-block">
            {!! do_shortcode('[right-side-ads][/right-side-ads]') !!}
        </div>
        {!! do_shortcode('[home-top-ads][/home-top-ads]') !!}
        <section class="sub-page">
            <section class="">
                <section class="archive-featured-new">
                    @php
                        $main_category = count($posts) > 0 ? $posts[0] : null;
                    @endphp

                    @if (count($posts) > 0)
                        <div class="row g-0 mx-0">
                            <div class="col-12 col-md-6 main-category">
                                <a class="featured-new-item thumb-full item-thumbnail" href="{{ $main_category->url }}">
                                    <img src="{{ get_object_image($main_category->image) }}" class="attachment-full size-full wp-post-image w-100" alt="{{ $main_category->name }}" loading="lazy">
                                    <h2 class="featured-new-item-title white-space bsize">
                                        {{ $main_category->name }}
                                    </h2><!-- end .featured-new-item-title -->
                                </a><!-- end .featured-new-item -->
                            </div>
                            <div class="col-12 col-md-6 row g-2 mx-0 mt-0">
                                @foreach ($posts as $post_category)
                                    @if ($loop->index < 5 && $loop->index > 0)
                                        <a class="featured-new-item thumb-full item-thumbnail col-12 col-md-6" href="{{ $post_category->url }}">
                                            <img src="{{ get_object_image($post_category->image) }}" class="attachment-full size-full wp-post-image w-100" alt="{{ $post_category->name }}" loading="lazy">
                                            <h2 class="featured-new-item-title white-space bsize">
                                                {{ $post_category->name }}
                                            </h2><!-- end .featured-new-item-title -->
                                        </a><!-- end .featured-new-item -->
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <!-- ads -->
                    {!! do_shortcode('[leaderboard-ads][/leaderboard-ads]') !!}
                </section><!-- end .archive-featured-new -->
                <div class="d-flex category-container">
                    <section class="flex-grow-1 pe-3 category">
                        @if (count($posts) >= 5)
                            @php
                                $ads = get_standard_banner_ads(session('all_ads'), $category->id);
                            @endphp
          
                            <!-- ads -->
                            @foreach ($ads as $categoryAd)
                                @if ($categoryAd->is_html)
                                    {!! $categoryAd->html !!}
                                @else
                                    <div class="category-post-ads mt-1">
                                        <a href="{{ $categoryAd->link }}" class="d-block ads-wrapper mx-auto mt-3 d-flex align-items-center justify-content-center">
                                            <img src="{{ get_image_url($categoryAd->image) }}" loading="lazy" alt="{{ $categoryAd->name }}" />
                                        </a>
                                    </div>
                                @endif
                            @endforeach  
                            <!-- end ads -->
                            <section class="block-archive-head category-style">
                                <span class="tf">{{ $category->name }}</span>
                            </section><!-- end .block-archive-head -->
                        @endif 
                        <section class="archive-pro-wrap">
                            <ul class="m-0 p-0 row gx-0">
                                @foreach($posts as $post_category)
                                    @if ($loop->index >= 5)
                                        <section class="new-item bsize col-12 col-md-6">
                                            <a class="new-item-thumb thumb-full item-thumbnail" href="{{ $post_category->url }}">
                                                <img src="{{ get_object_image($post_category->image) }}" loading="lazy" class="attachment-full size-full wp-post-image" alt="{{ $post_category->name }}" loading="lazy">
                                            </a><!-- end .new-item-thumb -->
                                            <section class="new-item-info">
                                                <div class="d-flex justify-content-between mt-3">
                                                    @if ($post_category->author)
                                                        <div>
                                                            <i class="fa fa-user me-1"></i>
                                                            <span>{{ ucfirst($post_category->author->last_name) . ' ' . ucfirst($post_category->author->first_name) }}</span>
                                                        </div>
                                                    @endif
                                                    <section class="new-item-date">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($post_category->created_at, 'M d, Y') }}
                                                    </section><!-- end .new-item-date -->
                                                </div>
                                                <h2 class="new-item-title post1-item-title my-3">
                                                    <a href="{{ $post_category->url  }}">{{ $post_category->name }}</a>
                                                </h2><!-- end .new-item-title -->
                                            </section><!-- end .new-item-info -->
            
                                            <section class="cboth"></section><!-- end .cboth -->
                                        </section><!-- end .new-item -->
                                    @endif
                                @endforeach
                            </ul>
                        </section><!-- end .archive-pro-wrap -->
                        @if ($posts->count() > 0)
                            <section class="pagination">
                                {!! $posts->links() !!}
                            </section><!-- end .pagination -->
                        @endif
                    </section><!-- end .primary -->
                    <aside class="sidebar">
                        {!! dynamic_sidebar('primary_sidebar') !!}
                    </aside><!-- end .sidebar -->
                </div>
            </section><!-- end .container -->
        </section>
    </div>
</div>

