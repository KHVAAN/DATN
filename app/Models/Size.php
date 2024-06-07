<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'Size';
    protected $fillable = [
        'tensize',
        'trangthai',
    ];

    public function product_detail()
    {
        return $this->hasMany(Product_detail::class, 'size_id', 'id');
    }
}