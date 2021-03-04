@extends('front.layout-intranet')
@section('body_class','perks')
@section('title', 'Avantatges')

@section('content')
<main class="avantatges-container container section-paddings">
	<div class="avantatges-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Avantatges</h1>
	</div>

	<div class="avantatges-description">
		<div class="color-headline school-color">{{ $blocks['0']->title }}</div>
		<p>{{ $blocks['0']->body }}</p>

		<form class="search-bar" action="{{ route('search-perks') }}">
			<input placeholder="Cercar" type="text" name="t">
			<button class="school-background"><i class="fas fa-search"></i></button>
		</form>

		@if(isset($_GET['t']))
		<h2>Heu cercat: {{ $_GET['t'] }}</h2>
		@endif
	</div>

	<div class="galeria-grid">
		@foreach($perks as $perk)
			@php
				if($perk->school_id == 0){
					$s_title = 'ICCIC';
					$s_id = 0;
					$s_color = 'inherit';
				} else {
					$s_title = $perk->school->title;
					$s_id = $perk->school->id;
					$s_color = $perk->school->color;
				}
			@endphp

		<div class="avantatge">
			<div>
				<div class="avantatge-title">{{ $perk->title }}</div>
				<div class="avantatge-description">{!! $perk->body !!}</div>
			</div>
			<div class="school-text" style="color: {{ $s_color  }}">Per a alumnes {{ $s_title }}</div>
			@include('front.intranet.partials.bar-perk',['id'=>$s_id,'color'=>$s_color])
		</div>
		@endforeach
		{{-- {{ $perks->links() }} --}}
	</div>

</main>
@endsection
