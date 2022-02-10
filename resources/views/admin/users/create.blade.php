@extends('layouts.admin')
@section('title')
    Добавление Пользовтеля @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавление пользователя</h1>

    </div>
@endsection
@section('content')

    <form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            @foreach ($userFields as  $item)
                @error($item)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'email')
                    <div class="input-group">
                        <input type="email" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    @continue
                @endif
                @if($item === 'is_admin')
                    <div class="form-check">
                        <input class="form-check-input" value="1" type="checkbox" id="{{ $item }}" name="{{ $item }}[]"
                               @if(is_array(old($item)) && in_array(1,old($item))) checked @endif>
                        <label class="form-check-label" for="{{ $item }}">
                            Администратор
                        </label>
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

