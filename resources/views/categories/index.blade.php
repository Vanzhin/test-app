@extends('layouts.main')
@section('title')
    @parent Категории новостей
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все категории</h1>

            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse($categoryList as $category)

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('news.categories.show',['category' => $category]) }}" type="button" class="btn btn-sm btn-outline-secondary">Все новости категории</a>
                        </div>
                    </div>
        @empty
            <h2>Записей нет</h2>
        @endforelse
        </div>
            {{ $categoryList->onEachSide(0)->links() }}
    </div>

</div>


@endsection


