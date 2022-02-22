@extends('layouts.admin')
@section('title')
    Обновление данных источника @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Обновление данных источника</h1>
    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.resources.update', ['resource' => $resource]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            @foreach ($resourceFields as $item)
                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @error($item)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if($item === 'is_active')
                    <div class="form-check">
                        <input class="form-check-input" value="1" type="checkbox" id="{{ $item }}" name="{{ $item }}[]"
                               @if($resource->is_active) checked @endif>
                        <label class="form-check-label" for="{{ $item }}">
                            Активнный источник?
                        </label>
                    </div>
                    @continue
                @endif

                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{$resource->$item}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Обновить</button>
    </form>
@endsection


