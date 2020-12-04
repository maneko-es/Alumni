@extends('front.layout')
@section('title', 'Inici')
@section('body_class','home')
@section('content')

<div class="main-section section-paddings welcome-header-text" style="background-image: url({{ url('images/welcome.png') }});">
	<div class="veil"></div>
	<div class="text">
		<h3 class="white">{{ $blocks['0']->hashtag}}</h3>
		<h1 class="blue">{{ $blocks['0']->title}}</h1>
		<h2 class="blue">{{ $blocks['0']->body}}</h2>
		<a href="{{ $blocks['0']->link}}"><button>{{ $blocks['0']->button}}</button></a>
	</div>
</div>


<div class="welcome-under-bar">
	<div class="bar-content"><div class="bar-blue"></div></div>
	<div class="bar-content"><div class="bar-yellow"></div></div>
</div>

<div class="welcome-connecta main-section section-paddings">
	<h1 class="blue">{{ $blocks['1']->title}}</h1>
	<p class="blue">{{ $blocks['1']->body}}</p>
</div>

<div class="welcome-alumni main-section section-paddings">
	<div class="welcome-alumni-text">
	<h1 class="blue">{{ $blocks['2']->title}}</h1>
	<p class="blue">{{ $blocks['2']->body}}</p>
	<a href="{{ $blocks['2']->link}}"><button>{{ $blocks['2']->button}}</button></a>
	</div>
</div>



<div class="slider-container section-paddings">
     <div class="title-arrows entry-paddings">
		<h1>{{ trans('front.actualitat-alumni') }}</h1>
		<a href="{{ route('activitats') }}"><p>{{ trans('front.tota-actualitat') }}</p></a>
		<div id="arrows"></div>
	</div>

	<div id="actualitat-slider">
		@foreach($activities as $activity)
		<div class="welcome-actualitat-entry entry-paddings">
			<h3>{{ $activity->category->title }}</h3>
			<h2>{{ $activity->title }}</h2>
			<p>{{ $activity->body }}</p>
		</div>
		@endforeach
	</div>


	

</div>



@endsection