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
            @foreach ($news as  $item)

                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'status')
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option value="draft" selected>draft</option>
                        <option value="active">active</option>
                        <option value="blocked">blocked</option>

                    </select>
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

