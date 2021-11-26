@php
    set_page_type(3);
@endphp

@php
    $popupAds = get_popup_ads(session('all_ads'))->shuffle()->pop();
@endphp

@if ($popupAds)
    <div class="popup-ads">
        <div class="popup-content rounded shadow position-relative">
            <button type="button" class="btn-close close-btn" aria-label="Close"></button>
            <a class="popup-ads-container" href="{{ $popupAds->link }}">
                <img class="rounded-top" src="{{ get_image_url($popupAds->image) }}" onload="showPopup()" alt="{{ $popupAds->name }}"/> 
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
        @php
            $category = $post->categories()->first();
            $post_categories = [];

            if ($category) {
                $allRelatedCategoryIds = array_unique(array_merge(app(\Botble\Blog\Repositories\Interfaces\CategoryInterface::class)->getAllRelatedChildrenIds($category), [$category->id]));
                $post_categories = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)->getByCategory($allRelatedCategoryIds, 0, 5);
            }
        @endphp

        <section class="sub-page">
            {{--
            <!-- feature post -->
            @foreach($post_categories as $featurePost)
                <section class="featured-home-post-item thumb-full fleft">
                    <img src="{{ get_object_image($featurePost->image) }}"
                            class="attachment-full size-full wp-post-image" alt="{{ $featurePost->name }}"/>
                    <section class="featured-home-post-item-info bsize">
                        <h2 class="featured-home-post-item-title p-2">
                            <a href="{{ $featurePost->url }}">{{ $featurePost->name }}</a>
                        </h2><!-- end .featured-home-post-item-title -->
                        <section class="featured-home-post-item-date">
                            <span><i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($featurePost->created_at, 'M m, Y') }}</span>
                        </section><!-- end .featured-home-post-item-date -->
                    </section><!-- end .featured-home-post-item-info -->
                </section><!-- end .featured-home-post-item -->
            @endforeach
            <section class="cboth"></section>
            --}}
            <!-- leaderboard ads -->
            {!! do_shortcode('[leaderboard-ads][/leaderboard-ads]') !!}
            <section class="d-flex detail-page">
                <section class="primary flex-grow-1 me-2">
                    <!-- ads -->
                    @foreach (get_standard_banner_ads(session('all_ads')) as $ads)
                        <div class="category-post-ads mt-1">
                            <a href="{{ $ads->url }}" class="d-block ads-wrapper mx-auto mt-1 d-flex align-items-center justify-content-center">
                                <img src="{{ get_image_url($ads->image) }}" alt="{{ $ads->name }}" />
                            </a>
                        </div>
                    @endforeach
                    {{--
                    <section class="block-post-wrap-head sidebar-item-head tf my-3">
                        <a class="" href="">
                            <span>{{ $post->categories()->first() ? $post->categories()->first()->name : __('Uncategorized') }}</span>
                        </a>
                    </section><!-- end .sidebar-item-head -->
                    --}}
                    <h1 class="single-title">
                        {{ $post->name }}
                    </h1><!-- end .single-pro-title -->
                    <div class="col-lg-12 mt-0 border-bottom pb-5 mb-4" id="fb-btn">

                        <div class="d-flex flex-wrap">
                            <!-- user -->
                            @if ($post->author)
                                <span>
                                    <i class="fa fa-user"></i>
                                    {{ ucfirst($post->author->last_name) . ' ' . ucfirst($post->author->first_name) }}
                                </span>
                                <span class="mx-2">|</span>
                            @endif
                            <!-- category -->
                            <a class="text-dark" href="{{ $post->categories()->first() ? $post->categories()->first()->url : '' }}">{{ $post->categories()->first() ? $post->categories()->first()->name : __('Uncategorized') }}</a>
                            <span class="mx-2">|</span>
                            <!-- create date -->
                            <span>
                                <i class="fa fa-clock-o"></i>
                                {{ date('M m, Y', strtotime($post->created_at)  ) }}
                            </span>
                            <span class="mx-2">|</span>
                            <!-- view count -->
                            <span class="view-icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>  
                            <span class="view-visitor ms-1">{{$post->views}}</span> 
                            <!-- facebook -->
                            <div class="flex-fill d-flex">
                                {{--
                                <div class="fb-share-button" 
                                    data-href="{{URL::current()}}" 
                                    data-layout="button_count" 
                                    data-size="small">
                                        <a target="_blank" 
                                            href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}&amp;src=sdkpreparse" 
                                            class="fb-xfbml-parse-ignore">Share</a>
                                </div>
                                --}}
                                <div class="fb-like ms-auto"
                                    data-href="{{URL::current()}}"
                                    data-width=""
                                    data-layout="button_count"
                                    data-action="like"
                                    data-size="large"
                                    data-share="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="single-content">
                        @if ($post->format_type == 'video')
                            @php $url = str_replace('watch?v=', 'embed/', get_meta_data($post, 'video_link', true)); @endphp
                            @if (!empty($url))
                                <div class="embed-responsive embed-responsive-16by9 mb30">
                                    <iframe class="embed-responsive-item" allowfullscreen frameborder="0" height="315" width="420" src="{{ str_replace('watch?v=', 'embed/', $url) }}"></iframe>
                                </div>
                                <br>
                            @endif
                        @else
                        <img src="{{get_image_url($post->image)}}" class="img-responsive" alt="{{$post->name}}">
                        @endif

                        @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($post)))
                            {!! render_object_gallery($galleries, ($post->categories()->first() ? $post->categories()->first()->name : __('Uncategorized'))) !!}
                        @endif
                        
                        <!-- detail top ads -->
                        @foreach (get_detail_top_ads(session('all_ads')) as $detailTopAds)
                            <div class="category-post-ads mt-1">
                                <a href="{{ $detailTopAds->url }}" class="d-block ads-wrapper mx-auto mt-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ get_image_url($detailTopAds->image) }}" alt="{{ $detailTopAds->name }}" />
                                </a>
                            </div>
                        @endforeach

                        <!-- ads inside content -->
                        <div class="ads-inside-content d-none">
                            @foreach (get_detail_middle_ads(session('all_ads')) as $detailMiddleAds)
                                <div class="category-post-ads mt-1">
                                    <a href="{{ $detailMiddleAds->url }}" class="d-block ads-wrapper mx-auto mt-3 d-flex align-items-center justify-content-center">
                                        <img src="{{ get_image_url($detailMiddleAds->image) }}" alt="{{ $detailMiddleAds->name }}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        
                        <div id="news-content">
                            {!! $post->content !!}
                        </div>

                        <script>
                            (() => {
                                const newsContents = document.querySelectorAll('#news-content p');
                                const newsContentSize = newsContents.length;

                                if (newsContentSize === 0) return;
                                
                                const adsPosition = Math.floor(newsContentSize / 2);
                                
                                const newsContent = newsContents[adsPosition - 1];
                                const ads = document.querySelector('.ads-inside-content');
                                
                                if (ads) {
                                    ads.classList.remove('d-none');
                                    newsContent.insertAdjacentElement('beforeEnd', ads)
                                }
                            })();
                        </script>

                        <!-- detail bottom ads -->
                        @foreach (get_detail_bottom_ads(session('all_ads')) as $detailBottomAds)
                            <div class="category-post-ads mt-1">
                                <a href="{{ $detailBottomAds->url }}" class="d-block ads-wrapper mx-auto mt-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ get_image_url($detailBottomAds->image) }}" alt="{{ $detailBottomAds->name }}" />
                                </a>
                            </div>
                        @endforeach

                        <br>
                        <div class="list-tag">
                            @if (!$post->tags->isEmpty())
                                <span>
                                    <span class="tag-list-title">{{ __('Tags') }}: </span>
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                                    @endforeach
                                </span>
                            @endif
                        </div>
                    </section><!-- end .single-pro-content -->

                    <section class="single-comment">
                        <section class="block-archive-head">
                            <section class="box-share fright">
                                <div class="addthis_inline_share_toolbox_pjup"></div>
                            </section><!-- end .box-share-->
                            <section class="cboth"></section>
                        </section><!-- end .block-archive-head -->
                        <section class="single-comment-content">
                            {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}
                        </section><!-- end .single-comment-content -->
                    </section><!-- end .single-comment -->
                    {{--
                    <div class="d-flex flex-column">
                        <div class="author-detail">
                            <!-- author image -->
                            <img src="{{ $post->author->avatar_url }}" width="70px" height="70px" loadig="lazy" class="mx-auto rounded-circle mb-3" />
                            <!-- author name -->
                            <h5 class="text-center">{{ ucfirst($post->author->last_name) . ' ' . ucfirst($post->author->first_name) }}</h5>
                            <!-- description -->
                            <p> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                            standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled 
                            it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic 
                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets 
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including 
                            versions of Lorem Ipsum.</p>
                            <!-- social media -->
                            <div class="d-flex justify-content-center">
                                <a class="social-link m-3" href="">
                                    <i class="fa fa-facebook-square fa-2x text-dark"></i>
                                </a>
                                <a class="social-link m-3" href="">
                                    <i class="fa fa-youtube fa-2x text-dark"></i>
                                </a>
                                <a class="social-link m-3" href="">
                                    <i class="fa fa-linkedin-square fa-2x text-dark"></i>
                                </a>
                                <a class="social-link m-3" href="">
                                    <i class="fa fa-instagram fa-2x text-dark"></i>
                                </a>
                            </div>
                        <div>   
                    <div>
                    --}}
                    <section class="single-pro-related">
                        <section class="block-archive-head">
                            <span class="tf"><i class="fa fa-newspaper-o" aria-hidden="true"></i>{{ __('Related posts') }}</span>
                        </section><!-- end .block-archive-head -->
                        <section class="block-content single-new-related-content">
                            <section class="">
                                <ul class="ps-0 related-post-container row">
                                    @foreach (get_related_posts($post->slug, 5) as $related_item)
                                        <section class="new-item bsize col-12 col-md-4">
                                            <a class="related-post-thumb new-item-thumb thumb-full item-thumbnail" href="{{ $related_item->url }}">
                                                <img src="{{ get_object_image($related_item->image) }}" class="attachment-full size-full wp-post-image" alt="{{ $related_item->name }}" loading="lazy">
                                            </a><!-- end .new-item-thumb -->
                                            <section class="new-item-info">
                                                <div class="d-flex flex-row flex-md-column justify-content-between mt-3">
                                                    @if ($related_item->author)
                                                        <div>
                                                            <i class="fa fa-user me-1"></i>
                                                            <span>{{ ucfirst($related_item->author->last_name) . ' ' . ucfirst($related_item->author->first_name) }}</span>
                                                        </div>
                                                    @endif
                                                    <section class="new-item-date">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($related_item->created_at, 'M d, Y') }}
                                                    </section><!-- end .new-item-date -->
                                                </div>
                                                <h2 class="new-item-title post1-item-title my-3">
                                                    <a href="{{ $related_item->url  }}">{{ $related_item->name }}</a>
                                                </h2><!-- end .new-item-title -->
                                            </section><!-- end .new-item-info -->
            
                                            <section class="cboth"></section><!-- end .cboth -->
                                        </section><!-- end .new-item -->
                                    @endforeach
                                </ul>
                            </section><!-- end .featured-pro-wrap -->
                        </section><!-- end .block-content -->
                    </section><!-- end .single-pro-related -->
                </section><!-- end .primary -->
                <aside class="sidebar">
                    {!! dynamic_sidebar('primary_sidebar') !!}
                </aside><!-- end .sidebar -->
                <section class="cboth"></section><!-- end .cboth -->
            </section><!-- end .container -->
        </section>
    </div>
</div>


