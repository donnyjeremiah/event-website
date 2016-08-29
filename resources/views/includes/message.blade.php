@if(count($errors) > 0)
{{--
<div class="row">
    <div class="col-md-6 col-md-offset-3 error">
        <div class="jumbotron vertical-center text-center" style="background-color:#ff7a7a">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
--}}
<div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    <strong>Error:</strong> {{ Session::get('error') }}
</div>
@endif
@if(Session::has('success'))
{{--
    <div class="row">
      <div class="col-md-6 col-md-offset-3 success">
          <div class="jumbotron vertical-center text-center" style="background-color:#abff7b">
              {{ Session::get('success') }}
          </div>
      </div>
    </div>
--}}
<div class="alert alert-success" role="alert">
    <strong>Success:</strong> {{ Session::get('success') }}
</div>
@endif
