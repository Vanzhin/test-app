@extends('layouts.admin')
@section('title')
    Новости @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-secondary">Добавить</a>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-sm table-hover">
            <thead class="thead-light">
            <tr>
                @foreach($fields as $item)
                    <th scope="col">{{$item}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
                <tr>
                    @foreach($news as $item)
                        <td >{{$item}}</td>
                    @endforeach
                    <td>
                        <div class="d-flex">
                            <a href="#" type="button" class="btn btn-warning">Редактировать</a>
                            <a href="#" type="button" class="btn btn-danger">Удалить</a>
                        </div>
                    </td>
                </tr>
            @empty
                <p>Записей нет</p>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
