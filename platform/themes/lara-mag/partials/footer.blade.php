<footer class="footer w-100 m-0">
    <div class="main-container">
        <div class="row gx-5 pt-4">
            <div class="col-12 col-md-4 d-flex flex-column">
                <img class="rounded-circle" src="{{ get_image_url(theme_option('logo')) }}" width="80px" height="80px" alt="{{ theme_option('site_title') }}"
                    title="{{ theme_option('site_title') }}" />
                {!! setting('footer_general') !!}
            </div>
            {!! setting('footer_contact') !!}
            <div class="col-12 col-md-4">
                <section class="text-light">
                    <h6 class="font-weight-bold">Popular Categories</h6>
                    @foreach(get_popular_categories() as $popularCategory)
                        <div class="footer-style d-flex align-items-center">
                            <i class="fa fa-angle-right"></i>
                            <p class="mb-0 ms-2">
                                <a class="text-white" href="{{ $popularCategory->url }}">{{ $popularCategory->name }}</a>
                            </p>
                        </div>
                    @endforeach
                </section>
            </div>
            <div class="col-12">
                <p class="text-light text-center pt-4 pt-md-0">{!! clean(theme_option('copyright')) !!}</p>
            </div>
        </div>
    </div>
</footer>
