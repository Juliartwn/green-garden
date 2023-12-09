<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $table = 'sellers';
    public $primaryKey = 'id_seller';
    protected $fillable = [
        'id', 'address', 'shop_name', 'desc_shop', 'address_shop'
    ];

    public function products() {
        return $this->hasMany(Product::class, 'id_seller', 'id_seller');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
