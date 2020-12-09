@extends('front.layout')
@section('title', $activity->title)
@section('body_class','activity activity-single')
@section('content')

<main class="section-paddings">
    <div class="container">
        <div class="row">
            <a class="activity-back col-xs-12 col-md-4" href="{{ route('activitats') }}"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp; Activitats</a>
            <div class="main-section col-xs-12 col-md-8">
            	<h3 class="yellow">{{ $activity->category->title }}</h3>
            	@if(getMedia($activity))<img class="activity-img" src="{{ getMedia($activity) }}">@endif
            </div>
        </div>
        <div class="row">
            <aside class="col-xs-12 col-md-4">
                <div id="post-meta" class="short-border">
                    <span class="category big">{{ $activity['cat'] }}</span>
                    @include('front.partials.share')
                </div>

            </aside>
            <div class="col-xs-12 col-sm-8">
               
                <h1>{{ $activity['title'] }}</h1>
                {!! $activity['body'] !!}
            </div>
            
        </div>
    </div>
</main>
@endsection