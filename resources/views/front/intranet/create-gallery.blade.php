@extends('front.layout-intranet')
@section('body_class','galleries')
@section('title', 'Crear galeria')
@section('content')
<main class="avantatges-container create-gallery section-paddings container">
	<div class="avantatges-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Crear galeria</h1>
	</div>
	@if($errors)
        <div class="error">
            @foreach ($errors->all() as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
	<form action="{{ route('save-gallery-front') }}" enctype="multipart/form-data" method="post">
		{{ csrf_field() }}
		<label>Nom<br>
			<input type="text" name="name" required="">
		</label>
		<label>Descripció<br>
			<textarea name="description" rows="3"></textarea>
		</label>
		<label>Categoria<br>
			<select name="category_id" required="">
				@foreach($categories as $cat)
				<option value="{{ $cat->id }}">{{ $cat->title }}</option>
				@endforeach
			</select>
		</label>
		<label>
			Imatges<br>
			<input type="file" name="pictures[]" multiple="" required="">
			<small>Formats permesos: jpg. Mida màxima per element: 1MB</small>
		</label>
		<input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
		<input type="submit" value="Crear galeria">
	</form>

</main>
@endsection
