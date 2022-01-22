@extends('layouts.admin')
@section('title')
    список категорий @parent
@endsection

@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список категорий</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Удалить</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div>
    @foreach ($categoryList as $category)
    <p>Идентификатор категории: {{ $category['id'] }}</p>
    <p>Название категории: {{ $category['title'] }}</p>
    <p>Дата создания категории: {{ $category['created_at'] }}</p>
    <hr>


    @endforeach
</div>
@endsection
