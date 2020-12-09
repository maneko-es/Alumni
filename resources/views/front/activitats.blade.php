@extends('front.layout')
@section('body_class','activitats')
@section('title', 'Activitats')

@section('content')
<div class="activitats-banner main-section section-paddings">
	<div class="width-banner-text container">
		<h3 class="white">{{ $intro->hashtag}}</h3>
		<h1 class="white">{{ $intro->title}}</h1>
		<p class="yellow">{{ $intro->body}}</p>
	</div>
</div>

<div class="activitats-agenda section-paddings container">
	<div class="activitats-menu">
		<div class="menu-form">
			<h2>{{ trans('front.trobades_agenda') }}</h2>
			<form action="{{ route('search-activitats') }}" method="post">
				{{ csrf_field() }}
				<div class="menu-search">
					<input type="text" name="t" placeholder="Cercar" @if(isset($_POST['t']))value= "{{ $_POST['t'] }}" @endif>
					<i class="fas fa-search"></i>
	            </div>
	            <div class="menu-select">
					<select name="school_id">
						<option value="" selected>{{ trans('front.escola') }}</option>
						@foreach($schools as $school)
							<option value="{{ $school->id }}" @if(isset($_POST['school_id']) && $_POST['school_id'] == $school->id) selected="selected" @endif>{{ $school->title }}</option>
						@endforeach
					</select>
					<i class="fas fa-chevron-down"></i>
				</div>
				<div class="menu-select">
					<select name="category_id">
						<option value="" selected>{{ trans('front.categories') }}</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" @if(isset($_POST['category_id']) && $_POST['category_id'] == $category->id) selected="selected" @endif>{{ $category->title }}</option>
						@endforeach
					</select>
					<i class="fas fa-chevron-down"></i>
				</div>
				<button style="text-transform: uppercase;">{{ trans('front.cercar') }}</button>
			</form>
		</div>
	</div>

	<div class="activitats-container">
		<div class="activitats-grid">
			@forelse($activities as $activity)
				@if($activity->is_meeting)
				<div class="activitats-item-alt" style="background-color: {{ $activity->school->color }}">
					<a href="{{ route('activity-single', ['slug'=>$activity->slug]) }}" >
						<h2>Trobada {{ $activity->school->title }}</h2>
						<h3>{{ $activity->title }}</h3>
						<?php $body = strip_tags($activity->body);
	                        $bodyArray = explode(' ',$body);
	                        $bodyCut = array_slice($bodyArray,0,30);
	                        $excerpt = implode(' ',$bodyCut);
	                        ?>
	                        {{-- <p>{{ $excerpt }}@if(count($bodyArray) > 30)...@endif</p> --}}
	                        <p>{!! substr($activity->body, 0, 50) !!}</p>
						<div class="activitat-footer">
							<div class="activitat-footer-item">
								<i class="fas fa-calendar-week "></i>{{ $activity->date }}
							</div>
							<div class="activitat-footer-item">
								<i class="fas fa-map-marker-alt "></i>{{ $activity->place }}
							</div>
						</div>
					</a>
				</div>
				@else
				<div class="activitats-item">
					<a href="{{ route('activity-single', ['slug'=>$activity->slug]) }}" >
						<div class="item-title">{{ $activity->category->title }}</div>
						<div class="item-card">
							<img src="/images/activitat1.png">
							<div class="color-bar-card"> <div class="color1"></div> <div class="color2"></div> <div class="color3"></div> <div class="color4"></div> <div class="color5"></div> <div class="color6"></div> <div class="color7"></div> </div>
							<h2>{{ $activity->title }}</h2>
							<?php $body = strip_tags($activity->body);
	                        $bodyArray = explode(' ',$body);
	                        $bodyCut = array_slice($bodyArray,0,30);
	                        $excerpt = implode(' ',$bodyCut);
	                        ?>
	                        {{-- <p>{{ $excerpt }}@if(count($bodyArray) > 30)...@endif</p> --}}
	                        <p>{!! substr($activity->body, 0, 50) !!}</p>
						</div>
					</a>
				</div>
				@endif
			@empty
				<p>No hi ha resultats</p>
			@endforelse

			<?php /*<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat2.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>

		<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat3.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>
		<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat4.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>
		<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat5.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>
		<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat6.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>
		<div class="activitats-item-alt blau">
		<div class="trobada-title">
		<h2>Trobada Thau Barcelona</h2>
		<img src="/images/children-logo.png">
		</div>

		<h3>Alumni 2015</h3>
		<p>Nam tincidunt diam vel tortor scelerisque feugiat ut nunc purus ed quam velit.</p>
		<div class="activitat-footer">
		<div class="activitat-footer-item">
		<i class="fas fa-calendar-week icon-yellow"></i>14.05.20
		</div>
		<div class="activitat-footer-item">
		<i class="fas fa-map-marker-alt icon-yellow"></i>Barcelona
		</div>
		</div>
		</div>

		<div class="activitats-item">
		<div class="item-title">EXPOSICIÓ</div>
		<div class="item-card">
		<img src="/images/activitat7.png">
		<div class="color-bar-card">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
		</div>
		<h2>Inici curs '125 anys d'història de Catalunya'</h2>
		<p>El proper 21 de novembre s'inicia el curs “Una història de la cultura catalana”.</p>
		</div>
		</div>
		</div>
		<div class="activitats-pages">
		<a href="">1</a>
		<a href="">2</a>
		<a href="">3</a>*/ ?>
		</div>
	</div>
</div>

@endsection
