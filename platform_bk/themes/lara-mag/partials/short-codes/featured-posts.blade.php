<section class="featured-home-post">
    <section class="container">
        @if (is_plugin_active('blog'))
            @foreach(get_featured_posts(5) as $post)
                <section class="featured-home-post-item thumb-full fleft">
                    <img src="{{ get_object_image($post->image) }}"
                         class="attachment-full size-full wp-post-image" alt="{{ $post->name }}"/>
                    <section class="featured-home-post-item-info bsize">
                        <h2 class="featured-home-post-item-title">
                            <a href="{{ $post->url }}">{{ $post->name }}</a>
                        </h2><!-- end .featured-home-post-item-title -->
                        <section class="featured-home-post-item-date">
                            <span><i class="fa fa-calendar" aria-hidden="true"></i>{{ date_from_database($post->created_at, 'Y-m-d') }}</span>
                        </section><!-- end .featured-home-post-item-date -->
                        <section class="featured-home-post-item-des">
                            {{ Str::limit($post->description, 80) }}
                        </section><!-- end .featured-home-post-item-des -->
                    </section><!-- end .featured-home-post-item-info -->
                </section><!-- end .featured-home-post-item -->
            @endforeach
        @endif
        <section class="cboth"></section><!-- end .cboth -->
    </section><!-- end .featured-home-post -->
</section><!-- end .featured-home-post -->
