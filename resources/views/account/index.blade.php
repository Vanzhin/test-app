<h1> Привет, {{ Auth::user()->name }}!</h1>
@if(Auth::user()->is_admin)
<a href="{{ route('admin.index') }}">В админку</a>
@endif

@if(Auth::user()->avatar)
    <img src="{{ Auth::user()->avatar }}" style="width: 25px;height: 25px;">

@endif
<br>
<a href="{{ route('account.logout') }}">Выход</a>


