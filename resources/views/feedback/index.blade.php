@extends('layouts.main')
@section('title')
    @parent Отзывы
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все отзывы</h1>

            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                пусто
            </div>
        </div>
        <a  href="{{ route('feedback.create') }}" class="btn btn-success">Добавить</a>
    </div>
@endsection


