@extends('layouts.master')
@section('title', '| Individual')
@section('ActiveEvents','active')

@section('content')
<!-- *****************************************************************************************************************
 BLUE WRAP
 ***************************************************************************************************************** -->
<div id="blue">
    <div class="container">
    <div class="row">
      <h3>{{ $event->name }}</h3>
    </div><!-- /row -->
    </div> <!-- /container -->
</div><!-- /blue -->

<!-- *****************************************************************************************************************
 TITLE & CONTENT
 ***************************************************************************************************************** -->

 <div class="container mt">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1 centered">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="assets/img/portfolio/single01.jpg" alt="">
          </div>
          <div class="item">
            <img src="assets/img/portfolio/single02.jpg" alt="">
          </div>
          <div class="item">
            <img src="assets/img/portfolio/single03.jpg" alt="">
          </div>
        </div>
      </div><! --/Carousel -->
    </div>

    <div class="col-lg-5 col-lg-offset-1">
      <div class="spacing"></div>
      <h4>{{ $event->name }}</h4>
      <p>{{ $event->description }}</p>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      <h4>Our Proposal</h4>
      <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
      <p><b>Tagged:</b> Flat, UI, Development</p>
      <p><b>Website:</b> <a href="http://blacktie.co">http://blacktie.co</a></p>
    </div>

  </div><! --/row -->
 </div><! --/container -->
@endsection

@section('style')
@endsection

@section('script')
@endsection
