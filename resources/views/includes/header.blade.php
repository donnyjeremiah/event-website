<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Mancunian.</a>
    </div>
    <div class="navbar-collapse collapse navbar-right">
      <ul class="nav navbar-nav">
        <li class="@yield('ActiveHome')"><a href="{{ url('/') }}">HOME</a></li>
        <li class="@yield('ActiveEvents')"><a href="{{ route((true)?'visitor::events.index':'', ['city' => 'Chennai']) }}">EVENTS</a></li>
        <li class="@yield('ActiveLogin')"><a href="{{ url('/login') }}">LOGIN</a></li>
        <li class="@yield('ActiveRegister')"><a href="{{ url('/register') }}">REGISTRATION</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">PAGES <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="blog.html">BLOG</a></li>
            <li><a href="single-post.html">SINGLE POST</a></li>
            <li><a href="portfolio.html">PORTFOLIO</a></li>
            <li><a href="single-project.html">SINGLE PROJECT</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
