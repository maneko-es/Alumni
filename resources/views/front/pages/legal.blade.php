@extends('front.layout')
@section('body_class','legal')
@section('title', 'Legal')

@section('content')
<header id="page-header" class="veil-parent" style="height:400px;background-image: url('https://www.iccic.edu/media/original/open-book-library-education-read-159621-5bb21276a9427.jpeg');">
    <div class="veil"></div>
    <div class="container">
        <h1>{{$page->title}}</h1>
    </div>
</header>
<div class="colors-line float">
    <div class="background-darkblue"></div>
    <div class="background-orange"></div>
    <div class="background-salmon"></div>
    <div class="background-darkgreen"></div>
    <div class="background-green"></div>
    <div class="background-blue"></div>
    <div class="background-pink"></div>
</div>
<main>
    <div class="container mb-5">

      <div class="float-right">
          <h2 class="playfair">{{ $page->title }}</h2>
          <div class="page-content">{!! $blocks[0]->body !!}</div>
      </div>

    </div>
</main>



@endsection
