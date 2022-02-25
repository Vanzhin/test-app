@extends('layouts.main')
@section('title')
    @parent Мой профиль
@endsection

@section('content')
    @if(Auth::user())
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="bd-placeholder-img rounded-circle"  src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif"  width="140" height="140">
                        <h2>{{Auth::user()->name}}</h2>
                        <p>Отображение информации профиля</p>
                        <p>Вы заходили последний раз {{Auth::user()->last_login_at}}</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <p>Профиль не существует</p>
    @endif

@endsection

