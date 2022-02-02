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
        @include('inc.message')
        <div class="container">
            <div class="list-group">
                <a href="{{ route('feedback.create') }}" type="button" class="btn btn-secondary">Добавить отзыв</a>

                <ul class="list-group">
                    @forelse($feedbacks as $feedback)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $feedback->message }}</div>
                            {{ $feedback->nickName }}
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $feedback->created_at }}</span>
                    </li>
                    @empty
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Отзывов пока нет
                            </div>
                        </li>
                    @endforelse
                </ul>
                {{$feedbacks->links()}}

            </div>

        </div>
@endsection


