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

    public function submenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->where('status', 1);
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'menu_id', 'id')->where('status', 1);
    }

    public function subproducts()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }


}
