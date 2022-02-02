@extends('layouts.admin')
@section('title')
    Добавить отзыв @parent
@endsection

@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить отзыв</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.feedbacks.store') }}">
        @include('inc.message')
        @csrf
        <div class="form-group">
            @foreach ($feedbackFields as  $item)

                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{old($item)}}</textarea>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}">
            @endforeach
        </div>
        <div class="form-group" style="margin-top: 10px;">
        <button type="submit"  class="btn btn-success">Добавить</button>
        </div>
    </form>
@endsection

