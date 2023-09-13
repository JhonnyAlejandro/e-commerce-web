<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_information extends Model
{
    use HasFactory;

    public function shipping_information()
{
    return $this->hasOne(Shipping_information::class, 'sales_id');
}
}
