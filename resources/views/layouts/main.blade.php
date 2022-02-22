<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@section('title') News - @show</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>
<body>
{{-- TODO убрать этот костыль и сделать нормально--}}
@component('components.header',['menu'=>\App\View\Components\Header::getMenu()])
@endcomponent

<main>

    @php
    $msg = "hello everybody";
    @endphp

    @component('components.alert',['type' => 'danger', 'message' => $msg])
    @endcomponent

    @yield('header')


    @yield('content')

</main>
@component('components.footer')
@endcomponent
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
