@extends('layouts.main')

@section('content')
    @hasrole('Business')
    <h2>₸ {{ $user_account }}</h2>
    @else
        <h2>Бонусов: {{ $data }}</h2>
    @endhasrole
    @can('top-up-account')
        <button type="button" value="myself" class="toggle-btn btn btn-primary" data-toggle="modal" data-target="#cardModal" data-whatever="Пополнить счет">
            Пополнить счет
        </button>
        <a href="{{ route('top-up-account') }}"></a>
        <h3>Клиенты</h3>
        <ul class="list-group">
            @foreach ($clients as $client)
                <li class="list-group-item">
                    <span>{{ $client->name }}</span>
                    <button type="button" value="{{ $client->id }}" class="toggle-btn btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="{{ $client->name }}">Отпарвить бонусы</button>
                </li>
            @endforeach
        </ul>
        <h3>Мои транзакции</h3>
        <ul class="list-group">
            @foreach ($user_payments as $user_payment)
                <li class="list-group-item">
                    <span>Номер платежа:{{ $user_payment->id }}</span> |
                    <span>Сумма платежа: {{ $user_payment->amount }} ₸</span> |
                    @if($user_payment->status == 'success')
                        <span style="color: forestgreen;">Статус: {{ $user_payment->status_desc }}</span> |
                    @else
                        <span style="color: red;">Статус: {{ $user_payment->status_desc }}</span> |
                    @endif
                    <span>Дата:{{ $user_payment->created_at }}</span>
                </li>
            @endforeach
        </ul>
        <div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="top-up-account-form" action="/top-up-account">
                            @csrf
                            <div class="form-group">
                                <label for="sum" class="col-form-label">Сумма:</label>
                                <input type="text" class="form-control" id="sum" placeholder="0" name="amount">
                            </div>
                            @include('card')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="top-up-account-form" class="btn btn-primary">Начислить</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="send-bonuses-form" action="/send-bonuses">
                            @csrf
                            <div class="form-group">
                                <label for="sum" class="col-form-label">Сумма:</label>
                                <input type="text" class="form-control" id="amount" placeholder="0" name="sum">
                            </div>
                            <div class="form-group">
                                <span>Остаток на счете после списания: <span>350.00</span></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" form="send-bonuses-form" class="form-control" id="user" placeholder="0" name="user_id">
                        <button type="submit" form="send-bonuses-form" class="btn btn-primary">Начислить</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelectorAll('.toggle-btn').forEach(elem => {
                elem.onclick = function () {
                    document.querySelector('#user').value =  elem.value
                }
            })
        </script>
    @endcan
@endsection
<style>
    ul{
        list-style: none;
        margin: 0;
        padding: 0;
    }
    ul li{

    }
</style>


