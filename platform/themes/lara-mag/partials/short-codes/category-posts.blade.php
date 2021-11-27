@php
    $orderedCategory = get_all_categories(['categories.status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED, 'categories.parent_id' => 0, 'is_featured' => 1]);
    $orderedCategory = $orderedCategory->sortBy('order');
@endphp

@if (is_plugin_active('blog'))

    @foreach ($orderedCategory as $category)
        
        @php
            $allRelatedCategoryIds = array_unique(array_merge(app(\Botble\Blog\Repositories\Interfaces\CategoryInterface::class)->getAllRelatedChildrenIds($category), [$category->id]));

            $post_categories = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)->getByCategory($allRelatedCategoryIds, 0, 6);

            $standardBannerAds = get_standard_banner_ads(session('all_ads'), $category->id);
        @endphp

        <!-- ads -->
        @foreach ($standardBannerAds as $ads)
            @if ($ads->is_html)
                {!! $ads->html !!}
            @else
                <div class="category-post-ads mt-1">
                    <a href="{{ $ads->url }}" class="d-block ads-wrapper mx-auto mt-3 d-flex align-items-center justify-content-center">
                        <img src="{{ get_image_url($ads->image) }}" loading="lazy" alt="{{ $ads->name }}" />
                    </a>
                </div>
            @endif
        @endforeach
        <!-- end ads -->
        <section class="block-post-wrap-item block-post1-wrap-item bsize">
            <section class="block-post-wrap-head sidebar-item-head tf mb-2">
                <a data-order="{{ $category->order }}" class="" href="{{ $category->url }}">
                    <span>{{ $category->name }}</span>
                </a>
            </section><!-- end .sidebar-item-head -->
            <section class="block-post-wrap-content row px-0 mx-0">
                @php
                    $post_category = count($post_categories) > 0 ? $post_categories[0] : null;
                @endphp
                @if ($post_category)
                    <div class="post-main col-12 col-lg-6 pe-0">
                        <section class="post1-item pe-0">
                            <a class="post1-item-thumb thumb-full item-thumbnail"
                            href="{{ $post_category->url }}">
                                <img src="{{ get_object_image($post_category->image) }}"
                                    class="attachment-full size-full wp-post-image" loading="lazy" alt="{{ $post_category->name }}"/>
                            </a><!-- end .post1-item-thumb -->
                            <section class="post1-item-info">
                                <h2 class="post1-item-title text-break text-wrap">
                                    <a class=""
                                    href="{{ $post_category->url }}">{{ $post_category->name }}</a>
                                </h2><!-- end .post1-item-title -->
                            </section><!-- end .post1-item-info -->
                            <!-- post date -->
                            <section class="category-main-item-date">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($post_category->created_at, 'M d, Y') }}</span>
                            </section><!-- end .featured-home-post-item-date -->
                        </section><!-- end .post1-item -->
                    </div>
                @endif
                <div class="post-sub col-12 col-lg-6">
                    @foreach($post_categories as $post_category)
                        @if ($loop->index < 4 && $loop->index > 0)
                            <section class="post1-item d-flex align-items-start">
                                <a class="post1-item-thumb thumb-full item-thumbnail"
                                   href="{{ $post_category->url }}">
                                    <img src="{{ get_object_image($post_category->image) }}" loading="lazy"
                                         class="attachment-full size-full wp-post-image" alt="{{ $post_category->name }}"/>
                                </a><!-- end .post1-item-thumb -->
                                <section class="post1-item-info flex-grow-1 ms-2 d-flex flex-column justify-content-between">
                                    <h2 class="post1-item-title text-break text-wrap mt-0">
                                        <a class=""
                                           href="{{ $post_category->url }}">{{ $post_category->name }}</a>
                                    </h2><!-- end .post1-item-title -->
                                    <section class="category-item-date">
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($post_category->created_at, 'M d, Y') }}</span>
                                    </section><!-- end .featured-home-post-item-date -->
                                </section><!-- end .post1-item-info -->
                            </section><!-- end .post1-item -->
                        @endif
                    @endforeach
                </div>
            </section><!-- end .block-post-wrap-content -->
        </section><!-- end .block-post-wrap -->
    @endforeach
@endif
