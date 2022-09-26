@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">Пользователи</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-0" style="display: block;">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Тип</th>
                        <th>Счет</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><a href="pages/examples/invoice.html">{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->BIN)
                                <span class="badge badge-warning">Бизнес</span>
                            @else
                                <span class="badge badge-success">Клиент</span>
                            @endif
                        </td>
                        <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $user->account }}</div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
