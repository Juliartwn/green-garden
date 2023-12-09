<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $primaryKey = 'id_transaction';
    protected $fillable = [
        'id', 'id_product', 'transaction_method', 'transaction_status', 'total_price', 'transaction_date', 'address'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function products() {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }


}
