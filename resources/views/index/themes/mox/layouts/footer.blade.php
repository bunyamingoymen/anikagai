<footer>
    <div class="footer-top-wrap">
        <div class="container">
            <div class="">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="footer-logo">
                            <a href="{{route('index')}}"><img src="../../../{{$logo_footer->value}}" alt=""
                                    style="max-width: 155px;"></a>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <div class="quick-link-list">
                                    <p>{{$index_text->value}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer-menu">
                            <nav>
                                <div class="footer-social">
                                    <ul>
                                        @foreach ($social_media as $item)
                                        <li><a href="{{$item->optional ?? ''}}"><i
                                                    class="fab fa-{{$item->value}}"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text">
                        <p>
                            {!! $footer_copyright->value !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>