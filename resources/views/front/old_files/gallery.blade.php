@extends('front.layout-intranet')
@section('body_class','galleries')
@section('title', 'Galeria')
@section('content')
<main>
	@include('front.intranet.partials.gallery-header')

	<div class="galeria section-paddings">
		@if($galleries->count() > 0)
			<div class="galeria-grid wide-row-gap">
				@foreach($galleries as $gallery)
				<div class="galeria-item">
					<a href="{{ route('gallery-single',['slug'=>$gallery->slug]) }}">
						<?php $img = $gallery->pictures()->orderBy('created_at','desc')->first()->img; ?>
						<div class="galeria-foto"><img src="{{ url('galleries/medium/'.$img) }}" alt="{{ $gallery->title }}"></div>
						<div class="galeria-title">{{ $gallery->title }}<i class="fas fa-chevron-right school-color"></i></div>
					</a>
				</div>
				@endforeach
				{{ $galleries->links() }}
			</div>
		@else
			<p>No hi ha àlbums.</p>
		@endif
	</div>
	
</main>
@endsection