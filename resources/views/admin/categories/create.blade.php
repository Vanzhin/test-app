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
    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf
        @foreach ($categoryList as $item)
            @if($item === 'title' or $item === 'description')
                <div class="form-group">
                    <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                    <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}">
                    <br>
                    <br>
                </div>
            @endif
        @endforeach
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

