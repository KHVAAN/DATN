<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Order';
    protected $fillable = [
        'ma_kh',
        'ngay_lap_hoa_don',
        'ngay_nhan_hang',
        'ttthanhtoan',
        'ttvanchuyen',
        'trangthai',
    ];
    public function orderdetail()
    {
        return $this->hasOne(Order_detail::class, 'ma_hd', 'id');
    }
}