@foreach ($menus = dashboard_menu()->getAll() as $menu)
    <li class="nav-item @if ($menu['active']) active @endif" id="{{ $menu['id'] }}">
        @if (isset($menu['name']) && $menu['name'] != 'plugins/contact::contact.menu' )
            <a href="{{ $menu['url'] }}" class="nav-link nav-toggle">
                <i class="{{ $menu['icon'] }}"></i>
                <span class="title">{{ trans($menu['name']) }} {!! apply_filters(BASE_FILTER_APPEND_MENU_NAME, null, $menu['id']) !!}</span>
                @if (isset($menu['children']) && count($menu['children'])) <span class="arrow @if ($menu['active']) open @endif"></span> @endif
            </a>
        @endif
        @if (isset($menu['children']) && count($menu['children']))

            <ul class="sub-menu @if (!$menu['active']) hidden-ul @endif">
                @foreach ($menu['children'] as $item)
                    @if (isset($item['name']) && $item['name'] != 'packages/theme::theme.name' )
                    <li class="nav-item @if ($item['active']) active @endif" id="{{ $item['id'] }}">
                        <a href="{{ $item['url'] }}" class="nav-link">
                            <i class="{{ $item['icon'] }}"></i>
                            {{ trans($item['name']) }}
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endforeach