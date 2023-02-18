<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicionalProduct extends Model
{
    use HasFactory;
    protected $table = 'adicional_product';
    protected $fillable = [
        'adicional_id',
        'product_id',
        'quantity',
        'price'
    ];

    // adisyon ürün ve adisyon arasında 1-1 ilişki
    public function adicional()
    {
        return $this->belongsTo(Adicional::class, 'adicional_id', 'id');
    }

    // adisyon ürün ve ürün arasında 1-1 ilişki
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
