<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    use HasFactory;
    protected $fillable = [
        'desk_id',
        'status' // 1 ise adisyon aktif 0 ise adisyon pasif
    ];

    // ürün ve adisyon arasında çok çok ilişki
    public function products()
    {
        return $this->belongsToMany(Product::class, 'adicional_product', 'adicional_id', 'product_id');
    }

    // masa ve adisyon arasında 1-1 ilişki
    public function desk()
    {
        return $this->belongsTo(Desk::class, 'desk_id', 'id');
    }

    // adisyon ve adisyon ürün arasında 1-çok ilişki
    public function adicionalProduct()
    {
        return $this->hasMany(AdicionalProduct::class);
    }

}
