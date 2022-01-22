<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">Test-app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                @foreach($menu as $key => $item)

                <li class="nav-item">
                    <a class="nav-link" href="{{ route($item) }}">{{$key}}</a>
                </li>
                    @endforeach

            </ul>
            <form>
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            <div class="text-end">
                <a href="{{ route('auth') }}"  type="button" class="btn btn-outline-light me-2">Login</a>
                <a type="button" class="btn btn-warning">Sign-up</a>
            </div>
        </div>
    </div>
</nav>