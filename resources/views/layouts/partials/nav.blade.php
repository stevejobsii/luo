<div role="navigation" class="navbar navbar-default navbar-static-top topnav">
  <div class="container">
    <div class="navbar-header">

      <a href="/" class="navbar-brand">沉香论坛</a>
    </div>
    <div id="top-navbar-collapse" class="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="{!! (Request::is('topics*') ? ' active' : '') !!}"><a href="{!! route('topics.index') !!}">{!! lang('Topics') !!}</a></li>
        <li class="{!! (Request::is('nodes/40') ? ' active' : '') !!}"><a href="{!! route('nodes.show', 40) !!}">{!! lang('Jobs') !!}</a></li>
        <li class="{!! (Request::is('wiki*') ? ' active' : '') !!}"><a href="{!! route('wiki') !!}">{!! lang('Wiki') !!}</a></li>
        <li class="{!! (Request::is('about*') ? ' active' : '') !!}"><a href="{!! route('about') !!}">{!! lang('About') !!}</a></li>
        <li><a href="http://goodgoto.com/" target="_blank">{!! lang('Document') !!}</a></li>
      </ul>

      <div class="navbar-right">
        {!! Form::open(['method'=>'get', 'class'=>'navbar-form navbar-left', 'target'=>'_blank']) !!}
          <div class="form-group">
          {!!Form::input('search','q',null,['placeholder'=>lang('Search'),'class'=>'form-control search-input mac-style'])!!}
          </div>
        {!! Form::close() !!}
       
        <ul class="nav navbar-nav github-login" >
          @if (Auth::check())
              <li>
                  <a href="{!! route('notifications.index') !!}" class="text-warning">
                      <span class="badge badge-{!! Auth::user()->notification_count > 0 ? 'important' : 'fade'; !!} redbg" id="notification-count">
                          <i class="fa fa-envelope-o"></i> {!! Auth::user()->notification_count !!}
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{!! route('users.show', Auth::user()->id) !!}">
                      <div class="avatar-container-nav">
                      <img src="{{Auth::user()->avatar_30}}" id="avatar">
                      </div>
                  </a>
              </li>
              <li>
                  <a class="button" href="{!! url('auth/logout') !!}" onclick=" return confirm('{!! lang('Are you sure want to logout?') !!}')">
                      <i class="fa fa-sign-out"></i> {!! lang('Logout') !!}
                  </a>
              </li>
          @else
              
              <a href="{!! url('auth/login') !!}" class="btn btn-info" id="login-btn">
                <i class="fa fa-github-alt"></i>
                {!! lang('Login') !!}
              </a>
          @endif
        </ul>

      </div>
    </div>

  </div>
</div>
