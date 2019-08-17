<div>
    <h4>Заказ №{{ $order->id }} завершен</h4>
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->name }} x {{ $product->pivot->quantity }}</li>
        @endforeach
    </ul>
    <hr>
    <span>Стоимость заказа: {{ $order->getPrice() }}</span>
</div>
