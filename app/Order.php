<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @property integer $status
 * @property string $client_email
 * @property integer $partner_id
 */
class Order extends Model
{
    #statuses
    const NEW = 'Новый';
    const CONFIRMED = 'Подтвержден';
    const COMPLETED = 'Завершен';

    const STATUSES = [
        0 => self::NEW,
        10 => self::CONFIRMED,
        20 => self::COMPLETED,
    ];

    public function getStatusAttribute()
    {
        return self::STATUSES[$this->attributes['status']];
    }

    /**
     * @param string $status
     * @return false|int
     */
    public static function getStatusCode(string $status)
    {
        return array_search($status, self::STATUSES);
    }

    /**
     * Set the total price per products
     *
     * @param Collection<Order> $orders
     * @return Collection<Order>
     */
    public static function setPrice($orders)
    {
        foreach ($orders as $order) {
            $order->total_price = $order->getPrice();
        }

        return $orders;
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price');
    }

    /**
     * Get total order price
     *
     * @return int
     */
    public function getPrice()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->pivot->quantity * $product->price;
        }

        return $sum;
    }
}
