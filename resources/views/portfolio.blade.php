@extends('layouts.front')

@section('title') {{$portfoliosettings->meta_title}} @endsection
@section('meta') {{$portfoliosettings->meta_description}} @endsection

@section('content')

<div class="banner-section" data-background-image-url="{{$portfoliosettings->banner_img ? $portfoliosettings->banner_img : '/public/img/200x200.png'}}">

    <div class="container">
        <h1 class="banner-title">{!!$portfoliosettings->banner_title!!}</h1>
        <p class="banner-desc">{!!$portfoliosettings->banner_desc!!}</p>
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

<div class="portfolio-section-page light-section">
    <div class="projects-page-row">

        @php
        $count = 1;
        // Sort projects by creation date in descending order
        $sortedProjects = $projects->sortByDesc('created_at');
        @endphp

        @foreach($sortedProjects as $project)


        <div class="project-row @php if($count % 2 == 0){ echo 'project-row-right'; } @endphp">
            <div class="project_index">0.@php echo $count; @endphp </div>
            <div class="project__img">
                <a href="{{URL::to('/')}}/project/{{$project->slug}}">
                    <img class="img-fluid thumparallax-down" width="900" height="938" src="{{$project->image_featured2}}"> </a>
            </div>
            <div class="container">
                <div class="info-row__info">
                    <h2 class="info-row__title"><a href="{{URL::to('/')}}/project/{{$project->slug}}">{{$project->title}}</a></h2>
                    <div class="project-desc">
                        {!!$project->excerpt!!}
                    </div>
                    <div class="project-button">
                        <a href="{{URL::to('/')}}/project/{{$project->slug}}" title="{{$project->title}}"><span>{{clean( trans('niva-backend.view_project') , array('Attr.EnableID' => true))}}</span><svg viewBox="0 0 80 80"><polyline points="19.89 15.25 64.03 15.25 64.03 59.33"></polyline><line x1="64.03" y1="15.25" x2="14.03" y2="65.18"></line></svg></a>
                    </div>
                </div>
            </div>
        </div>


        @php
        $count++;
        @endphp
        @endforeach

    </div>
</div>



@endsection
