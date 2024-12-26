<?php

namespace App\Models;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['client_name', 'remaining_date'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->order_no = static::generateUniqueOrderNo();
        });
    }

    private static function generateUniqueOrderNo(): string
    {
        do {
            $orderNo = rand(100000, 999999);
        } while (self::where('order_no', $orderNo)->exists());

        return $orderNo;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getClientNameAttribute()
    {
        return $this->client ? $this->client->name : null;
    }
    public function getRemainingDateAttribute()
    {
        return now()->diff($this->due_date)->format('%d days');
    }
}
