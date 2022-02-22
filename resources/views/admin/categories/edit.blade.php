@extends('layouts.admin')
@section('title')
    Обновление категории @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Обновление категории</h1>
    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}">
        @include('inc.message')
        @csrf
        @method('put')
        <div class="form-group">
            @foreach ($categoryFields as  $item)
                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{$category->$item}}</textarea>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{$category->$item}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Обновить</button>
    </form>
@endsection



