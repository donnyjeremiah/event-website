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
      <div class="col-md-10">
          <h3>{{ $event->name }}</h3>
      </div>
      <div class="col-md-2">
          <a href="{{ route('organiser::events.edit', ['id' => $event->id]) }}" class="btn btn-lg btn-block btn-danger">Cancel</a>
          {{ Form::submit('Save', ['class' => 'btn btn-lg btn-block btn-success']) }}
      </div>
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

    <div class="col-lg-5">
      <div class="spacing"></div>
      <h4>Name:</h4>
      {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
      <h4>Description:</h4>
      {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="col-lg-5 col-lg-offset-1">
      <div class="spacing"></div>
      <h4>Project Details</h4>
      <div class="hline"></div>

      {{ Form::label('organiser', 'Organiser:', ['class' => 'col-lg-1']) }}
      <div class="col-lg-4">
          {{ Form::text('organiser', null, ['class' => 'form-control']) }}
      </div>

      <p><b>Organiser:</b> {{ $event->organiser->name }}</p>
      <p><b>Date:</b> {{ $event->date_start->format('F j, Y') }}</p>
      <p><b>Time:</b> {{ $event->time }}</p>
      {{ Form::label('organiser', 'Organiser:', ['class' => '']) }}
      {{ Form::text('organiser', null, ['class' => 'form-control']) }}
      <p><b>Type:</b> {{ $event->type->name }}</p>
      {{ Form::label('organiser', 'Organiser:', ['class' => '']) }}
      {{ Form::text('organiser', null, ['class' => 'form-control']) }}
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
