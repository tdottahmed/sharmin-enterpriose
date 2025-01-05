<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $appends = ['identifier'];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function documents()
    {
        return $this->hasMany(ClientOrderDocument::class);
    }

    public function getIdentifierAttribute()
    {
        return $this->id . ' - ' . $this->name;
    }
}
