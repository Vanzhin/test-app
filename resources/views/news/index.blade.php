@extends('layouts.main')
@section('title')
    @parent Все новости
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все новости</h1>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @include('inc.message')

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @forelse($newsList as $news)
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-img" style="position: relative">
                                <img src="@if($news->image){{ Storage::disk('public')->url($news->image) }}@else{{ Storage::disk('public')->url('images/news/default.png') }}@endif" class="card-img-top" alt="{{ $news->title }}">
                                <strong>
                                    <p class="card-text " style="position: absolute; top: 50%;left: 15%;width: 80%; color: white; text-align: center; font-size: large">{{  $news->title }}</p>
                                </strong>

                            </div>
                            <div class="card-body">
                                <strong>
                                    <p class="card-text">{!! $news->description !!}</p>
                                </strong>
                                <p class="card-text"> Автор: {{ $news->author }}</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $news->id }}">
                                    Подписаться на {{ $news->author }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_{{ $news->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Оформить подписку на автора {{ $news->author }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{ route('subscribe.store') }}">
                                                @csrf
                                            <div class="modal-body">
                                                При появлении новых статей автора Вы будете получать уведомления по email
                                                @guest
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @endguest
                                                @auth
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus hidden>
                                                @endauth
                                                <input id="subject_type" type="text" class="form-control" name="subject_type" value="author" autofocus hidden>
                                                <input id="subject" type="text" class="form-control" name="subject" value="{{ $news->author }}" autofocus hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                                                <button type="submit" class="btn btn-outline-success">Пописаться</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text"> Добавлено: {{ $news->created_at }}</p>
                                <div class="d-flex justify-content-between align-items-center" style="flex-direction: column">
                                    <div class="btn-group">
                                        <a href="{{ route('news.show',['news' => $news->id]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                    </div>
                                    <small class="text-muted">Категории:</small>

                                    <div class="list-group">
                                        @forelse($news->categories as $category)
                                            <a href = "{{ route('news.categories.show',['category' => $category]) }}" class="list-group-item list-group-item-action">{{ $category->title }}</a>
                                        @empty
                                            Нет категории
                                        @endforelse
                                    </div>

                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            {{ $newsList->onEachSide(0)->links() }}
        </div>
    </div>
@endsection

