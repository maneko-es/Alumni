@extends('front.layout-intranet')
@section('body_class','galleries')
@section('title', 'Galeria')
@section('content')
<main>
	@include('front.intranet.partials.gallery-header')

	<div class="galeria container section-paddings">
		@if($galleries->count() > 0)
			<div class="galeria-grid wide-row-gap">
				@foreach($galleries as $gallery)
          @if($gallery->pictures->count() > 0)
    				<div class="galeria-item">
    					<a href="{{ route('gallery-single',['slug'=>$gallery->slug]) }}">
    						<?php $img = $gallery->pictures()->orderBy('created_at','desc')->first()->img; ?>
    						<div class="galeria-foto"><img src="{{ url('galleries/medium/'.$img) }}" alt="{{ $gallery->title }}"></div>
    						<div class="galeria-title">{{ $gallery->title }}<i class="fas fa-chevron-right school-color"></i></div>
    					</a>
    				</div>
            @else
            <div class="galeria-item">
              <a href="{{ route('gallery-single',['slug'=>$gallery->slug]) }}">
                <div class="galeria-foto"><img style="width:100%;height:100%;object-fit:cover;" src="{{ asset('images/image-placeholder.jpg') }}" alt="{{ $gallery->title }}"></div>
                <div class="galeria-title">{{ $gallery->title }}<i class="fas fa-chevron-right school-color"></i></div>
              </a>
            </div>
          @endif
				@endforeach
				{{ $galleries->links() }}
			</div>
		@else
			<p>No hi ha àlbums.</p>
		@endif
	</div>

</main>
@endsection
