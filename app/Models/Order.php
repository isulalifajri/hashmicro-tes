<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function statusPesanan()
    {
        return $this->hasOne(StatusPesanan::class)->latestOfMany(); // Ambil yang terbaru
    }

    public function TrackingStatusPesanan()
    {
        return $this->hasMany(StatusPesanan::class);
    }
}
