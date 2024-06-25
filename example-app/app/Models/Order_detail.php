<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'oder_detail';
    protected $fillable = [
        'ma_hd',
        'sp_id',
        'chitietsp_id',
        'soluong',
        'giaohang',
        'thanhtien',
        'diachi',
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'sp_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'id', 'ma_hd');
    }
    public function ordertail()
    {
        return $this->belongsTo(Order_detail::class, 'chitietsp_id', 'id');
    }
}