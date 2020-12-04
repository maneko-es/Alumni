@extends('front.layout-intranet')
@section('body_class','perks')
@section('title', 'Avantatges')

@section('content')
<main class="avantatges-container section-paddings">
	<div class="avantatges-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Avantatges</h1>
	</div>

	<div class="avantatges-description">
		<div class="color-headline school-color">Ser alumni té uns avantatges que van més enllà de les emocions i les relacions interpersonals.</div>
		<p>En aquest apartat veureu uns descomptes pensats per a vosaltres i que incideixen sobre les diverses propostes educatives de la ICCIC, així com també sobre l’ús de les nostres instal·lacions. La borsa de treball, a més, està pensada per a aquelles persones que volen tenir una primera feina fent classes de reforç o de cangur.</p>
		
		<form class="search-bar" action="{{ route('search-perks') }}">
			<input placeholder="Cercar" type="text" name="t">
			<button class="school-background"><i class="fas fa-search"></i></button>
		</form>

		@if(isset($_GET['t']))
		<h2>Heu cercat: {{ $_GET['t'] }}</h2>
		@endif
	</div>

	<div class="avantatges-list">
		@foreach($perks as $perk)	
		<div class="avantatge">
		  <div class="avantatge-title">{{ $perk->title }}</div>
		  <div class="avantatge-description">{!! $perk->body !!}</div>
		</div>
		@endforeach
		{{ $perks->links() }}
	</div>

</main>
@endsection