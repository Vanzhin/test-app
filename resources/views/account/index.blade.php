<h1> Привет, {{ Auth::user()->name }}!</h1>
@if(Auth::user()->is_admin)
<a href="{{ route('admin.index') }}">В админку</a>
@endif
<br>
<a href="{{ route('account.logout') }}">Выход</a>


