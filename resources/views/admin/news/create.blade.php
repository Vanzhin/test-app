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

    <form method="post" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
       @include('inc.message')
    @csrf
        <div class="form-group">
            @foreach ($newsFields as  $item)

                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @if($item === 'status')
                    <select name="status" id="status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option value="draft" selected>draft</option>
                        <option value="active">active</option>
                        <option value="blocked">blocked</option>
                    </select>
                    @continue
                @endif
                @if($item === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{old($item)}}</textarea>
                    @continue
                @endif
                @if($item === 'image')
                    <div class="input-group">
                        <input type="file" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{old($item)}}">
            @endforeach
                <label for="categories"><p>Выбрать категорию(и)</p></label>
                <select multiple name = "categories[]" id = "categories" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

