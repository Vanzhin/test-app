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
        <div class="form-group">
            @foreach ($categoryFields as  $item)
                @error($item)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{old($item)}}</textarea>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

