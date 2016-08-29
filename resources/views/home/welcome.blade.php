@extends('layouts.master')

@section('style')
<style>
  #map-canvas {
   width: 100%;
   height: 400px;
   background-color: grey;
  }
</style>
@endsection

@section('content')
<div id="headerwrap">
   <div class="container">
   <div class="row">
     <div class="col-lg-8 col-lg-offset-2">
       <h3>Check out events near you!</h3>
       <h1>Party hard!</h1>
     </div>
     <div class="col-lg-8 col-lg-offset-2 himg">
       <!-- <img src="assets/img/browser.png" class="img-responsive"> -->
       <button type="button" id="current" class="btn btn-primary">Near me</button>
       <button type="button" id="zip" class="btn btn-primary">Use Zip code</button>
       <div id="map-canvas"></div>
     </div>
   </div><!-- /row -->
   </div> <!-- /container -->
</div><!-- /headerwrap -->
@endsection

@section('script')
<script src="{{ asset('js/map.js') }}" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCKnxu-Hgws5rNSloauYgiIRKq6AUUKWoY&callback=initMap" async defer></script>
<!-- https://maps.googleapis.com/maps/api/js?key=AIzaSyCKnxu-Hgws5rNSloauYgiIRKq6AUUKWoY&callback=initMap -->
@endsection
