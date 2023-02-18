<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'menus';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'order',
        'status',
    ];

    // menü ve ürün arasında 1-1 ilişki
    public function submenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->where('status', 1);
    }

    // menü ve ürün arasında 1-çok ilişki
    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->where('status', 1);
    }

    // menü ve ürün arasında 1-çok ilişki
    public function products()
    {
        return $this->hasMany(Product::class, 'menu_id', 'id')->where('status', 1);
    }

    // menü ve ürün arasında 1-çok ilişki
    public function subproducts()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    // menü ve ürün arasında 1-1 ilişki
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    // menü ve ürün arasında 1-çok ilişki
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }




}
