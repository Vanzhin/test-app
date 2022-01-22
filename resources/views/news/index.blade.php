@extends('layouts.main')
@section('title')
    @parent main
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все новости</h1>

            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($newsList as $news)
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $news['title'] }}</text></svg>

                            <div class="card-body">
                                <p class="card-text">{!! $news['description'] !!}</p>
                                <p class="card-text"> Автор: {{ $news['author'] }}</p>
                                <p class="card-text"> Добавлено: {{ $news['created_at'] }}</p>


                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('news.show',['id' => $news['id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                        <a href="{{ route('news.categories.show', ['category_id' => $news['category_id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Все новости раздела</a>
                                    </div>
                                    <small class="text-muted">9 mins</small>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>

                @endforelse
            </div>
        </div>
    </div>

@endsection
