@extends('layouts.front')

@section('title') {{$project->meta_title}} @endsection
@section('meta') {{$project->meta_description}} @endsection

@section('styles')
<link href="{{ asset('css/front/magnific.min.css') }}" type="text/css" rel="stylesheet">
@endsection

@section('content')

<div class="breadcrumb-area">
    <div class="container">
        <h1 class="breadcrumb-title">{{$project->meta_title}}</h1>
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">{{ clean(trans('niva-backend.home'), array('Attr.EnableID' => true)) }}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-home"><a class="bread-link" href="{{ route('portfolio') }}" title="Home">{{ clean(trans('niva-backend.our_projects'), array('Attr.EnableID' => true)) }}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{$project->meta_title}}</li>
        </ul>
    </div>
</div>

<div class="project-content">
    <div class="container">
        <div class="project__img_single">
            <img class="img-fluid thumparallax-down" width="900" height="938" src="{{$project->image_featured2}}" alt="{{$project->meta_title}}">
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2 class="post-name">{{$project->meta_title}}</h2>
                <span class="venor-animate-border"></span>
                {!! $project->body !!}
            </div>
        </div>
        <div class="gallery">
            <div class="row">
                @for($i = 1; $i <= 10; $i++)
                    @php
                        $img_gal_var = 'img_gal' . $i;
                    @endphp
                    @if(!empty($project->$img_gal_var))
                        <div class="col-md-6">
                            <div class="featured-image">
                                <a href="{{$project->$img_gal_var}}">
                                    <img class="thumparallax-down img-fluid" src="{{$project->$img_gal_var}}" alt="{{$project->meta_title}}">
                                </a>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>

@endsection
