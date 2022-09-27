<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'price',
        'discount',
        'stock',
        'status',
        'menu_id',
        'parent_id',
    ];

    public function menus()
    {
        return $this->hasOne(Menu::class, 'id', 'id');
    }

    public function submenus()
    {
        return $this->hasOne(Menu::class, 'parent_id', 'id');
    }

    public function product_menus()
    {
        return $this->hasMany(ProductMenu::class, 'product_id', 'id');
    }



}
