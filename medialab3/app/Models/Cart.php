<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
