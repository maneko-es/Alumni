@extends('front.layout')
@section('body_class','avantatges')
@section('title', 'Avantatges')

@section('content')

<div class="avantatges-1 section-paddings">
	<div class="width-banner-text main-section">
		<h3 class="yellow">{{ $blocks['0']->hashtag}}</h3>
		<h1 class="blue">{{ $blocks['0']->title}}</h1>
		<h2 class="blue">{{ $blocks['0']->body}}</h2>
	</div>
	<div class="avantatges-1-form">
		<h1>{{ $blocks['0']->title}}</h1>
		<h2>{{ $blocks['0']->body}}</h2>
		@if(session('err'))
			<div class="alert alert-danger" role="alert"> {{session('err')}}</div>
		@endif
		<form action="{{ route('save-registry') }}" method="post">
			{{ csrf_field() }}
			<input name="name" type="text" placeholder="Nom i Cognoms" class="form-input" required="required">
			<input type="email" name="email" placeholder="Correu electrònic" class="form-input" required="required">
			<div class="menu-select form-input">
				<select name="school_id"  required="required">
					<option value="" selected disabled="">Escola</option>
					@foreach($schools as $school)
					<option value="{{ $school->id }}">{{ $school->title }}</option>
					@endforeach
				</select>
				<i class="fas fa-chevron-down"></i>
			</div>
			<input type="text" name="year" placeholder="Any promoció" class="form-input"  required="required">
			<input type="checkbox" name="chk3" id="chk3" class="chkrad X fade" required="required"><label for="chk3"><span></span>He llegit i accepto la política de privacitat.</label>
			<button type="submit">CONNECTA'T</button>
		</form>
		<p>Si formes part de diverses promocions les pots afegir posteriorment en el teu perfil.</p>
	</div>
</div>
<div class="avantatges-2 section-paddings">
	<div class="avantatges-grid">
		<div class="avantatge"><img src="/images/avantatge4-2.png" alt=""><div class="avantatge-text">trobades</div></div>
		<div class="avantatge"><img src="/images/avantatge3-2.png" alt=""><div class="avantatge-text">borsa de treball</div></div>
		<div class="avantatge"><img src="/images/avantatge2-2.png" alt=""><div class="avantatge-text">accés conferències</div></div>
		<div class="avantatge"><img src="/images/avantatge1-2.png" alt=""><div class="avantatge-text">promocions</div></div>
	</div>
	<div class="avantatges-2-text">
		<p>En aquest apartat veureu uns descomptes pensats per a vosaltres i que incideixen sobre les diverses propostes educatives de la ICCIC, així com també sobre l’ús de les nostres instal·lacions. La borsa de treball, a més, està pensada per a aquelles persones que volen tenir una primera feina fent classes de reforç o de cangur. </p>
	</div>
</div>

@if(session('success'))
	<div class="modal fade" id="acceptanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<h1>Sol·licitud Alumni</h1>
				<p>Hem rebut correctament la sol·licitud per formar part de la ICCIC Alumni.</p>
				<p>Ben aviat ens posarem en contacte amb tu.</p>
				<button data-dismiss="modal">D'acord</button>
			</div>
		</div>
	</div>
@endif

@endsection

@if(session('success'))
	@section('scripts')
	<script type="text/javascript">
		$('#acceptanceModal').modal('show');
	</script>
	@endsection
@endif