@extends('layouts.admin')
@section('title')
    Новости @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Удалить</button>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div>
        @forelse($newsList as $news)

            <p class="card-text"><strong>{!! $news['description'] !!}</strong></p>
            <p class="card-text"> Автор: {{ $news['author'] }}</p>
            <p class="card-text"> Добавлено: {{ $news['created_at'] }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('news.show',['id' => $news['id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                    <a href="{{ route('news.categories.show', ['category_id' => $news['category_id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Все новости раздела</a>
                </div>
            </div>
            <hr>

        @empty
            <h2>Записей нет</h2>

        @endforelse
    </div>

@endsection
