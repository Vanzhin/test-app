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

    <div>
        <div>
            @foreach ($news as $key => $item)
            <p>Поле: {{ $key }}</p>
            <input type="text" name="{{ $key }}">
            <?php endforeach;?>
            <p>Поле для подробного описания новости: </p>
            <textarea name="full_description"
                      rows="5" cols="50" >
    </textarea>
            <br>
            <br>
                <a href="{{ route('admin.news.store') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить</a>

        </div>
    </div>

@endsection

