@extends('layouts.master')
@section('title', '| Create New Event')
@section('ActiveEvents','active')

@section('content')

@include('includes.blue', [
        'title' => 'Create New Event',
    ])

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="create_form" class="form-horizontal" role="form" method="POST" action="{{ route('organiser::events.store') }}"
                    enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include('includes.message')

                        <div class="jumbotron vertical-center"><h2>What?</h2></div>

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- TYPE -->
                        <div class="form-group">
                            <label for="type" class="col-md-3 control-label">Type</label>
                            <div class="col-md-3">
                                <select id="type" class="form-control" name="type" value="{{ old('type') }}">
                                    <option>Art-Festival</option>
                                    <option>Film-Festival</option>
                                    <option>Debate</option>
                                    <option>Party</option>
                                    <option>Talk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="poster" class="col-md-3 control-label">Poster</label>
                            <div class="col-md-7">
                                <input id="poster" type="file" class="btn btn-primary" name="poster[]" multiple>
                            </div>
                        </div>

                        <!-- DESC -->
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">Description</label>
                            <div class="col-md-7">
                                <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="jumbotron vertical-center"><h2>When?</h2></div>

                        <!-- DAYS -->
                        <div class="form-group">
                            <label for="days" class="col-md-3 control-label">Days</label>
                            <div class="col-md-3">
                                <select id="days" class="form-control" name="days" value="{{ old('days') }}">
                                    <option>1</option>
                                    <option>1+</option>
                                </select>
                            </div>
                        </div>

                        <!-- DATE -->
                        <div class="form-group">
                            <label for="date_start" class="col-md-3 control-label">Date</label>
                            <div class="col-md-7">
                                <!-- From -->
                                <div class="input-group">
                                    <input id="date_start" type="date" class="form-control" placeholder="DD/MM/YYYY" name="date_start" value="{{ old('date_start') }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <!-- To -->
                                <div class="input-group padding-top" id="showTo">
                                    <input  id="date_end" type="date" class="form-control" placeholder="DD/MM/YYYY" name="date_end" value="{{ old('date_end') }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- TIME -->
                        <div class="form-group">
                            <label for="time" class="col-md-3 control-label">Time</label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <input id="time" type="text" class="form-control timepicker" name="time" value="{{ old('time') }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- CONTACT -->
                        <!--
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Contact</label>
                            <div class="col-md-7">
                              <input id="email" type="text" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}">
                              <div class="padding-top">
                                <input id="phone" type="text" class="form-control" placeholder="Phone: +91 xxxxx xxxxx" name="phone" value="{{ old('phone') }}">
                              </div>
                            </div>
                        </div>
                        -->

                        <div class="jumbotron vertical-center"><h2>Where?</h2></div>

                        <!-- ADDRESS -->
                        <div class="form-group">
                            <label for="line_1" class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-7">
                                <input id="line_1" type="text" class="form-control" name="line_1" value="{{ old('line_1') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="line_2" class="col-md-3 control-label">Address Line 2</label>
                            <div class="col-md-7">
                                <input id="line_2" type="text" class="form-control" name="line_2" value="{{ old('line_2') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="landmark" class="col-md-3 control-label">Landmark</label>
                            <div class="col-md-7">
                                <input id="landmark" type="text" class="form-control" name="landmark" value="{{ old('landmark') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="countryId" class="col-md-3 control-label">Country</label>
                            <div class="col-md-3">
                                <select id="countryId" class="form-control countries" name="country" value="{{ old('country') }}">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stateId" class="col-md-3 control-label">State</label>
                            <div class="col-md-3">
                              <select id="stateId" class="form-control states" name="state" value="{{ old('state') }}">
                                  <option value="">Select State</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cityId" class="col-md-3 control-label">City</label>
                            <div class="col-md-3">
                              <select id="cityId" class="form-control cities" name="city" value="{{ old('city') }}">
                                  <option value="">Select City</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="zip" class="col-md-3 control-label">Zip Code</label>
                            <div class="col-md-3">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}">
                            </div>
                        </div>

                        <div class="jumbotron vertical-center"><h2>Map:</h2></div>

                        <!-- MAP -->
                        <div class="form-group">
                            <label for="map" class="col-md-3 control-label">Map</label>
                            <div class="col-md-7">
                                <div class="btn-group-justified padding-bottom">
                                    <a href="" id="markerSet" class="btn btn-primary">Set</a>
                                    <a href="" id="markerUnset" class="btn btn-primary">Clear</a>
                                </div>
                                <div class="input-group padding-bottom">
                                    <input id="zipText" type="text" class="form-control" placeholder="Zip Code">
                                    <span class="input-group-btn"><button id="zipSearch" type="button" class="btn btn-success">Go</button></span>
                                </div>
                                <div id="map-canvas"></div>
                                <div class="padding-top">
                                    <button id= "setLocation" type="button" class="btn btn-primary btn-block">Set Location</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="latitude" class="col-md-3 control-label">Latitude</label>
                            <div class="col-md-7">
                                <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="longitude" class="col-md-3 control-label">Longitude</label>
                            <div class="col-md-7">
                                <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') }}">
                            </div>
                        </div>


                        <div class="panel-footer clearfix">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary" value="Register">
                                <input type="button" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
.padding-top {
  padding-top:1%;
}
.padding-bottom {
  padding-bottom:1%;
}
.jumbotron {
  padding: 0.5em 0.5em;
}
#map-canvas {
 height: 300px;
 background-color: grey;
}
</style>
<link href="{{ asset('vendor/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/css/parsley.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
<script src="{{ asset('vendor/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/js/parsley.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" type="text/javascript"></script>
<script src="http://iamrohit.in/lab/js/location.js" type="text/javascript"></script>

<script src="{{ asset('js/events_create.js') }}" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCKnxu-Hgws5rNSloauYgiIRKq6AUUKWoY&callback=initMap" async defer></script>
@endsection
