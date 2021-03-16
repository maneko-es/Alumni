@extends('front.layout-intranet')
@section('body_class','galleries')
@section('title', 'Galeria')
@section('content')
<?php $desc = $picture->description; ?>
<link rel="stylesheet" type="text/css" href="{{ url('css/chosen.css') }}">
<main class="container section-paddings">

    <div class="slider-header">
        <a href="{{ route('gallery-single',['slug'=>$gallery->slug]) }}"><h3 class="school-color"><i class="fas fa-chevron-left school-color"></i> tornar</h3></a>
        <h1>{{ $gallery->title }}</h1>
    </div>

    <div id="galeriaSlider" class="">
        @if($prev)
            <a href="{{ route('picture-single',['slug'=>$gallery->slug,'id'=>$prev]) }}" title="Anterior"><i class="fas fa-chevron-left prev slick-arrow" style="" aria-hidden="true"></i></a>
        @endif

        <div class="slide-title-captions">
            <div class="slide-photo">
                <img src="{{ url('galleries/'. $picture->img) }}" alt="{{ $desc }}">
                @if($picture->uploaded_by)
                    <small class="cap">Autor/a: {{ App\User::find($picture->uploaded_by)->name }}</small>
                @endif
            </div>

            @if($desc)
                <div class="photo-title">{{ $desc }}</div><br>
            @elseif($picture->uploaded_by == $user->id)
            <br>
                <form action="{{ route('add-description') }}" method="post" >
                    {{ csrf_field()}}
                    <input type="hidden" name="picture_id" value="{{ $picture->id }}">
                    <input type="text" name="description" placeholder="Afegir descripció" >
                    <input type="submit" class="add-caption" value="Afegir">
                </form>
            <br>
            @endif

            @if($picture->users()->count() > 0)
            <div class="photo-captions">
                <img src="/images/caption-logo.png" class="caption-logo" alt="">
                @foreach($picture->users()->get() as $mate)
                    @if($mate->id == $user->id)
                        <form class="caption" action="{{ route('delete-tag') }}" method="post">
                            {{ $mate->name }}
                            {{ csrf_field() }}
                            <input type="hidden" name="picture_id" value="{{ $picture->id }}">
                            <input type="submit" value="&times;">
                        </form>
                    @else
                        <div class="caption"> {{ $mate->name }} </div>
                    @endif
                @endforeach
            </div>
            @endif

            <button id="add-caption" class="add-caption">Afegir company/a</button>
            @if(Auth::user()->id === $picture->uploaded_by)
              <div class="mt-4">
                <form action="{{ route('delete-picture') }}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="picture_id" value="{{ $picture->id }}">
                  <input type="submit" class="add-caption" value="Borrar Foto">
                </form>
              </div>
            @endif
            <form action="{{ route('tag-users') }}" id="select-mate" class="out" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="picture_id" value="{{ $picture->id }}">
                <select autocomplete="off" name="users[]" class="chosen-select" multiple="" data-placeholder="Selecciona o escriu per buscar">
                    @foreach($promotion->users()->get() as $mate)
                    <option value="{{ $mate->id }}">{{ $mate->name }}</option>
                    @endforeach
                </select>
                <input type="submit" class="add-caption" value="Afegir">
            </form>
        </div>

        @if($next)
            <a href="{{ route('picture-single',['slug'=>$gallery->slug,'id'=>$next]) }}" title="Següent"><i class="fas fa-chevron-right next slick-arrow" style="" aria-hidden="true"></i></a>
        @endif
    </div>

</main>
@endsection

@section('scripts')
<script src="{{ url('js/chosen.jquery.js') }}" ></script>

<script type="text/javascript">
    $(".chosen-select").chosen(
        {width: "400px"}
    );
    $('#add-caption').click(function(){
        $('#select-mate').toggleClass('out');
    })
</script>
@endsection
