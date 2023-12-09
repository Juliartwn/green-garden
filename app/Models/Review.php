<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    public $primaryKey = 'id_review';
    protected $fillable = [
        'id', 'id_product', 'rating', 'review', 'review_date'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
