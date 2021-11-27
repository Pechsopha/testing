<header class="header">
    <section class="header-bottom">
        <section class="main-container d-flex align-items-center position-relative">
            <a class="icon-home icon-home-active icon-home-active d-flex align-items-center" href="{{ route('public.single') }}">
                @if (!theme_option('logo'))
                <span>Lara</span>Mag
                @else
                <img src="{{ get_image_url(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}"
                    title="{{ theme_option('site_title') }}" />
                @endif
            </a>
            <section class="collap-main-nav">
                <img src="{{ Theme::asset()->url('images/icon/collapse.png') }}" alt="Icon Collap"/>
            </section>

            <section class="main-nav d-flex align-items-center">
                <section class="main-nav-inner tf">
                    <section class="close-nav">
                        <i class="fa fa-times" aria-hidden="true"></i> {{ __('Close menu') }}
                    </section><!-- end .close nav -->
                    {!!
                        Menu::renderMenuLocation('main-menu', [
                            'options' => ['id' => 'menu-header-main-menu', 'class' => 'menu'],
                            'theme' => true,
                        ])
                    !!}
                </section><!-- end .main-nav-inner -->
            </section><!-- end .main-nav -->
            <div class="d-inline-block ms-auto">
                {!! apply_filters('language_switcher') !!}
            </div>
        </section><!-- end .container -->
    </section><!-- end .header-bottom -->
</header><!-- end .header -->
