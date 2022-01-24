@extends('layouts.admin')
@section('title')
    Добавление новости @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавление новости</h1>

    </div>
@endsection
@section('content')

    <form method="post" action="{{ route('admin.news.store') }}">
        @if($errors->any())
            <div class="form-group">
                @foreach($errors->all() as $error)
                    @component('components.alert',['type' => 'danger', 'message' => $error])
                    @endcomponent
                @endforeach
            </div>

        @endif
    @csrf
        <div class="form-group">
            @foreach ($news as $key => $item)

                @if($key === 'id' or $key === 'created_at')
                    @continue;
                @endif

                <label for="{{ $key }}"><p>Поле для : {{ $key }}</p></label>
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{old($key)}}">
            @endforeach
        </div>
        <div class="form-group">
            <label for="full_description"><p>Поле для подробного описания новости: </p></label>
            <br>
            <textarea name="full_description" rows="5" cols="50" id="full_description">{{old('full_description')}}</textarea>
            <br>
        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>

    </form>


@endsection

