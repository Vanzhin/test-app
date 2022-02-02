<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Test-app - Отзыв</title>

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


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">

</head>
<body class="text-center">

<main class="form-signin">
    <form method="post" action="{{ route('feedback.store') }}">
        @csrf
        @include('inc.message')

        <h1 class="h3 mb-3 fw-normal">Оставить отзыв</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName"  name="nickName" value="{{old('nickName')}}" placeholder="Иван Иванов">
            <label for="floatingName" >Ваше имя</label>
        </div>
        <div class="form-floating">
            <textarea type="text" class="form-control" id="floatingFeedback"
                      rows="5" style="height: auto" name="message">{{old('message')}}</textarea>
            <label for="floatingFeedback">Ваш отзыв</label>
        </div>


        <button class="w-100 btn btn-lg btn-success" type="submit">Отправить</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
</main>



</body>
</html>


