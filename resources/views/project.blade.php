@extends('layouts.front')

@section('title') {{$project->meta_title}} @endsection
@section('meta') {{$project->meta_description}} @endsection

@section('styles')
<link href="{{ asset('css/front/magnific.min.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('content')


   <div class="breadcrumb-area">
       <h1 class="breadcrumb-title">{{$project->meta_title}}</h1>
   </div>

   <div class="project-content">
   		<div class="container">
   			<div class="row">
				<div class="col-md-8">
			        <h2 class="post-name">{{$project->meta_title}}</h2>
			        <span class="mjacksi-animate-border"></span>
			        {!!$project->body!!}
				</div>
			    <div class="col-md-4">
					@if($currentLang->code=='ar')
			        <h4 class="post-name"> معلومات </h4>
					@else
						<h4 class="post-name"> {{trans('front.info')}} </h4>
				   	@endif
			        <span class="mjacksi-animate-border"></span>

			        <p><strong>{{$project->date}}</strong></p>
			        <p><strong>{{$project->client}}</strong></p>
			        <p><strong>{{$project->project_category->name}}</strong></p>

			        <a href="{{$project->button_link}}" target="_blank" class="btn btn-style1"><span>{{$project->button_text}}</span></a>
                    @if($project->ios_link)
			            <a href="{{$project->ios_link}}" target="_blank" class="btn btn-style1"><span>App Store</span></a>
                    @endif
                    @if($project->android_link)
			        <a href="{{$project->android_link}}" target="_blank" class="btn btn-style1"><span>Google Play</span></a>
                    @endif
                </div>
			</div>

			<div class="gallery">
				<div class="row">

					<div class="col-md-12">
						<div class="featured-image">
							<a href="{{$project->img_gal1}}">
								<img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal1}}">
							</a>
						</div>
					</div>

					<div class="col-md-12">
						<div class="featured-image">
							<a href="{{$project->img_gal2}}">
								<img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal2}}">
							</a>
						</div>
					</div>

					<div class="col-md-12">
						<div class="featured-image">
							<a href="{{$project->img_gal3}}">
								<img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal3}}">
							</a>
						</div>
					</div>

					<div class="col-md-12">
						<div class="featured-image">
							<a href="{{$project->img_gal4}}">
								<img class="img-fluid lazy" src="/public/img/loading-blog.gif" data-src="{{$project->img_gal4}}">
							</a>
						</div>
					</div>

				</div>

			</div>

   		</div>

   	</div>



@endsection

