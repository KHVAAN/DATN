<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    use HasFactory;
    protected $table = 'Product_detail';

    protected $fillable = [
        'sanpham_id',
        'mau_id',
        'size_id',
        'dongia',
        'soluong',
        'giamgia',
        'trangthai',
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'sanpham_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'mau_id', 'id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}