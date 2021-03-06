<section class="sub-page">
    <section class="container">
        <section class="primary fleft">
            <section class="block-breakcrumb">
                <span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="{{ route('public.single') }}" rel="v:url" property="v:title">{{ __('Home') }}</a> / <span class="breadcrumb_last">{{ $page->name }}</span></span></span>
            </section><!-- end .block-breakcrumb -->
            <h1 class="single-title">
                {{ $page->name }}
            </h1><!-- end .single-pro-title -->
            <section class="single-content">
                @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($page)))
                    {!! render_object_gallery($galleries) !!}
                @endif
                {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $page->content, $page) !!}
            </section><!-- end .single-pro-content -->
        </section><!-- end .primary -->
        <aside class="sidebar fright">
            {!! dynamic_sidebar('primary_sidebar') !!}
        </aside><!-- end .sidebar -->
        <section class="cboth"></section><!-- end .cboth -->
    </section><!-- end .container -->
</section>
