<ul class="m-0 ps-0" {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li @if ($row->css_class) class="{{ $row->css_class }} @endif @if ($row->url == Request::url()) current @endif {{ $loop->first ? 'rounded-top' : '' }} {{ $loop->last ? 'rounded-bottom' : '' }}">
            <a href="{{ $row->url }}" @if ($row->target !== 'self') target="{{ $row->target }}" @endif>
                @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif <span>{{ $row->title }}</span>
            </a>
            @if ($row->has_child)
                {!! Menu::generateMenu([
                    'slug'      => $menu->slug,
                    'parent_id' => $row->id
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>
