<nav class="navbar navbar-expand-sm navbar-dark bg-dark " aria-label="Third navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">Test-app</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                @foreach($menu as $key => $item)

                <li class="nav-item">
                    @if($key === 'Админка')
                        @if(Auth::user() && Auth::user()->is_admin === true)
                            <a class="nav-link" href="{{ route($item) }}">{{$key}}</a>
                        @endif
                            @continue
                    @endif
                    <a class="nav-link" href="{{ route($item) }}">{{$key}}</a>
                </li>
                    @endforeach
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
        @if(Auth::guest())
            <div class="text-end navbar-brand">
                <a href="{{ route('login') }}"  class="btn btn-outline-light me-auto">Вход</a>
                <a href="{{ route('register') }}" class="btn btn-warning">Регистрация</a>
            </div>
        @else
            <div class="text-end navbar-brand">
                <a class="navbar-brand" href="{{ route('account') }}">
                    <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif" alt="" width="30" height="30" style="border-radius: 5px">
                </a>
                <a href="{{ route('logout') }}" class="btn btn-outline-light me-auto">Выход</a>
            </div>
        @endif
    </div>
</nav>
