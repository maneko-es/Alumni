@extends('front.layout-error')
@section('body_class','galleries')
@section('title', 'Error galeria')
@section('content')
<main class="avantatges-container create-gallery section-paddings" style="min-height: 70vH">
	<div class="avantatges-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Error</h1>
	</div>

	<p>El conjunt d'arxius té una mida massa gran. Cada pujada ha de fer com a màxim 8MB.</p>
	<p>Recorda que pots afegir més fotos un cop creada la galeria.</p>
	<button onclick="goBack()">Tornar</button>
</main>
@endsection

@section('scripts')
<script type="text/javascript">
	function goBack() {
	  window.history.back();
	}
</script>
@endsection