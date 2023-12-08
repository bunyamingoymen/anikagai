<footer class="footer">
    <div class="container">
        <div class="ui grid">
            <div class="row">
                <div class="left floated sixteen wide tablet four wide computer column">
                    <a class="footer-logo" href="{{route('index')}}"
                        style="background: url(../../../{{$data['index_logo']->value}}) center no-repeat; display: block; width: 100%; height: 75px; background-size: 160px 32px;">{{$data['index_title']->value}}</a>
                </div>
                <div class="right floated sixteen wide tablet twelve wide computer column">
                    <ul class="footer-social right floated">
                        @foreach ($data['social_media'] as $item)
                        <li>
                            <a href="{{$item->optional ?? '#'}}" rel="nofollow">
                                <i class="fab fa-{{$item->value}} fa-lg"
                                    style="color: #ffffff;display: flex; align-items: center; justify-content: center;"></i>
                                <p>
                                    <span>{{$item->value}}</span>
                                    <span> </span>
                                </p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="ui three column doubling grid">
            <div class="column">
                <h6>Popüler Türler</h6>
                <div class="ui two column doubling grid">
                    <div class="column">
                        <div class="ui link list">
                            @foreach ($categories->take(5) as $item)
                            <a class="item" href="{{url("search/?query=".$item->short_name)}}"
                                title="{{$item->name}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @if (count($categories)>5)
                    <div class="column">
                        <div class="ui link list">
                            @foreach ($categories->skip(5)->take(5) as $item)
                            <a class="item" href="{{url("search/?query=".$item->short_name)}}"
                                title="{{$item->name}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>



            <div class="column">
                @if ($data['anime_active']->value == 1 || $data['webtoon_active']->value == 1)
                <h6>
                    Popüler
                    {{$data['anime_active']->value == 1 ? "Animeler": ""}}
                    {{(($data['anime_active']->value == 1) && ($data['webtoon_active']->value == 1)) ? "Ve": ""}}
                    {{$data['webtoon_active']->value == 1 ? "Webtoonlar": ""}}
                </h6>
                <div class="ui two column doubling grid">
                    @if ($data['anime_active']->value == 1)
                    <div class="column">
                        <div class="ui link list">
                            @foreach ($trend_animes as $item)
                            <a class="item" href="{{url('anime/'.$item->short_name)}}"
                                title="{{$item->name}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($data['webtoon_active']->value == 1)
                    <div class="column">
                        <div class="ui link list">
                            @foreach ($trend_webtoons as $item)
                            <a class="item" href="{{url('webtoon/'.$item->short_name)}}"
                                title="{{$item->name}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="column">
                <h6>Diğer Linkler:</h6>
                <div class="ui two column doubling grid">
                    @foreach ($menu_alts as $item)
                    @if (($loop->index) % 5 == 0)
                    <div class="column">
                        <div class="ui link list">
                            @endif
                            <a class="item" href="{{$item->optional_2 ?? '#'}}"
                                title="{{$item->value}}">{{$item->value}}</a>
                            @if (($loop->index) % 5 == 4)
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>{!! $data['footer_copyright']->value !!}</p>
        </div>
    </div>

</footer>