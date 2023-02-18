<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    use HasFactory;
    // modeli oluştururken oluşturulacak tablonun adını belirtiyoruz
    protected $table = 'desks';
    // kullanıcının erişim sağlayabileceği alanları belirtiyoruz
    protected $fillable = [
        'number',
        'capacity',
        'status', // 0: dolu, 1: boş
        'user_id',
        'adicional_id',
    ];

    // bir masa birden fazla ürünü içerebilir bunun için bir ilişki kuruyoruz
    // product tablosu ile ilişki kuruyoruz(bire çok ilişki)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // masa ve adisyon arasında 1-1 ilişki
    public function adicional()
    {
        return $this->hasOne(Adicional::class)->where('status', 1);
    }
}
