@extends('index.themes.mox.layouts.main')
@section('index_content')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">{{ $page->name }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/contact_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="contact-form-wrap">
                            <div class="widget-title mb-50">
                                <h5 class="title">{{ $page->name }}</h5>
                            </div>
                            <div class="contact-form">
                                {!! $page->text !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->


    </main>
    <!-- main-area-end -->
    <script>
        @if (session('success'))
            document.getElementById('successMessage').innerText = "{{ session('success') }}"
        @endif
    </script>
@endsection
