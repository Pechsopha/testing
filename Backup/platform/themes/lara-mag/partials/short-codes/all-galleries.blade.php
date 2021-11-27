@if (function_exists('get_galleries'))
    @php $galleries = get_galleries(8); Gallery::registerAssets(); @endphp
    @if (!$galleries->isEmpty())
        <section class="block-post-wrap-item block-post1-wrap-item fleft bsize" style="width: 100%;">
            <section class="block-post-wrap-head sidebar-item-head tf">
                <span><i class="fa fa-tags" aria-hidden="true"></i>{{ trans('plugins/gallery::gallery.galleries') }}</span>
            </section><!-- end .sidebar-item-head -->
            <section class="block-post-wrap-content">
                <div class="gallery-wrap">
                    @foreach ($galleries as $gallery)
                        <div class="gallery-item">
                            <div class="img-wrap">
                                <a href="{{ $gallery->url }}"><img src="{{ get_object_image($gallery->image, 'medium') }}" alt="{{ $gallery->name }}"></a>
                            </div>
                            <div class="gallery-detail">
                                <div class="gallery-title"><a href="{{ $gallery->url }}">{{ $gallery->name }}</a></div>
                                <div class="gallery-author">{{ __('Posted At') }}: {{ date_from_database($gallery->created_at, 'Y-m-d') }}</div>
                            </div>
                        </div>
                    @endforeach
                    <div class="cboth"></div>
                </div>
            </section>
        </section>
        </section>
    @endif
@endif
