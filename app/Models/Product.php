<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $primaryKey = 'id_product';
    protected $fillable = [
        'name_product', 'desc_product', 'price', 'stock', 'id_seller', 'id_category', 'img_product'
    ];

    public function cart() {
        return $this->hasMany(Cart::class, 'id_product', 'id_product');
    }
    public function seller() {
        return $this->belongsTo(Seller::class, 'id_seller', 'id_seller');
    }
    public function category() {
        return $this->belongsTo(Categorie::class, 'id_category', 'id_category');
    }
    public function transaction() {
        return $this->hasMany(Transaction::class, 'id_product', 'id_product');
    }
    public function review() {
        return $this->hasMany(Review::class, 'id_product', 'id_product');
    }

}
