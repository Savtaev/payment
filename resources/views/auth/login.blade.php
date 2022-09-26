@extends('layouts.main')

@section('content')

    <h2>Войти</h2>

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label for="email_or_phone_number">Логин:</label>
            <input type="text" class="form-control" id="email_or_phone_number" name="email_or_phone_number">
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Войти</button>
        </div>
        @include('layouts.formerrors')
    </form>

@endsection
