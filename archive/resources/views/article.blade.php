@extends('layouts.front')

@section('title') {{$post->meta_title}} @endsection
@section('meta') {{$post->meta_description}} @endsection



@section('content')




<div class="breadcrumb-area">
	<div class="container">
		<h1 class="breadcrumb-title">{{$post->meta_title}}</h1>

		<ul class="page-list">
			<li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">{{clean( trans('niva-backend.home') , array('Attr.EnableID' => true))}}</a></li>
			<li class="separator separator-home"></li>
			<li class="item-home"><a class="bread-link" href="{{ route('blog') }}" title="Home">{{clean( trans('niva-backend.our_news') , array('Attr.EnableID' => true))}}</a></li>
			<li class="separator separator-home"></li>
			<li class="item-current">{{$post->meta_title}}</li>
		</ul>
	</div>
</div>

<div class="post-content blog-page-section">
	<div class="container">
		<div class="row">

			<div class="col-md-8">
				<article class="single-post blogloop-v2">
					<div class="blog_custom">
						<div class="post-thumbnail">
							<a href="{{URL::to('/')}}/post/{{$post->slug}}">
								<img class="blog_post_image img-fluid lazy" width="800" height="550" src="/img/loading-blog.gif" data-src="{{$post->photo ? '/images/media/' . $post->photo->file : '/img/200x200.png'}}" alt="{{$post->title}}">
							</a>
						</div>
						<span class="post-date">{{ date('d.M.Y', strtotime($post->created_at)) }}</span>
						<!-- POST DETAILS -->
						<div class="post-details">
							<div class="post-details-holder">
								<div class="post-author-avatar">
									<img alt="" src="/img/loading-blog.gif" data-src="{{$post->user->photo ? '/images/media/' . $post->user->photo->file : '/img/200x200.png'}}" class="avatar img-fluid lazy" height="120" width="120">
								</div>

								<h2 class="post-name">
									{{$post->title}}

								</h2>

								<div class="post-category-comment-date">
									<span class="post-tags"><i class="fa fa-tag"></i>{{$post->category->name}}</span>
								</div>

								<div class="post-body">
									{!! $post->body !!}
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>

			<div class="col-md-4">

				<div class="widget_element">
					{!!$blogsettings->html_sidebar1!!}
				</div>

				<div class="widget_element">
					{!!$blogsettings->html_sidebar2!!}
				</div>

			</div>

		</div>



	</div>

</div>



@endsection