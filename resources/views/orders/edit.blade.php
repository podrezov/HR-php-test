@extends('layouts.app')

@section('content')
    <div class="row">
        <h4 class="text-center">Редактирование заказа #{{ $order->id }}</h4>
        <div class="col-md-6 col-md-offset-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orders.update', $order) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label>Email клиента</label>
                    <input type="email" class="form-control" value="{{ $order->client_email ?? old('client_email') }}"
                           name="client_email" required>
                </div>

                <div class="form-group">
                    <label>Партнер</label>
                    <select name="partner" class="form-control">
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}" {{ $partner->id === $order->partner_id ? 'selected' : '' }}>{{ $partner->id }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Статус заказа</label>

                    <select name="status" class="form-control">
                        @foreach($statuses as $key => $status)
                            <option value="{{ $key }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Продукты</label>

                    @foreach($order->products as $product)
                        <div>{{ $product->name }} x {{ $product->pivot->quantity }}</div>
                    @endforeach
                </div>

                <div class="form-group">
                    Стоимость заказа: {{ $order->getPrice() }}
                </div>

                <button class="btn btn-primary">Сохранить</button>
                <a href="{{ route('orders.index') }}" class="btn btn-danger">Назад</a>
            </form>
        </div>
    </div>
@endsection