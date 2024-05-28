<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'category_id');
    }

    public function items(){
        return $this->hasMany(Item::class, 'product_id');
    }

    public function getRemainingAttribute(){
        return $this->items()->where('availability', 1)->count();
    }

    public function getAllAttribute(){
        return $this->items()->count();
    }
}
