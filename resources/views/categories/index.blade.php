@extends('layouts.main')
@section('title')
    @parent Категории новостей
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все категории</h1>

            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($categoryList as $category)
            <div class="col">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <p class="card-text">ID: {{ $category->id }}</p>
                        <p class="card-text"> Название категории: {{ $category->title }}</p>
                        <p class="card-text"> Дата создания категории: {{ $category->created_at }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('news.categories.show', ['category_id' => $category->id] ) }}" type="button" class="btn btn-sm btn-outline-secondary">Все новости категории</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <h2>Записей нет</h2>

        @endforelse
    </div>


@endsection


