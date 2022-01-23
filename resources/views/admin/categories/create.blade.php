@extends('layouts.admin')
@section('title')
    Добавить категорию @parent
@endsection

@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить категорию</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
@endsection

@section('content')
    <div>
        @foreach ($categoryList as $key => $item)
        <div>
            <p>Поле для : {{ $key }}</p>
            <input type="text">
            <br>
            <br>
        </div>

        @endforeach
        {{-- TODO route('admin.categories.store') не работает --}}
            <a href="{{ route('admin.categories.store') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить</a>

    </div>
@endsection

