<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    public $primaryKey = 'id_promo';
    protected $fillable = [
        'code_promo', 'discount', 'start_date', 'end_date', 'review_date'
    ];

    public function transaction() {
        return $this->belongsToMany(Transaction::class, 'promo_transactions');
    }
}
