<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
     protected $fillable = [
        'user_id', 'delivery_address', 'payment_method',
        'total_items', 'total_price', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function details()
    {
        return $this->hasMany(CommandDetails::class);
    }
    public function products()
{
    return $this->hasMany(CommandDetails::class); // ou la relation intermédiaire
}
    public function payment()
{
    return $this->hasOne(Payment::class);
}
    public function recuperation()
{
    return $this->hasOne(Recuperation::class);
}



}
