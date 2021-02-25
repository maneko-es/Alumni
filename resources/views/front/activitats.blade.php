@extends('front.layout')
@section('body_class','activitats')
@section('title', 'Activitats')

@section('content')
<div class="activitats-banner main-section section-paddings">
	<div class="width-banner-text container">
		<h3 class="white">{{ $intro->hashtag}}</h3>
		<h1 class="white">{{ $intro->title}}</h1>
		<p class="yellow">{{ $intro->body}}</p>
	</div>
</div>

<div class="activitats-agenda section-paddings container">
	<div class="activitats-menu">
		<div class="menu-form">
			<h2>{{ trans('front.trobades_agenda') }}</h2>
			<form action="{{ route('search-activitats') }}" method="post">
				{{ csrf_field() }}
				<div class="menu-search">
					<input type="text" name="t" placeholder="Cercar" @if(isset($_POST['t']))value= "{{ $_POST['t'] }}" @endif>
					<i class="fas fa-search"></i>
	            </div>
	            <div class="menu-select">
					<select name="school_id">
						<option value="" selected>{{ trans('front.escola') }}</option>
						@foreach($schools as $school)
							<option value="{{ $school->id }}" @if(isset($_POST['school_id']) && $_POST['school_id'] == $school->id) selected="selected" @endif>{{ $school->title }}</option>
						@endforeach
					</select>
					<i class="fas fa-chevron-down"></i>
				</div>
				<div class="menu-select">
					<select name="category_id">
						<option value="" selected>{{ trans('front.categories') }}</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" @if(isset($_POST['category_id']) && $_POST['category_id'] == $category->id) selected="selected" @endif>{{ $category->title }}</option>
						@endforeach
					</select>
					<i class="fas fa-chevron-down"></i>
				</div>
				<button style="text-transform: uppercase;">{{ trans('front.cercar') }}</button>
			</form>
		</div>
	</div>

	<div class="activitats-container">
		<div class="activitats-grid">
			@forelse($activities as $activity)
        @php
          $media_src = $activity->medias->first() ? url('/media/original/' . $activity->medias->first()->filename) : '/images/activitat1.png';
        @endphp
				@if($activity->is_meeting)
  				<div class="activitats-item-alt" style="background-color: {{ $activity->school->color }}">
  					<a href="{{ route('activity-single', ['slug'=>$activity->slug]) }}" >
  						<h2>Trobada {{ $activity->school->title }}</h2>
  						<h3>{{ $activity->title }}</h3>
              <p>{!! substr($activity->body, 0, 50) !!}</p>
  						<div class="activitat-footer">
  							<div class="activitat-footer-item">
  								<i class="fas fa-calendar-week "></i>{{ $activity->date }}
  							</div>
  							<div class="activitat-footer-item">
  								<i class="fas fa-map-marker-alt "></i>{{ $activity->place }}
  							</div>
  						</div>
  					</a>
  				</div>
				@else
				<div class="activitats-item">
					<a href="{{ route('activity-single', ['slug'=>$activity->slug]) }}" >
						<div class="item-title">{{ $activity->category->title }}</div>
						<div class="item-card">
              <img src="<?php echo $media_src ; ?>" alt="">
							<div class="color-bar-card"> <div class="color1"></div> <div class="color2"></div> <div class="color3"></div> <div class="color4"></div> <div class="color5"></div> <div class="color6"></div> <div class="color7"></div> </div>
							<h2>{{ $activity->title }}</h2>
	           <p>{!! substr($activity->body, 0, 50) !!}</p>
						</div>
					</a>
				</div>
				@endif
			@empty
				<p>No hi ha resultats</p>
			@endforelse


{{-- 		<div class="activitats-pages">
  		<a href="">1</a>
  		<a href="">2</a>
  		<a href="">3</a>
		</div> --}}
	 </div>
  </div>
</div>

@endsection
