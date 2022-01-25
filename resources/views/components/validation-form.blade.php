<link href="{{ asset('css/form-validation.css') }}" rel="stylesheet">

<body class="bg-light">

<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Форма запроса</h2>
            <p class="lead">Заполните форму для выполнения запроса.</p>
        </div>

        <div class="row g-5" style="justify-content: center">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Данные пользователя</h4>
                <form class="needs-validation" novalidate action="{{ route('query.store') }}" method="post">
                    @csrf
                    <div class="row g-3">

                        <div class="col-12">
                            <label for="username" class="form-label">Имя пользователя</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" name = "username" placeholder="Username" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control" id="email" name = "email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tel" class="form-label">Телефон</label>
                            <input type="tel" class="form-control" id="tel" name = "tel" placeholder="+7 999 999 99 99" required>
                            <div class="invalid-feedback">
                                Please enter your phone.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="query" class="form-label">Запрос</label>
                            <input type="text" class="form-control" id="query" name = "query" placeholder="Ваш запрос" required>
                            <div class="invalid-feedback">
                                Please enter your query.
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Сделать запрос</button>
                </form>
            </div>
        </div>
    </main>

</div>

<script src="{{ asset('js/form-validation.js') }}"></script>
</body>

