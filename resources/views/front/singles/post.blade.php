@extends('front.layout')
@section('body_class','news news-single')
@section('content')
<main>
	<div class="thumb" style="background-image: url({{ getMedia($post) }})"></div>
	<div class="container-fluid container-margin">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3 onShow">
				<h1>{{ $post->title }}</h1>
				<div id="meta">
					<div id="post-date">
						<img src="{{ url('img/blog/date.png') }}">
						<?php
						$date = new DateTime($post->created_at);
						echo $date->format('d M Y');
						?>
					</div>
					<div id="post-images">
						<?php
						$countImages = $images;
						foreach($galleries as $gallery){ $countImages = $countImages + $gallery->medias->count(); }
						?>
						<img src="{{ url('img/blog/images.png') }}">{{ $countImages }} {{ trans('front.photos') }}
					</div>
				</div>
				<div id="intro-post">{{ $post->body }}</div>
			</div>
		</div>
	</div>

	@foreach($blocks as $block)
		{{-- TEXT --}}
		@if($block->type == 'text')
		<div class="block-text container-fluid container-margin onShow">
			<div class="row">
				<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					{!! $block->body !!}
				</div>
			</div>
		</div>

		{{-- HIGHLIGHT --}}
		@elseif($block->type == 'highlight')
		<div class="block-highlight container-fluid container-margin onShow">
			<div class="row">
				<div class="col-lg-8 offset-lg-4 col-xl-6 offset-xl-3">
					<h3 class="highlight">{{ $block->body }}</h3>
				</div>
			</div>
		</div>

		{{-- IMAGE --}}
		@elseif($block->type == 'image')
		<div class="block-image container-fluid container-margin onShow">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<img src="{{ getMedia($block) }}">
				</div>
			</div>
		</div>
		

		{{-- GALLERY --}}
		@elseif($block->type == 'gallery')
		<div class="block-gallery onShow">
			@foreach($block->medias as $media)
            <div class="thumb" style="background-image: url({{ url('media/original/'.$media->filename) }})"></div>
            @endforeach
		</div>


		{{-- VIDEO --}}
		@elseif($block->type == 'video')
		<div class="block-video onShow">
			{!! $block->body !!}
		</div>
		@endif
	@endforeach

	@if($next->count() > 0)
	<div id="keep-reading">
		<div class="block-image container-fluid container-margin onShow">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<h2>{{ trans('front.keep-reading') }}</h2>
					<div id="nextPosts">
						@foreach($next as $nextP)
						<div class="nextPost" style="padding: 0 10px">
							<a href="{{ route('news-single', ['slug' => $nextP->slug]) }}">
								<div class="thumb" style="background-image: url({{ getMedia($nextP) }})"></div> 
								<?php 
								$date = new DateTime($nextP->date);
								$dateF = $date->format('d F, Y');
							 	?>
								<span class="date">{{ $dateF }}</span>
								<h4>{{ $nextP->title }}</h4>
								{{ $nextP->description }}
							</a>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<br><br><br><br>
	@endif
</main>
@endsection