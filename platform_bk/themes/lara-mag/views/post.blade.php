<section class="sub-page">
    <section class="container">
        <section class="primary fleft">
            <section class="block-breakcrumb">
                <span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="{{ route('public.single') }}" rel="v:url" property="v:title">{{ __('Home') }}</a> / <span class="breadcrumb_last">{{ $post->name }}</span></span></span>
            </section><!-- end .block-breakcrumb -->
            <h1 class="single-title">
                {{ $post->name }}
            </h1><!-- end .single-pro-title -->

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
                <div class="col-lg-12" id="fb-btn">

                        <div class="count-visitors"> <span class="view-visitor">{{$post->views}}</span> <span class="view-icon"><i class="fa fa-eye" aria-hidden="true"></i></span>  &nbsp; {{ date('d-m-Y', strtotime($post->created_at)) }} &nbsp; <?php echo $post->created_at->diffForHumans() ?></div>

                        <div class="pull-right" style=" display: inline-block; margin-top: -20px;">
                            {{-- <div class="fb-share-button" data-href="{{URL::current()}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> --}}
                            <div class="fb-like"
                            data-href="{{URL::current()}}"
                            data-width=""
                            data-layout="button_count"
                            data-action="like"
                            data-size="large"
                            data-share="true">

                    </div>
                    </div>

               </div>

                {!! $post->content !!}
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
            <section class="single-pro-related">
                <section class="block-archive-head">
                    <span class="tf"><i class="fa fa-newspaper-o" aria-hidden="true"></i>{{ __('Related posts') }}</span>
                </section><!-- end .block-archive-head -->
                <section class="block-content single-new-related-content">
                    <section class="">
                        <ul>
                            @foreach (get_related_posts($post->slug, 5) as $related_item)
                            <li class="post1-item-list">
                                <a href="{{ $related_item->url }}"><i class="fa fa-caret-right" aria-hidden="true"></i>{{ $related_item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </section><!-- end .featured-pro-wrap -->
                </section><!-- end .block-content -->
            </section><!-- end .single-pro-related -->
        </section><!-- end .primary -->
        <aside class="sidebar fright">
            {!! dynamic_sidebar('primary_sidebar') !!}
        </aside><!-- end .sidebar -->
        <section class="cboth"></section><!-- end .cboth -->
    </section><!-- end .container -->
</section>
