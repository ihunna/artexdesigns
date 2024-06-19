@extends('layouts.front')

<title>Artex Designs</title>
@section('meta') {{$homesetting->meta_description}} @endsection

@section('content')

<div class="slider-venor-section">
    <div class="slider-venor owl-carousel">
        @php $count = 0; @endphp
        @foreach($sliders as $slido)
        <div class="slider-inner-venor" style="background-image: url('{{ $slido->photo ? asset('public/images/media/' . $slido->photo->file) : asset('public/img/200x200.png') }}');">
            <div class="container">
                <div class="slider-content">
                    <h1 @if($count == 0) class="active" @endif>{!! $slido->heading1 !!}</h1>
                    <h2 @if($count == 0) class="active" @endif>{!! $slido->heading2 !!}</h2>
                    <div class="slider-body @if($count == 0) active @endif">{!! $slido->bodyslider !!}</div>
                    @if($slido->button_text)
                    <div class="button-slider-b">
                        <a href="{!! $slido->button_link !!}" target="_self" class="btn btn-slider"><span>{!! $slido->button_text !!}</span><svg width="11.4" height="9.2"><use xlink:href="#arrow"></use></svg></a>
                    </div>
                    @endif
                    @if($slido->button_text2)
                    <div class="button-slider-b">
                        <a href="{!! $slido->button_link2 !!}" target="_self" class="btn btn-slider"><span>{!! $slido->button_text2 !!}</span><svg width="11.4" height="9.2"><use xlink:href="#arrow"></use></svg></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @php $count++; @endphp
        @endforeach
    </div>
    <div class="header-social-share">
        <ul>
            <li><a href="https://www.instagram.com/artexdesignss/" target="_blank" rel="noopener"><em class="instagram-icon"><strong>instagram</strong></em></a></li>
            <li><a href="https://www.behance.net/artexdesignss" target="_blank" rel="noopener"><em class="behance-icon"><strong>behance</strong></em></a></li>
            <li><a target="_blank" rel="noopener" href="https://twitter.com/artexdesignss"><em class="twitter-icon"><strong>twitter</strong></em></a></li>
        </ul>
    </div>
    <a href="#" class="hero__scroll"><svg width="15" height="22.1"><use xlink:href="#scroll"></use></svg></a>
</div>

@endsection
