<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commandDetails extends Model
{
    protected $fillable = [
        'command_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
    ];
     protected $casts = [
        'unit_price' => 'integer',
        'total_price' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
     public function command()
    {
        return $this->belongsTo(Command::class);
    }
     /**
     * Relation avec le produit
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Calcul automatique du prix total avant sauvegarde
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_price = $model->quantity * $model->unit_price;
        });
    }
    // Formatage des prix pour l'affichage
public function getFormattedUnitPriceAttribute()
{
    return number_format($this->unit_price, 0, ',', ' ') . ' F CFA';
}
// Dans CommandDetail.php
public function scopeForProduct($query, $productId)
{
    return $query->where('product_id', $productId);
}
}
