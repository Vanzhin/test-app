@extends('layouts.main')
@section('title')
    @parent {{ $news->title }}
@endsection

@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">{{ $news->title }}</h1>
            <p class="card-text"> Добавлено: {{ $news->created_at }}</p>
            <p class="card-text"> Автор: {{ $news->author }}</p>
            <p class="card-text"> Из категории:
            @forelse($news->categories as $category)
                {{ $category->title }}
            @empty
                нет категории
            @endforelse
            </p>
            <p class="lead fw-normal">{!! $news->description !!}</p>
{{--            TODO не работает правильно, т.к. id новости может быть не по порядку--}}
            <a class="btn btn-outline-secondary" href="{{ route('news.show',['news' => $news->id - 1]) }}">Предыдущая</a>
            <a class="btn btn-outline-secondary" href="{{ route('news.show',['news' => $news->id + 1]) }}">Следующая</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
@endsection
