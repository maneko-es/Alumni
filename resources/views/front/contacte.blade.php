@extends('front.layout')
@section('body_class','contact')
@section('title', 'Contacte')

@section('content')

<div class="contacte-container">

  <div class="contacte main-section section-paddings container">
  	<div class="contacte-titol">
  		<h3 class="yellow">#ALUMNICCIC</h3>
  		<h1 class="blue">Contacte</h1>

  		<div class="address black">
  			<h2>Institució Cultural del CIC</h2>
  			<p>Via Augusta, 205</p>
  			<p>08021 Barcelona</p>
  			<p>93 200 11 33</p>
  			<p>iccic@iccic.edu</p>
  		</div>
  	</div>
  	<div class="contacte-form">
  		<h1>Envia’ns els teus suggeriments</h1>

  		<form action="{{ route('contact-send') }}" method="post">
  			{{ csrf_field() }}
  			<input name="name" type="text" placeholder="Nom i Cognoms" class="form-input">
  			<input type="email" name="email" placeholder="Correu electrònic" class="form-input">
  			<div class="select-escola">
  				<select name="school_id">
  					@foreach($schools as $school)
  					<option value="{{ $school->id }}">{{ $school->title }}</option>
  					@endforeach
  				</select>
  				<i class="fas fa-chevron-down"></i>
  			</div>
  			<textarea name="message" placeholder="Missatge"></textarea>
  			<input type="checkbox" name="chk3" id="chk3" class="chkrad X fade" required><label for="chk3"><span></span>He llegit i accepto la política de privacitat.</label>
          	<button type="submit">ENVIAR</button>
  		</form>
  	</div>
  </div>
</div>

@if(session('success'))
	<div class="modal fade" id="acceptanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<h1>Moltes gràcies</h1>
				<p>Ens posarem en contacte amb vostè aviat.</p>
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
