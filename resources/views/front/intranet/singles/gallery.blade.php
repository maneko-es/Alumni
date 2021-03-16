@extends('front.layout-intranet')
@section('body_class','galleries')
@section('title', 'Galeria')
@section('content')
<main class="container section-paddings">
	@if($errors)
        <div class="error">
            @foreach ($errors->all() as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <div class="galeria-detall-header">
      <a href="{{ route('gallery') }}"><h3 class="school-color"><i class="fas fa-chevron-left school-color"></i>Tornar a galeria</h3></a>
      <h1>
        {{ $gallery->title }}
        @if($gallery->created_by)
        <small>Creada per {{ App\User::find($gallery->created_by)->name }}</small>
        @endif
      </h1>
      <button id="add-pic" class="add-caption school-background">Afegir fotos</button>
    </div>
      <form action="{{ route('add-pictures') }}" id="add-pictures" class="out" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
          <input type="file" name="pictures[]" multiple="" required="">
          <input type="submit" class="add-caption school-background" value="Afegir">
      </form>
    <div class="galeria-grid">
      @if($gallery->pictures->count() > 0)
        @foreach ($pictures as $picture)
          <div class="galeria-detall-item">
            <a href="{{ route('picture-single',['slug'=>$gallery->slug,'id'=>$picture->id]) }}">
              <div class="item-photo">
                <img src="{{ url('galleries/medium/'.$picture->img) }}">
              </div>
              @if($picture->users()->count() > 0)
              <span class="avatar-icon"><i class="far fa-user"></i></span>
              @endif
            </a>
          </div>
        @endforeach
      @else
      <div>Aquesta galeria no conté cap imatge</div>
      @endif


      {{ $pictures->links() }}
    </div>
</main>
@endsection
