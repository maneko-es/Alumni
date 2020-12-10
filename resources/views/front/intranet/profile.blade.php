@extends('front.layout-intranet')
@section('body_class','profile')
@section('title', 'Perfil')

@section('content')
<style type="text/css">
	.form-container input, .form-container select {
    	color: {{ $school->color  }} !important;
    }
	.form-container input[type="submit"] {
    	color: white !important;
    }
</style>
<main class="container section-paddings">
	<div class="profile-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Perfil</h1>
	</div>

	<div class="form-container">
		<form action="{{ route('update-profile') }}" method="POST">
			{{ csrf_field() }}

			<div class="photo-contact-details">
				<div class="photo">
					<label for="img">
						<div class="user-thumbnail" @if($user->img) style="background-image: url('{{ url('profile/thumbnail/'.$user->img) }}')" @endif></div>
					</label>
					<p>Foto perfil</p>
					@if($errors)
				        <div class="error">
				            @foreach ($errors->all() as $message)
				            <div class="alert alert-danger" role="alert">{{$message}}</div>
				            @endforeach
				        </div>
				    @endif
				</div>
				<div class="contact-details">
					<div class="form-row">
						<label for="fullName">Nom i Cognoms:</label>
						<input name="name" type="text" @if($user->name) value="{{ $user->name }}" @endif>
					</div>

					<div class="form-row">
						<label for="email">Correu electrònic:</label>
						<input name="email" type="email" @if($user->email) value="{{ $user->email }}" @endif>
					</div>

					<div class="form-row">
						<label for="birthdate">Data de naixement</label>
						<input name="birth" type="date" @if($user->birth) value="{{ $user->birth }}" @endif>
					</div>

					<div class="form-row">
						<label for="address">Adreça:</label>
						<input name="address" type="text" @if($user->address) value="{{ $user->address }}" @endif>
					</div>

					<div class="form-row">
						<label for="zipcode">Codi Postal:</label>
						<input name="cp" type="text" @if($user->cp) value="{{ $user->cp }}" @endif>
					</div>

					<div class="form-row">
						<label for="city">Localitat:</label>
						<input name="city" type="text" @if($user->city) value="{{ $user->city }}" @endif>
					</div>
					<div class="form-row">
						<label for="phone">Telèfon:</label>
						<input name="phone" type="tel" @if($user->phone) value="{{ $user->phone }}" @endif>
					</div>
				</div>
			</div>

			<div id="schools_fake" class="form-school">
				<div id="schools">
					@foreach($user->promotions()->get() as $promotion)
						<div class="form-row">
							<div class="school">
								<label for="select-school">Escola</label>
								<div  id="select-school">
									<div id="schools_container" >
										<h4>{{ $promotion->school()->first()->title }} - {{ $promotion->title }}</h4>
									</div>
									
								</div>
							</div>
						</div>
					@endforeach
							<div class="form-row">
								<div class="school">
									
								<select name="school" autocomplete="off">
										@foreach($schools as $sschool)
										<option value="{{ $sschool->id }}">{{ $sschool->title }}</option>
										@endforeach
									</select>
								</div>
								<div class="promo" style="flex-direction: column;">									
									<div><label for="promo">Any promoció</label>
									<input autocomplete="off" name="year" type="text"></div>
								</div>
							</div>
				</div>
				<a id="afegirEscola">Afegir escola</a>
			</div>

			<div class="form-status">
				<div class="form-row">
					<div class="situacio-actual">
						<div class="status-title">Situació actual</div>
						<div class="radio-buttons">
							<div class="radio-option">
								<label><input type="radio" name="situation" value="Estudiant" @if($user->situation == 'Estudiant') checked="" @endif>Estudiant</label>
							</div>
							<div class="radio-option">
								<label><input type="radio" name="situation" value="Treballant" @if($user->situation == 'Treballant') checked="" @endif>Treballant</label>
							</div>
						</div>
					</div>
				</div>

				<div id="studies_fake">
					<div>
						<div class="form-row">
							<div class="label-input">
								<label for="estudis">Estudis</label>
								<div style="width: 60%">
									@if($studies = $user->studies)
									<div id="studies_container" >
										@foreach($studies as $study)
										<p>{{ $study->name}}</p>
										@endforeach
									</div>
									@endif
									<input type="text" name="content">
								</div>
							</div>
						</div>
					</div>
					<a id="afegirEstudi">Afegir estudi</a>
				</div>

				<div class="form-row">
					<div class="label-input">
						<label for="professio">Professió</label>
						<input name="job" type="text" @if($user->job) value="{{ $user->job }}" @endif>
					</div>
				</div>
			</div>

			<div class="form-children">
				<div class="form-row">
					<div class="children">
						<div class="children-title">Actualment tens fills a l'escola?</div>

						<div class="radio-buttons">
							<div class="radio-option">
 								<label><input type="radio" name="has_children" value="Yes" @if($user->has_children == 'Yes') checked="" @endif>Sí</label>
							</div>
							<div class="radio-option">
								<label><input type="radio" name="has_children" value="No" @if($user->has_children == 'No') checked="" @endif>No</label>
							</div>
						</div>
					</div>
				</div>

				<div class="check-item">
					<label><input type="checkbox" name="wants_info" @if($user->wants_info) checked="" @endif>Vull rebre informació de la institució. Casella Text legal utilització dades LOPD</label>
				</div>

				<div class="check-item">
					<label for="privacy"><input checked="checked" type="checkbox" id="privacy" required="required"> He llegit i accepto la <a href="#">política de privacitat</a>. Text legal</label>
				</div>
			</div>

			<input type="submit" value="Guardar" id="send-button" class="school-background">
		</form>

		
	</div>

	<form id="real_studies" action="{{ route('add-studies') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="study">
	</form>

	<form id="real_schools" action="{{ route('add-school') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="school_id">
		<input type="hidden" name="school_year">
	</form>

	<form id="real_picture" action="{{ route('update-image') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="img" id="img" style="visibility: hidden;">
	</form>
</main>
@endsection

@section('scripts')
<script type="text/javascript">
	$('#schools_fake select').change(function(){
		$('#real_schools [name="school_id"]').val($(this).val());
	})
	$('#schools_fake [name="year"]').bind("propertychange change click keyup input paste", function(event){
		$('#real_schools [name="school_year"]').val($(this).val());
	});
	$('#schools_fake a').click(function(){
        var url = $('#real_schools').attr('action');
        var data = $('#real_schools').serializeArray();
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            success: function(data){
            	$('#schools_container').append('<h4>'+data.school+' - '+data.year+'</h4>');
            },
            error: function(result){
                alert(result);
            },
            dataType: 'json',
        });
	})


	$('#studies_fake input').bind("propertychange change click keyup input paste", function(event){
		$('#real_studies input[name="study"]').val($(this).val());
	});
	$('#studies_fake a').click(function(){
        var url = $('#real_studies').attr('action');
        var data = $('#real_studies').serializeArray();
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            success: function(data){
            	$('#studies_container').append('<p>'+data.name+'</p>');
            },
            error: function(result){
                alert(result);
            },
            dataType: 'json',
        });
	})

	$('#real_picture input').change(function(){
		$('#real_picture').submit();
	})
</script>
@endsection