@extends('front.layout-intranet')
@section('body_class','promotion')
@section('title', 'Promoció')

@section('content')
<main>
	<div class="section-paddings container">
		<div class="promocio-header">
			<h3 class="school-color">#ALUMNICCIC</h3>
			<h1>Promoció</h1>
			<p>{{ $blocks['0']->body }}</p>
		</div>

		<div class="promocio-grid">
			<?php $mates = $promotion->users()->get(); ?>
			@foreach($mates as $mate)

			<div class="promocio-grid-item">
				<div class="item-photo">
					@if(getMedia($user))
						<?php $urlpic = getMedia($user); ?>
					@else
						<?php $urlpic = url('profile/placeholder.svg'); ?>
					@endif
					<img src="{{ $urlpic }}" alt=""></div>
				<div class="item-info">
					<div class="info-name">{{ $mate->name }}</div>
					@if($mate->job) <div class="info-job">{{ $mate->job }}</div> @endif
					<a href="mailto:{{ $mate->email }}"><i class="far fa-envelope school-color"></i></a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</main>
@endsection
