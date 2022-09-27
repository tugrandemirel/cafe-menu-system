<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMenu extends Model
{
    use HasFactory;
    protected $table = 'product_menu';
    protected $fillable = [
        'product_id',
        'menu_id',
    ];
}
