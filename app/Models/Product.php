<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $table = 'Product';
    protected $fillable = [
        'tensanpham',
        'loaisp_id',
        'nh_id',
        'mota',
        'trangthai',

    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'nh_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'loaisp_id', 'id');
    }
    public function image()
    {
        return $this->hasMany(Image::class, 'sp_id');
    }

}