@extends('layouts.master')
@section('title', '| Event')
@section('ActiveEvents','active')

@section('content')

@include('includes.blue', [
        'title' => $event->name,
    ])

<h1 class="col-lg-12 event-carousel-div">
<div class="col-lg-10 col-lg-offset-1 centered">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      @if($event->poster_no != 0)
        @for ($i = 0; $i < $event->poster_no; $i++)
          <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ ($i == 0)?'active':'' }}"></li>
        @endfor
      @endif
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      @if($event->poster_no != 0)
        @for ($i = 0; $i < $event->poster_no; $i++)
          <div class="item{{ ($i == 0)?' active':'' }}">
            <img src="{{ asset('storage/poster/carousel/' . $event->id . '-event-poster-' . ($i+1). '.jpg') }}" alt="">
          </div>
        @endfor
      @endif
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><span class="icon-prev"></span></a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="icon-next"></span></a>
  </div><! --/Carousel -->
</div>
</h1>

<!-- Buttons -->
<div class="col-lg-2 col-lg-offset-3">
  <a href="{{ route('organiser::events.edit', ['id' => $event->id]) }}" class="btn btn-lg btn-block btn-primary">Edit</a>
</div>
<div class="col-lg-2">
  {!! Form::open(['route' => ['organiser::events.destroy', $event->id], 'method' => 'DELETE']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-lg btn-block btn-danger']) !!}
  {!! Form::close() !!}
</div>
<div class="col-lg-2">
  <a href="{{ route('organiser::events.index') }}" class="btn btn-lg btn-block btn-primary">See All Events</a>
  {{-- MAKE ABOVE BUTTON AS BACK BUTTON --}}
</div>

<!-- Details -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-lg-offset-1">
      <div class="spacing"></div>
      <a href="#"><h3 class="ctitle">{{ $event->name }}</h3></a>
      <p><csmall>Posted: {{ $event->created_at->format('F j, Y') }}.</csmall> | <csmall2>By: {{ $event->organiser->name }} - 3 Comments</csmall2></p>
      <h4>Description:</h4>
      <p>{{ $event->description }}</p>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      <br>
      @if($event->poster_no != 0)
          @for ($i = 1; $i <= $event->poster_no; $i++)
              Name: {{ $event->id . "-event-poster-" . $i . ".jpg" }} <br>
          @endfor
      @endif
      <br>
      <h6>SHARE:</h6>
      <p class="share">
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-tumblr"></i></a>
        <a href="#"><i class="fa fa-google-plus"></i></a>
      </p>
    </div>

    <div class="col-lg-4 col-lg-offset-1">
      <div class="spacing"></div>
      <h4>Project Details</h4>
      <div class="hline"></div>
      <p><b>Organiser:</b> {{ $event->organiser->name }}</p>
      <p><b>Date:</b> {{ $event->date_start->format('F j, Y') }}</p>
      <p><b>Time:</b> {{ $event->time }}</p>
      <p><b>Type:</b> {{ $event->type->name }}</p>
      <p><b>Place:</b> {{ $event->address->city }}, {{ $event->address->state }}</p>
      <p><b>Number:</b> {{ $event->poster_no }} </p>
      <p><b>Tagged:</b> Flat, UI, Development</p>
      <p><b>Website:</b> <a href="http://blacktie.co">http://blacktie.co</a></p>
    </div>
  </div><! --/row -->
</div><! --/container -->
@endsection

@section('style')
<style>
.event-carousel-div {
    background-color: #131313;
    margin-top: auto;
    padding-top: 10px;
    padding-bottom: 10px;
  	padding-left: 80px;
}
</style>
@endsection

@section('script')
@endsection
