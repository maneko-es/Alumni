<div class="galeria-header-and-search section-paddings">
	<div class="galeria-header">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<h1>Galeria</h1>
		@if(isset($_POST['t']) || isset($_POST['cat']))
			<h2>Heu cercat 
				@if(isset($_POST['t']) && $_POST['t']) "{{$_POST['t']}}" @endif
				@if(isset($_POST['cat'])) - Categoria "{{ App\Category::find($_POST['cat'])->title }}" @endif
			</h2>
		@endif
	</div>
	<form action="{{ route('search-gallery') }}" method="post" class="galeria-search">

			{{ csrf_field() }}
		
			<div class="select-chevron">
				<i class="fas fa-chevron-down school-color"></i>
				<select name="cat">
					<option value="">Categoria</option>
					@foreach($categories as $cat)
					<option value="{{ $cat->id }}" @if(isset($_POST['cat']) && $_POST['cat']==$cat->id) selected="selected" @endif>{{ $cat->title }}</option>
					@endforeach
				</select>
			</div>

			<input type="text" name="t" @if(isset($_POST['t']) && $_POST['t']) value="{{$_POST['t']}}" @endif>
			<input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
			<button class="buscar-galeria school-background"><i class="fas fa-search"></i></button>
		

		<a href="{{ route('create-gallery-front') }}" class="crear-galeria school-background">
			Crear Galeria
		</a>
	</form>
</div>