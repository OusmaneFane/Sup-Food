<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{

    protected $fillable = [
        'command_id',
        'recuperee',
        'recuperee_at'
    ];
    public function command()
{
    return $this->belongsTo(Command::class);
}

}
