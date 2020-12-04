@extends('front.layout-intranet')
@section('body_class','dashboard')
@section('title', 'Intranet')
@section('content')
<main>
	<div class="welcome-intranet-main main-section section-paddings">
		<h3 class="school-color">#ALUMNICCIC</h3>
		<div class="title-and-badge ">
			<h1>{{ trans('intranet.welcome').' '.$school->title }}</h1>

			<div class="badge-container">
				<div class="promocio-badge school-background">
					<i class="fas fa-graduation-cap"></i>
					<h3>{{ $promotion->title }}</h3>
					<p>Promoció</p>
				</div>
			</div>
		</div>
	</div>

	<div class="welcome-galeria section-paddings">
		<div class="welcome-galeria-header school-color">Galeria promoció <br>{{ $promotion->title }}</div>

		<div class="galeria-grid">
			<?php $galleries = $promotion->galleries()->take(6)->get(); ?>
			@if($galleries->count() > 0)
				@foreach($galleries as $gallery)
				<div class="galeria-item">
					<a href="{{ route('gallery-single',['slug'=>$gallery->slug]) }}">
						<?php $img = $gallery->pictures()->orderBy('created_at','desc')->first()->img; ?>
						<img src="{{ url('galleries/medium/'.$img) }}" alt="">

						<div class="photo-hover school-background">
							<div class="caption">{{ $gallery->title }}</div><i class="fas fa-chevron-right"></i>
						</div>
					</a>
				</div>
				
				@endforeach
			@endif
		</div>

		<div class="gallery-link school-background"><a href="{{ route('gallery') }}">Veure la galeria<i class="far fa-image"></i></a></div>
    </div>
	
</main>

@if(
	!$user->birth ||
	!$user->address ||
	!$user->cp ||
	!$user->city ||
	!$user->phone ||
	!$user->situation ||
	!$user->job ||
	!$user->has_children ||
	!$user->img
	)
	<div class="modal" tabindex="-1" role="dialog" id="profileModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<h2>Hola Nicole!</h2>
				<p>Ja gairebé has acabat de completar el teu compte. Per finalitzar el registre a Alumni vés al teu perfil i omple els camps que et falten.</p>
				<p>Recorda que si formes part d'una altra escola, també pots afegir-la des del teu perfil.</p>
				<a href="{{ route('profile') }}" class="school-background">Completa el teu perfil</a>
			</div>
		</div>
	</div>

	@section('scripts')
		<script type="text/javascript">
			$('#profileModal').modal('show')
		</script>
	@endsection
@endif

@endsection

