<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @property string $name
 * @property integer $price
 * @property integer $vendor_id
 */
class Product extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
