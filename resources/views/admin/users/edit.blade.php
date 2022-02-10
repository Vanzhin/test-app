@extends('layouts.admin')
@section('title')
    Обновление данных пользователя @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Обновление данных пользователя</h1>

    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.users.update', ['user' => $user]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            @foreach ($userFields as $item)
                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @error($item)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if($item === 'is_admin')
                    <div class="form-check">
                        <input class="form-check-input" value="1" type="checkbox" id="{{ $item }}" name="{{ $item }}[]"
                               @if(is_array($user->is_admin) && in_array(1,$user->is_admin)) checked @endif>
                        <label class="form-check-label" for="{{ $item }}">
                            Администратор
                        </label>
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" @if($item !== 'password') value="{{$user->$item}}"@endif>
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Обновить</button>
    </form>
@endsection


