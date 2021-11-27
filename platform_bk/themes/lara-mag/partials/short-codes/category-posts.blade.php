@if (is_plugin_active('blog'))
    @foreach (get_all_categories(['categories.status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED, 'categories.parent_id' => 0, 'is_featured' => 1]) as $category)
        @php
            $allRelatedCategoryIds = array_unique(array_merge(app(\Botble\Blog\Repositories\Interfaces\CategoryInterface::class)->getAllRelatedChildrenIds($category), [$category->id]));

            $post_categories = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)->getByCategory($allRelatedCategoryIds, 0, 6);
        @endphp
        <section class="block-post-wrap-item block-post1-wrap-item fleft bsize">
            <section class="block-post-wrap-head sidebar-item-head tf">
                <a class="white-space" href="{{ $category->url }}">
                    <span><i class="fa fa-tags" aria-hidden="true"></i>{{ $category->name }}</span>
                </a>
            </section><!-- end .sidebar-item-head -->
            <section class="block-post-wrap-content">
                @foreach($post_categories as $post_category)
                    @if ($loop->index < 3)
                        <section class="post1-item fleft">
                            <a class="post1-item-thumb thumb-full item-thumbnail"
                               href="{{ $post_category->url }}">
                                <img src="{{ get_object_image($post_category->image) }}"
                                     class="attachment-full size-full wp-post-image" alt="{{ $post_category->name }}"/>
                                <div class="thumbnail-hoverlay main-color-1-bg"></div>
                                <div class="thumbnail-hoverlay-icon"><i class="fa fa-search"></i></div>
                            </a><!-- end .post1-item-thumb -->
                            <section class="post1-item-info">
                                <h2 class="post1-item-title">
                                    <a class="white-space"
                                       href="{{ $post_category->url }}">{{ $post_category->name }}</a>
                                </h2><!-- end .post1-item-title -->
                                <section class="post1-item-des">
                                    {{ $post_category->description }}
                                </section><!-- end .post1-item-des -->
                            </section><!-- end .post1-item-info -->
                        </section><!-- end .post1-item -->
                    @endif
                @endforeach
                <section class="cboth post1-item-bottom"></section><!-- end .cboth -->
                @foreach($post_categories as $post_category)
                    @if ($loop->index >= 3)
                        <h2 class="post1-item-list">
                            <a class="white-space"
                               href="{{ $post_category->url }}"><i
                                    class="fa fa-caret-right" aria-hidden="true"></i>{{ $post_category->name }}</a>
                        </h2><!-- end .post1-item-list -->
                    @endif
                @endforeach
            </section><!-- end .block-post-wrap-content -->
        </section><!-- end .block-post-wrap -->
    @endforeach
@endif
