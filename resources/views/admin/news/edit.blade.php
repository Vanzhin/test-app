@extends('layouts.admin')
@section('title')
    Обновление новости @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Обновление новости</h1>

    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            @foreach ($newsFields as  $item)

                <label for="{{ $item }}"><p>Поле для : {{ $item }}</p></label>
                @error($item)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if($item === 'status')
                    <select name="status" id="status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option @if($news->status === 'draft') selected @endif value="draft" >draft</option>
                        <option @if($news->status === 'active') selected @endif value="active">active</option>
                        <option @if($news->status === 'blocked') selected @endif value="blocked">blocked</option>
                    </select>
                    @continue
                @endif
                @if($item === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $item }}" name="{{ $item }}" >{{$news->$item}}</textarea>
                    @continue
                @endif
                @if($item === 'image')
                        <small class="text-muted">Текущая картинка  @if(is_null($news->$item))отсутствует @else {{$news->$item}}@endif</small>
                    <div class="input-group">
                        <input type="file" class="form-control" id="{{ $item }}" name="{{ $item }}"  aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $item }}" name="{{ $item }}" value="{{$news->$item}}">
            @endforeach
            <label for="categories"><p>Выбрать категорию(и)</p></label>
                @error('categories')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            <select multiple name = "categories[]" id = "categories" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                @foreach($categories as $category)
                    <option @if(in_array($category->id ,$newsCategories)) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"  class="btn btn-success">Обновить</button>
    </form>
@endsection


