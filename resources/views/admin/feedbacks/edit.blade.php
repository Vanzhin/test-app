@extends('layouts.admin')
@section('title')
    Обновление отзыва @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Обновление отзыва</h1>
    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.feedbacks.update', ['feedback' => $feedback]) }}">
        @include('inc.message')
        @csrf
        @method('put')
        <div class="form-group">
            @foreach ($feedbackFields as  $item)

                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'message')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{$feedback->$item}}</textarea>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{$feedback->$item}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Обновить</button>
    </form>
@endsection



