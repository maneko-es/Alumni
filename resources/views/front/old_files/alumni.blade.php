@extends('front.layout')
@section('body_class','alumni')
@section('title', 'Alumni')

@section('content')
<div class="alumni-banner main-section section-paddings">
	<div class="alumni-banner-text">
		<h3>{{ $blocks['0']->hashtag}}</h3>
		<h1>{{ $blocks['0']->title}}</h1>
		<h2>{{ $blocks['0']->body}}</h2>
	</div>
</div>
<div class="quisom normal-section section-paddings">
	<h1>{{ $blocks['1']->title}}</h1>
	<h2>{{ $blocks['1']->body}}</h2>

	<div class="three-p">
		<div class="square-p">
			<img src="{{ url('images/yellow-square.png') }}">
			<p>{{ $blocks['2']->body}}</p>
		</div>
		<div class="square-p">
			<img src="{{ url('images/yellow-square.png') }}">
			<p>{{ $blocks['3']->body}}</p>
		</div>
		<div class="square-p">
			<img src="{{ url('images/yellow-square.png') }}">
			<p>{{ $blocks['4']->body}}</p>
		</div>
	</div>
</div>
<div class="queensproposem normal-section section-paddings">
	<h1>{{ $blocks['5']->title}}</h1>
	<h2>{{ $blocks['5']->body}}</h2>
</div>
<div class="normal-section section-paddings">
	<h1 class="blue">{{ trans('front.escoles')}}</h1>
	<div class="escoles-logos">
		@foreach($schools as $school)
		<a href="{{ $school->link }}" target="_blank" title="{{ $school->title }}">
			<img src="{{ getMedia($school) }}" alt="{{ $school->title }}">
		</a>
		@endforeach
	</div>
</div>


@endsection