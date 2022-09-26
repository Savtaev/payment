@extends('layouts.admin')

@section('content')
    <h2>Register</h2>
    <form method="POST" action="/admin/users">
        @csrf
        <!-- button with a dropdown -->
        <div class="form-check">
            <input class="form-check-input" style="cursor:pointer" type="radio" name="usertype" id="flexRadioDefault1"
                   value="1">
            <label class="form-check-label" style="cursor:pointer" for="flexRadioDefault1">
                Бизнес
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" style="cursor:pointer" type="radio" name="usertype" id="flexRadioDefault2"
                   checked value="2">
            <label class="form-check-label" style="cursor:pointer" for="flexRadioDefault2">
                Клиент
            </label>
        </div>
        @include('auth.business_form')
        @include('auth.client_form')
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>
    @include('layouts.formerrors')
    <style>
        .userType1 {
            display: none;
        }
    </style>
    <script>
        let flexRadioDefault1 = document.querySelector('#flexRadioDefault1')
        let flexRadioDefault2 = document.querySelector('#flexRadioDefault2')

        let firstTypeElems = document.querySelectorAll('.userType1')
        let secondTypeElems = document.querySelectorAll('.userType2')

        flexRadioDefault1.onchange = toggleFormInput
        flexRadioDefault2.onchange = toggleFormInput

        function toggleFormInput(e) {
            if (e.target.value == 1) {
                show(firstTypeElems)
                hide(secondTypeElems)
            } else if (e.target.value == 2) {
                show(secondTypeElems)
                hide(firstTypeElems)
            }
        }

        hide = (elements) => elements.forEach(element => element.style.display = 'none')
        show = (elements) => elements.forEach(element => element.style.display = 'block')

    </script>
@endsection
