<aside id="primary-sidebar">
    <div id="sidebar-inner" class="scrollbar-macosx">
        <section class="guide-menu fluid">
            <h5 class="section-heading">Menü</h5>
            <ul class="guide-icon-menu">
                @foreach ($menus as $item)
                @if (isset($active_menu) && $active_menu->code == $item->code)
                <li>
                    <a href="{{url($item->optional_2 ?? '')}}">
                        {{$item->value}}
                    </a>
                </li>
                @else
                <li>
                    <a href="{{url($item->optional_2 ?? '')}}">
                        {{$item->value}}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </section>
    </div>
</aside>