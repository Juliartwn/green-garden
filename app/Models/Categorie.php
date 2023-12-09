<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $primaryKey = 'id_category';
    protected $fillable = [
        'name_category', 'desc_category'
    ];

    public function products() {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}
