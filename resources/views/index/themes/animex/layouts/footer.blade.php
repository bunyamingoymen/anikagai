<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="{{ route('index') }}"><img src="{{ url($data['index_logo_footer']->value) }}" alt=""
                            style="max-width: 155px;"></a>
                </div>
            </div>
            <div class="col-lg-6  ">
                <div class="footer__nav mt-2">
                    <ul>
                        @foreach ($data['social_media'] as $item)
                            <li><a href="{{ $item->optional ?? '#' }}"><i
                                        class="fa-brands fa-{{ $item->value }}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer__nav ">
                    <ul>
                        @foreach ($menu_alts as $item)
                            <li>
                                <a href="{{ $item->optional_2 ? url($item->optional_2) : '#' }}">
                                    {{ $item->value }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p>
                    {!! $data['footer_copyright']->value !!}
                </p>

            </div>
        </div>
    </div>
</footer>
