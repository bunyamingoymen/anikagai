<aside id="primary-sidebar">
    <div id="sidebar-inner" class="scrollbar-macosx">
        <section class="guide-menu fluid">
            <h5 class="section-heading">Menü</h5>
            <ul class="guide-icon-menu">
                @foreach ($menus as $item)
                    @if (isset($active_menu) && $active_menu->code == $item->code)
                        <li>
                            <a href="{{ url($item->optional_2 ?? '') }}">
                                {{ $item->value }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url($item->optional_2 ?? '') }}">
                                {{ $item->value }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </section>
        <section class="guide-menu">
            <h5 class="section-heading">Popüler Kategoriler</h5>
            <ul class="trending-thisweek">
                @foreach ($categories as $item)
                    <li>
                        <a href="{{ url('search?query=' . $item->short_name) }}" data-navigo>
                            <h5 class="truncate" title={{ $item->name }}">#{{ $item->name }}</h5>
                            <small> + {{ $item->show_count ?? '0' }} Görüntüleme</small>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</aside>
