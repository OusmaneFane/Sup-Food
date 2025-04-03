<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   protected $fillable = [
        'command_id', 'user_id', 'amount_given', 'change_due', 'payment_method',
    ];

    public function command()
    {
        return $this->belongsTo(Command::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
